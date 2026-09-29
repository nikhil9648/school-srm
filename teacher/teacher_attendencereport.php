<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['cl_loggedin']) ){ 
    header("Location: ../partials/teacher_login.php");
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
    <title>Student I'd</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../student/student_style.css">
    
    <link rel="stylesheet" href="../erpstyle.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="../javascript/function.js"></script>
    <link rel="stylesheet" href="./teacher_style.css">
</head>

<body>
    <div class="student_dashboard">
        <div class="section1 hideonmobile">
            <?php include '../teacher/teacher_sidebar.php' ;?>
        </div>
        <div class="student_main">
            <div class="navbar">
                <?php include '../teacher/teacher_header.php';
                include '../teacher/teacher_mobile_sidebar.php';?>
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
                $class = $_SESSION['cl_classesteacher'];
                $sql = "SELECT * FROM `studentsdetail` WHERE class = '$class'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_num_rows($result);
                $totalNumberOfStudents = $row;
                $studentname = array();
                $studentid = array();
                $count = 0;
                while($assoc = mysqli_fetch_assoc($result)){
                    $studentname[]= $assoc['first_name']. " ".$assoc['last_name'];
                    $studentid[] = $assoc['admission_number'];
                }
                ?>
                <!-- <h1>Smart Attendence Management System</h1> -->
                <h3>Students Attendence of Month: <u><font color="red"><?php echo strtoupper(date("F", strtotime($firstDayOfMonth)))." ".$year;?></font></u></h3>
                <table class="table table-bordered" cellspacing="0">
                    <?php for($i=1; $i<=$totalNumberOfStudents+2; $i++){
                        if($i == 1){
                            echo "<tr>";
                            echo "<td rowspan='2'>Sno.</td>";
                            echo "<td rowspan='2'>Names</td>";
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