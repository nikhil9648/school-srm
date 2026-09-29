<?php

$showalert=false;
include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
?>
<?php
if (isset($_GET['delete_id'])) {
    $delete = $_GET['delete_id'];

    $get_adm_sql = "SELECT admission_number, profile_photo FROM studentsdetail WHERE Sno = $delete";
    $get_adm_result = mysqli_query($conn, $get_adm_sql);
    $rowss = mysqli_fetch_assoc($get_adm_result);

    if ($rowss) {

        $adm_no = $rowss['admission_number'];
        $photo_filename = $rowss['profile_photo'];
        $photo_path = "../profileimage/".$photo_filename;

        if (!empty($photo_filename) && file_exists($photo_path)) {
            unlink($photo_path);
        }

        // Related table delete queries
        mysqli_query($conn, "DELETE FROM tution_fees WHERE stu_admission_no = $adm_no");
        mysqli_query($conn, "DELETE FROM convenience_fees WHERE stu_conve_admissionno = $adm_no");
        mysqli_query($conn, "DELETE FROM map_convence_fees WHERE trans_admission_no = $adm_no");

        // Delete student record
        $result3 = mysqli_query($conn, "DELETE FROM studentsdetail WHERE Sno = $delete");

        if ($result3) {
            echo "<script>alert('Record Deleted Successfully'); window.location.href='../erp/erp_student.php';</script>";
        } else {
            echo "Error deleting student: " . mysqli_error($conn);
        }

    } else {
        echo "No student found with Sno = $delete";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRM | Student</title>
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
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../erpstyle.css">
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
    <script src="../javascript/function.js"></script>

</head>

<body>
    <?php
    include '../partials/youtubeinsta.php';
    $showalert = false;
    $showerror = false;
    ?>
    <div class="sectionerp">
        <div class="section1 hideonmobile">
            <?php include '../erp/erp_sidebar.php'; ?>
        </div>
        <div class="section2">
            <?php
            include '../erp/erp_header.php';
            ?>
            <div class="student_idcard"
                style="display: flex; justify-content: left;gap:10px; margin-left:10px;margin-bottom:10px; align-items: center;">
                <div class="student_search" style="border: 1px solid black; padding:10px; border-radius: 10px;">
                    <div class="search_student">
                        <h5>Search Student By Class</h5>
                        <?php
                        if(isset($_POST['class'])){
                            $class = $_POST['class'];
                        }
                        else{
                            $class = 0;
                        } 
                        ?>
                        <form class="byclass_search" action="" method="post">
                            <div class="mb-3">
                                <label for="class" class="form-label">Class</label>
                                <select type="text" class="form-control" id="class" name="class"
                                    aria-describedby="emailHelp" style="width: 200px;">
                                    <option selected>Select</option>
                                    <option value="PG">PG</option>
                                    <option value="LKG">LKG</option>
                                    <option value="SKG">SKG</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success" style="margin-top:17px;">Search</button>
                        </form>
                    </div>
                </div>
                <div class="generate_idcard_stu"
                    style="border: 1px solid black; padding:19px 10px; border-radius: 10px; ">
                    <h5>Generate Student Id Card</h5>
                    <?php
                    if(isset($_POST['idcard_class'])){
                        $idcard_class = $_POST['idcard_class'];
                    }
                    else{
                        $idcard_class = 0;
                    }
                    ?>
                    <form class="byclass_search" action="" method="post"
                        style="display: flex; flex-direction: row; gap:10px; align-items: center;">
                        <div class="mb-3">
                            <label for="class" class="form-label">Class</label>
                            <select type="text" class="form-control" id="idcard_class" name="idcard_class"
                                aria-describedby="emailHelp" style="width: 200px;">
                                <option selected>Select</option>
                                <option value="all">All</option>
                                <option value="PG">PG</option>
                                <option value="LKG">LKG</option>
                                <option value="SKG">SKG</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success" style="margin-top:17px;">Search</button>
                    </form>
                </div>
            </div>
            <?php
                if(isset($_POST['class']) && $class != 0){
                    ?>
            <table class="table table-bordered print_record">
                <thead>
                    <tr>
                        <th scope="col">Sno</th>
                        <th scope="col">Name</th>
                        <th scope="col">Adm. No</th>
                        <th scope="col">Class</th>
                        <th scope="col">Dob</th>
                        <th scope="col">Father's Name</th>
                        <th scope="col">Mother's Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Sr. No</th>
                        <th scope="col">Aadhar no</th>
                        <th scope="col">Mobile</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM studentsdetail WHERE class = '$class' AND status IN ('New Admission', 'Active')";
                    $result = mysqli_query($conn, $sql);
                    $snos = 0;
                    while($rows = mysqli_fetch_assoc($result)){
                        $snos= $snos+1;
                        $date = $rows['dob'];
                        list($year, $month, $day) = explode('-', $date);
                        echo "<tr>
                              <th scope='row'>".$snos."</th>
                              <td>".$rows['first_name'] ." ". $rows['middle_name']. " ". $rows['last_name']."</td>
                              <td>".$rows['admission_number']."</td>
                              <td>".$rows['class']."</td>
                              <td>".$day."/".$month."/".$year."</td>
                              <td>".$rows['father_name']."</td>
                              <td>".$rows['mother_name']."</td>
                              <td>".$rows['village'] ." ". $rows['post']. " ". $rows['district']."</td>
                              <td>".$rows['sr_no']."</td>
                              <td>".$rows['aadhar_number']."</td>
                              <td>".$rows['mobile_number']."</td>
                              </tr>";
                    }
                   ?>
                </tbody>
            </table>
            <button style="display:flex;justify-content:center;align-items:center;margin-top:10px;"
                class="btn btn-success btn-print" onclick="printPage()">Print Record</button>
            <?php }
                ?>
            <!-- id card generate details -->
            <?php
                if(isset($_POST['idcard_class']) && $idcard_class != 0){
                    ?>
            <form action="../erp/erp_studentIdcard.php" method="post">
                <table class="table table-bordered print_record" id="mytable1">
                    <thead>
                        <tr>
                            <th scope="col">Sno</th>
                            <th scope='col'><input type='checkbox' onclick='toggleSelectAll(this)' id='select-all'></th>
                            <th scope="col">Photo</th>
                            <th scope="col">Name</th>
                            <th scope="col">Adm. No</th>
                            <th scope="col">Class</th>
                            <th scope="col">Dob</th>
                            <th scope="col">Father's Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Mobile</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    if ($idcard_class == "all") {
                        $sql = "SELECT * FROM `studentsdetail` Where status IN ('New Admission', 'Active')";
                    } else {
                        $sql = "SELECT * FROM studentsdetail WHERE class = '$idcard_class' AND status IN ('New Admission', 'Active')";
                    }
                    $result = mysqli_query($conn, $sql);
                    $snos = 0;
                    while($rows = mysqli_fetch_assoc($result)){
                        $snos= $snos+1;
                        $date = $rows['dob'];
                        list($year, $month, $day) = explode('-', $date);
                        echo "<tr>
                              <th scope='row'>".$snos."</th>
                              <th scope='col'><input type='checkbox' class='studentid' name='select[]' value=".$rows['admission_number']."></th>
                              <td><img src='../profileimage/".$rows['profile_photo']."'></td>
                              <td>".$rows['first_name'] ." ". $rows['middle_name']. " ". $rows['last_name']."</td>
                              <td>".$rows['admission_number']."</td>
                              <td>".$rows['class']."</td>
                              <td>".$day."/".$month."/".$year."</td>
                              <td>".$rows['father_name']."</td>
                              
                              <td>".$rows['village'] ." ". $rows['post']. " ". $rows['district']."</td>
                              <td>".$rows['mobile_number']."</td>
                              </tr>";
                    }
                   ?>
                    </tbody>
                </table>
                <div style='display:flex;justify-content:center;margin-top:10px;'><a
                        href='../erp/erp_studentIdcard.php'><button type='submit' id='submit'
                            class='btn btn-success'>Generate Id Card</button></a></div>
                <?php }
                ?>
            </form>
            <hr>
            <!-- start table for fee submit and edit details -->
            <?php
             $status = "active";
                        if(isset($_POST['status'])){
                        $status = $_POST['status'];
                        }
                        if($status == "All"){
                        $query = "SELECT * FROM studentsdetail";
                        }else{
                        $query = "SELECT * FROM studentsdetail WHERE status='$status'";
                        }
            ?>
            <form class="byclass_search" action="" method="post">
                <div class="mb-3"
                    style="display:flex;align-items:center;justify-content:right;margin-right:63px;height:10px;">
                    <select class="form-control" id="status" name="status" style="width:200px;"
                        onchange="this.form.submit()">
                        <option value="Active" <?php if($status=="Active") echo "selected"; ?>>Active</option>
                        <option value="All" <?php if($status=="All") echo "selected"; ?>>All</option>
                        <option value="Active" <?php if($status=="Active") echo "selected"; ?>>Active</option>
                        <option value="New Admission" <?php if($status=="New Admission") echo "selected"; ?>>New
                            Admission</option>
                        <option value="Leave" <?php if($status=="Leave") echo "selected"; ?>>Leave</option>
                    </select>
                </div>
            </form>
            <div class="studentrecord">
                <table class="table table-bordered" id="mytable">
                    <thead>
                        <tr>
                            <th scope="col">Sno</th>
                            </th>
                            <th scope="col">Profile</th>
                            <th scope="col">Adm. No</th>
                            <th scope="col">Class</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Father's Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $status = "active";
                        if(isset($_POST['status'])){
                        $status = $_POST['status'];
                        }
                        if($status == "All"){
                        $query = "SELECT Sno, admission_number, class, first_name, middle_name, last_name, father_name, profile_photo FROM studentsdetail";
                        }else{
                        $query = "SELECT Sno, admission_number, class, first_name, middle_name, last_name, father_name, profile_photo FROM studentsdetail WHERE status='$status'";
                        }
                    // $sql = "SELECT * FROM `studentsdetail`";
                    $result = mysqli_query($conn, $query);
                    $sno = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        $sno= $sno+1;
                        echo "<tr>
                              <th scope='row'>".$sno."</th>
                              <td><img src='../profileimage/".$row['profile_photo']."'></td>
                              <td>".$row['admission_number']."</td>
                              <td>".$row['class']."</td>
                              <td>".$row['first_name'] ." ". $row['middle_name']. " ". $row['last_name']."</td>
                              <td>".$row['father_name']."</td>
                              <td><a href='../erp/students_profile.php?student_id=" . $row['Sno'] . "'><button class='edit btn btn-sm btn-primary' id = ".$row['Sno']." type='button'> View </button></a> <a href='../partials/admissionformedit.php?editstudents=" . $row['Sno'] . "'><button class='edit btn btn-sm btn-primary' id = ".$row['Sno']." type='button'> Edit </button></a> <a href='../erp/erp_feessubmit.php?studentfees_id=" . $row['Sno'] . "'><button class='edit btn btn-sm btn-primary' id = ".$row['Sno']." type='button'> Fee Submit </button></a> <a><button class='delete btn btn-sm btn-danger'  id ='d".$row['Sno']."' type='button'> Delete </button></a></td>
                              </tr>";
                    }
                   ?>
                    </tbody>
                </table>
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
        <script src="jquery-3.7.1.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#mytable').DataTable()
        });

        $(document).ready(function() {
            $('#mytable1').DataTable({
                "paging": false
            });
        });

        function toggleSelectAll(source) {
            const checkboxes = document.querySelectorAll('input[name="select[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
        }


        $(document).on("click", ".delete", function() {
            const Sno = $(this).attr("id").substring(1);
            if (confirm("Are you sure you want to delete this student record!")) {
                window.location.href = `../erp/erp_student.php?delete_id=${Sno}`;
            }
        });

        function printPage() {
            var originalContent = document.body.innerHTML;
            var contentToPrint = document.querySelector('.print_record');
            // console.log('' + print)
            document.body.innerHTML = contentToPrint.outerHTML;
            window.print();
            document.body.innerHTML = originalContent;
        }
        </script>
</body>

</html>