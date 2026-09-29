<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher I'd</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
    page {
        page-size: A 4;
    }
    </style>
</head>

<body>
    <main class="idmain">
    <div class="id" id="id">
    <?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['select']) && is_array($_POST['select'])) {
        $teacher_id = $_POST['select'];
        foreach ($teacher_id as $teacher) {
           $sql = "SELECT * FROM `class` WHERE cl_schoolid = '$teacher'";
           $result= mysqli_query($conn,$sql);
           $row = mysqli_fetch_assoc($result);
           echo '<div class="idcard" style="height: 395px">
            <header style="background-color: #265b90ff; height:113px;">
                <div class="schoolcode">
                    <p>Affiliation No.- 2133678</p>
                    <p>School Code -71792</p>
                </div>
                <div class="nameschool" style="margin-top:-12px;">
                    <img src="../img/logo.png" alt="">
                    <div>
                        <h4 style="font-size:25px;">S.R.M Modern Public School</h4>
                        <p style="margin-top:-4px; font-size:13px;">Bariyarshah, Bhadar, Amethi</p>
                    </div>
                </div>
            </header>
            <div class="profilei" style="margin-top:3px;"><img src="../profileimage/'.$row['cl_profile_photo'].'" alt=""></div>
            <section style="padding-bottom:7px;height: 143px;background-color: #ffffffff">
                <h5 style="text-align:center;margin-top:4px ;margin-bottom: 14px;color: #eb2c2cff;font-weight:600;">'.$row['cl_Firstname'] ." ". $row['cl_lastname'].'</h5>
                <div style="display:flex;justify-content: center;align-item:center;color:#2C3E50;font-weight:700">
                    <div class="nameclass">
                        <p><span>Designation</span></p>
                        <p><span>Gender</span></p>
                        <p><span>Mobile No.</span></p>
                        <p><span>Address</span></p>

                    </div>
                    <div class="nameclass" style="margin-left: 4px; width: 14px">
                        <p><span> : </span></p>
                        <p><span> : </span></p>
                        <p><span> : </span></p>
                        <p><span> : </span></p>

                    </div>
                    <div class="nameaddress" style="margin-right: -5px;">
                        <p><span> '.$row['cl_department'] .'</span></p>
                        <p><span> '.$row['cl_gender'] .'</span></p>
                        <p><span> '.$row['cl_mobile'] .'</span></p>
                        <p style="line-height:1; margin-top:-18px;"> <span>'.$row['cl_village'] ." ". $row['cl_post']. " ". $row['cl_district']. "(". $row['cl_state']. ") ". $row['cl_pin'].'</span></p>
                    </div>
                </div>
                <img class="img" style="bottom:10px;" src="../img/sign.png" alt="">
            </section>
            
            <footer class="principalsign" style="background-color: #265b90ff;">
                <p>Contact No. : 9918868227</p>
                <p style="color:white;">Principal Sign.</p>
            </footer>
        </div>';
        }
    } else {
        echo "We are facing some error please try again after Sometime";
    }
} else {
    echo "<h2>Invalid request method</h2>";
}
?>
    </div>
    </main>
    <button type="submit" style="margin-top:-15px;" class="btn btn-success btn-print" onclick="printPage()">Print Reciept</button>
    <!-- <button id="generatePdf">Print Document</button> -->
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
        function printPage() {
        var originalContent = document.body.innerHTML;
        var contentToPrint = document.querySelector('.idmain');
        // console.log('' + print)
        document.body.innerHTML = contentToPrint.outerHTML;
        window.print();
        document.body.innerHTML = originalContent;
    }
    </script>
</body>

</html>