<?php
include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
$date = date("Y-m-d");
list($year, $month, $day) = explode('-', $date);
if($_SERVER['REQUEST_METHOD']=="POST"){
$month = $_POST['month'];
$year = $_POST['year'];
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRM ERP | stu.Attendence</title>
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
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../teacher/teacher_style.css">
    <script src="../javascript/function.js"></script>
</head>

<body>

    <?php
    include '../partials/youtubeinsta.php';
    ?>
    <div class="sectionerp">
        <div class="section1 hideonmobile">
            <?php include '../erp/erp_sidebar.php'; ?>
        </div>
        <div class="section2">
            <?php
            include '../erp/erp_header.php';?>
            <div class="month_year">
            <h3>Search Attendence Month & Year</h3>
                <form class="months_years" method="post">
                    <div class="mb-3">
                        <label for="month" class="form-label">Month</label>
                        <input type="text" class="form-control" id="month" name="month" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Year</label>
                        <input type="text" class="form-control" id="year" name="year" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div><?php
                $firstDayOfMonth = date("1-$month-$year");
                $totalDaysInMonth = date("t", strtotime($firstDayOfMonth));
                $sql = "SELECT * FROM `studentsdetail`";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_num_rows($result);
                $totalNumberOfStudents = $row;
                $student_class = array();
                $studentname = array();
                $studentid = array();
                $count = 0;
                while($assoc = mysqli_fetch_assoc($result)){
                    $studentname[]= $assoc['first_name']. " ".$assoc['last_name'];
                    $studentid[] = $assoc['admission_number'];
                    $student_class[] = $assoc['class'];
                }
                ?>
            <!-- <h1>Smart Attendence Management System</h1> -->
            <h3 style="padding-left:5px;">Students Attendence of Month: <u>
                    <font color="red"><?php echo strtoupper(date("F", strtotime($firstDayOfMonth)))." ".$year;;?></font>
                </u></h3>
            <table class="table table-bordered" cellspacing="0" id="mytable">
                <?php for($i=1; $i<=$totalNumberOfStudents+2; $i++){
                        if($i == 1){
                            echo "<tr>";
                            echo "<td rowspan='2'>Sno.</td>";
                            echo "<td rowspan='2'>Names</td>";
                            echo "<td rowspan='2'>Class</td>";
                            for($j = 1; $j<=$totalDaysInMonth; $j++){
                                echo "<td>$j</td>";
                            }
                            echo "</tr>";
                        }else if($i==2){
                            echo "<tr>";
                            for($j = 0; $j<$totalDaysInMonth; $j++){
                                echo "<td>".date("D", strtotime("+$j day", strtotime($firstDayOfMonth)))."</td>";
                            }
                            echo "</tr>";
                        }else{
                            echo "<tr>";
                            echo "<td>".($count+1)."</td>";
                            echo "<td>".$studentname[$count]."</td>";
                            echo "<td>".$student_class[$count]."</td>";
                            for($j = 1; $j<=$totalDaysInMonth; $j++){
                                $j=$j<10?'0'.$j:$j;
                                $dateofattendence = date("$year-$month-$j");
                                // echo $dateofattendence;
                                $attendencesql = "SELECT * FROM `student_attendence` Where stu_admission_number ='".$studentid[$count]."' AND curr_date = '".$dateofattendence."'";
                                $attendenceresult = mysqli_query($conn, $attendencesql);
                                $isattendence = mysqli_num_rows($attendenceresult);
                                if($isattendence > 0){
                                    $stu_attendence = mysqli_fetch_assoc($attendenceresult);
                                    if($stu_attendence['attendence_marked'] == 'P'){
                                        $color = 'green';
                                    }
                                    else if($stu_attendence['attendence_marked'] == 'A'){
                                        $color = 'red';
                                    }
                                    else{
                                        $color = 'blue';
                                    }
                                    echo "<td style='color:$color;'>". $stu_attendence['attendence_marked']."</td>";
                                }else{
                                    echo "<td></td>";
                                }
                            }
                            echo "</tr>";
                            $count++;
                        }
                        }
               ?>
            </table>

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
    <script src="jquery-3.7.1.min.js"></script>
    <script>
    // $(document).ready(function() {
    //     $('#mytable').DataTable();
    // });
    //     new DataTable('#mytable', {
    //     columnDefs: [
    //         {
    //             targets: 0,
    //             searchable: false
    //         }
    //     ]
    // });
    function toggleSelectAll(source) {
        const checkboxes = document.querySelectorAll('input[name="select[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = source.checked;
        });
    }
    </script>
</body>

</html>