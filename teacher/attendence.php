<?php
include '../backend/connection.php';
session_start();
$firstDayOfMonth = date("1-m-Y");
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
                <h1>Smart Attendence Management System</h1>
                <h3>Students Attendence of Month: <u><font color="red"><?php echo strtoupper(date("F", strtotime($firstDayOfMonth)));?></font></u></h3>
                <table border="1" class="table table-bordered" cellspacing="0">
                    <?php for($i=1; $i<=$totalNumberOfStudents+2; $i++){
                        if($i == 1){
                            echo "<tr>";
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
                            echo "<td>".$studentname[$count]."</td>";
                            for($j = 1; $j<=$totalDaysInMonth; $j++){
                                $dateofattendence = date("Y-m-$j");
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