<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
$showalert=false;
$showerror = false;
$ids = $_GET['teacher_id'];
    $editsql = "SELECT * FROM `class` WHERE cl_Sno = '$ids'";
    $editresult = mysqli_query($conn, $editsql);
    $editrow = mysqli_fetch_assoc($editresult);
if(isset($_POST['update'])){
        $firstname = $_POST['first'];
        $lastname = $_POST['last'];
        $teacherid = $_POST['teacher_id'];
        $gender = $_POST['gender'];
        $caste = $_POST['caste'];
        $martial = $_POST['martial'];
        $classteacher = $_POST['class_teacher'];
        $mothername = $_POST['mother'];
        $fathername = $_POST['father'];
        $department = $_POST['department'];
        $dob = $_POST['dob'];
        $panno = $_POST['pan'];
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
        $old_img = $_POST['profile_old_img'];
        $file_name = $_FILES['profile_new_img']['name'];
        $file = $df_name.$file_name;
        
        if($file_name != ''){
            $update_img = $file;
        }else{
            $update_img = $old_img;
        }

        $editsqls = "UPDATE `class` SET `cl_class_teacher` = '$classteacher', `cl_Firstname` = '$firstname', `cl_lastname` = '$lastname', `cl_fathersname` = '$fathername', `cl_department` = '$department', `cl_dob` = '$dob', `cl_mothers_name` = '$mothername', `cl_martial_status` = '$martial', `cl_gender` = '$gender', `cl_caste` = '$caste', `cl_mobile` = '$mobileno', `cl_gmail` = '$gmailid', `cl_profile_photo` = '$update_img', `cl_village` = '$village', `cl_post` = '$post', `cl_district` = '$district', `cl_state` = '$state', `cl_pin` = '$pincode', `cl_aadharnumber` = '$aadharno', `cl_Pannumber` = '$panno' WHERE `class`.`cl_Sno` = '$ids'";
        $result= mysqli_query($conn, $editsqls);
        if($result){
            if($_FILES['profile_new_img']['name'] != ''){
            $file_name = $_FILES['profile_new_img']['name'];
            $tempname = $_FILES['profile_new_img']['tmp_name'];
            $folder = '../profileimage/'.$df_name.$file_name;
            move_uploaded_file($tempname, $folder);
            unlink("../profileimage/".$old_img);
        }
           $showalert = true;
           header("location: ../erp/erp_teachers.php");
        }
        else{
            echo "data not inserted";
        }
    }
    if(isset($_POST['passupdate'])){
        $password = $_POST['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $editsqls = "UPDATE `class` SET `cl_password` = '$hash' WHERE `class`.`cl_Sno` = '$ids'";
        $result= mysqli_query($conn, $editsqls);
        if($result){
            $showalert = true;
            header("location: ../erp/erp_teachers.php");
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
     <h1 class="text-center">Edit Teacher Registration</h1>
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="container">
            <div style="border: 1px solid black;padding:15px;border-radius:10px;margin-bottom:20px">
                <div class="row my-3">
                    <div class="col">
                        <label for="first" class="form-label requireds">First name</label>
                        <input type="text" class="form-control" name="first" id="first" placeholder="First name"
                            aria-label="First name" value="<?php echo $editrow['cl_Firstname']?>">
                    </div>
                    <div class="col">
                        <label for="last" class="form-label requireds">Last name</label>
                        <input type="text" class="form-control" name="last" id="last" placeholder="Last name"
                            aria-label="Last name" value="<?php echo $editrow['cl_lastname']?>">
                    </div>
                    <div class="col">
                        <label for="teacher_id" class="form-label">Teacher's Id</label>
                        <input type="text" class="form-control" name="teacher_id" placeholder="Teacher Id"
                            aria-label="Admission number" id="teacher_id" value="<?php echo $editrow['cl_schoolid']?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" aria-label="Default select example" name="gender" id="gender">
                            <option value="<?php echo $editrow['cl_gender']?>" selected><?php echo $editrow['cl_gender']?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Transgender">Transgender</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="caste" class="form-label">Caste</label>
                        <select class="form-select" aria-label="Default select example" name="caste" id="caste">
                            <option value="<?php echo $editrow['cl_caste']?>"selected><?php echo $editrow['cl_caste']?></option>
                            <option value="General">General</option>
                            <option value="OBC">OBC</option>
                            <option value="SC/ST">SC/ST</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="martial" class="form-label">Marital Status</label>
                        <select class="form-select" aria-label="Default select example" name="martial" id="martial">
                            <option value="<?php echo $editrow['cl_martial_status']?>"selected><?php echo $editrow['cl_martial_status']?></option>
                            <option value="married">married</option>
                            <option value="unmarried">unmarried</option>
                        </select>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="class_teacher" class="form-label">Class Teacher</label>
                        <select type="text" class="form-select" name="class_teacher" placeholder="Class Teacher" aria-label="class" id="class_teacher">
                            <option value="<?php echo $editrow['cl_class_teacher']?>" selected><?php echo $editrow['cl_class_teacher']?></option>
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
                            aria-label="Mother name" id="mother" value="<?php echo $editrow['cl_mothers_name']?>">
                    </div>
                    <div class="col">
                        <label for="father" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" name="father" placeholder="Father's name"
                            aria-label="Father name" id="father" value="<?php echo $editrow['cl_fathersname']?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-select" name="department" id="department" aria-label="Default select example">
                            <option value="<?php echo $editrow['cl_department']?>" selected><?php echo $editrow['cl_department']?></option>
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
                            <option value="TGT - Science">TGT - Science</option>
                            <option value="TGT - Science">TGT - Computer</option>
                            <option value="TGT - SST">TGT - SST</option>
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
                    <div class="col">
                        <label for="dob" class="form-label">DOB</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $editrow['cl_dob']?>">
                    </div>
                    <div class="col">
                        <label for="highest_qualificaion" class="form-label">Highest Qualification</label>
                        <input type="text" class="form-control" name="highest_qualificaion" placeholder="Highest Quaification"
                            aria-label="email" id="highest_qualificaion" value="<?php echo $editrow['cl_highestqualification']?>">
                    </div>
                </div>
            </div>
            <div style="border: 1px solid black;padding:15px;border-radius:10px">
                <div class="row my-3">
                    
                    <div class="col">
                        <label for="mobile" class="form-label">Mobile No</label>
                        <input type="text" class="form-control" name="mobile" placeholder="Mobile no" maxlength="10"
                            aria-label="Mobile no" id="mobile" value="<?php echo $editrow['cl_mobile']?>">
                    </div>
                    <div class="col">
                        <label for="aadhar" class="form-label">Aadhar No(Pattern XXXX XXXX XXXX)</label>
                        <input type="text" class="form-control" name="aadhar" placeholder="Aadhar no" maxlength="12"
                            aria-label="Aadhar no" id="aadhar" value="<?php echo $editrow['cl_aadharnumber']?>">
                    </div>
                    <div class="col">
                        <label for="pan" class="form-label">PAN No.</label>
                        <input type="text" class="form-control" name="pan" placeholder="PAN no" maxlength="10"
                            aria-label="Aadhar no" id="pan" value="<?php echo $editrow['cl_Pannumber']?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="village" class="form-label">Village</label>
                        <input type="text" class="form-control" name="village" placeholder="Village"
                            aria-label="Village" id="village" value="<?php echo $editrow['cl_village']?>">
                    </div>
                    <div class="col">
                        <label for="post" class="form-label">Post</label>
                        <input type="text" class="form-control" name="post" placeholder="Post" aria-label="Post"
                            id="post" value="<?php echo $editrow['cl_post']?>">
                    </div>
                    <div class="col">
                        <label for="district" class="form-label">District</label>
                        <input type="text" class="form-control" name="district" placeholder="District"
                            aria-label="District" id="district" value="<?php echo $editrow['cl_district']?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="email" class="form-label">Email-Address</label>
                        <input type="email" class="form-control" name="email" placeholder="Email-Address"
                            aria-label="email" id="email" value="<?php echo $editrow['cl_gmail']?>">
                    </div>
                    <div class="col">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" name="state" placeholder="State" aria-label="State"
                            id="state">
                    </div>
                    <div class="col">
                        <label for="pincode" class="form-label">Pincode</label>
                        <input type="text" class="form-control" name="pincode" placeholder="Pincode"
                            aria-label="Pincode" id="pincode" maxlength="6" value="<?php echo $editrow['cl_pin']?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="formFile" class="form-label">Upload Profile Photo(.jpeg/.jpg/.png)</label>
                        <input class="form-control" type="file" id="formFile" name="profile_new_img">
                        <input class="form-control" type="hidden" id="formFile" name="profile_old_img" value="<?php echo $editrow['cl_profile_photo']?>">
                    </div>
                    <div class="col">
                        <img src="<?php echo "../profileimage/".$editrow['cl_profile_photo'] ?>"
                            style="width:100px; height:100px;" alt="">
                    </div>
                    <div class="col">
                        
                    </div>
                </div>
            </div>
            <div class="button"><button type="submit" class="btn btn-success" name="update">Submit</button></div>
        </div>
    </form>
    <form action="#" method="POST">
        <div class="container">
            <div style="border: 1px solid black;padding:15px;border-radius:10px;margin-bottom:20px">
                <div class="row my-3">
                    <div class="col">
                        <label for="inputPassword5" class="form-label">Password</label>
                        <input type="password" id="inputPassword5" name="password" class="form-control"
                            aria-describedby="passwordHelpBlock" placeholder="Password">
                    </div>
                    <div class="col">
                        
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
            <div class="button"><button type="submit" class="btn btn-success" name="passupdate">Submit</button></div>
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