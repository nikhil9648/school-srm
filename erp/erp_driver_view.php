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
        <h1 style="text-align:center;color:red;">Driver Details</h1>
        <div class="personal">
            <h3>Personal Details</h3>
            <hr>
           <?php
           $id = $_GET['driver_id'];
           $sql = "SELECT * FROM `driver_details` WHERE Sno = $id";
           $result= mysqli_query($conn,$sql);
           $row = mysqli_fetch_assoc($result);
        //    $admissionno = $row['admission_number'];
            echo '<div class="personalsection">
                <div class="per">
                    <p><span>Teacher Id : </span><span class="bold">'.$row['dri_driver_id'].'</span></p>
                    <p><span>Name : </span><span class="bold">'.$row['dri_first_name'] ." ". $row['dri_last_name'].'</span></p>
                    <p><span>Driver Bus Number : </span><span class="bold">'.$row['dri_bus_no'].'</span></p>
                    <p><span>Fathers Name : </span><span class="bold">'.$row['dri_father_name'].'</span></p>
                    <p><span>Mothers Name : </span><span class="bold">'.$row['dri_mother_name'].'</span></p>
                    <p><span>Aadhar No : </span><span class="bold">'.$row['dri_aadhar_no'].'</span></p>
                </div>
                <div class="per">
                    <p><span>DOB : </span><span class="bold">'.$row['dri_dob'].'</span></p>
                    <p><span>Mobile No : </span><span class="bold">'.$row['dri_mobile_no'].'</span></p>
                    <p><span>Email Address : </span><span class="bold">'.$row['dri_gmail_id'].'</span></p>
                    <p><span>PAN No : </span><span class="bold">'.$row['dri_pan_no'].'</span></p>
                </div>
                <div class="per">
                    <img src="../profileimage/'.$row['dri_profile_photo'].'" alt="">
                </div>
            </div>
        </div>
        <div class="personal">
            <h3>Address</h3>
            <hr>
            <div class="personalsection">
                <div class="per">
                    <p><span>Village : </span><span class="bold">'.$row['dri_village'].'</span></p>
                    <p><span>State : </span><span class="bold">'.$row['dri_state'].'</span></p>
                </div>
                <div class="per">
                    <p><span>Post : </span><span class="bold">'.$row['dri_post'].'</span></p>
                    <p><span>Driving License No : </span><span class="bold">'.$row['dri_dl_no'].'</span></p>
                </div>
                <div class="per">
                    <p><span>District : </span><span class="bold">'.$row['dri_district'].'</span></p>
                    <p><span>Driving experience(in year) : </span><span class="bold">'.$row['dri_driving_experiance'].'</span></p>
                </div>
                <div class="per">
                    <p><span>Pin code : </span><span class="bold">'.$row['dri_pincode'].'</span></p>
                </div>
            </div>
        </div>';
    ?>
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