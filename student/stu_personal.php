<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['stu_loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student I'd</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../student/student_style.css">
    <link rel="stylesheet" href="../erpstyle.css">
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="../javascript/function.js"></script>
</head>
<body>
    <div class="student_dashboard">
        <div class="section1 hideonmobile">
            <?php include '../student/student_sidebar.php' ;?>
        </div>
        <div class="student_main">
            <div class="navbar">
                <?php include '../student/stu_header.php';
                include '../student/stu_mobile_sidebar.php'; ?>
                  <div class="student_personaldetails" style="width:77vw;">
                <h1 style="text-align:center;color:red;">Student Details</h1>
                <div class="personal">
                    <h3>Personal Details</h3>
                    <hr>
                    <?php
           $admission_no = $_SESSION['stu_admission_no'];
           $sql = "SELECT * FROM `studentsdetail` WHERE admission_number = '$admission_no'";
           $result= mysqli_query($conn,$sql);
           $row = mysqli_fetch_assoc($result);
           $admissionno = $row['admission_number'];
            echo '<div class="personalsection">
                <div class="per">
                    <p><span>Admission No : </span><span class="bold">'.$row['admission_number'].'</span></p>
                    <p><span>Name : </span><span class="bold">'.$row['first_name'] ." ". $row['middle_name']. " ". $row['last_name'].'</span></p>
                    <p><span>Class : </span><span class="bold">'.$row['class'].'</span></p>
                    <p><span>Fathers Name : </span><span class="bold">'.$row['father_name'].'</span></p>
                    <p><span>Mothers Name : </span><span class="bold">'.$row['mother_name'].'</span></p>
                    <p><span>Aadhar No : </span><span class="bold">'.$row['aadhar_number'].'</span></p>
                </div>
                <div class="per">
                    <p><span>DOB : </span><span class="bold">'.$row['dob'].'</span></p>
                    <p><span>Gender : </span><span class="bold">'.$row['gender'].'</span></p>
                    <p><span>Mobile No : </span><span class="bold">'.$row['mobile_number'].'</span></p>
                    <p><span>Caste : </span><span class="bold">'.$row['Caste'].'</span></p>
                    <p><span>Religion : </span><span class="bold">'.$row['religion'].'</span></p>
                    <p><span>Email Address : </span><span class="bold">'.$row['email_address'].'</span></p>
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
            </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
                integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
                crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
                integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
                crossorigin="anonymous">
            </script>
            <script>
            function showsidebar() {
                const sidebar = document.querySelector('.sidebar')
                sidebar.style.display = "flex"
            }

            function hidesidebar() {
                const sidebar = document.querySelector('.sidebar')
                sidebar.style.display = "none"
            }
            </script>
</body>

</html>