<?php include '../backend/connection.php';
$showmsg = false;
session_start();
?>
<?php
$username = $_SESSION['tfirst_name'];
if(!isset($_SESSION['loggedin'])){
    header("Location: ../partials/erp_login.php");
    exit;
}

$prefix = date("Ym");

$sql = "SELECT MAX(reciept_no) as last_receipt 
        FROM student_fees_submitted 
        WHERE reciept_no LIKE '$prefix%'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
if($row['last_receipt'] != NULL){
    $last_number = substr($row['last_receipt'],6);
    $next_number = $last_number + 1;
}else{
    $next_number = 1;
}
$sequence = str_pad($next_number,4,"0",STR_PAD_LEFT);
$receipt_no = $prefix.$sequence;


// Get student
$id = isset($_GET['studentfees_id']) ? intval($_GET['studentfees_id']) : 0;
if($id <= 0) die("Missing student ID");

$stu = mysqli_query($conn,"SELECT * FROM studentsdetail WHERE Sno=$id");
if(!$stu || mysqli_num_rows($stu)==0) die("Student not found");
$student = mysqli_fetch_assoc($stu);

$admissionno = $student['admission_number'];
$student_class = $student['class'];
$student_village = $student['village'];
$showmsg = $err = "";

// Fee mapping fetch
$fee = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM map_tuition_fees WHERE class='$student_class' LIMIT 1"));
$conv = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM map_convence_fees WHERE trans_admission_no='$admissionno' LIMIT 1"));

$tuition_rate = $fee['tuition_fees'] ?? 0;
$admission_fee = $fee['admission_fees'] ?? 0;
$exam_fee = $fee['examination_fees'] ?? 0;
$other_default = $fee['other_fees'] ?? 0;
$conv_rate = $conv['2026-2027_fees'] ?? 0;

function clean($v){ return trim($v); }

if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['fees_submit'])){
    $session = clean($_POST['session']);
    $months = isset($_POST['narration']) && is_array($_POST['narration']) ? array_filter($_POST['narration']) : [];
    $months_csv = count($months) > 0 ? implode(",", $months) : "No Month Selected";
    $months_count = count($months);

    $add_admission = isset($_POST['add_admission']) ? 1 : 0;
    $add_exam = isset($_POST['add_exam']) ? 1 : 0;

    $other_charges = floatval($_POST['other_charges'] ?? 0);

    // ✅ FIXED concession handling
    $concession_type = isset($_POST['concession_type']) ? clean($_POST['concession_type']) : "fixed";
    $concession_value = isset($_POST['concession_value']) ? floatval($_POST['concession_value']) : 0;
    $pending_amount = floatval($_POST['pending_amount'] ?? 0);
    $online_payment  = floatval($_POST['online_payment'] ?? 0);
$offline_payment = floatval($_POST['offline_payment'] ?? 0);
$total_paid = $online_payment + $offline_payment;

$payment_mode = "";
if($online_payment > 0) $payment_mode .= "Online ";
if($offline_payment > 0) $payment_mode .= "Offline";
$payment_mode = trim($payment_mode);

    $tuition_total = $tuition_rate * $months_count;
    // $conv_total = $conv_rate * $months_count;

    $conv_total = 0;

foreach ($months as $month) {
    if (strtolower(trim($month)) != 'june') {
        $conv_total += $conv_rate;
    }
}

    $admission_amt = $add_admission ? $admission_fee : 0;
    $exam_amt = $add_exam ? $exam_fee : 0;

    $subtotal = $tuition_total + $conv_total + $admission_amt + $exam_amt + $other_charges;

    $concession_amount = ($concession_type=="percent") ? ($subtotal * $concession_value/100) : $concession_value;
    if($concession_amount < 0) $concession_amount = 0;

    $grand_total = $subtotal - $concession_amount - $pending_amount;
    if($grand_total < 0) $grand_total = 0;

    if(empty($err)){
       $q = "INSERT INTO student_fees_submitted 
(stu_admission_no,reciept_no,class,session,months,tuition_total,convence_total,
admission_fees,examination_fees,other_fees,subtotal,
concession_type,concession_value,concession_amount,pending_amount,
grand_total,online_payment,offline_payment,total_paid,payment_mode,narration,submitted_by,created_at)
VALUES 
('$admissionno',$receipt_no,'$student_class','$session','$months_csv','$tuition_total','$conv_total',
'$admission_amt','$exam_amt','$other_charges','$subtotal','$concession_type',
'$concession_value','$concession_amount','$pending_amount','$grand_total',
'$online_payment','$offline_payment','$total_paid','$payment_mode','$months_csv','$username',NOW())";

        if(mysqli_query($conn,$q)){
            $showmsg = "✅ Fees submitted successfully!";
        } else {
            $err = "DB Error: " . mysqli_error($conn);
        }
    }
}
$session = "2026-2027";
                if(isset($_POST['session'])){
                    $session = $_POST['session'];
                }
