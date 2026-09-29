<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
    exit;
}
$showalert=false;
$showerror = '';

        
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $existsqls = "SELECT MAX(CAST(admission_number AS UNSIGNED)) AS last_admission_no FROM `studentsdetail`";
        $results = mysqli_query($conn, $existsqls);
        $row = mysqli_fetch_assoc($results);
        $lastAdmissionNo = isset($row['last_admission_no']) ? (int)$row['last_admission_no'] : 1000;

        $firstname = mysqli_real_escape_string($conn, $_POST['first'] ?? '');
        $lastname = mysqli_real_escape_string($conn, $_POST['last'] ?? '');
        $middlename = mysqli_real_escape_string($conn, $_POST['middle'] ?? '');
        $gender = mysqli_real_escape_string($conn, $_POST['gender'] ?? '');
        $caste = mysqli_real_escape_string($conn, $_POST['caste'] ?? '');
        $regilion = mysqli_real_escape_string($conn, $_POST['religion'] ?? '');
        $class = mysqli_real_escape_string($conn, $_POST['class'] ?? '');
        $mothername = mysqli_real_escape_string($conn, $_POST['mother'] ?? '');
        $fathername = mysqli_real_escape_string($conn, $_POST['father'] ?? '');
        $dob = mysqli_real_escape_string($conn, $_POST['dob'] ?? '');
        $admissionno = $lastAdmissionNo + 1;
        $status = mysqli_real_escape_string($conn, $_POST['status'] ?? 'New Admission');
        $transport = mysqli_real_escape_string($conn, $_POST['transport'] ?? 'No');
        $bus_fees = mysqli_real_escape_string($conn, $_POST['bus_fees'] ?? 0);
        $transfer = mysqli_real_escape_string($conn, $_POST['tc'] ?? 'No');
        $sr_no = mysqli_real_escape_string($conn, $_POST['sr_no'] ?? '');
        $password = $_POST['password'] ?? '';
        $mobileno = mysqli_real_escape_string($conn, $_POST['mobile'] ?? '');
        $aadharno = mysqli_real_escape_string($conn, $_POST['aadhar'] ?? '');
        $village = mysqli_real_escape_string($conn, $_POST['village'] ?? '');
        $post = mysqli_real_escape_string($conn, $_POST['post'] ?? '');
        $district = mysqli_real_escape_string($conn, $_POST['district'] ?? '');
        $gmailid = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
        $state = mysqli_real_escape_string($conn, $_POST['state'] ?? '');
        $pincode = mysqli_real_escape_string($conn, $_POST['pincode'] ?? '');

        $file = '';
        if(isset($_FILES['profile']) && !empty($_FILES['profile']['name'])){
            $df_name = md5(time());
            $file_name = basename($_FILES['profile']['name']);
            $file = $df_name.$file_name;
            $tempname = $_FILES['profile']['tmp_name'];
            $folder = '../profileimage/'.$file;
            move_uploaded_file($tempname, $folder);
        }
       
        $existsql = "SELECT * FROM `studentsdetail` WHERE admission_number = '$admissionno' LIMIT 1";
        $result = mysqli_query($conn, $existsql);
        $numrows = mysqli_num_rows($result);
        
        if($numrows>0){
            $showerror = "This student admission number is already registered.";
        }
        else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `studentsdetail` (`first_name`, `last_name`, `middle_name`, `gender`, `Caste`, `religion`, `class`, `mother_name`, `father_name`, `dob`, `admission_number`, `profile_photo`, `transport_fac`, `transfer_certificate`, `sr_no`, `password`, `mobile_number`, `aadhar_number`, `village`, `post`, `district`, `email_address`, `state`, `pin_code`, `status`) VALUES ('$firstname', '$lastname', '$middlename', '$gender', '$caste', '$regilion', '$class', '$mothername', '$fathername', '$dob', '$admissionno', '$file', '$transport', '$transfer', '$sr_no', '$hash', '$mobileno', '$aadharno', '$village', '$post', '$district', '$gmailid', '$state', '$pincode', '$status')";
            $resultn = mysqli_query($conn, $sql);
            if($transport == "Yes"){
                $sqlfees = "INSERT INTO `map_convence_fees` (`trans_admission_no`, `2026-2027_fees`) VALUES ('$admissionno', '$bus_fees')";
                mysqli_query($conn, $sqlfees);
            }
            if($resultn){
                header("location: ../erp/erpdashboard.php");
            }
            else{
                $showerror = "Your data was not inserted successfully. Please try again.";
            }
        }
        // header("location:/school/partials/admissionform.php");
    }

    $date = date("Y-m-d");
    list($year, $month, $day) = explode('-', $date);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admission form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    /* background-color: #c7dfdd; */
    .button {
        display: flex;
        justify-content: center;
        margin: 20px 0px;
        /* padding:0px 20px; */
    }

    .button .btn {
        padding: 7px 30px;
    }
    </style>
</head>

<body>
    <?php
            if($showalert){
                echo '<div class="success alert-warning alert-dismissible fade show" role="alert">
  <strong>SUCCESSFUL</strong> '. $showalert .' 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
            }
            if($showerror){
                echo '<div class="danger alert-warning alert-dismissible fade show" role="alert">
    <strong>Error!</strong> '. $showerror .' 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
            }
        
