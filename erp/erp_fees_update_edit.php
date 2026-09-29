<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}

$edit_id = intval($_GET['id'] ?? 0);
if($edit_id <= 0) die("Invalid record ID");

$username = $_SESSION['tfirst_name'];

// Fetch fee record
$recQ = mysqli_query($conn,"SELECT * FROM student_fees_submitted WHERE id=$edit_id");
if(mysqli_num_rows($recQ)==0) die("Record not found");
$feeRow = mysqli_fetch_assoc($recQ);

// Fetch student info
$stuQ = mysqli_query($conn,"SELECT * FROM studentsdetail WHERE admission_number='".$feeRow['stu_admission_no']."'");
$stu = mysqli_fetch_assoc($stuQ);
$student_id = $stu['Sno'] ?? 0;
if(!$stu) die("Student not found");

// Fetch fee rates like submit.php
$fee_map = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM map_tuition_fees WHERE class='".$stu['class']."' LIMIT 1"));
$conv_map = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM map_convence_fees WHERE trans_admission_no='".$feeRow['stu_admission_no']."' LIMIT 1"));

$tuition_rate = $fee_map['tuition_fees'] ?? 0;
$admission_fee = $fee_map['admission_fees'] ?? 0;
$exam_fee = $fee_map['examination_fees'] ?? 0;
$conv_rate = $conv_map['2026-2027_fees'] ?? 0; // Default session, adjust if needed

$months_list = ["January","February","March","April","May","June","July","August","September","October","November","December"];
$selected_months = ($feeRow['months'] === 'no month selected' || trim($feeRow['months']) === '') ? [] : explode(",", $feeRow['months']);
$msg = "";
$err = "";

