<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
// get method used
$admission = $_GET['admission_no'];
$sql = "SELECT * FROM `tc_generate` WHERE admission_no = '$admission'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

// Insert sql
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $admission = $_GET['admission_no'];
    $sr_no = $_POST['sr_no'];
    $name = $_POST['name'];
    $mother = $_POST['mother'];
    $father = $_POST['father'];
    $nationality = $_POST['nationality'];
    $caste = $_POST['caste'];
    $date_of_first_admission = $_POST['date_of_first_admission'];
    $dob = $_POST['dob'];
    $student_failed = $_POST['student_failed'];
    $subject_offered = $_POST['subject_offered'];
    $last_class_studied = $_POST['last_class_studied'];
    $last_class_result = $_POST['last_class_result'];
    $next_higher_class = $_POST['next_higher_class'];
    $paid_all_dues = $_POST['paid_all_dues'];
    $fee_concession = $_POST['fee_concession'];
    $ncc_cadet = $_POST['ncc_cadet'];
    $date_on_stuck = $_POST['date_on_stuck'];
    $leaving_reason = $_POST['leaving_reason'];
    $meeting_upto_date = $_POST['meeting_upto_date'];
    $attended_date = $_POST['attended_date'];
    $general_conduct = $_POST['general_conduct'];
    $pi_no = $_POST['pi_no'];
    $school_government = $_POST['school_government'];
    $other_remark = $_POST['other_remark'];
    $date_of_issue = $_POST['date_of_issue'];
    $user = $_SESSION['tfirst_name'];
    // $insert_sql = "INSERT INTO `tc_generate` (`admission_no`, `book_no`, `sr_no`, `student_name`, `mother_name`, `father_name`, `nationality`, `category`, `Date_of_first_admission`, `dob`, `student_failed`, `subject_offered`, `last_class_studied`, `last_class_result`, `qualified_by_next_class`, `student_paid_dues`, `fee_concession`, `ncc_cadet`, `date_stuck_forschool`, `reason_for_leaving_school`, `no_of_class_attend`, `attended_date`, `general_conduct`, `school_under_government`, `any_other_remark`, `pi_no`, `date_issue_tc`, `user`) VALUES ('$admissionno', '$book_no', '$sr_no', '$name', '$mother', '$father', '$nationality', '$caste', '$date_of_first_admission', '$dob', '$student_failed', '$subject_offered', '$last_class_studied', '$last_class_result', '$next_higher_class', '$paid_all_dues', '$fee_concession', '$ncc_cadet', '$date_on_stuck', '$leaving_reason', '$meeting_upto_date', '$attended_date', '$general_conduct', '$school_government', '$other_remark', '$pi_no', '$date_of_issue', '$user')";
    $update_sql = "UPDATE `tc_generate` SET `sr_no`='$sr_no',`student_name`='$name',`mother_name`='$mother',`father_name`='$father',`nationality`='$nationality',`category`='$caste',`Date_of_first_admission`='$date_of_first_admission',`dob`='$dob',`student_failed`='$student_failed',`subject_offered`='$subject_offered',`last_class_studied`='$last_class_studied',`last_class_result`='$last_class_result',`qualified_by_next_class`='$next_higher_class',`student_paid_dues`='$paid_all_dues',`fee_concession`='$fee_concession',`ncc_cadet`='$ncc_cadet',`date_stuck_forschool`='$date_on_stuck',`reason_for_leaving_school`='$leaving_reason',`no_of_class_attend`='$meeting_upto_date',`attended_date`='$attended_date',`general_conduct`='$general_conduct',`school_under_government`='$school_government',`any_other_remark`='$other_remark',`pi_no`='$pi_no',`date_issue_tc`='$date_of_issue', `user`='$user' WHERE `admission_no`= '$admission'";
    $insert_result = mysqli_query($conn, $update_sql);
    if($insert_result){
        header("location: ../erp/erp_transfer_certificate.php");
    }
}
?>
<?php
function numberToWords($num) {
    $ones = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
    $tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
    
    if ($num < 20) return $ones[$num];
    if ($num < 100) return $tens[intval($num / 10)] . ($num % 10 !== 0 ? " " . $ones[$num % 10] : "");
    if ($num < 1000) return $ones[intval($num / 100)] . " Hundred" . ($num % 100 !== 0 ? " " . numberToWords($num % 100) : "");
    if ($num < 10000) return numberToWords(intval($num / 1000)) . " Thousand" . ($num % 1000 !== 0 ? " " . numberToWords($num % 1000) : "");
    return $num;
}
function monthToWords($month) {
    $months = ["", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    return $months[$month];
}

function dobToWords($dob) {
    list($year, $month, $day) = explode('-', $dob);
    return numberToWords((int)$day) . " " . monthToWords((int)$month) . " " . numberToWords((int)$year);
}

$date = date("Y-m-d");
list($year, $month, $day) = explode('-', $date);
// select from from tc
$tc_sql = "SELECT * FROM `tc_generate`";
$tc_result = mysqli_query($conn, $tc_sql);
$sno = mysqli_num_rows($tc_result);
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student I'd</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
    <style>
    .tc {
        width: 80vw;
        margin: auto;
    }
    </style>
    <link rel="stylesheet" href="../tc.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body>
    <div class="tranfer">
        <?php
        echo '<form action="" method="post">
            <div class="tc">
                <div class="header">
                    <img src="../img/logo.png" alt="">
                    <div>
                        <h1>SRM Modern Public School</h1>
                        <h6>Senior Secondary(10+2)</h6>
                        <p>Bariyarshah, Bhadar, Amethi(UP) 227406</p>
                        <p>Phone no.- 9793237340, Gmail- srmmps.com</p>
                    </div>
                </div>
                <section class="tcname">
                    <h4>स्थानांतरण प्रमाणपत्र/Transfer Certificate</h4>
                </section>
                <div class="school_detail">
                    <div class="rows">
                        <p>क्रम संख्या/S.no - '. $row['Sno'] .'</p>
                        <p>प्रवेश संख्या/Admission no. - '.$row['admission_no'].'</p>
                        <p>विद्यालय संख्या/School no. - 71792</p>
                        <p>पुस्तक संख्या/Book no. - '.$row['book_no'].'</p>
                    </div>
                    <div class="rows">
                        <p>Affiliation no. - 2133678</p>
                        <p>पी ई नंबर/P.E No. - <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="pi_no" value="'.$row['pi_no'].'"></p>
                        <p>Udise+ no. - 09732705202</p>
                    </div>
                    <div class="rows">
                        <p>Registration No of candidate(Incase of IX to XII) - <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="sr_no" value="'.$row['sr_no'].'"></p></p>
                    </div>
                </div>
                <hr>
                <div class="details" style="margin-top:-13px;">
                    <div class="sno">1.</div>
                    <div class="question">
                        <p>विद्यार्थी का नाम / Name of the student</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="'.$row['student_name'] .'"></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">2.</div>
                    <div class="question">
                        <p>माता का नाम / Mothers Name</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="mother" value="'.$row['mother_name'].'"></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">3.</div>
                    <div class="question">
                        <p>पिता का नाम / Fathers Name</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="father" value="'.$row['father_name'].'"></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">4.</div>
                    <div class="question">
                        <p>राष्ट्रीयता / Nationality</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nationality" value="'.$row['nationality'].'"></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">5.</div>
                    <div class="question">
                        <p>क्या अनुसूचित जाति / अनुसूचित जनजाति / अन्य पिछड़ा वर्ग से सम्बंदित है<br>Whether the
                            student belongs to GEN/SC/ST/OBC Category</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="caste" value="'.$row['category'].'"></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">6.</div>
                    <div class="question">
                        <p>विद्यालय में प्रथम प्रवेश की तिथि और कक्षा<br>Date of first admission in the school
                            with class.</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" name="date_of_first_admission" aria-describedby="emailHelp" value="'.$row['Date_of_first_admission'].'">
                        </p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">7.</div>
                    <div class="question">
                        <p>प्रवेश पंजिका के अनुसार जन्म तिथि (अंको में/in figure) <br>Date of Birth according to
                            admission Register(in words)</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="dob" value="'.$row['dob'].'"></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">8.</div>
                    <div class="question">
                        <p>क्या विद्यार्थी का परीक्षा परिणाम अनुत्तीर्ण है <br>Whether the student is failed?</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" name="student_failed" aria-describedby="emailHelp" value="'.$row['student_failed'].'">
                        </p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">9.</div>
                    <div class="question">
                        <p>प्रस्तावित विषय / Subject offered</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" name="subject_offered" aria-describedby="emailHelp" value="'.$row['subject_offered'].'">
                        </p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">10.</div>
                    <div class="question">
                        <p>पिछली कक्षा जिसमे विद्यार्थी अधयंत्रात था <br>Class in which the student last
                            studied(in words)</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" name="last_class_studied" aria-describedby="emailHelp" value="'.$row['last_class_studied'].'">
                        </p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">11.</div>
                    <div class="question">
                        <p>पिछले विद्यालय / बोर्ड परीक्षा एवं परिणाम <br>School/Board Annaul examination last
                            taken with result</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" name="last_class_result" aria-describedby="emailHelp" value="'.$row['last_class_result'].'">
                        </p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">12.</div>
                    <div class="question">
                        <p>क्या उच्च कक्षा में पदोन्नति का अधिकारी है? <br>whether qualified for promotion to
                            the next higher class?</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" name="next_higher_class" aria-describedby="emailHelp" value="'.$row['qualified_by_next_class'].'">
                        </p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">13.</div>
                    <div class="question">
                        <p>क्या विद्यार्थी ने विद्यालय के देय राशि का भुगतान कर दिया है <br>Whether the student
                            has paid all dues to the school?</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" name="paid_all_dues" aria-describedby="emailHelp" value="'.$row['student_paid_dues'].'">
                        </p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">14.</div>
                    <div class="question">
                        <p>क्या विद्यार्थी का कोई शुल्क रियायत प्रदान की गयी थी ? यदि हाँ , तो उसकी प्रकृति
                            Whether the student was in reciept of any fee concession, if so, the nature of such
                            concession.</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" name="fee_concession" aria-describedby="emailHelp" value="'.$row['fee_concession'].'">
                        </p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">15.</div>
                    <div class="question">
                        <p>क्या विद्यार्थी एन०सी०सी कैंडिट / स्कॉउट है? विवरण दे /Whether the <br>student is NCC
                            cadet/Boy Scout/Girl Guide(give detail)</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" name="ncc_cadet" aria-describedby="emailHelp" value="'.$row['ncc_cadet'].'">
                        </p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">16.</div>
                    <div class="question">
                        <p>विद्यालय से विद्यार्थी का नाम काटे जाने की तिथि <br>Date on which student name was
                            stuck off the rolls of the school</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" name="date_on_stuck" aria-describedby="emailHelp" value="'.$row['date_stuck_forschool'].'">
                        </p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">17.</div>
                    <div class="question">
                        <p>विद्यालय छोड़ने का कारण / Reason for leaving the school</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" name="leaving_reason" aria-describedby="emailHelp" value="'.$row['reason_for_leaving_school'].'">
                        </p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">18.</div>
                    <div class="question">
                        <p>अंतिम तिथि तक उपास्थियों की कुल संख्या <br>Number of meeting up to date</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" name="meeting_upto_date" aria-describedby="emailHelp" value="'.$row['no_of_class_attend'].'">
                        </p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">19.</div>
                    <div class="question">
                        <p>विद्यार्थी की विद्यालय दिवसो की कुल संख्या / Number of school <br>days the student
                            attended date</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" name="attended_date" aria-describedby="emailHelp" value="'.$row['attended_date'].'">
                        </p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">20.</div>
                    <div class="question">
                        <p>सामान्य आचरण / General Conduct</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" name="general_conduct" aria-describedby="emailHelp" value="'.$row['general_conduct'].'">
                        </p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">21.</div>
                    <div class="question">
                        <p>क्या विद्यालय सरकारी / अल्प संख्यक / स्वत्रन्त्र श्रेणी में आता है <br>Whether school
                            is under Govt./Minority/Independent Category</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" name="school_government" aria-describedby="emailHelp" value="'.$row['school_under_government'].'">
                        </p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">22.</div>
                    <div class="question">
                        <p>कोई अन्य टिप्पणी <br>Any other remarks</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" name="other_remark" aria-describedby="emailHelp" value="'.$row['any_other_remark'].'">
                        </p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">23.</div>
                    <div class="question">
                        <p>प्रणाम पत्र जारी करने की तिथि <br>Date of issue of certificate</p>
                    </div>
                    <div class="answer">
                        <p><input type="text" class="form-control" id="exampleInputEmail1" name="date_of_issue" value="'.$row['date_issue_tc'].'" aria-describedby="emailHelp">
                        </p>
                    </div>
                </div>
                <div class="signature">
                    <div class="maker">तैयारकर्ता / Prepared by <br>(Name & Designation)</div>
                    <div class="verifer">जांचकर्ता / Checked by <br>(Name & Designation)</div>
                    <div class="principal">ह० प्राचार्य / कार्यालय मुहर <br>Sign of Principal with offical Seal
                    </div>
                </div>
            </div>
            <button type="submit" style="text-align:center;margin-top:10px;" class="btn btn-success">Update</button>
        </form>';
        ?>
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
</body>

</html>