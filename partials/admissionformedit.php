<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
$showalert=false;
$showerror = false;
$ids = $_GET['editstudents'];
    $editsql = "SELECT * FROM `studentsdetail` WHERE Sno = '$ids'";
    $editresult = mysqli_query($conn, $editsql);
    $editrow = mysqli_fetch_assoc($editresult);
$bus_sql = "SELECT * FROM `map_convence_fees` WHERE trans_admission_no = '".$editrow['admission_number']."'";
$bus_result = mysqli_query($conn, $bus_sql);
$bus_fees = mysqli_fetch_assoc($bus_result);
$charge = 0;
if(mysqli_num_rows($bus_result) > 0){
    $charge = $bus_fees['2026-2027_fees'];
}
if(isset($_POST['update'])){
    $ids = $_GET['editstudents'];
    $editfirstname = $_POST['sfirst'];
    $editlastname = $_POST['slast'];
    $editmiddlename = $_POST['smiddle'];
    $editgender = $_POST['sgender'];
    $editcaste = $_POST['scaste'];
    $editregilion = $_POST['sreligion'];
    $editclass = $_POST['sclass'];
    $editmothername = $_POST['smother'];
    $editfathername = $_POST['sfather'];
    $editdob = $_POST['sdob'];
    $editstatus = $_POST['sstatus'];
    $editadmissionno = $_POST['sadmission'];
    $edittransport = $_POST['stransport'];
    $edit_bus_charge = $_POST['sbus_charge'];
    $editbusno = $_POST['bus_no'];
    $edittransfer = $_POST['stc'];
    $edit_sr_no = $_POST['sr_no'];
    $editmobileno = $_POST['smobile'];
    $editaadharno = $_POST['saadhar'];
    $editvillage = $_POST['svillage'];
    $editpost = $_POST['spost'];
    $editdistrict = $_POST['sdistrict'];
    $editgmailid = $_POST['semail'];
    $editstate = $_POST['sstate'];
    $editpincode = $_POST['spincode'];
    $df_name = md5(time());
    $old_img = $_POST['sprofile_old_img'];
    $editfile_name = $_FILES['sprofile_new_img']['name'];
    $editfile = $df_name.$editfile_name;
    if($editfile_name != ''){
        $update_img = $editfile;
    }else{
        $update_img = $old_img;
    }
    $editsqls = "UPDATE `studentsdetail` SET `first_name` = '$editfirstname', `last_name` = '$editlastname', `middle_name` = '$editmiddlename', `gender` = '$editgender', `Caste` = '$editcaste', `religion` = '$editregilion', `class` = '$editclass', `mother_name` = '$editmothername', `father_name` = '$editfathername', `dob` = '$editdob', `transport_fac` = '$edittransport', `sr_no` = '$edit_sr_no', `bus_number` = '$editbusno', `transfer_certificate` = '$edittransfer', `mobile_number` = '$editmobileno', `aadhar_number` = '$editaadharno', `village` = '$editvillage', `profile_photo` = '$update_img', `post` = '$editpost', `district` = '$editdistrict', `email_address` = '$editgmailid', `state` = '$editstate', `pin_code` = '$editpincode', `status` = '$editstatus' WHERE `studentsdetail`.`Sno` = '$ids'";
    $result= mysqli_query($conn, $editsqls);
    // Fixed: Fresh check for $edittransport == "Yes" using updated $editadmissionno
    $bus_check_sql = "SELECT * FROM `map_convence_fees` WHERE `trans_admission_no` = '$editadmissionno' LIMIT 1";
    $bus_check_result = mysqli_query($conn, $bus_check_sql);
    $bus_exists = mysqli_num_rows($bus_check_result) > 0;
    if($edittransport == "Yes"){
        if($bus_exists){
            $sqlfees = "UPDATE `map_convence_fees` SET `2026-2027_fees` = '$edit_bus_charge' WHERE `map_convence_fees`.`trans_admission_no` = '$editadmissionno'";
            mysqli_query($conn, $sqlfees) or error_log("Transport UPDATE failed: " . mysqli_error($conn));
        }else{
            $sql_inserted_fees = "INSERT INTO `map_convence_fees` (`trans_admission_no`, `2026-2027_fees`) VALUES ('$editadmissionno', '$edit_bus_charge')";
            mysqli_query($conn, $sql_inserted_fees);
        }
    }else{
        if($bus_exists){
            $sqlfees = "DELETE FROM `map_convence_fees` WHERE `map_convence_fees`.`trans_admission_no` = '$editadmissionno'";
            mysqli_query($conn, $sqlfees) or error_log("Transport DELETE failed: " . mysqli_error($conn));
        }
    }
    if($result){
        if($_FILES['sprofile_new_img']['name'] != ''){
            $edittempname = $_FILES['sprofile_new_img']['tmp_name'];
            $folder = '../profileimage/'.$df_name.$editfile_name;
            move_uploaded_file($edittempname, $folder);
            unlink("../profileimage/".$old_img);
        }
        $showalert = true;
        header("location: ../erp/erp_student.php");
    }
    
}
 if(isset($_POST['passupdate'])){
    $ids = $_GET['editstudents'];
    $editpassword = $_POST['spassword'];
    $hash = password_hash($editpassword, PASSWORD_DEFAULT);
    $editsqls = "UPDATE `studentsdetail` SET `password` = '$hash' WHERE `studentsdetail`.`Sno` = '$ids'";
    $result= mysqli_query($conn, $editsqls);
    if($result){
        $showalert = true;
        header("location: ../erp/erp_student.php");
    }
 }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Details</title>
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
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successful </strong> You data updated successful.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    ?>
    <h1 class="text-center">Update Students Details</h1>
    <button onclick="goBack()" class="btn btn-secondary back-btn" style="margin-bottom:-10px; left:10px;position:fixed; top:10px;">
            ← Back
        </button>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="container">
            <div style="border: 1px solid black;padding:15px;border-radius:10px;margin-bottom:20px">
                <div class="row my-3">
                    <div class="col">
                        <input type="hidden" name="id" value="<?php echo $editrow['Sno']?>">
                        <label for="first" class="form-label">First name</label>
                        <input type="text" class="form-control" name="sfirst" id="sfirst" placeholder="First name"
                            aria-label="First name" value="<?php echo $editrow['first_name']?>">
                    </div>
                    <div class="col">
                        <label for="last" class="form-label">Last name</label>
                        <input type="text" class="form-control" name="slast" id="slast" placeholder="Last name"
                            aria-label="Last name" value="<?php echo $editrow['last_name']?>">
                    </div>
                    <div class="col">
                        <label for="middle" class="form-label">Middle name</label>
                        <input type="text" class="form-control" name="smiddle" id="smiddle" placeholder="Middle name"
                            aria-label="Middle name" value="<?php echo $editrow['middle_name']?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" aria-label="Default select example" name="sgender" id="sgender">
                            <option value="<?php echo $editrow['gender']?>" selected><?php echo $editrow['gender']?>
                            </option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Transgender">Transgender</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="caste" class="form-label">Caste</label>
                        <select class="form-select" aria-label="Default select example" name="scaste" id="scaste">
                            <option value="<?php echo $editrow['Caste']?>" selected><?php echo $editrow['Caste']?>
                            </option>
                            <option value="General">General</option>
                            <option value="OBC">OBC</option>
                            <option value="SC/ST">SC/ST</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="religion" class="form-label">Religion</label>
                        <select class="form-select" aria-label="Default select example" name="sreligion" id="sreligion">
                            <option value="<?php echo $editrow['religion']?>" selected><?php echo $editrow['religion']?>
                            </option>
                            <option value="Hindu">Hindu</option>
                            <option value="Muslim">Muslim</option>
                            <option value="Sikh">Sikh</option>
                        </select>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="class" class="form-label">Class</label>
                        <select type="text" class="form-select" name="sclass" placeholder="Class" aria-label="class"
                            id="sclass">
                            <option value="<?php echo $editrow['class']?>" selected><?php echo $editrow['class']?></option>
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
                        <input type="text" class="form-control" name="smother" placeholder="Mother's name"
                            aria-label="Mother name" id="smother" value="<?php echo $editrow['mother_name']?>">
                    </div>
                    <div class="col">
                        <label for="father" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" name="sfather" placeholder="Father's name"
                            aria-label="Father name" id="sfather" value="<?php echo $editrow['father_name']?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="sdob" class="form-label">DOB</label>
                        <input type="date" class="form-control" id="sdob" name="sdob"
                            value="<?php echo $editrow['dob']?>">
                    </div>
                    <div class="col">
                        <label for="admission" class="form-label">Admission Number</label>
                        <input type="text" class="form-control" name="sadmission" placeholder="Admission Number"
                            aria-label="Admission number" id="sadmission"
                            value="<?php echo $editrow['admission_number'];?>">
                    </div>
                    <div class="col">
                        <label for="admission" class="form-label">Sr. No</label>
                        <input type="text" class="form-control" name="sr_no" placeholder="SR. No." aria-label="Srnumber"
                            id="sr_no" value="<?php echo $editrow['sr_no'];?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="stransport" class="form-label">Transport Facility</label>
                        <select class="form-select" aria-label="Default select example" name="stransport" id="stransport">
                            <option value="<?php echo $editrow['transport_fac'];?>" selected><?php echo $editrow['transport_fac'];?></option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="bus_no" class="form-label">Bus No.</label>
                        <input type="text" class="form-control" name="bus_no" id="bus_no"
                            value="<?php echo $editrow['bus_number'];?>">
                    </div>
                    <div class="col">
                        <label for="sbus_charge" class="form-label">Bus Charge</label>
                        <input type="text" class="form-control" name="sbus_charge" id="sbus_charge"