// Update submit
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['update_fees'])){
    $session = trim($_POST['session']);
    $months = $_POST['months'] ?? [];
    if(!is_array($months)){
        $months = [];
    }
    $months = array_filter(array_map('trim', $months), function($m){
        return $m !== '';
    });
    $months = array_values(array_unique($months));
    $months_count = count($months);
    $months_csv = $months_count > 0 ? implode(",", $months) : "No Month Selected";

    $add_admission = isset($_POST['add_admission']) ? 1 : 0;
    $add_exam = isset($_POST['add_exam']) ? 1 : 0;
    $other_fees = floatval($_POST['other_fees'] ?? 0);
    $concession_type = trim($_POST['concession_type'] ?? 'fixed');
    $concession_value = floatval($_POST['concession_value'] ?? 0);
    $pending_amount = floatval($_POST['pending_amount'] ?? 0);
    $online = floatval($_POST['online_payment'] ?? 0);
    $offline = floatval($_POST['offline_payment'] ?? 0);
    $total_paid = $online + $offline;

    $payment_mode = "";
    if($online > 0) $payment_mode .= "Online ";
    if($offline > 0) $payment_mode .= "Offline";
    $payment_mode = trim($payment_mode);

    $tuition_total = $tuition_rate * $months_count;

    $conv_total = 0;

foreach ($months as $month) {
    if (strtolower(trim($month)) != 'june') {
        $conv_total += $conv_rate;
    }
}

    // $conv_total = $conv_rate * $months_count;
    $adm_fees = $add_admission ? $admission_fee : 0;
    $exam_fees = $add_exam ? $exam_fee : 0;
    $subtotal = $tuition_total + $conv_total + $adm_fees + $exam_fees + $other_fees;
    $concession_amount = ($concession_type == "percent") ? ($subtotal * $concession_value / 100) : $concession_value;
    $concession_amount = max(0, $concession_amount);
    $grand_total = max(0, $subtotal - $concession_amount - $pending_amount);

    $q = "UPDATE student_fees_submitted SET 
            session='$session',
            months='$months_csv',
            tuition_total='$tuition_total',
            convence_total='$conv_total',
            admission_fees='$adm_fees',
            examination_fees='$exam_fees',
            other_fees='$other_fees',
            subtotal='$subtotal',
            concession_type='$concession_type',
            concession_value='$concession_value',
            concession_amount='$concession_amount',
            pending_amount='$pending_amount',
            grand_total='$grand_total',
            online_payment='$online',
            offline_payment='$offline',
            total_paid='$total_paid',
            payment_mode='$payment_mode',
            narration='$months_csv',
            submitted_by='$username'
            -- updated_at=NOW()
        WHERE id=$edit_id";
    $results = mysqli_query($conn, $q);
    if($results){
        $msg = "✅ Fees record updated successfully! Receipt updated.";
        // Refresh data
        header("Location: ../erp/erp_feessubmit.php?studentfees_id=$student_id");
        exit;
    } else {
        $err = "❌ DB Error: " . mysqli_error($conn);
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fees Reciept</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../erpstyle.css">
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
    <script src="../javascript/function.js"></script>
    <style>
    .back-btn {
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 999;
    }
    </style>
</head>

<body>
    <div class="container my-4">
        <h3 class="text-center text-primary mb-4">💰 Update & Submit Fees</h3>
        <button onclick="goBack()" class="btn btn-secondary back-btn" style="margin-bottom:10px;">
            ← Back to Student Fees
        </button>
        <?php if($msg): ?><div class="alert alert-success alert-dismissible fade show"><?=$msg?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>
        <?php if($err): ?><div class="alert alert-danger alert-dismissible fade show"><?=$err?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>

        <!-- Student Details -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h6>👤 Student: <?= htmlspecialchars($stu['first_name'].' '.$stu['middle_name'].' '.$stu['last_name']) ?> (<?= $stu['class'] ?>)</h6>
            </div>
            <div class="card-body">
                <p><strong>Admission No:</strong> <?= $feeRow['stu_admission_no'] ?></p>
                <p><strong>Father:</strong> <?= htmlspecialchars($stu['father_name']) ?></p>
                <a href="../erp/erp_feessubmit.php?studentfees_id=<?= $stu['Sno'] ?>" class="btn btn-outline-primary btn-sm">📋 View All Fees</a>
            </div>
        </div>

        <div class="row g-3">

            <div class="col-md-8">
                <div class="card p-4">

                    <form method="POST" id="fees-update-form">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Session <small class="text-muted">(Current: <?= htmlspecialchars($feeRow['session']) ?>)</small></label>
                                <select name="session" class="form-select" required>
                                    <option value="2025-2026" <?= ($feeRow['session']=='2025-2026') ? 'selected' : '' ?>>2025-2026</option>
                                    <option value="2026-2027" <?= ($feeRow['session']=='2026-2027') ? 'selected' : '' ?>>2026-2027</option>
                                    <option value="2027-2028" <?= ($feeRow['session']=='2027-2028') ? 'selected' : '' ?>>2027-2028</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label>Select Months <small class="text-muted">(Hold Ctrl/Cmd to select multiple. Current: <?= count($selected_months) ?> months)</small></label>
                                <select id="narration" name="months[]" multiple>
                                    <?php 
                                    $months_list = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                                    foreach($months_list as $m) { 
                                        $selected = in_array($m, $selected_months) ? 'selected' : '';
                                        echo "<option value='$m' $selected>$m</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-4 form-check">
                                <input type="checkbox" class="form-check-input" id="add_admission" name="add_admission" <?= (floatval($feeRow['admission_fees'])>0) ? 'checked' : '' ?>>
                                <label class="form-check-label">Admission Fee (₹<?= $admission_fee ?>)</label>
                            </div>
                            <div class="col-md-4 form-check">
                                <input type="checkbox" class="form-check-input" id="add_exam" name="add_exam" <?= (floatval($feeRow['examination_fees'])>0) ? 'checked' : '' ?>>
                                <label class="form-check-label">Exam Fee (₹<?= $exam_fee ?>)</label>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="other_fees" id="other_fees" class="form-control" placeholder="Other Fees" value="<?= $feeRow['other_fees'] ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>Concession Type <small class="text-muted">(Current: <?= htmlspecialchars($feeRow['concession_type']) ?>)</small></label>
                                <select id="concession_type" name="concession_type" class="form-select">
                                    <option value="fixed" <?= ($feeRow['concession_type']=='fixed') ? 'selected' : '' ?>>Fixed</option>
                                    <option value="percent" <?= ($feeRow['concession_type']=='percent') ? 'selected' : '' ?>>Percent</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Concession Value (<?= $feeRow['concession_type']=='percent' ? '%' : '₹' ?>)</label>
                                <input type="number" id="concession_value" name="concession_value" class="form-control" min="0" value="<?= $feeRow['concession_value'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label>Pending Amt (₹)</label>
                                <input type="number" id="pending_amount" name="pending_amount" class="form-control" min="0" value="<?= $feeRow['pending_amount'] ?>">
                            </div>
                        </div>

                        <div class="p-3 bg-light rounded">
                            <h6 class="mb-2">Summary</h6>
                            <p>Tuition/month: ₹<?=$tuition_rate?></p>
                            <p>Bus/month: ₹<?=$conv_rate?></p>
                            <hr>
                            <p><b>Months:</b> <span id="months_count">0</span></p>
                            <p><b>Subtotal:</b> ₹<span id="subtotal_preview">0</span></p>
                            <p><b>Concession:</b> ₹<span id="concession_preview">0</span></p>
                            <p><b>Pending:</b> ₹<span id="pending_preview">0</span></p>
                            <h5 class="text-success"><b>Total:</b> ₹<span id="grand_preview">0</span></h5>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Online Payment (₹) <small class="text-muted">(Current: <?= $feeRow['online_payment'] ?>)</small></label>
                                <input type="number" name="online_payment" class="form-control" min="0" value="<?= $feeRow['online_payment'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Offline Payment (₹) <small class="text-muted">(Current: <?= $feeRow['offline_payment'] ?>)</small></label>
                                <input type="number" name="offline_payment" class="form-control" min="0" value="<?= $feeRow['offline_payment'] ?>">
                            </div>
                        </div>

                        <button type="submit" name="update_fees" class="btn btn-primary w-100 mt-3">💾 Update Fees</button>
                    </form>

                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
        </script>
        <script>
        const ch = new Choices('#narration', {
            removeItemButton: true,
            shouldSort: false
        });
        const tuition = <?=$tuition_rate?>,
            conv = <?=$conv_rate?>,
            adm = <?=$admission_fee?>,
            exam = <?=$exam_fee?>;

        // Prefill checkboxes based on current data
        document.addEventListener('DOMContentLoaded', function() {
            calc(); // Initial calc
        });

        function calc() {
            let selectedMonths = ch.getValue(true);
            let m = ch.getValue(true).length;

            
            // June does not have conveyance fees
            let convMonths = selectedMonths.filter(
                month => month.toLowerCase().trim() !== 'june'
            ).length;


            let addAdm = document.getElementById('add_admission').checked ? adm : 0;
            let addExam = document.getElementById('add_exam').checked ? exam : 0;
            let other = parseFloat(document.getElementById('other_fees').value || 0);
           
            
            let tuitionTotal = tuition * m;
            let convTotal = conv * convMonths;

            let subtotal = tuitionTotal + convTotal + addAdm + addExam + other;

            
            let ctype = document.getElementById('concession_type').value;
            let cval = parseFloat(document.getElementById('concession_value').value || 0);
            let pend = parseFloat(document.getElementById('pending_amount').value || 0);
            let concess = (ctype === 'percent') ? (subtotal * cval / 100) : cval;
            let grand = subtotal - concess - pend;
            if (grand < 0) grand = 0;

            document.getElementById('months_count').textContent = m;
            document.getElementById('subtotal_preview').textContent = subtotal.toFixed(2);
            document.getElementById('concession_preview').textContent = concess.toFixed(2);
            document.getElementById('pending_preview').textContent = pend.toFixed(2);
            document.getElementById('grand_preview').textContent = grand.toFixed(2);
        }
        ["change", "input"].forEach(e => {
            document.body.addEventListener(e, calc);
        });
        calc();


        function goBack() {
            window.history.back();
        }

        </script>
</body>

</html>