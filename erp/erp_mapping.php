<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}

// Handle conveyance fee updates
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_conv']) ) {
    $id = intval($_POST['id']);
    $fees = floatval($_POST['fees']);
    $update_query = "UPDATE map_convence_fees SET `2026-2027_fees` = '$fees' WHERE id = $id";
    if (mysqli_query($conn, $update_query)) {
        $success = "Conveyance fee updated successfully!";
    } else {
        $error = "Update failed: " . mysqli_error($conn);
    }
}

// Handle tuition fee updates (add similar for new rows)
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_tuition']) ) {
//     $sno = intval($_POST['sno']);
//     $class = mysqli_real_escape_string($conn, $_POST['class']);
//     $adm = floatval($_POST['adm_fees']);
//     $tui = floatval($_POST['tui_fees']);
//     $exam = floatval($_POST['exam_fees']);
//     $other = floatval($_POST['other_fees']);
//     $update_query = "UPDATE map_tuition_fees SET class='$class', admission_fees='$adm', tuition_fees='$tui', examination_fees='$exam', other_fees='$other' WHERE Sno = $sno";
//     if (mysqli_query($conn, $update_query)) {
//         $success = "Tuition fee updated successfully!";
//     } else {
//         $error = "Update failed: " . mysqli_error($conn);
//     }
// }
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRM ERP | Mapping</title>
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
    <!-- Tailwind removed, use Bootstrap -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../erpstyle.css">
    <script src="../javascript/function.js"></script>
</head>

<body>
    <?php
    include '../partials/youtubeinsta.php';
    ?>
    <div class="sectionerp">
        <div class="section1 hideonmobile">
            <?php include '../erp/erp_sidebar.php'; ?>
        </div>
        <div class="section2">
            <?php
            include '../erp/erp_header.php';
            ?>
<div class="bg-white p-6 rounded-lg shadow">

                <h2 class="text-2xl font-bold mb-4">Fees Mapping</h2>
                <?php if (isset($success)) echo '<div class="alert alert-success">'.$success.'</div>'; ?>
                <?php if (isset($error)) echo '<div class="alert alert-danger">'.$error.'</div>'; ?>


                <!-- Dropdown -->
                <div class="mb-5">
                    <select id="mappingType" onchange="showTable()" class="border p-2 rounded w-64">
                        <option value="">Select Mapping Type</option>
                        <option value="tuition">Tuition Fees Mapping</option>
                        <option value="conveyance">Conveyance Fees Mapping</option>
                    </select>
                </div>

                <!-- Tuition Table -->
                <div id="tuitionTable" class="d-none">
                    <h3 class="text-xl font-semibold mb-3">Tuition Fees Mapping</h3>

                    <table class="table table-striped table-bordered w-full">
                        <thead class="table-dark">
                            <tr>
                                <th>Sno</th>
                                <th>Class</th>
                                <th>Admission Fees</th>
                                <th>Tuition Fees</th>
                                <th>Exam Fees</th>
                                <th>Other Fees</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                $res = mysqli_query($conn, "SELECT * FROM map_tuition_fees ORDER BY Sno");
                $Sno = 0;
                while($row = mysqli_fetch_assoc($res)){
                    $Sno++;
                ?>
                            <tr class="text-center">
                                <td><?= $Sno ?></td>
                                <form method="POST">
                                    <td><input type="text" name="class" value="<?= htmlspecialchars($row['class']) ?>" class="form-control form-control-sm"></td>
                                    <td><input type="number" name="adm_fees" value="<?= $row['admission_fees'] ?>" class="form-control form-control-sm"></td>
                                    <td><input type="number" name="tui_fees" value="<?= $row['tuition_fees'] ?>" class="form-control form-control-sm"></td>
                                    <td><input type="number" name="exam_fees" value="<?= $row['examination_fees'] ?>" class="form-control form-control-sm"></td>
                                    <td><input type="number" name="other_fees" value="<?= $row['other_fees'] ?>" class="form-control form-control-sm"></td>
                                    <td>
                                        <input type="hidden" name="sno" value="<?= $row['Sno'] ?>">
                                        <button type="submit" name="update_tuition" class="btn btn-sm btn-primary" onclick="return confirm('Update?')">Update</button>
                                    </td>
                                </form>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- <button class="btn btn-success mt-2" onclick="addNewTuition()">+ Add New Class Mapping</button> -->
                </div>

                <!-- Conveyance Table -->
                <div id="conveyanceTable" class="d-none">
                    <h3 class="text-xl font-semibold mb-3">Conveyance Fees Mapping</h3>

                    <table class="table table-striped table-bordered w-full" id="mytable1">
                        <thead class="table-dark">
                            <tr>
                                <th>S.no</th>
                                <th>Admission No</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Fees (2026-2027)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res2 = mysqli_query($conn, "SELECT m.id,m.trans_admission_no, m.`2026-2027_fees` AS fees, s.first_name, s.class,s.last_name,s.middle_name FROM map_convence_fees m LEFT JOIN studentsdetail s ON m.trans_admission_no = s.admission_number ORDER BY m.id");
                             $con_sno = 0;
                             while($row2 = mysqli_fetch_assoc($res2)){ $con_sno++; ?>
                            <tr class="text-center">
                                <td><?= $con_sno ?></td>
                                <td><?= $row2['trans_admission_no'] ?></td>
                                <td><?= htmlspecialchars($row2['first_name']) ?> <?= htmlspecialchars($row2['middle_name']) ?> <?= htmlspecialchars($row2['last_name']) ?></td>
                                <td><?= $row2['class'] ?></td>
                                <form method="POST">
                                    <td><input type="number" name="fees" value="<?= $row2['fees'] ?>" class="form-control form-control-sm"></td>
                                    <td>
                                        <input type="hidden" name="id" value="<?= $row2['id'] ?>">
                                        <button type="submit" name="update_conv" class="btn btn-sm btn-primary" onclick="return confirm('Update fees?')">Update</button>
                                    </td>
                                </form>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- <button class="btn btn-success mt-2" onclick="addNewConveyance()">+ Add New</button> -->
                </div>

            </div>
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
    <script>

    $(document).ready(function() {
            $('#mytable1').DataTable({
                "paging": false
            });
        });


    $(document).ready(function() {
        // No mytable, skip DataTable
    });

    function showTable() {
        let value = document.getElementById("mappingType").value;

        // Hide all
        document.getElementById("tuitionTable").classList.add("d-none");
        document.getElementById("conveyanceTable").classList.add("d-none");

        if (value === "tuition") {
            document.getElementById("tuitionTable").classList.remove("d-none");
        } else if (value === "conveyance") {
            document.getElementById("conveyanceTable").classList.remove("d-none");
        }
    }
    </script>
</body>

</html>