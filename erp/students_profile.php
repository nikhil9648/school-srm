<?php
session_start();
include '../backend/connection.php';
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School</title>
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
    <script src="../javascript/function.js"></script>
</head>

<body>
    <div class="student_personaldetails">
        <h1 style="text-align:center;color:red;">Student Details</h1>
        <div class="personal">
            <h3>Personal Details</h3>
            <hr>
            <?php 
         $id = $_GET['student_id'];
           $sql = "SELECT * FROM `studentsdetail` WHERE Sno = $id";
           $result= mysqli_query($conn,$sql);
           $row = mysqli_fetch_assoc($result);
           $admissionno = $row['admission_number'];
           $date = $row['dob'];
            list($year, $month, $day) = explode('-', $date);
            echo '<div class="personalsection">
                <div class="per">
                    <p><span>Admission No : </span><span class="bold">'.$row['admission_number'].'</span></p>
                    <p><span>Name : </span><span class="bold">'.$row['first_name'] ." ". $row['middle_name']. " ". $row['last_name'].'</span></p>
                    <p><span>Class : </span><span class="bold">'.$row['class'].'</span></p>
                    <p><span>Fathers Name : </span><span class="bold">'.$row['father_name'].'</span></p>
                    <p><span>Mothers Name : </span><span class="bold">'.$row['mother_name'].'</span></p>
                    <p><span>Aadhar No : </span><span class="bold">'.$row['aadhar_number'].'</span></p>
                    <p><span>Transport Facility : </span><span class="bold">'.$row['transport_fac'].'</span></p>
                    <p><span>Bus No. : </span><span class="bold">'.$row['bus_number'].'</span></p>
                </div>
                <div class="per">
                    <p><span>DOB : </span><span class="bold">'.$day."/".$month."/".$year.'</span></p>
                    <p><span>Gender : </span><span class="bold">'.$row['gender'].'</span></p>
                    <p><span>Mobile No : </span><span class="bold">'.$row['mobile_number'].'</span></p>
                    <p><span>Caste : </span><span class="bold">'.$row['Caste'].'</span></p>
                    <p><span>Religion : </span><span class="bold">'.$row['religion'].'</span></p>
                    <p><span>Email Address : </span><span class="bold">'.$row['email_address'].'</span></p>
                    <p><span>TC(Submitted/not submitted) : </span><span class="bold">'.$row['transfer_certificate'].'</span></p>
                </div>
                <div class="per">
                    <img src="../profileimage/'.$row['profile_photo'].'" alt="">
                </div>
            </div>
        </div>
        <div class="personal">
            <h3>Address</h3>
            <hr>
            <div class="personalsection">
                <div class="per">
                    <p><span>Village : </span><span class="bold">'.$row['village'].'</span></p>
                    <p><span>State : </span><span class="bold">'.$row['state'].'</span></p>
                </div>
                <div class="per">
                    <p><span>Post : </span><span class="bold">'.$row['post'].'</span></p>
                </div>
                <div class="per">
                    <p><span>District : </span><span class="bold">'.$row['district'].'</span></p>
                </div>
                <div class="per">
                    <p><span>Pin code : </span><span class="bold">'.$row['pin_code'].'</span></p>
                </div>
            </div>
        </div>';
    ?>
            <div class="personal">
                <h3>Fees Details</h3>
                <hr>
                <?php
            $exist_tuition_sql = "SELECT * FROM `tution_fees` where stu_admission_no = '$admissionno'";
            $exist_tuition_result = mysqli_query($conn, $exist_tuition_sql);
            $row_tuition = mysqli_fetch_assoc($exist_tuition_result);
            $exist_bus_sql = "SELECT * FROM `convenience_fees` WHERE stu_conve_admissionno = '$admissionno'";
            $exist_bus_result = mysqli_query($conn, $exist_bus_sql);
            $row_bus = mysqli_fetch_assoc($exist_bus_result);
            if(mysqli_num_rows($exist_tuition_result)>0 && mysqli_num_rows($exist_bus_result)>0){
            echo '<div class="personalsection">
            <div class="per">
                <p><span>Previous Pending : </span><span class="bold">'. $row_tuition['stu_previous_pending_fees'].'</span></p>
            </div>
            <div class="per">
                <p><span>Admission Fees : </span><span class="bold">'.$row_tuition['stu_admission_fees'].'</span></p>
            </div>
            <div class="per">
                <p><span>Examination Fees : </span><span class="bold">'.$row_tuition['stu_examination_fees'].'</span></p>
            </div>
        </div>
                <table class="table table-bordered">
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
                            <td>'.$row_tuition['stu_tuition_apr'].'</td>
                            <td>'.$row_bus['stu_conve_apr'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">May</th>
                            <td>'.$row_tuition['stu_tuition_may'].'</td>
                            <td>'.$row_bus['stu_conve_may'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">June</th>
                            <td>'.$row_tuition['stu_tuition_jun'].'</td>
                            <td>'.$row_bus['stu_conve_jun'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">July</th>
                            <td>'.$row_tuition['stu_tuition_jul'].'</td>
                            <td>'.$row_bus['stu_conve_jul'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">August</th>
                            <td>'.$row_tuition['stu_tuition_aug'].'</td>
                            <td>'.$row_bus['stu_conve_aug'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">September</th>
                            <td>'.$row_tuition['stu_tuition_sep'].'</td>
                            <td>'.$row_bus['stu_conve_sep'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">October</th>
                            <td>'.$row_tuition['stu_tuition_oct'].'</td>
                            <td>'.$row_bus['stu_conve_oct'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">November</th>
                            <td>'.$row_tuition['stu_tuition_nov'].'</td>
                            <td>'.$row_bus['stu_conve_nov'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">December</th>
                            <td>'.$row_tuition['stu_tuition_dec'].'</td>
                            <td>'.$row_bus['stu_conve_dec'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">January</th>
                            <td>'.$row_tuition['stu_tuition_jan'].'</td>
                            <td>'.$row_bus['stu_conve_jan'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">February</th>
                            <td>'.$row_tuition['stu_tuition_feb'].'</td>
                            <td>'.$row_bus['stu_conve_feb'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">March</th>
                            <td>'.$row_tuition['stu_tuition_mar'].'</td>
                            <td>'.$row_bus['stu_conve_mar'].'</td>
                        </tr>
                    </tbody>
                </table>
            </div>';
            }
            ?>
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
</body>

</html>