value="<?php echo $charge; ?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="stc" class="form-label">Previous School TC(Submitted)</label>
                        <select class="form-select" aria-label="Default select example" name="stc" id="stc">
                            <option value="<?php echo $editrow['transfer_certificate'];?>" selected><?php echo $editrow['transfer_certificate'];?></option>
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
                        <label for="status" class="form-label">Status</label>
                        <select type="text" class="form-select" name="sstatus" placeholder="Status" aria-label="status"
                            id="sstatus">
                                    <option value="<?php echo $editrow['status'];?>" selected><?php echo $editrow['status'];?></option>
                                    <option value="New Admission">New Admission</option>
                                    <option value="Active">Active</option>
                                    <option value="Leave">Leave</option>
                                </select>
                    </div>
                    <div class="col">
                        <label for="mobile" class="form-label">Mobile No</label>
                        <input type="text" class="form-control" name="smobile" placeholder="Mobile no" size="10"
                            aria-label="Mobile no" id="smobile" value="<?php echo $editrow['mobile_number']?>">
                    </div>
                    <div class="col">
                        <label for="aadhar" class="form-label">Aadhar No(Pattern XXXX XXXX XXXX)</label>
                        <input type="text" class="form-control" name="saadhar" placeholder="Aadhar no" size="12"
                            aria-label="Aadhar no" id="saadhar" value="<?php echo $editrow['aadhar_number']?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="village" class="form-label">Village</label>
                        <input type="text" class="form-control" name="svillage" placeholder="Village"
                            aria-label="Village" id="svillage" value="<?php echo $editrow['village']?>">
                    </div>
                    <div class="col">
                        <label for="post" class="form-label">Post</label>
                        <input type="text" class="form-control" name="spost" placeholder="Post" aria-label="Post"
                            id="spost" value="<?php echo $editrow['post']?>">
                    </div>
                    <div class="col">
                        <label for="district" class="form-label">District</label>
                        <input type="text" class="form-control" name="sdistrict" placeholder="District"
                            aria-label="District" id="sdistrict" value="<?php echo $editrow['district']?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="email" class="form-label">Email-Address</label>
                        <input type="email" class="form-control" name="semail" placeholder="Email-Address"
                            aria-label="email" id="semail" value="<?php echo $editrow['email_address']?>">
                    </div>
                    <div class="col">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" name="sstate" placeholder="State" aria-label="State"
                            id="sstate" value="<?php echo $editrow['state']?>">
                    </div>
                    <div class="col">
                        <label for="pincode" class="form-label">Pincode</label>
                        <input type="text" class="form-control" name="spincode" placeholder="Pincode"
                            aria-label="Pincode" id="spincode" size="6" value="<?php echo $editrow['pin_code']?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="formFile" class="form-label">Upload Profile Photo(.jpeg/.jpg/.png)</label>
                        <input class="form-control" type="file" id="formFile" name="sprofile_new_img">
                        <input class="form-control" type="hidden" name="sprofile_old_img"
                            value="<?php echo $editrow['profile_photo']?>">
                    </div>
                    <div class="col">
                        <img src="<?php echo "../profileimage/".$editrow['profile_photo'] ?>"
                            style="width:100px; height:100px;" alt="">
                    </div>
                    <div class="col">

                    </div>
                </div>
            </div>
            <div class="button"><button type="submit" class="btn btn-success" id="update" name="update">Update</button>
            </div>
        </div>
    </form>
    <form action="" method="POST">
        <div class="container">
            <div style="border: 1px solid black;padding:15px;border-radius:10px">
                <div class="row my-3">
                    <div class="col">
                        <label for="spassword" class="form-label">Password</label>
                        <input type="text" class="form-control" name="spassword" placeholder="Password" id="spassword">
                    </div>
                    <div class="col">

                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
            <div class="button"><button type="submit" class="btn btn-success" id="passupdate"
                    name="passupdate">Update</button>
            </div>
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