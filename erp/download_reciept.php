<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}

$fee_reciept = $_GET['fee_reciept'];
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
</head>

<body>
    <div class="feesub">
    <div class="fees_reciept">
        <main class="main">
            <div class="affiliation">
                <p>Affiliation No.- 2133678</p>
                <p> School Code -71792</p>
            </div>
            <header class="header">
                <div class="logo">
                    <img src="../img/logo.png" alt="">
                </div>
                <div class="schoolname">
                    <h2>SRM Modern Public School</h2>
                    <p>Bariyarshah, Bhadar, Amethi(UP) 228159</p>
                    <p>Email: srmmps2010@gmail.com</p>
                    <p style="text-align:right;">Ph: (+91)8572965004</p>
                </div>
            </header>
            <h5>Fee Reciept</h5>
            <hr>
            <?php 
                $reciept_sql = "SELECT * FROM `reciept` WHERE reciept_no = $fee_reciept";
                $reciept_result = mysqli_query($conn, $reciept_sql);
                $reciept_row = mysqli_fetch_assoc($reciept_result);
                $admissionno = $reciept_row['admission_no'];
            echo '<section class=personaldetail>
                <div class="namefather">
                    <p><span>Receipt No : </span><span class="student_bold">'.$reciept_row['reciept_no'].'</span></p>
           <p><span>Admission No : </span><span class="student_bold">'.$reciept_row['admission_no'].'</span></p>
                    <p><span>Name : </span><span class="student_bold">'.$reciept_row['stu_name'].'</span></p>
                    <p><span>Fathers Name : </span><span class="student_bold">'.$reciept_row['father_name'].'</span></p>
                </div>
                <div class="class">
                    <p><span>Session : </span><span class="student_bold">2025-2026</span></p>
                    <p><span>Date : </span><span id="date" class="student_bold" name="date">'.$reciept_row['reciept_date'].'</span></p>
                    <p><span>Class : </span><span class="student_bold">'.$reciept_row['class'].'</span></p>
                </div>
            </section>
            <hr>
            <section class=personaldetail>
                <div class="namefather">
                    <p><span>Particular</span></p>
                    <p><span>Old Fee : </span></p>
                    <p><span>Admission Fee : </span></p>
                    <p><span>Tuition Fee : </span></p>
                    <p><span>convenience Fee : </span></p>
                    <p><span>Examination Fee : </span></p>
                </div>
                <div class="class">
                    <p><span>Amount</span></p>
                    <p><span class="student_bold">'.$reciept_row['old_fee'].'</span></p>
                    <p><span class="student_bold">'.$reciept_row['admission_fee'].'</span></p>
                    <p><span class="student_bold">'.$reciept_row['tuition_fee'].'</span></p>
                    <p><span class="student_bold">'.$reciept_row['bus_fee'].'</span></p>
                    <p><span class="student_bold">'.$reciept_row['exam_fee'].'</span></p>
                </div>
                </section>
            <hr>
            <section class=personaldetail>
                <div class="namefather">
                    <p><span>Total</span></p>
                </div>
                <div class="class">
                    <p><span class="student_bold">'.$reciept_row['total_fee'].'</span></p>
                </div>
            </section>
            <hr>
            <section class=personaldetail>
                <div class="namefather" style="width:560px;">
                    <p><span>Narration : </span><span class="student_bold month">'.$reciept_row['narration'].' fee collected</span></p>
                </div>
            </section>
            <section class=personaldetail>
                <div class="namefather" style="width:560px;">
                    <p><span>Amount(in words) : </span><span class="student_bold" id="convert1">';?>
            <script>
            convertToWords(<?php echo $reciept_row['total_fee']; ?>, "convert1")
            </script> <?php echo '</span><span style="font-weight:650;"> Only</span></p>
                </div>
            </section> 
            <section class=personaldetail>
                <div class="namefather" style="width:560px;">
                    <p><span>Payment Mode : </span><span class="student_bold month">'.$reciept_row['payment_method'].'</span></p>
                </div>
            </section>
            <section class=personaldetail style="margin-top:60px;">
                <div class="namefather">
                    <p><span>Username : </span><span class="student_bold">'.$reciept_row['erp_teacher_name'].'</span></p>
                </div>
                <div class="class">
                    <p><span>Signature</span></p>
                </div>
            </section>';
        ?>
        </main>
        <main class="main">
            <div class="affiliation">
                <p>Affiliation No.- 2133678</p>
                <p> School Code -71792</p>
            </div>
            <header class="header">
                <div class="logo">
                    <img src="../img/logo.png" alt="">
                </div>
                <div class="schoolname">
                    <h2>SRM Modern Public School</h2>
                    <p>Bariyarshah, Bhadar, Amethi(UP) 228159</p>
                    <p>Email: srmmps2010@gmail.com</p>
                    <p style="text-align:right;">Ph: (+91)8572965004</p>
                </div>
            </header>
            <h5>Fee Reciept</h5>
            <hr>
            <?php
            echo '<section class=personaldetail>
                <div class="namefather">
                    <p><span>Receipt No : </span><span class="student_bold">'.$reciept_row['reciept_no'].'</span></p>
           <p><span>Admission No : </span><span class="student_bold">'.$reciept_row['admission_no'].'</span></p>
                    <p><span>Name : </span><span class="student_bold">'.$reciept_row['stu_name'].'</span></p>
                    <p><span>Fathers Name : </span><span class="student_bold">'.$reciept_row['father_name'].'</span></p>
                </div>
                <div class="class">
                    <p><span>Session : </span><span class="student_bold">2025-2026</span></p>
                    <p><span>Date : </span><span id="date" class="student_bold" name="date">'.$reciept_row['reciept_date'].'</span></p>
                    <p><span>Class : </span><span class="student_bold">'.$reciept_row['class'].'</span></p>
                </div>
            </section>
            <hr>
            <section class=personaldetail>
                <div class="namefather">
                    <p><span>Particular</span></p>
                    <p><span>Old Fee : </span></p>
                    <p><span>Admission Fee : </span></p>
                    <p><span>Tuition Fee : </span></p>
                    <p><span>Convenence Fee : </span></p>
                    <p><span>Examination Fee : </span></p>
                </div>
                <div class="class">
                    <p><span>Amount</span></p>
                    <p><span class="student_bold">'.$reciept_row['old_fee'].'</span></p>
                    <p><span class="student_bold">'.$reciept_row['admission_fee'].'</span></p>
                    <p><span class="student_bold">'.$reciept_row['tuition_fee'].'</span></p>
                    <p><span class="student_bold">'.$reciept_row['bus_fee'].'</span></p>
                    <p><span class="student_bold">'.$reciept_row['exam_fee'].'</span></p>
                </div>
                </section>
            <hr>
            <section class=personaldetail>
                <div class="namefather">
                    <p><span>Total</span></p>
                </div>
                <div class="class">
                    <p><span class="student_bold">'.$reciept_row['total_fee'].'</span></p>
                </div>
            </section>
            <hr>
            <section class=personaldetail>
                <div class="namefather" style="width:560px;">
                    <p><span>Narration : </span><span class="student_bold month">'.$reciept_row['narration'].' fee collected</span></p>
                </div>
            </section>
            <section class=personaldetail>
                <div class="namefather" style="width:560px;">
                    <p><span>Amount(in words) : </span><span class="student_bold" id="convert2">';?>
            <script>
            convertToWords(<?php echo $reciept_row['total_fee']; ?>, "convert2")
            </script> <?php echo '</span><span style="font-weight:650;"> Only</span></p>
                </div>
            </section> 
            <section class=personaldetail>
                <div class="namefather" style="width:560px;">
                    <p><span>Payment Mode : </span><span class="student_bold month">'.$reciept_row['payment_method'].'</span></p>
                </div>
            </section>
            <section class=personaldetail style="margin-top:60px;">
                <div class="namefather">
                    <p><span>Username : </span><span class="student_bold">'.$reciept_row['erp_teacher_name'].'</span></p>
                </div>
                <div class="class">
                    <p><span>Signature</span></p>
                </div>
            </section>';
        ?>
        </main>
    </div>
        <button type="submit" style="margin-top:-15px;" class="btn btn-success btn-print" onclick="printPage()">Print Reciept</button>
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
    function printPage() {
        var originalContent = document.body.innerHTML;
        var contentToPrint = document.querySelector('.fees_reciept');
        document.body.innerHTML = contentToPrint.outerHTML;
        window.print();
        document.body.innerHTML = originalContent;
    }
    </script>
</body>

</html>