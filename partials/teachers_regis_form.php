<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
$showalert=false;
$showerror = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $existsql = "SELECT * FROM `class`";
        $result = mysqli_query($conn, $existsql);
        $sno = 0;
        $numrows = mysqli_num_rows($result);
        while($row = mysqli_fetch_assoc($result)){
            $sno = $row['cl_Sno'];
        }
        $firstname = $_POST['first'];
        $lastname = $_POST['last'];
        $teacherid = 5000+($sno+1);
        $gender = $_POST['gender'];
        $department = $_POST['department'];
        $caste = $_POST['caste'];
        $martial = $_POST['martial'];
        $classteacher = $_POST['class_teacher'];
        $mothername = $_POST['mother'];
        $fathername = $_POST['father'];
        $dob = $_POST['dob'];
        $panno = $_POST['pan'];
        $password = $_POST['password'];
        $mobileno = $_POST['mobile'];
        $aadharno = $_POST['aadhar'];
        $village = $_POST['village'];
        $post = $_POST['post'];
        $district = $_POST['district'];
        $gmailid = $_POST['email'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];
        $highestqualification = $_POST['highest_qualificaion'];
        $df_name = md5(time());
        $file_name = $_FILES['profile']['name'];
        $file = $df_name.$file_name;
        $tempname = $_FILES['profile']['tmp_name'];
        $folder = '../profileimage/'.$df_name.$file_name;
        move_uploaded_file($tempname, $folder);

        $existsql = "SELECT * FROM `class` WHERE cl_schoolid = '$teacherid' AND cl_aadharnumber = '$aadharno'";
        $result = mysqli_query($conn, $existsql);
        $numrows = mysqli_num_rows($result);
        if($numrows>0){
            $showerror = "This teacher teacher Id or Aadhar number are already registered.";
            header("location:/school/partials/admissionform.php");
        }
        else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `class` (`cl_class_teacher`, `cl_Firstname`, `cl_lastname`, `cl_fathersname`, `cl_dob`, `cl_mothers_name`, `cl_department`,`cl_martial_status`, `cl_gender`, `cl_caste`, `cl_mobile`, `cl_gmail`, `cl_village`, `cl_post`, `cl_district`, `cl_state`, `cl_pin`, `cl_password`, `cl_highestqualification`, `cl_schoolid`, `cl_aadharnumber`, `cl_Pannumber`, `cl_profile_photo`) VALUES ('$classteacher', '$firstname', '$lastname', '$fathername', '$dob', '$mothername', '$department', '$martial', '$gender', '$caste', '$mobileno', '$gmailid', '$village', '$post', '$district', '$state', '$pincode', '$hash', '$highestqualification', '$teacherid', '$aadharno', '$panno', '$file')";
            $resultn = mysqli_query($conn, $sql);
            if($resultn){
                header("location: ../erp/erpdashboard.php");
            }
            else{
                header("location:/school/partials/admissionform.php");
                $showerror = true;
            }
        }
    }



    
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
    /* body {
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
  <strong>Error!</strong> "Your data not inserted succesfully please insert again." 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
            }
            ?>
     <h1 class="text-center">Teacher Registration</h1>
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="container">
            <div style="border: 1px solid black;padding:15px;border-radius:10px;margin-bottom:20px">
                <div class="row my-3">
                    <div class="col">
                        <label for="first" class="form-label requireds">First name</label>
                        <input type="text" class="form-control" name="first" id="first" placeholder="First name"
                            aria-label="First name">
                    </div>
                    <div class="col">
                        <label for="last" class="form-label requireds">Last name</label>
                        <input type="text" class="form-control" name="last" id="last" placeholder="Last name"
                            aria-label="Last name">
                    </div>
                    <div class="col">
                        <label for="department" class="form-label">Designation</label>
                        <select class="form-select" name="department" id="department" aria-label="Default select example">
                            <option selected>Select</option>
                            <option value="Chairperson">Chairperson</option>
                            <option value="Manager">Manager</option>
                            <option value="Co-Manager">Co-Manager</option>
                            <option value="Principal">Principal</option>
                            <option value="Assistant Teacher">Assistant Teacher</option>
                            <option value="PGT - English">PGT - English</option>
                            <option value="PGT Mathematics">PGT Mathematics</option>
                            <option value="PGT - Chemistry">PGT - Chemistry</option>
                            <option value="PGT - Hindi">PGT - Hindi</option>
                            <option value="PGT - SST">PGT - SST</option>
                            <option value="PGT - Physics">PGT - Physics</option>
                            <option value="PGT - Biology">PGT - Biology</option>
                            <option value="TGT - English">TGT - English</option>
                            <option value="TGT - Hindi">TGT - Hindi</option>
                            <option value="TGT - SST">TGT - SST</option>
                            <option value="TGT - Science">TGT - Science</option>
                            <option value="TGT - Science">TGT - Computer</option>
                            <option value="I.T Teacher">I.T Teacher</option>
                            <option value="Computer Operator">Computer Operator</option>
                            <option value="Accountant">Accountant</option>
                            <option value="Councellor">Councellor</option>
                            <option value="Lab Assistant">Lab Assistant</option>
                            <option value="Mother Teacher">Mother Teacher</option>
                            <option value="PRT Teacher">PRT Teacher</option>
                            <option value="Primary Teacher">Primary Teacher</option>
                            <option value="PTI Dance Teacher">PTI Dance Teacher</option>
                        </select>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" aria-label="Default select example" name="gender" id="gender">
                            <option selected>Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Transgender">Transgender</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="caste" class="form-label">Caste</label>
                        <select class="form-select" aria-label="Default select example" name="caste" id="caste">
                            <option selected>Select</option>
                            <option value="General">General</option>
                            <option value="OBC">OBC</option>
                            <option value="SC/ST">SC/ST</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="martial" class="form-label">Marital Status</label>
                        <select class="form-select" aria-label="Default select example" name="martial" id="martial">
                            <option selected>Select</option>
                            <option value="married">married</option>
                            <option value="unmarried">unmarried</option>
                        </select>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="class_teacher" class="form-label">Class Teacher</label>
                        <select type="text" class="form-select" name="class_teacher" placeholder="Class Teacher" aria-label="class" id="class_teacher">
                            <option value="Select" selected>Select</option>
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
                        <input type="date" class="form-control" id="dob" name="dob" value="">
                    </div>
                    <div class="col">
                        <label for="inputPassword5" class="form-label">Password</label>
                        <input type="password" id="inputPassword5" name="password" class="form-control"
                            aria-describedby="passwordHelpBlock" placeholder="Password">
                    </div>
                    <div class="col">
                        <label for="formFile" class="form-label">Upload Profile Photo(.jpeg/.jpg/.png)</label>
                        <input class="form-control" type="file" id="formFile" name="profile">
                    </div>
                </div>
            </div>
            <div style="border: 1px solid black;padding:15px;border-radius:10px">
                <div class="row my-3">
                    
                    <div class="col">
                        <label for="mobile" class="form-label">Mobile No</label>
                        <input type="text" class="form-control" name="mobile" placeholder="Mobile no" maxlength="10"
                            aria-label="Mobile no" id="mobile">
                    </div>
                    <div class="col">
                        <label for="aadhar" class="form-label">Aadhar No(Pattern XXXX XXXX XXXX)</label>
                        <input type="text" class="form-control" name="aadhar" placeholder="Aadhar no" maxlength="12"
                            aria-label="Aadhar no" id="aadhar">
                    </div>
                    <div class="col">
                        <label for="pan" class="form-label">PAN No.</label>
                        <input type="text" class="form-control" name="pan" placeholder="PAN no" maxlength="10"
                            aria-label="Aadhar no" id="pan">
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
                            id="state">
                    </div>
                    <div class="col">
                        <label for="pincode" class="form-label">Pincode</label>
                        <input type="text" class="form-control" name="pincode" placeholder="Pincode"
                            aria-label="Pincode" id="pincode" maxlength="6">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="highest_qualificaion" class="form-label">Highest Qualification</label>
                        <input type="text" class="form-control" name="highest_qualificaion" placeholder="Highest Quaification"
                            aria-label="email" id="highest_qualificaion">
                    </div>
                    <div class="col">
                        <!-- <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" name="state" placeholder="State" aria-label="State"
                            id="state"> -->
                    </div>
                    <div class="col">
                        <!-- <label for="pincode" class="form-label">Pincode</label>
                        <input type="text" class="form-control" name="pincode" placeholder="Pincode"
                            aria-label="Pincode" id="pincode" maxlength="6"> -->
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
</body>

</html>