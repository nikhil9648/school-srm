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
                <main class="idmain">
                <div class="id" id="id">
                <?php
                
                $admissionno = $row['admission_number'];
            $sql = "SELECT * FROM `studentsdetail` WHERE admission_number = '$admissionno'";
           $result= mysqli_query($conn,$sql);
           $row = mysqli_fetch_assoc($result);
           echo '<div class="idcard">
            <header>
                <div class="schoolcode">
                    <p>Affiliation No.- 2133678</p>
                    <p>School Code -71792</p>
                </div>
                <div class="nameschool">
                    <img src="../img/logo.png" alt="">
                    <div>
                        <h4>S.R.M Modern Public School</h4>
                        <p>Bariyarshah, Bhadar, Amethi</p>
                    </div>
                </div>
            </header>
            <div class="profilei"><img src="../profileimage/'.$row['profile_photo'].'" alt=""></div>
            <section>
                <h5 style="text-align:center;margin-bottom:15px;color: rgb(234, 217, 22);">'.$row['first_name'] ." ". $row['middle_name']. " ". $row['last_name'].'</h5>
                <div style="display:flex;justify-content: center;align-item:center;">
                    <div class="nameclass">
                        <p><span>Father name : </span></p>
                        <p><span>Class : </span></p>
                        <p><span>DOB : </span></p>
                        <p><span>Address : </span></p>
                        <p style="margin-top:-6.5px;"><span>Contact No : </span></p>
                    </div>
                    <div class="nameaddress">
                        <p><span>'.$row['father_name'].'</span></p>
                        <p><span>'.$row['class'].'</span></p>
                        <p><span>'.$row['dob'].'</span></p>
                        <p style="line-height: 1.2;"><span>'.$row['village'] ." ". $row['post']. " ". $row['district']. "(". $row['state']. ") ". $row['pin_code'].'</span></p>
                        <p style="margin-top:-20px;"><span>'.$row['mobile_number'].'</span></p>
                    </div>
                </div>
                <img class="img" src="../img/sign.png" alt="">
            </section>
            
            <footer class="principalsign">
                <p>Contact No. : 9918868227</p>
                <p>Principal Sign.</p>
            </footer>
        </div>';
?>          </div>
</main>
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