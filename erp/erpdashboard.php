<?php
$showalert=false;
$attendencess = false;
include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
$sql = "SELECT * FROM `studentsdetail` WHERE transport_fac = 'Yes'";
    $result = mysqli_query($conn, $sql);
    $bus_facility = mysqli_num_rows($result); 
$sql = "SELECT * FROM `driver_details`";
    $result = mysqli_query($conn, $sql);
    $total_driver = 0;
    $conductor = 0;
    $other = 0;
    While($row = mysqli_fetch_assoc($result)){
        if($row['dri_designation'] == 'Bus Driver'){
            $total_driver = $total_driver + 1;
        }else if($row['dri_designation'] == 'Conductor'){
            $conductor = $conductor + 1;
        }else{
            $other = $other + 1;
        }
    }
?>
<!-- Attendence details -->
<?php
                        $present=0;
                        $absent = 0;
                        $dateofattendence = date("Y-m-d");
                         $attendencesql = "SELECT * FROM `student_attendence` Where curr_date = '".$dateofattendence."'";
                         $attendenceresult = mysqli_query($conn, $attendencesql);
                         if($isattendence = mysqli_num_rows($attendenceresult) > 0){
                            while($stu_attendence = mysqli_fetch_assoc($attendenceresult)){
                             if($stu_attendence['attendence_marked'] == 'P'){
                                 $present = $present+1;
                             }
                             else if($stu_attendence['attendence_marked'] == 'A'){
                                 $absent =$absent + 1;
                             }
                            }
                        }
                        else{
                            $attendencess = true;    
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
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../erpstyle.css">
    <script src="../javascript/function.js"></script>
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
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
            include '../erp/erp_header.php';
            $sql = "SELECT * FROM `studentsdetail` WHERE status IN ('Active', 'New Admission')";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_num_rows($result);
            $tsql = "SELECT * FROM `class`";
            $tresult = mysqli_query($conn, $tsql);
            $trows = mysqli_num_rows($tresult);
            ?>
            <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            echo '<div class="main">
                <div class="welcome">
                    <h1 style="color:pink;"><span>Welcome, </span><span>' . $_SESSION['tfirst_name'] . '</span></h1>
                </div>
                <div class="record">
                    <div class="contain record1" style="background-color: rgb(238, 232, 240);">
                        <div>
                            <p style="font-size:13px;font-weight:450;">Students</p>
                            <h5 style="margin-top:-20px;">'.$rows.'</h5>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#B197FC"
                                d="M320 32c-8.1 0-16.1 1.4-23.7 4.1L15.8 137.4C6.3 140.9 0 149.9 0 160s6.3 19.1 15.8 22.6l57.9 20.9C57.3 229.3 48 259.8 48 291.9l0 28.1c0 28.4-10.8 57.7-22.3 80.8c-6.5 13-13.9 25.8-22.5 37.6C0 442.7-.9 448.3 .9 453.4s6 8.9 11.2 10.2l64 16c4.2 1.1 8.7 .3 12.4-2s6.3-6.1 7.1-10.4c8.6-42.8 4.3-81.2-2.1-108.7C90.3 344.3 86 329.8 80 316.5l0-24.6c0-30.2 10.2-58.7 27.9-81.5c12.9-15.5 29.6-28 49.2-35.7l157-61.7c8.2-3.2 17.5 .8 20.7 9s-.8 17.5-9 20.7l-157 61.7c-12.4 4.9-23.3 12.4-32.2 21.6l159.6 57.6c7.6 2.7 15.6 4.1 23.7 4.1s16.1-1.4 23.7-4.1L624.2 182.6c9.5-3.4 15.8-12.5 15.8-22.6s-6.3-19.1-15.8-22.6L343.7 36.1C336.1 33.4 328.1 32 320 32zM128 408c0 35.3 86 72 192 72s192-36.7 192-72L496.7 262.6 354.5 314c-11.1 4-22.8 6-34.5 6s-23.5-2-34.5-6L143.3 262.6 128 408z" />
                        </svg>
                    </div>
                    <div class="contain record2" style="background-color: rgb(232, 239, 240);">
                        <div>
                            <p style="font-size:13px;font-weight:450;">Teachers</p>
                            <h5 style="margin-top:-20px;">'.$trows.'</h5>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#74C0FC"
                                d="M192 96a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm-8 384l0-128 16 0 0 128c0 17.7 14.3 32 32 32s32-14.3 32-32l0-288 56 0 64 0 16 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-16 0 0-64 192 0 0 192-192 0 0-32-64 0 0 48c0 26.5 21.5 48 48 48l224 0c26.5 0 48-21.5 48-48l0-224c0-26.5-21.5-48-48-48L368 0c-26.5 0-48 21.5-48 48l0 80-76.9 0-65.9 0c-33.7 0-64.9 17.7-82.3 46.6l-58.3 97c-9.1 15.1-4.2 34.8 10.9 43.9s34.8 4.2 43.9-10.9L120 256.9 120 480c0 17.7 14.3 32 32 32s32-14.3 32-32z" />
                        </svg>
                    </div>
                    <div class="contain record3" style="background-color: rgb(225, 220, 229);">
                        <div>
                            <p style="font-size:13px;font-weight:450;">Bus Facilities</p>
                            <h5 style="margin-top:-20px;">'.$bus_facility.'</h5>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#25c17d" d="M288 0C422.4 0 512 35.2 512 80l0 16 0 32c17.7 0 32 14.3 32 32l0 64c0 17.7-14.3 32-32 32l0 160c0 17.7-14.3 32-32 32l0 32c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-32-192 0 0 32c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-32c-17.7 0-32-14.3-32-32l0-160c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32c0 0 0 0 0 0l0-32s0 0 0 0l0-16C64 35.2 153.6 0 288 0zM128 160l0 96c0 17.7 14.3 32 32 32l112 0 0-160-112 0c-17.7 0-32 14.3-32 32zM304 288l112 0c17.7 0 32-14.3 32-32l0-96c0-17.7-14.3-32-32-32l-112 0 0 160zM144 400a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm288 0a32 32 0 1 0 0-64 32 32 0 1 0 0 64zM384 80c0-8.8-7.2-16-16-16L208 64c-8.8 0-16 7.2-16 16s7.2 16 16 16l160 0c8.8 0 16-7.2 16-16z"/></svg>
                    </div>
                    <div class="contain record3" style="background-color: rgba(237, 229, 231, 1);">
                        <div>
                            <p style="font-size:13px;font-weight:450;">Bus Driver</p>
                            <h5 style="margin-top:-20px;">' . $total_driver . '</h5>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#dfaf49"
                                d="M4.1 38.2C1.4 34.2 0 29.4 0 24.6C0 11 11 0 24.6 0L133.9 0c11.2 0 21.7 5.9 27.4 15.5l68.5 114.1c-48.2 6.1-91.3 28.6-123.4 61.9L4.1 38.2zm503.7 0L405.6 191.5c-32.1-33.3-75.2-55.8-123.4-61.9L350.7 15.5C356.5 5.9 366.9 0 378.1 0L487.4 0C501 0 512 11 512 24.6c0 4.8-1.4 9.6-4.1 13.6zM80 336a176 176 0 1 1 352 0A176 176 0 1 1 80 336zm184.4-94.9c-3.4-7-13.3-7-16.8 0l-22.4 45.4c-1.4 2.8-4 4.7-7 5.1L168 298.9c-7.7 1.1-10.7 10.5-5.2 16l36.3 35.4c2.2 2.2 3.2 5.2 2.7 8.3l-8.6 49.9c-1.3 7.6 6.7 13.5 13.6 9.9l44.8-23.6c2.7-1.4 6-1.4 8.7 0l44.8 23.6c6.9 3.6 14.9-2.2 13.6-9.9l-8.6-49.9c-.5-3 .5-6.1 2.7-8.3l36.3-35.4c5.6-5.4 2.5-14.8-5.2-16l-50.1-7.3c-3-.4-5.7-2.4-7-5.1l-22.4-45.4z" />
                        </svg>
                    </div>
                    <div class="contain record3" style="background-color: rgba(223, 220, 229, 1);">
                        <div>
                            <p style="font-size:13px;font-weight:450;">Conductor</p>
                            <h5 style="margin-top:-20px;">'.$conductor.'</h5>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#25c17d" d="M288 0C422.4 0 512 35.2 512 80l0 16 0 32c17.7 0 32 14.3 32 32l0 64c0 17.7-14.3 32-32 32l0 160c0 17.7-14.3 32-32 32l0 32c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-32-192 0 0 32c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-32c-17.7 0-32-14.3-32-32l0-160c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32c0 0 0 0 0 0l0-32s0 0 0 0l0-16C64 35.2 153.6 0 288 0zM128 160l0 96c0 17.7 14.3 32 32 32l112 0 0-160-112 0c-17.7 0-32 14.3-32 32zM304 288l112 0c17.7 0 32-14.3 32-32l0-96c0-17.7-14.3-32-32-32l-112 0 0 160zM144 400a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm288 0a32 32 0 1 0 0-64 32 32 0 1 0 0 64zM384 80c0-8.8-7.2-16-16-16L208 64c-8.8 0-16 7.2-16 16s7.2 16 16 16l160 0c8.8 0 16-7.2 16-16z"/></svg>
                    </div>
                    <div class="contain record3" style="background-color: rgb(237, 235, 229);">
                        <div>
                            <p style="font-size:13px;font-weight:450;">School Staff</p>
                            <h5 style="margin-top:-20px;">'.$other.'</h5>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#dfaf49"
                                d="M4.1 38.2C1.4 34.2 0 29.4 0 24.6C0 11 11 0 24.6 0L133.9 0c11.2 0 21.7 5.9 27.4 15.5l68.5 114.1c-48.2 6.1-91.3 28.6-123.4 61.9L4.1 38.2zm503.7 0L405.6 191.5c-32.1-33.3-75.2-55.8-123.4-61.9L350.7 15.5C356.5 5.9 366.9 0 378.1 0L487.4 0C501 0 512 11 512 24.6c0 4.8-1.4 9.6-4.1 13.6zM80 336a176 176 0 1 1 352 0A176 176 0 1 1 80 336zm184.4-94.9c-3.4-7-13.3-7-16.8 0l-22.4 45.4c-1.4 2.8-4 4.7-7 5.1L168 298.9c-7.7 1.1-10.7 10.5-5.2 16l36.3 35.4c2.2 2.2 3.2 5.2 2.7 8.3l-8.6 49.9c-1.3 7.6 6.7 13.5 13.6 9.9l44.8-23.6c2.7-1.4 6-1.4 8.7 0l44.8 23.6c6.9 3.6 14.9-2.2 13.6-9.9l-8.6-49.9c-.5-3 .5-6.1 2.7-8.3l36.3-35.4c5.6-5.4 2.5-14.8-5.2-16l-50.1-7.3c-3-.4-5.7-2.4-7-5.1l-22.4-45.4z" />
                        </svg>
                    </div>
                </div>
            </div>';
        }
             ?>
            <div class="attendence_container">
                <div class="containers">

                </div>
                <div class="attendence_graph">
                <?php 
                    if($attendencess){
                        echo '<h4 style="color:red;text-align:center;">Overall Attendence</h4>
                                  <h5 style="color:red;text-align:center">0%</h5>';
                    }
                    else{
                        echo '<canvas id="attendanceChart">
                    
                    </canvas>';
                    }
                    ?>
                    
                </div>
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
    // Manually define attendance data
    let attendanceData = {
        "Present": <?php echo $present;?>,
        "Absent": <?php echo $absent;?>
    };

    // Calculate total students
    let totalStudents = Object.values(attendanceData).reduce((a, b) => a + b, 0);

    // Extract labels and values
    let labels = Object.keys(attendanceData);
    let values = Object.values(attendanceData);

    // Create doughnut chart
    var ctx = document.getElementById('attendanceChart').getContext('2d');
    var attendanceChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: values,
                backgroundColor: ['green', 'red'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            let count = values[tooltipItem.dataIndex];
                            let percentage = ((count / totalStudents) * 100).toFixed(1);
                            return ` ${labels[tooltipItem.dataIndex]}: ${count} (${percentage}%)`;
                        }
                    }
                },
                legend: {
                    position: 'top'
                },
                datalabels: {
                    color: 'white',
                    font: {
                        weight: 'bold',
                        size: 13
                    },
                    formatter: (value, context) => {
                        let percentage = ((value / totalStudents) * 100).toFixed(1);
                        return `${value} (${percentage}%)`; // Display count + percentage inside chart
                    }
                }
            }
        },
        plugins: [ChartDataLabels] // Enable datalabels plugin
    });
    </script>
</body>

</html>