// ✅ Fetch previous fee records
$prevFeesQuery = mysqli_query($conn, 
    "SELECT * FROM student_fees_submitted 
     WHERE stu_admission_no = '$admissionno' AND session = '$session'
     ORDER BY id DESC"
);
?>

<!-- this code for pending amount -->
<?php
$idss = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['print_receipt'])) {

    $idss = intval($_POST['pay_id']);
    $update_sql = "UPDATE student_fees_submitted
                   SET pending_amount = 0
                   WHERE id = $idss";
    mysqli_query($conn, $update_sql);
    header("Location: " . $_SERVER['PHP_SELF'] . "?studentfees_id=" . $id);
}
?>

<?php
      $id = $_GET['studentfees_id'];
      $sql = "SELECT * FROM `studentsdetail` WHERE Sno = $id";
      $result= mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
      $admissionno = $row['admission_number'];
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
            $admission_fees = $_POST['admission_fees'];
            $prevous_pending = $_POST['previous_pending'];
            $examination_fees = $_POST['examination_fees'];
            $april_tuition_fees = $_POST['tuition_apr'];
            $april_bus_fees = $_POST['bus_apr'];
            $may_tuition_fees = $_POST['tuition_may'];
            $may_bus_fees = $_POST['bus_may'];
            $june_tuition_fees = $_POST['tuition_jun'];
            $june_bus_fees = $_POST['bus_jun'];
            $july_tuition_fees = $_POST['tuition_jul'];
            $july_bus_fees = $_POST['bus_jul'];
            $august_tuition_fees = $_POST['tuition_aug'];
            $august_bus_fees = $_POST['bus_aug'];
            $september_tuition_fees = $_POST['tuition_sep'];
            $september_bus_fees = $_POST['bus_sep'];
            $october_tuition_fees = $_POST['tuition_oct'];
            $october_bus_fees = $_POST['bus_oct'];
            $november_tuition_fees = $_POST['tuition_nov'];
            $november_bus_fees = $_POST['bus_nov'];  
            $december_tuition_fees = $_POST['tuition_dec'];
            $december_bus_fees = $_POST['bus_dec']; 
            $january_tuition_fees = $_POST['tuition_jan'];
            $january_bus_fees = $_POST['bus_jan']; 
            $febuary_tuition_fees = $_POST['tuition_feb'];
            $febuary_bus_fees = $_POST['bus_feb']; 
            $march_tuition_fees = $_POST['tuition_mar'];
            $march_bus_fees = $_POST['bus_mar'];
            // check admission no is inserted are not
            $exist_tuition_sql = "SELECT * FROM `tution_fees` where stu_admission_no = '$admissionno'";
            $exist_tuition_result = mysqli_query($conn, $exist_tuition_sql);
            $row_tuition = mysqli_fetch_assoc($exist_tuition_result);
            $exist_bus_sql = "SELECT * FROM `convenience_fees` WHERE stu_conve_admissionno = '$admissionno'";
            $exist_bus_result = mysqli_query($conn, $exist_bus_sql);
            $row_bus = mysqli_fetch_assoc($exist_bus_result);
            if(mysqli_num_rows($exist_tuition_result)>0 && mysqli_num_rows($exist_bus_result)>0){
                $update_tuition_sql = "UPDATE `tution_fees` SET `stu_previous_pending_fees` = '$prevous_pending', `stu_admission_fees` = '$admission_fees', `stu_examination_fees` = '$examination_fees', `stu_tuition_jan` = '$january_tuition_fees', `stu_tuition_feb` = '$febuary_tuition_fees', `stu_tuition_mar` = '$march_tuition_fees', `stu_tuition_apr` = '$april_tuition_fees', `stu_tuition_may` = '$may_tuition_fees', `stu_tuition_jun` = '$june_tuition_fees', `stu_tuition_jul` = '$july_tuition_fees', `stu_tuition_aug` = '$august_tuition_fees', `stu_tuition_sep` = '$september_tuition_fees', `stu_tuition_oct` = '$october_tuition_fees', `stu_tuition_nov` = '$november_tuition_fees', `stu_tuition_dec` = '$december_tuition_fees' WHERE `tution_fees`.`stu_admission_no` = '$admissionno'";
                $update_tuition_result = mysqli_query($conn, $update_tuition_sql);
                $update_bus_sql = "UPDATE `convenience_fees` SET `stu_conve_jan` = '$january_bus_fees', `stu_conve_feb` = '$febuary_bus_fees', `stu_conve_mar` = '$march_bus_fees', `stu_conve_apr` = '$april_bus_fees', `stu_conve_may` = '$may_bus_fees', `stu_conve_jun` = '$june_bus_fees', `stu_conve_jul` = '$july_bus_fees', `stu_conve_aug` = '$august_bus_fees', `stu_conve_sep` = '$september_bus_fees', `stu_conve_oct` = '$october_bus_fees', `stu_conve_nov` = '$november_bus_fees', `stu_conve_dec` = '$december_bus_fees' WHERE `convenience_fees`.`stu_conve_admissionno` = '$admissionno'";
                $update_bus_result = mysqli_query($conn, $update_bus_sql);
                // show updated msg 
                   if($update_tuition_result && $update_bus_result){
                    $showmsg = "Fees updated successful.";
                   }
            }
            else{
                $tuition_insert_sql = "INSERT INTO `tution_fees` (`stu_admission_no`, `stu_previous_pending_fees`, `stu_admission_fees`, `stu_examination_fees`, `stu_tuition_jan`, `stu_tuition_feb`, `stu_tuition_mar`, `stu_tuition_apr`, `stu_tuition_may`, `stu_tuition_jun`, `stu_tuition_jul`, `stu_tuition_aug`, `stu_tuition_sep`, `stu_tuition_oct`, `stu_tuition_nov`, `stu_tuition_dec`) VALUES ('$admissionno', '$prevous_pending', '$admission_fees', '$examination_fees', '$january_tuition_fees', '$febuary_tuition_fees', '$march_tuition_fees', '$april_tuition_fees', '$may_tuition_fees', '$june_tuition_fees', '$july_tuition_fees', '$august_tuition_fees', '$september_tuition_fees', '$october_tuition_fees', '$november_tuition_fees', '$december_tuition_fees')";
                $tuition_insert_result = mysqli_query($conn, $tuition_insert_sql);
                $bus_insert_sql = "INSERT INTO `convenience_fees` (`stu_conve_admissionno`, `stu_conve_jan`, `stu_conve_feb`, `stu_conve_mar`, `stu_conve_apr`, `stu_conve_may`, `stu_conve_jun`, `stu_conve_jul`, `stu_conve_aug`, `stu_conve_sep`, `stu_conve_oct`, `stu_conve_nov`, `stu_conve_dec`) VALUES ('$admissionno', '$january_bus_fees', '$febuary_bus_fees', '$march_bus_fees', '$april_bus_fees', '$may_bus_fees', '$june_bus_fees', '$july_bus_fees', '$august_bus_fees', '$september_bus_fees', '$october_bus_fees', '$november_bus_fees', '$december_bus_fees')";
                $bus_insert_result = mysqli_query($conn, $bus_insert_sql);
                // show insert data succesfull
                   if($tuition_insert_result && $bus_insert_result){
                        $showmsg = "Fees submited successful.";
                   }
            }
        }
    ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRM | Fees Submit</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/brands.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js">
    </script>
    <script defer src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../erpstyle.css">
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
    <script src="../javascript/function.js"></script>
    <style>
    .card {
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .1);
    }

    .profile-img {
        width: 120px;
        height: 120px;
        border-radius: 8px;
        border: 3px solid #0d6efd;
        object-fit: cover;
    }

    .back-btn {
        /* position: fixed; */
        top: 15px;
        left: 15px;
        z-index: 999;
    }
    </style>