?>
    <h1 class="text-center">New Admission</h1>
    <button onclick="goBack()" class="btn btn-secondary back-btn" style="margin-bottom:-10px; left:10px;position:fixed; top:10px;">
            ← Back
        </button>
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="container">
            <div style="border: 1px solid black;padding:15px;border-radius:10px;margin-bottom:20px">
                <div class="row my-3">
                    <div class="col">
                        <label for="first" class="form-label">First name</label>
                        <input type="text" class="form-control" name="first" id="first" placeholder="First name"
                            aria-label="First name" required>
                    </div>
                    <div class="col">
                        <label for="last" class="form-label">Last name</label>
                        <input type="text" class="form-control" name="last" id="last" placeholder="Last name"
                            aria-label="Last name">
                    </div>
                    <div class="col">
                        <label for="middle" class="form-label">Middle name</label>
                        <input type="text" class="form-control" name="middle" id="middle" placeholder="Middle name"
                            aria-label="Middle name">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" aria-label="Default select example" name="gender" id="gender"
                            required>
                            <option selected>Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Transgender">Transgender</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="caste" class="form-label">Caste</label>
                        <select class="form-select" aria-label="Default select example" name="caste" id="caste"
                            required>
                            <option selected>Select</option>
                            <option value="General">General</option>
                            <option value="OBC">OBC</option>
                            <option value="SC/ST">SC/ST</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="religion" class="form-label">Religion</label>
                        <select class="form-select" aria-label="Default select example" name="religion" id="religion">
                            <option selected>Select</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Muslim">Muslim</option>
                            <option value="Sikh">Sikh</option>
                        </select>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="class" class="form-label">Class</label>
                        <select type="text" class="form-select" name="class" placeholder="Class" aria-label="class"
                            id="class" required>
                            <option>Select</option>
                            <option value="PG">PG</option>
                            <option value="LKG">LKG</option>
                            <option value="SKG">SKG</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="mother" class="form-label">Mother's Name</label>
                        <input type="text" class="form-control" name="mother" placeholder="Mother's name"
                            aria-label="Mother name" id="mother">
                    </div>
                    <div class="col">
                        <label for="father" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" name="father" placeholder="Father's name"
                            aria-label="Father name" id="father">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="dob" class="form-label">DOB</label>
                        <input type="date" class="form-control" id="dob" name="dob">
                    </div>
                    <div class="col">
                        <label for="formFile" class="form-label">Upload Profile Photo(.jpeg/.jpg/.png)</label>
                        <input class="form-control" type="file" id="formFile" name="profile">
                    </div>
                    <div class="col">
                        <label for="status" class="form-label">Status</label>
                        <select type="text" class="form-select" name="status" placeholder="Status" aria-label="status"
                            id="class" required>
                            <option>Select</option>
                            <option value="New Admission" selected>New Admission</option>
                        </select>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="admission" class="form-label">Sr. No</label>
                        <input type="text" class="form-control" name="sr_no" placeholder="SR. No." aria-label="Srnumber"
                            id="sr_no">
                    </div>
                    <div class="col">
                        <label for="transport" class="form-label">Transport Facility</label>
                        <select class="form-select" aria-label="Default select example" name="transport" id="transport">
                            <option selected>Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="bus_fees" class="form-label">Bus Charge</label>
                        <input type="text" class="form-control" name="bus_fees" placeholder="Bus Charge"
                            aria-label="Srnumber" id="bus_fees">

                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="tc" class="form-label">Previous School TC(Submitted)</label>
                        <select class="form-select" aria-label="Default select example" name="tc" id="tc">
                            <option selected>Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="col">

                    </div>
                    <div class="col">

                    </div>
                </div>
            </div>
            <div style="border: 1px solid black;padding:15px;border-radius:10px">
                <div class="row my-3">
                    <div class="col">
                        <label for="inputPassword5" class="form-label">Password</label>
                        <input type="password" id="inputPassword5" name="password" class="form-control"
                            aria-describedby="passwordHelpBlock" placeholder="Password">
                    </div>
                    <div class="col">
                        <label for="mobile" class="form-label">Mobile No</label>
                        <input type="text" class="form-control" name="mobile" placeholder="Mobile no" size="10"
                            aria-label="Mobile no" id="mobile">
                    </div>
                    <div class="col">
                        <label for="aadhar" class="form-label">Aadhar No(Pattern XXXX XXXX XXXX)</label>
                        <input type="text" class="form-control" name="aadhar" placeholder="Aadhar no" size="12"
                            aria-label="Aadhar no" id="aadhar">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="village" class="form-label">Village</label>
                        <input type="text" class="form-control" name="village" placeholder="Village"
                            aria-label="Village" id="village">
                    </div>
                    <div class="col">
                        <label for="post" class="form-label">Post</label>
                        <input type="text" class="form-control" name="post" placeholder="Post" aria-label="Post"
                            id="post">
                    </div>
                    <div class="col">
                        <label for="district" class="form-label">District</label>
                        <input type="text" class="form-control" name="district" placeholder="District"
                            aria-label="District" id="district">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="email" class="form-label">Email-Address</label>
                        <input type="email" class="form-control" name="email" placeholder="Email-Address"
                            aria-label="email" id="email">
                    </div>
                    <div class="col">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" name="state" placeholder="State" aria-label="State"
                            id="state" required>
                    </div>
                    <div class="col">
                        <label for="pincode" class="form-label">Pincode</label>
                        <input type="text" class="form-control" name="pincode" placeholder="Pincode"
                            aria-label="Pincode" id="pincode" size="6">
                    </div>
                </div>
            </div>
            <div class="button"><button type="submit" class="btn btn-success" name="submit">Submit</button></div>
        </div>
    </form>

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
         function goBack() {
        window.history.back();
    }
    </script>
</body>

</html>