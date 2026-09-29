<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['cl_loggedin']) ){ 
    header("Location: ../partials/teacher_login.php");
}
?>
<?php
if(isset($_POST['attendence_submit'])){
    date_default_timezone_set("Asia/Karachi");
    if($_POST['selected_date']==NULL){
        $selected_date = date("Y-m-d");
    }else{
        $selected_date = $_POST['selected_date'];
    }
    $attendence_month = date("M", strtotime($selected_date));
    // echo $attendence_month;
    $attendence_year = date("Y", strtotime($selected_date));

    if(isset($_POST['studentpresent'])){
        $studentpresent = $_POST['studentpresent'];
        $attendence = "P";
        foreach($studentpresent as $std){
            $presentsql = "INSERT INTO `student_attendence` (`stu_admission_number`, `curr_date`, `attendence_month`, `attendence_year`, `attendence_marked`) VALUES ('$std', '$selected_date', '$attendence_month', '$attendence_year', '$attendence')";
            $present_result = mysqli_query($conn, $presentsql);
        }
    }
    if(isset($_POST['studentabsent'])){
        $studentabsent = $_POST['studentabsent'];
        $attendence = "A";
        foreach($studentabsent as $std){
            $absentsql = "INSERT INTO `student_attendence` (`stu_admission_number`, `curr_date`, `attendence_month`, `attendence_year`, `attendence_marked`) VALUES ('$std', '$selected_date', '$attendence_month', '$attendence_year', '$attendence')";
            $absent_result = mysqli_query($conn, $absentsql);
        }
    }
    if(isset($_POST['studentnotmarked'])){
        $studentnotmarked = $_POST['studentnotmarked'];
        $attendence = "H";
        foreach($studentnotmarked as $std){
            $notmarkedsql = "INSERT INTO `student_attendence` (`stu_admission_number`, `curr_date`, `attendence_month`, `attendence_year`, `attendence_marked`) VALUES ('$std', '$selected_date', '$attendence_month', '$attendence_year', '$attendence')";
            $notmarked_result = mysqli_query($conn, $notmarkedsql);
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../student/student_style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="../javascript/function.js"></script>
</head>

<body>
    <div class="student_dashboard">
        <div class="section1 hideonmobile">
            <?php include '../teacher/teacher_sidebar.php' ;?>
        </div>
        <div class="student_main">
            <div class="navbar">
                <?php include '../teacher/teacher_header.php';
                include '../teacher/teacher_mobile_sidebar.php'; 
                ?>
                <table class="table table-bordered attendence_table">
                    <form action="" method="post">
                        <div style="margin-bottom:10px;margin-left:20px;font-weight:6   ``00;font-size:19px; ">
                            <label for="date" style="">Attendence Date </label>
                            <input type="date" id="date" name="selected_date" placeholder="dd-mm-yyyy" value=""
                                style="border-radius:10px;border:1px solid black;padding:2px;">
                        </div>
                        <thead>
                            <tr>
                                <th scope="col">S.no</th>
                                <th scope="col">Student Name</th>
                                <th scope="col"><input class='form-check-input' type='checkbox' name='studentpresent[]'
                                        onclick="toggleSelectAllpresent(this)" id="select-all"> P</th>
                                <th scope="col"><input class='form-check-input' type='checkbox' name='studentabsent[]'
                                        onclick="toggleSelectAllabsent(this)" id="select-all"> A</th>
                                <th scope="col"><input class='form-check-input' type='checkbox'
                                        name='studentnotmarked[]' onclick="toggleSelectAllholiday(this)"
                                        id="select-all"> H</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $classteacher = $_SESSION['cl_classesteacher'];
                            $sql = "SELECT * FROM `studentsdetail` WHERE class = '$classteacher'";
                            $result = mysqli_query($conn, $sql);
                            $sno = 0;
                            while($row = mysqli_fetch_assoc($result)){
                                $sno = $sno+1;
                               echo "<tr>
                               <th scope='row'>".$sno."</th>
                            <td>".$row['first_name'] ." ". $row['middle_name']. " ". $row['last_name']."</td>
                            <td><input class='form-check-input' type='checkbox' value='".$row['admission_number']."' name='studentpresent[]' id='flexCheckDefault'></td>
                            <td><input class='form-check-input' type='checkbox' value='".$row['admission_number']."' name='studentabsent[]' id='flexCheckDefault'></td>
                            <td><input class='form-check-input' type='checkbox' value='".$row['admission_number']."' name='studentnotmarked[]' id='flexCheckDefault'></td>
                            </tr>";
                            }
                            ?>
                        </tbody>
                </table>
                <button type="submit" class="btn btn-success" name="attendence_submit"
                    style="margin-left: 37vw;margin-top: 10px;">Submit</button>
                </form>

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

        function toggleSelectAllpresent(source) {
            const checkboxes = document.querySelectorAll('input[name="studentpresent[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
        }

        function toggleSelectAllabsent(source) {
            const checkboxes = document.querySelectorAll('input[name="studentabsent[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
        }
        function toggleSelectAllholiday(source) {
            const checkboxes = document.querySelectorAll('input[name="studentnotmarked[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
        }
        </script>
</body>

</html>