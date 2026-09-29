<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
if($_SERVER['REQUEST_METHOD']=="POST"){
    $admissionno = trim($_POST['admission']);
    $safeAdmission = mysqli_real_escape_string($conn, $admissionno);

    $tc_sql = "SELECT `admission_no` FROM `tc_generate` WHERE admission_no = '".$safeAdmission."' LIMIT 1";
    $tc_result = mysqli_query($conn, $tc_sql);
    if($tc_result && mysqli_num_rows($tc_result) > 0){
        ?>
        <script>alert("TC already generated for this admission number.")</script>
        <?php
    } else {
    $sql = "SELECT * FROM `studentsdetail` WHERE admission_number = '".$safeAdmission."'";
    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);
    if($numrows==1){
        header("location: ../erp/erp_tc_form.php?admission=$safeAdmission");
    }
    else{
        ?>
        <script>alert("Please Enter correct details.")</script> 
        <?php
    }
    }
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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link rel="stylesheet" href="../tc.css">
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
</head>

<body>
    <div class="sectionerp">
        <div class="section1 hideonmobile">
            <?php include '../erp/erp_sidebar.php'; ?>
        </div>
        <div class="section2">
            <?php
            include '../erp/erp_header.php';
            ?>
            <div class="generate_tc">
                <h2>Generate Transfer Certificate</h2>
                <form class="generate" action="" method="post">
                    <div class="mb-3">
                        <label for="admission" class="form-label">Admission Number</label>
                        <input type="text" class="form-control" id="admission" name="admission" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-success">Search</button>
                </form>
            </div>
            <div class="teachersrecord">
                <h2>View Transfer Certificate</h2>
                <table class="table table-bordered" id="mytable">
                    <thead>
                        <tr>
                            <th scope="col">Sno</th>
                            <th scope="col">Book No</th>
                            <th scope="col">Stu Name</th>
                            <th scope="col">Fa Name</th>
                            <th scope="col">User</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $existsql = "SELECT * FROM `tc_generate`";
                        $resultexist = mysqli_query($conn, $existsql);
                    $sno = 0;
                    while($existrow= mysqli_fetch_assoc($resultexist)){
                        $sno= $sno+1;
                        echo "<tr>
                              <th scope='row'>".$sno."</th>
                              <td>".$existrow['book_no']."</td>
                              <td>".$existrow['student_name'] ."</td>
                              <td>".$existrow['father_name'] ."</td>
                              <td>".$existrow['user']."</td>
                              <td><a href='../erp/erp_tc_view.php?admission_no=".$existrow['admission_no']."'><button class='edit btn btn-sm btn-success' id = ".$existrow['admission_no']."> View TC </button></a> <a href='../erp/erp_tc_edit_form.php?admission_no=".$existrow['admission_no']."'><button class='edit btn btn-sm btn-primary' id = ".$existrow['admission_no']."> Update TC </button></a></td>
                              </tr>";
                    }
                    ?>
                    </tbody>
                </table>
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
    function printPage() {
        var originalContent = document.body.innerHTML;
        var contentToPrint = document.querySelector('.tc');
        // console.log('' + print)
        document.body.innerHTML = contentToPrint.outerHTML;
        window.print();
        document.body.innerHTML = originalContent;
    }
    </script>
</body>

</html>