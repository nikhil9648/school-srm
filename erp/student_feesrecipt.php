<?php include '../backend/connection.php';
$showerror = false;
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
$admissionno = $_GET['admission_no'];
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $rsql= "SELECT * FROM `reciept`";
    $rresult = mysqli_query($conn, $rsql);
    while($rowss = mysqli_fetch_assoc($rresult)){
        $record = $rowss['reciept_no'];
    }
    $reciept = $record+1;
    $old_fee = $_POST['old_fee'];
    $fee_admission = $_POST['admission_fee'];
    $fee_tuition = $_POST['tuition_fee'];
    $fee_bus = $_POST['bus_fee'];
    $exam_fee = $_POST['exam_fee'];
    $narration = $_POST['narration'];
    $payment_mode = $_POST['flexRadioDefault'];
    if($payment_mode=="Online"){
        $payment = "Online";
    }
    else{
        $payment= "Cash";
    }
    $dates = date("d-m-Y");
    $erp_teacher_name = $_SESSION['tfirst_name'];
    $total = $_POST['old_fee'] + $_POST['admission_fee'] + $_POST['tuition_fee'] + $_POST['bus_fee'] + $_POST['exam_fee'];
    // select student details
    $stu_det_sql = "SELECT first_name, last_name, middle_name, father_name, class FROM `studentsdetail` WHERE admission_number = '$admissionno'";
    $stu_det_result = mysqli_query($conn, $stu_det_sql);
    $stu_row = mysqli_fetch_assoc($stu_det_result);
    $name= $stu_row['first_name'] ." ". $stu_row['middle_name'] ." ". $stu_row['last_name'];
    $father_name = $stu_row['father_name'];
    $class = $stu_row['class'];
    // check reciept no is already registered are not
    $sql = "SELECT * FROM `reciept` WHERE reciept_no = '$reciept'";
    $resultexist = mysqli_query($conn, $sql);
    $existrow = mysqli_num_rows($resultexist);
    if($existrow>0){
        $showerror = "Reciept Number already exist.";
    }
    else{
    $insertsql = "INSERT INTO `reciept` (`admission_no`, `stu_name`, `father_name`, `class`, `reciept_no`, `old_fee`, `admission_fee`, `tuition_fee`, `bus_fee`, `exam_fee`, `total_fee`, `narration`, `payment_method`, `reciept_date`, `erp_teacher_name`) VALUES ('$admissionno', '$name', '$father_name', '$class', '$reciept', '$old_fee', '$fee_admission', '$fee_tuition', '$fee_bus', '$exam_fee', '$total', '$narration','$payment','$dates','$erp_teacher_name')";
    $result = mysqli_query($conn, $insertsql);
    if($result){
    header("location: ../erp/download_reciept.php?fee_reciept='$reciept'");
    }
}
}
?>
<?php
$date = date("Y-m-d");
list($year, $month, $day) = explode('-', $date);


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fees Reciept</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../erpstyle.css">
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
    <script src="../javascript/function.js"></script>
    <style>
    body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .feesubmit {
        border: 2px solid black;
        border-radius: 10px;
        padding: 10px;
        margin-top: 100px;
    }

    a {
        margin-left: 125px;
    }
    </style>
</head>

<body>
    <?php
        if($showerror){
        echo '<div id="hello" class="alert alert-success alert-dismissible fade show loggedin" role="alert">
        <strong>Unsuccessful </strong> '.$showerror.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <div class="feesubmit">
        <form action="" method="POST">
            <div class="mb-3">
                <label for="old_fee" class="form-label">Old Fee : </label>
                <input type="text" class="form-label" name="old_fee" id="old_fee" placeholder="Enter Old Fee" value="0">
            </div>
            <div class="mb-3">
                <label for="admission_fee" class="form-label">Admission Fee : </label>
                <input type="text" class="form-label" name="admission_fee" id="admission_fee"
                    placeholder="Enter Admission Fee" value="0">
            </div>
            <div class="mb-3">
                <label for="tuition_fee" class="form-label">Tuition Fee : </label>
                <input type="text" class="form-label" name="tuition_fee" id="tuition_fee"
                    placeholder="Enter Tuition Fee">
            </div>
            <div class="mb-3">
                <label for="bus_fee" class="form-label">Convienence Fee : </label>
                <input type="text" class="form-label" name="bus_fee" id="bus_fee" placeholder="Enter Convienence Fee">
            </div>
            <div class="mb-3">
                <label for="exam_fee" class="form-label">Examination Fee : </label>
                <input type="text" class="form-label" name="exam_fee" id="exam_fee" placeholder="Enter Exam Fee"
                    value="0">
            </div>
            <div class="mb-3">
                <label for="narration" class="form-label">Narration : </label>
                <input type="text" class="form-label" name="narration" id="narration" placeholder="Enter Month">
            </div>
            <div style="display:flex;gap:50px;">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                        value="Online">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Paid by Online
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                        value="Cash" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Paid By Cash
                    </label>
                </div>
            </div>
            <!-- <input type="hidden" class="date" name="date" id="date"> -->
            <a href=""><button type="submit" class="btn btn-success">Generate</button></a>
        </form>
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
        // console.log('' + print)
        document.body.innerHTML = contentToPrint.outerHTML;
        window.print();
        document.body.innerHTML = originalContent;
    }
    const d = document.getElementById("date");
    const currentDate = new Date();
    const day = currentDate.getDate();
    const month = currentDate.getMonth() + 1; // Months are zero-based
    const year = currentDate.getFullYear();
    let value = `${day}/${month}/${year}`;
    d.setAttribute('value', value);
    // return `${day}/${month}/${year}`// e.g., "21/12/2024"
    </script>
</body>

</html>