</head>

<body>
    <div class="student_personaldetails">
        <button onclick="goBack()" class="btn btn-secondary back-btn" style="margin-bottom:-10px;">
            ← Back
        </button>
        <h1 class="text-center" style="color:red;">Fees Submit</h1>
        <?php  
        if($showmsg){
            echo '<div id="hello" class="alert alert-success alert-dismissible fade show loggedin" role="alert">
            <strong>SUCCESSFUL!</strong> '. $showmsg. '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        ?>
        <div class="personal">
            <h3>Personal Details</h3>
            <hr>
            <?php 
           
            echo '<div class="personalsection">
                <div class="per">
                    <p><span>Admission No : </span><span class="bold">'.$row['admission_number'].'</span></p>
                    <p><span>Name : </span><span class="bold">'.$row['first_name'] ." ". $row['middle_name']. " ". $row['last_name'].'</span></p>
                    <p><span>Fathers Name : </span><span class="bold">'.$row['father_name'].'</span></p>
                    <p><span>Mothers Name : </span><span class="bold">'.$row['mother_name'].'</span></p>
                    <p><span>Bus Facility : </span><span class="bold">'.$row['transport_fac'].'</span></p>
                </div>
                <div class="per">
                    <p><span>Class : </span><span class="bold">'.$row['class'].'</span></p>
                    <p><span>Gender : </span><span class="bold">'.$row['gender'].'</span></p>
                    <p><span>Mobile No : </span><span class="bold">'.$row['mobile_number'].'</span></p>
                    <p><span>Email Address : </span><span class="bold">'.$row['email_address'].'</span></p>
                </div>
                <div class="per per3">
                    <img src="../profileimage/'.$row['profile_photo'].'" alt="">
                </div>
            </div>
            </div>';
        ?>
            <div class="personal">
                <h3>Fees Submit</h3>
                <hr>
                <form class="byclass_search" action="" method="post">
                    <div class="mb-3"
                        style="display:flex;align-items:center;justify-content:right;margin-right:63px;height:10px;">
                        <select class="form-control" name="session" style="width:200px;" onchange="this.form.submit()">
                            <option value="2025-2026" <?php if($session=="2025-2026") echo "selected"; ?>>2025-2026
                            </option>
                            <!-- <option value="All">All</option> -->
                            <option value="2026-2027" <?php if($session=="2026-2027") echo "selected"; ?>>2026-2027
                            </option>
                            <option value="2027-2028" <?php if($session=="2027-2028") echo "selected"; ?>>2027-2028
                            </option>
                        </select>

                    </div>
                </form>
                <?php
                if($session == "2025-2026"){
                    $exist_tuition_sql = "SELECT * FROM `tution_fees` where stu_admission_no = '$admissionno'";
                    $exist_tuition_result = mysqli_query($conn, $exist_tuition_sql);
                    $row_tuition = mysqli_fetch_assoc($exist_tuition_result);
                    $exist_bus_sql = "SELECT * FROM `convenience_fees` WHERE stu_conve_admissionno = '$admissionno'";
                    $exist_bus_result = mysqli_query($conn, $exist_bus_sql);
                    $row_bus = mysqli_fetch_assoc($exist_bus_result);
                        if(mysqli_num_rows($exist_tuition_result)>0 && mysqli_num_rows($exist_bus_result)>0){
                              echo '<form action="" method="post">
                                      <div class="examinationadmission">
                                      <div>
                            <label for="first" class="form_label">Previous year pending : </label>
                            <input type="text" class="form_label" name="previous_pending" id="previous_pending"
                                aria-label="previous_pending" value='. $row_tuition['stu_previous_pending_fees'].'>
                        </div>
                        <div>
                            <label for="first" class="form_label">Admission Fees : </label>
                            <input type="text" class="form_label" name="admission_fees" id="admission_fees"
                                aria-label="admission_fees" value='. $row_tuition['stu_admission_fees'].'>
                        </div>
                        <div>
                            <label for="last" class="form-label">Examination Fees : </label>
                            <input type="text" class="form_label" name="examination_fees" id="examination_fees"
                                aria-label="examination_fees" value='.$row_tuition['stu_examination_fees'].'>
                        </div>
                    </div>
                    <table class="feessubmit table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Month</th>
                                <th scope="col">Tuition Fees</th>
                                <th scope="col">Convienence Fees</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">April</th>
                                <td><input type="text" class="form-control" name="tuition_apr" id="tuition_apr"
                                        aria-label="tuition_apr" value='. $row_tuition['stu_tuition_apr'].'></td>
                                <td><input type="text" class="form-control" name="bus_apr" id="bus_apr"
                                        aria-label="bus_apr" value='.$row_bus['stu_conve_apr'].'></td>
                            </tr>
                            <tr>
                                <th scope="row">May</th>
                                <td><input type="text" class="form-control" name="tuition_may" id="tuition_may"
                                        aria-label="tuition_may" value='.$row_tuition['stu_tuition_may'].'></td>
                                <td><input type="text" class="form-control" name="bus_may" id="bus_may"
                                        aria-label="bus_may" value='.$row_bus['stu_conve_may'].'></td>
                            </tr>
                            <tr>
                                <th scope="row">June</th>
                                <td><input type="text" class="form-control" name="tuition_jun" id="tuition_jun"
                                        aria-label="tuition_jun" value='.$row_tuition['stu_tuition_jun'].'></td>
                                <td><input type="text" class="form-control" name="bus_jun" id="bus_jun"
                                        aria-label="bus_jun" value='.$row_bus['stu_conve_jun'].'></td>
                            </tr>
                            <tr>
                                <th scope="row">July</th>
                                <td><input type="text" class="form-control" name="tuition_jul" id="tuition_jul"
                                        aria-label="tuition_jul" value='.$row_tuition['stu_tuition_jul'].'></td>
                                <td><input type="text" class="form-control" name="bus_jul" id="bus_jul"
                                        aria-label="bus_jul" value='.$row_bus['stu_conve_jul'].'></td>
                            </tr>
                            <tr>
                                <th scope="row">August</th>
                                <td><input type="text" class="form-control" name="tuition_aug" id="tuition_aug"
                                        aria-label="tuition_aug" value='.$row_tuition['stu_tuition_aug'].'></td>
                                <td><input type="text" class="form-control" name="bus_aug" id="bus_aug"
                                        aria-label="bus_aug" value='.$row_bus['stu_conve_aug'].'></td>
                            </tr>
                            <tr>
                                <th scope="row">September</th>
                                <td><input type="text" class="form-control" name="tuition_sep" id="tuition_sep"
                                        aria-label="tuition_sep" value='.$row_tuition['stu_tuition_sep'].'></td>
                                <td><input type="text" class="form-control" name="bus_sep" id="bus_sep"
                                        aria-label="bus_sep" value='.$row_bus['stu_conve_sep'].'></td>
                            </tr>
                            <tr>
                                <th scope="row">October</th>
                                <td><input type="text" class="form-control" name="tuition_oct" id="tuition_oct"
                                        aria-label="tuition_oct" value='.$row_tuition['stu_tuition_oct'].'></td>
                                <td><input type="text" class="form-control" name="bus_oct" id="bus_oct"
                                        aria-label="First name" value='.$row_bus['stu_conve_oct'].'></td>
                            </tr>
                            <tr>
                                <th scope="row">November</th>
                                <td><input type="text" class="form-control" name="tuition_nov" id="tuition_nov"
                                        aria-label="tuition_nov" value='.$row_tuition['stu_tuition_nov'].'></td>
                                <td><input type="text" class="form-control" name="bus_nov" id="bus_nov"
                                        aria-label="bus_nov" value='.$row_bus['stu_conve_nov'].'></td>
                            </tr>
                            <tr>
                                <th scope="row">December</th>
                                <td><input type="text" class="form-control" name="tuition_dec" id="tuition_dec"
                                        aria-label="tuition_dec" value='.$row_tuition['stu_tuition_dec'].'></td>
                                <td><input type="text" class="form-control" name="bus_dec" id="bus_dec"
                                        aria-label="First name" value='.$row_bus['stu_conve_dec'].'></td>
                            </tr>
                            <tr>
                                <th scope="row">Janurary</th>
                                <td><input type="text" class="form-control" name="tuition_jan" id="tuition_jan"
                                        aria-label="tuition_jan" value='.$row_tuition['stu_tuition_jan'].'></td>
                                <td><input type="text" class="form-control" name="bus_jan" id="bus_jan"
                                        aria-label="bus_jan" value='.$row_bus['stu_conve_jan'].'></td>
                            </tr>
                            <tr>
                                <th scope="row">Feburary</th>
                                <td><input type="text" class="form-control" name="tuition_feb" id="tuition_feb"
                                        aria-label="tuition_feb" value='.$row_tuition['stu_tuition_feb'].'></td>
                                <td><input type="text" class="form-control" name="bus_feb" id="bus_feb"
                                        aria-label="bus_feb" value='.$row_bus['stu_conve_feb'].'></td>
                            </tr>
                            <tr>
                                <th scope="row">March</th>
                                <td><input type="text" class="form-control" name="tuition_mar" id="tuition_mar"
                                        aria-label="tuition_mar" value='.$row_tuition['stu_tuition_mar'].'></td>
                                <td><input type="text" class="form-control" name="bus_mar" id="bus_mar"
                                        aria-label="bus_mar" value='.$row_bus['stu_conve_mar'].'></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="button"><button type="submit" class="btn btn-success" name="submit">Submit</button> 
                    </div>
                </form>';
            }
            else{
                echo '<form action="" method="post">
                    <div class="" style="display:flex;gap:1vw;flex-wrap:wrap;">
                        <div>
                            <label for="first" class="form_label">Previous year pending : </label>
                            <input type="text" class="form_label" name="previous_pending" id="previous_pending"
                                aria-label="previous_pending">
                        </div>
                        <div>
                            <label for="first" class="form_label">Admission Fees : </label>
                            <input type="text" class="form_label" name="admission_fees" id="admission_fees"
                                aria-label="admission_fees">
                        </div>
                        <div>
                            <label for="last" class="form-label">Examination Fees : </label>
                            <input type="text" class="form_label" name="examination_fees" id="examination_fees"
                                aria-label="examination_fees">
                        </div>
                    </div>
                    <table class="feessubmit table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tuition Fees</th>
                                <th scope="col">Convienence Fees</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">April</th>
                                <td><input type="text" class="form-control" name="tuition_apr" id="tuition_apr"
                                        aria-label="tuition_apr"></td>
                                <td><input type="text" class="form-control" name="bus_apr" id="bus_apr"
                                        aria-label="bus_apr"></td>
                            </tr>
                            <tr>
                                <th scope="row">May</th>
                                <td><input type="text" class="form-control" name="tuition_may" id="tuition_may"
                                        aria-label="tuition_may"></td>
                                <td><input type="text" class="form-control" name="bus_may" id="bus_may"
                                        aria-label="bus_may"></td>
                            </tr>
                            <tr>
                                <th scope="row">June</th>
                                <td><input type="text" class="form-control" name="tuition_jun" id="tuition_jun"
                                        aria-label="tuition_jun"></td>
                                <td><input type="text" class="form-control" name="bus_jun" id="bus_jun"
                                        aria-label="bus_jun"></td>
                            </tr>
                            <tr>
                                <th scope="row">July</th>
                                <td><input type="text" class="form-control" name="tuition_jul" id="tuition_jul"
                                        aria-label="tuition_jul""></td>
                                <td><input type="text" class="form-control" name="bus_jul" id="bus_jul"
                                        aria-label="bus_jul"></td>
                            </tr>
                            <tr>
                                <th scope="row">August</th>
                                <td><input type="text" class="form-control" name="tuition_aug" id="tuition_aug"
                                        aria-label="tuition_aug"></td>
                                <td><input type="text" class="form-control" name="bus_aug" id="bus_aug"
                                        aria-label="bus_aug"></td>
                            </tr>
                            <tr>
                                <th scope="row">September</th>
                                <td><input type="text" class="form-control" name="tuition_sep" id="tuition_sep"
                                        aria-label="tuition_sep"></td>
                                <td><input type="text" class="form-control" name="bus_sep" id="bus_sep"
                                        aria-label="bus_sep"></td>
                            </tr>
                            <tr>
                                <th scope="row">October</th>
                                <td><input type="text" class="form-control" name="tuition_oct" id="tuition_oct"
                                        aria-label="tuition_oct"></td>
                                <td><input type="text" class="form-control" name="bus_oct" id="bus_oct"
                                        aria-label="First name"></td>
                            </tr>
                            <tr>
                                <th scope="row">November</th>
                                <td><input type="text" class="form-control" name="tuition_nov" id="tuition_nov"
                                        aria-label="tuition_nov"></td>
                                <td><input type="text" class="form-control" name="bus_nov" id="bus_nov"
                                        aria-label="bus_nov"></td>
                            </tr>
                            <tr>
                                <th scope="row">December</th>
                                <td><input type="text" class="form-control" name="tuition_dec" id="tuition_dec"
                                        aria-label="tuition_dec"></td>
                                <td><input type="text" class="form-control" name="bus_dec" id="bus_dec"
                                        aria-label="First name"></td>
                            </tr>
                            <tr>
                                <th scope="row">Janurary</th>
                                <td><input type="text" class="form-control" name="tuition_jan" id="tuition_jan"
                                        aria-label="tuition_jan"></td>
                                <td><input type="text" class="form-control" name="bus_jan" id="bus_jan"
                                        aria-label="bus_jan"></td>
                            </tr>
                            <tr>
                                <th scope="row">Feburary</th>
                                <td><input type="text" class="form-control" name="tuition_feb" id="tuition_feb"
                                        aria-label="tuition_feb"></td>
                                <td><input type="text" class="form-control" name="bus_feb" id="bus_feb"
                                        aria-label="bus_feb"></td>
                            </tr>
                            <tr>
                                <th scope="row">March</th>
                                <td><input type="text" class="form-control" name="tuition_mar" id="tuition_mar"
                                        aria-label="tuition_mar"></td>
                                <td><input type="text" class="form-control" name="bus_mar" id="bus_mar"
                                        aria-label="bus_mar"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="button"><button type="submit" class="btn btn-success" name="submit">Submit</button>
                    </div>
                </form>';
            }?>
                <div class="generateid"><a
                        href="../erp/student_feesrecipt.php?admission_no=<?php echo $admissionno;?>"><button
                            type="submit" class="btn btn-success" name="">Generate Fees Reciept</button></a></div>
                <?php
        }else{
            ?>


                <!-- ✅ PREVIOUS FEES TABLE -->
                <?php if(mysqli_num_rows($prevFeesQuery) > 0){ ?>
                <div class="card mt-4">
                    <div class="card-header bg-dark text-white"><b>📌 Previous Fee Submitted Records</b></div>
                    <div class="card-body p-0 table-responsive">
                        <table class="table table-bordered table-striped mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th>Date</th>
                                    <th>Reciept No</th>
                                    <th>Session</th>
                                    <th>Months</th>
                                    <th>Tuition</th>
                                    <th>Bus</th>
                                    <th>Adm</th>
                                    <th>Exam</th>
                                    <th>Other</th>
                                    <th>Concession</th>
                                    <th>Pending</th>
                                    <th>Online</th>
                                    <th>Offline</th>
                                    <th>Total Paid</th>
                                    <th>Mode</th>
                                    <th>Total</th>
                                    <th>Sub. By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($pf = mysqli_fetch_assoc($prevFeesQuery)){ ?>
                                <tr>
                                    <td><?=date("d-m-Y", strtotime($pf['created_at']))?></td>
                                    <td><?=$pf['reciept_no']?></td>
                                    <td><?=$pf['session']?></td>
                                    <td><?=$pf['months']?></td>
                                    <td>₹<?=$pf['tuition_total']?></td>
                                    <td>₹<?=$pf['convence_total']?></td>
                                    <td>₹<?=$pf['admission_fees']?></td>
                                    <td>₹<?=$pf['examination_fees']?></td>
                                    <td>₹<?=$pf['other_fees']?></td>
                                    <td>₹<?=$pf['concession_amount']?></td>
                                    <td>₹<?=$pf['pending_amount']?></td>
                                    <td>₹<?=$pf['online_payment']?></td>
                                    <td>₹<?=$pf['offline_payment']?></td>
                                    <td>₹<?=$pf['total_paid']?></td>
                                    <td><?=$pf['payment_mode']?></td>
                                    <td><b>₹<?=$pf['grand_total']?></b></td>
                                    <td><?=$pf['submitted_by']?></td>
                                    <td>
                                        <a href="erp_fees_update_edit.php?id=<?=$pf['id']?>"
                                            class="btn btn-sm mb-1 <?= (date('d-m-Y') == date('d-m-Y', strtotime($pf['created_at']))) ? 'btn-warning' : 'btn-secondary disabled' ?>">
                                            Update
                                        </a> <a href="erp_updated_reciept.php?id=<?=$pf['id']?>"
                                            class="btn btn-sm btn-warning">Print</a>
                                        <form method="POST"
                                            onsubmit="return confirm('Set pending amount to 0 and print receipt?');">

                                            <input type="hidden" name="pay_id" value="<?= $pf['id'] ?>">

                                            <button type="submit" name="print_receipt"
                                                class="btn btn-warning btn-sm mt-1 <?= ($pf['pending_amount'] == 0) ? 'disabled' : '' ?>">
                                                Pay
                                            </button>

                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } else { ?>
                <div class="alert alert-info mt-3">ℹ️ No fee records found for this student.</div>


                <!-- fees submit form  -->

                <?php } ?>
                <div class="container my-4">
                    <!-- <h3 class="text-center text-primary mb-4">💰 Calculate & Submit Fees</h3> -->

                    <?php if($showmsg):?><div class="alert alert-success"><?=$showmsg?></div><?php endif;?>
                    <?php if($err):?><div class="alert alert-danger"><?=$err?></div><?php endif;?>

                    <div class="row g-3">


                        <div class="col-md-8">
                            <div class="card p-4">

                                <form method="POST">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label>Session</label>
                                            <select name="session" class="form-select" required>
                                                <option value="">Select</option>
                                                <option>2025-2026</option>
                                                <option>2026-2027</option>
                                                <option>2027-2028</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Select Months</label>
                                            <select id="narration" name="narration[]" multiple>
                                                <?php 
$months=["January","February","March","April","May","June","July","August","September","October","November","December"];
foreach($months as $m) echo "<option>$m</option>";
?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <input type="checkbox" id="add_admission" name="add_admission"> Admission
                                            Fee
                                        </div>
                                        <div class="col-md-4">
                                            <input type="checkbox" id="add_exam" name="add_exam"> Exam Fee
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" name="other_charges" id="other_charges"
                                                class="form-control" placeholder="Other Charges">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label>Concession Type</label>
                                            <select id="concession_type" name="concession_type" class="form-select">
                                                <option value="fixed">Fixed</option>
                                                <option value="percent">Percent</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Concession</label>
                                            <input type="number" id="concession_value" name="concession_value"
                                                class="form-control" value="0">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Pending Amt</label>
                                            <input type="number" id="pending_amount" name="pending_amount"
                                                class="form-control" value="0">
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
                                            <label>Online Payment (₹)</label>
                                            <input type="text" name="online_payment" class="form-control" value="0">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Offline Payment (₹)</label>
                                            <input type="text" name="offline_payment" class="form-control" value="0">
                                        </div>
                                    </div>

                                    <button class="btn btn-primary w-100 mt-3" name="fees_submit">💾 Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
                <?php
        }
    ?>


            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
        <script>
        const ch = new Choices('#narration', {
            removeItemButton: true,
            shouldSort: false
        });
        const tuition = <?=$tuition_rate?>,
            conv = <?=$conv_rate?>,
            adm = <?=$admission_fee?>,
            exam = <?=$exam_fee?>;

        function calc() {

            let selectedMonths = ch.getValue(true);
            let m = selectedMonths.length;

            // June does not have conveyance fees
            let convMonths = selectedMonths.filter(
                month => month.toLowerCase().trim() !== 'june'
            ).length;

            let addAdm = document.getElementById('add_admission').checked ? adm : 0;
            let addExam = document.getElementById('add_exam').checked ? exam : 0;
            let other = parseFloat(document.getElementById('other_charges').value || 0);

            let tuitionTotal = tuition * m;
            let convTotal = conv * convMonths;

            let subtotal = tuitionTotal + convTotal + addAdm + addExam + other;

            let ctype = document.getElementById('concession_type').value;
            let cval = parseFloat(document.getElementById('concession_value').value || 0);
            let pend = parseFloat(document.getElementById('pending_amount').value || 0);

            let concess = (ctype === 'percent') ?
                (subtotal * cval / 100) :
                cval;

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
            window.location.href = "./erp_student.php";
        }
        </script>
</body>

</html>