<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
$admission = $_GET['admission_no'];
$sql = "SELECT * FROM `tc_generate` WHERE admission_no = '$admission'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transfer Certificate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
    <style>
    page {
        page-size: A 4;
    }
    </style>
    <link rel="stylesheet" href="../tc.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
            <div class="tc">
                <div class="tranfer">
                    <img src="../img/logo.png" alt="">
                </div>
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
                        <p>क्रम संख्या/S.no - <?php echo $row['Sno']; ?></p>
                        <p>प्रवेश संख्या/Admission no. - <?php echo $row['admission_no']; ?></p>
                        <p>विद्यालय संख्या/School no. - 71792</p>

                    </div>
                    <div class="rows">
                        <p>पुस्तक संख्या/Book no. - <?php echo $row['book_no']; ?></p>
                        <p>Affiliation no. - 2133678</p>
                        <p>पी ई नंबर/P.E No. <?php echo $row['pi_no']; ?></p>
                        <p>Udise+ no. - 09732705202</p>
                    </div>
                    <div class="rows">
                        <p>Registration No of candidate(Incase of IX to XII) - <?php echo $row['sr_no']; ?></p>
                    </div>
                </div>
                <hr>
                <div class="details" style="margin-top:-13px;">
                    <div class="sno">1.</div>
                    <div class="question">
                        <p>विद्यार्थी का नाम / Name of the student</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['student_name']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">2.</div>
                    <div class="question">
                        <p>माता का नाम / Mother's Name</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['mother_name']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">3.</div>
                    <div class="question">
                        <p>पिता का नाम / Father's Name</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['father_name']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">4.</div>
                    <div class="question">
                        <p>राष्ट्रीयता / Nationality</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['nationality']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">5.</div>
                    <div class="question">
                        <p>क्या अनुसूचित जाति / अनुसूचित जनजाति / अन्य पिछड़ा वर्ग से सम्बंदित है<br>Whether the
                            student belongs to GEN/SC/ST/OBC Category</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['category']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">6.</div>
                    <div class="question">
                        <p>विद्यालय में प्रथम प्रवेश की तिथि और कक्षा<br>Date of first admission in the school
                            with class.</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['Date_of_first_admission']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">7.</div>
                    <div class="question">
                        <p>प्रवेश पंजिका के अनुसार जन्म तिथि (अंको में/in figure) <br>Date of Birth according to
                            admission Register(in words)</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['dob']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">8.</div>
                    <div class="question">
                        <p>क्या विद्यार्थी का परीक्षा परिणाम अनुत्तीर्ण है <br>Whether the student is failed?</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['student_failed']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">9.</div>
                    <div class="question">
                        <p>प्रस्तावित विषय / Subject offered</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['subject_offered']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">10.</div>
                    <div class="question">
                        <p>पिछली कक्षा जिसमे विद्यार्थी अध्ययनरत था <br>Class in which the student last
                            studied(in words)</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['last_class_studied']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">11.</div>
                    <div class="question">
                        <p>पिछले विद्यालय / बोर्ड परीक्षा एवं परिणाम <br>School/Board Annaul examination last
                            taken with result</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['last_class_result']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">12.</div>
                    <div class="question">
                        <p>क्या उच्च कक्षा में पदोन्नति का अधिकारी है? <br>whether qualified for promotion to
                            the next higher class?</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['qualified_by_next_class']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">13.</div>
                    <div class="question">
                        <p>क्या विद्यार्थी ने विद्यालय के देय राशि का भुगतान कर दिया है <br>Whether the student
                            has paid all dues to the school?</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['student_paid_dues']; ?></p>
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
                        <p>: <?php echo $row['fee_concession']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">15.</div>
                    <div class="question">
                        <p>क्या विद्यार्थी एन०सी०सी कैंडिट / स्कॉउट है? विवरण दे /Whether the <br>student is NCC
                            cadet/Boy Scout/Girl Guide(give detail)</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['ncc_cadet']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">16.</div>
                    <div class="question">
                        <p>विद्यालय से विद्यार्थी का नाम काटे जाने की तिथि <br>Date on which student name was
                            stuck off the rolls of the school</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['date_stuck_forschool']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">17.</div>
                    <div class="question">
                        <p>विद्यालय छोड़ने का कारण / Reason for leaving the school</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['reason_for_leaving_school']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">18.</div>
                    <div class="question">
                        <p>अंतिम तिथि तक उपास्थियों की कुल संख्या <br>Number of meeting up to date</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['no_of_class_attend']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">19.</div>
                    <div class="question">
                        <p>विद्यार्थी की विद्यालय दिवसो की कुल संख्या / Number of school <br>days the student
                            attended date</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['attended_date']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">20.</div>
                    <div class="question">
                        <p>सामान्य आचरण / General Conduct</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['general_conduct']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">21.</div>
                    <div class="question">
                        <p>क्या विद्यालय सरकारी / अल्प संख्यक / स्वत्रन्त्र श्रेणी में आता है <br>Whether school
                            is under Govt./Minority/Independent Category</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['school_under_government']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">22.</div>
                    <div class="question">
                        <p>कोई अन्य टिप्पणी <br>Any other remarks</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['any_other_remark']; ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="sno">23.</div>
                    <div class="question">
                        <p>प्रणाम पत्र जारी करने की तिथि <br>Date of issue of certificate</p>
                    </div>
                    <div class="answer">
                        <p>: <?php echo $row['date_issue_tc']; ?></p>
                    </div>
                </div>
                <div class="signature">
                    <div class="maker">तैयारकर्ता / Prepared by <br>(Name & Designation)</div>
                    <div class="verifer">जांचकर्ता / Checked by <br>(Name & Designation)</div>
                    <div class="principal">ह० प्राचार्य / कार्यालय मुहर <br>Sign of Principal with offical Seal
                    </div>
                </div>
            </div>
            <button type="submit" style="margin:10px 10px;text-align:center;" class="btn btn-success btn-print"
                onclick="printPage()">Print TC</button>
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