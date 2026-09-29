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
    <title>Student I'd</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
    page {
        page-size: A 4;
    }
    .idmain .id{
    /* display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    width: 300px; */


    display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 23px 15px;
            row-gap: 65px;;
            padding: 20px;
            /* background: #f5f5f5; */
}
.id .idcard .profilei{
    width: 117px;
    height: 140px;
    border-radius: 10px;
    margin: auto;
    /* border: 4px solid rgb(204, 86, 220); */
}
.id .idcard .profilei img{
    width: 120px;
    height: 139px;
    margin: auto;
    position: absolute;
    /* margin: 10px; */
    margin-top:8px;
    border-radius: 10px;
}
    </style>
</head>

<body>
    <main class="idmain">
    <div class="id" id="id">
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['select']) && is_array($_POST['select'])) {
        $hobbies = $_POST['select'];
        // echo "<h2>You have selected the following hobbies:</h2>";
        // echo "<ul>";
        foreach ($hobbies as $hobby) {
            // echo htmlspecialchars($hobby);
            $sql = "SELECT * FROM `studentsdetail` WHERE admission_number = '$hobby'";
           $result= mysqli_query($conn,$sql);
           $row = mysqli_fetch_assoc($result);
           $date = $row['dob'];
           if($date == '0000-00-00' || $date == '' || $date == null){
            $day = "00";
            $month = "00";
            $year = "0000";
           }else{
            list($year, $month, $day) = explode('-', $date);
           }
           echo '<div class="idcard" style="height: 423px; width:266px;">
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
            <div class="profilei" style="height:147px;"><img src="../profileimage/'.$row['profile_photo'].'" alt="" style="margin-top:13px;"></div>
            <section>
                <h5 style="text-align:center;margin-bottom:15px;margin-top:1.5px;color: rgb(234, 217, 22);">'.$row['first_name'] ." ". $row['middle_name']. " ". $row['last_name'].'</h5>
                <div style="display:flex;justify-content: center;align-item:center; font-size:18px">
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
                        <p><span>'.$day.'/'.$month.'/'.$year.'</span></p>
                        <p style="line-height: 1.1;min-height:41px;"><span>'.$row['village'] ." ". $row['post']. " ". $row['district']. "(". $row['state']. ") ". $row['pin_code'].'</span></p>
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