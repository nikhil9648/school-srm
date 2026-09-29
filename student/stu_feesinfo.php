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
                <hr>
                <div class="student_personaldetails">
                    <h2 style="text-align:center;color:red;">Fees Details</h2>
                    <hr>
                    <?php
                     $admission_no = $_SESSION['stu_admission_no'];
            $exist_tuition_sql = "SELECT * FROM `tution_fees` where stu_admission_no = '$admission_no'";
            $exist_tuition_result = mysqli_query($conn, $exist_tuition_sql);
            $row_tuition = mysqli_fetch_assoc($exist_tuition_result);
            $exist_bus_sql = "SELECT * FROM `convenience_fees` WHERE stu_conve_admissionno = '$admission_no'";
            $exist_bus_result = mysqli_query($conn, $exist_bus_sql);
            $row_bus = mysqli_fetch_assoc($exist_bus_result);
            if(mysqli_num_rows($exist_tuition_result)>0 && mysqli_num_rows($exist_bus_result)>0){
                echo '<table style="width:50vw;"class="table table-bordered" id="mytable">
                    <thead>
                        <tr>
                            <th scope="col">Month</th>
                           
                            <th scope="col">fees</th>
                           
                        </tr>
                    </thead>
                    <tbody>';?>
                        <?php
                        echo "<tr>
                              <th scope='row'>April</th>";?>
                              <?php if($row_tuition['stu_tuition_apr']==0){ ?>
                                <td style="color:red;">Pending</td>
                             <?php }
                              else{ ?>
                                <td style="color:green;">Submitted</td>
                           <?php }
                              echo "</tr>
                              <tr>
                              <th scope='row'>May</th>";?>
                              <?php if($row_tuition['stu_tuition_may']==0){ ?>
                                <td style="color:red;">Pending</td>
                             <?php }
                              else{ ?>
                                <td style="color:green;">Submitted</td>
                           <?php }
                              echo "</tr>
                              <tr>
                              <th scope='row'>June</th>";?>
                              <?php if($row_tuition['stu_tuition_jun']==0){ ?>
                                <td style="color:red;">Pending</td>
                             <?php }
                              else{ ?>
                                <td style="color:green;">Submitted</td>
                           <?php }
                              echo "</tr>
                              <tr>
                              <th scope='row'>July</th>";?>
                              <?php if($row_tuition['stu_tuition_jul']==0){ ?>
                                <td style="color:red;">Pending</td>
                             <?php }
                              else{ ?>
                                <td style="color:green;">Submitted</td>
                           <?php }
                              echo "</tr>
                              <tr>
                              <th scope='row'>August</th>";?>
                              <?php if($row_tuition['stu_tuition_aug']==0){ ?>
                                <td style="color:red;">Pending</td>
                             <?php }
                              else{ ?>
                                <td style="color:green;">Submitted</td>
                           <?php }
                              echo "</tr>
                              <tr>
                              <th scope='row'>September</th>";?>
                              <?php if($row_tuition['stu_tuition_sep']==0){ ?>
                                <td style="color:red;">Pending</td>
                             <?php }
                              else{ ?>
                                <td style="color:green;">Submitted</td>
                           <?php }
                              echo "</tr>
                              <tr>
                              <th scope='row'>October</th>";?>
                              <?php if($row_tuition['stu_tuition_oct']==0){ ?>
                                <td style="color:red;">Pending</td>
                             <?php }
                              else{ ?>
                                <td style="color:green;">Submitted</td>
                           <?php }
                              echo "</tr>
                              <tr>
                              <th scope='row'>November</th>";?>
                              <?php if($row_tuition['stu_tuition_nov']==0){ ?>
                                <td style="color:red;">Pending</td>
                             <?php }
                              else{ ?>
                                <td style="color:green;">Submitted</td>
                           <?php }
                              echo "</tr>
                              <tr>
                              <th scope='row'>December</th>";?>
                              <?php if($row_tuition['stu_tuition_dec']==0){ ?>
                                <td style="color:red;">Pending</td>
                             <?php }
                              else{ ?>
                                <td style="color:green;">Submitted</td>
                           <?php }
                              echo "</tr>";
                              echo "<tr>
                              <th scope='row'>January</th>";?>
                              <?php if($row_tuition['stu_tuition_jan']==0){ ?>
                                <td style="color:red;">Pending</td>
                             <?php }
                              else{ ?>
                                <td style="color:green;">Submitted</td>
                           <?php }
                              echo "</tr>
                              <tr>
                              <th scope='row'>Feburary</th>";?>
                              <?php if($row_tuition['stu_tuition_feb']==0){ ?>
                                <td style="color:red;">Pending</td>
                             <?php }
                              else{ ?>
                                <td style="color:green;">Submitted</td>
                           <?php }
                              echo "</tr>
                              <tr>
                              <th scope='row'>March</th>";?>
                              <?php if($row_tuition['stu_tuition_mar']==0){ ?>
                                <td style="color:red;">Pending</td>
                             <?php }
                              else{ ?>
                                <td style="color:green;">Submitted</td>
                           <?php }
                           echo "</tr>";
                   ?> 
                    </tbody>
                </table>
                <?php
            }
            ?>
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