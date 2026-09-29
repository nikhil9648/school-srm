<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
$showalert=false;
$showerror = false;
$ids = $_GET['driver_id'];
    $editsql = "SELECT * FROM `driver_details` WHERE Sno = '$ids'";
    $editresult = mysqli_query($conn, $editsql);
    $editrow = mysqli_fetch_assoc($editresult);
if(isset($_POST['update'])){
        $ids = $_GET['driver_id'];
        $firstname = $_POST['first'];
        $lastname = $_POST['last'];
        $gender = $_POST['gender'];
        $designation = $_POST['designation'];
        $driver_id = $_POST['driver_id'];
        $mothername = $_POST['mother'];
        $fathername = $_POST['father'];
        $bus_no = $_POST['bus_no'];
        $dob = $_POST['dob'];
        $pan_no = $_POST['pan_no'];
        $dl_license = $_POST['driving_lic'];
        $driving_experience = $_POST['driving_experience'];
        $mobileno = $_POST['mobile'];
        $aadharno = $_POST['aadhar'];
        $village = $_POST['village'];
        $post = $_POST['post'];
        $district = $_POST['district'];
        $gmailid = $_POST['email'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];
        $df_name = md5(time());
        $old_img = $_POST['profile_old_imgs'];
        $file_name = $_FILES['profile_new_imgs']['name'];
        $file = $df_name.$file_name;
        if($file_name != ''){
            $update_img = $file;
        }else{
            $update_img = $old_img;
        }

        $editsqls = "UPDATE `driver_details` SET `dri_first_name` = '$firstname', `dri_last_name` = '$lastname', `dri_driver_id` = '$driver_id', `dri_gender` = '$gender', `dri_designation` = '$designation', `dri_bus_no` = '$bus_no', `dri_dob` = '$dob', `dri_aadhar_no` = '$aadharno', `dri_pan_no` = '$pan_no', `dri_dl_no` = '$dl_license', `dri_village` = '$village', `dri_post` = '$post', `dri_district` = '$district', `dri_pincode` = '$pincode', `dri_state` = '$state', `dri_father_name` = '$fathername', `dri_mother_name` = '$mothername', `dri_mobile_no` = '$mobileno', `dri_gmail_id` = '$gmailid', `dri_driving_experiance` = '$driving_experience', `dri_profile_photo` = '$update_img' WHERE `driver_details`.`Sno` = '$ids'";
        $result= mysqli_query($conn, $editsqls);
        if($result){
            if($_FILES['profile_new_imgs']['name'] != ''){
            $file_name = $_FILES['profile_new_imgs']['name'];
            $tempname = $_FILES['profile_new_imgs']['tmp_name'];
            $folder = '../profileimage/'.$df_name.$file_name;
            move_uploaded_file($tempname, $folder);
            unlink("../profileimage/".$old_img);
        }
           $showalert = true;
           header("location: ../erp/erp_driverdetails.php");
        }
        else{
            echo "data not inserted";
        }
    }
    if(isset($_POST['passupdate'])){
        $ids = $_GET['driver_id'];
        $password = $_POST['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $editsqls = "UPDATE `driver_details` SET `dri_password` = '$hash' WHERE `driver_details`.`Sno` = '$ids'";
        $result= mysqli_query($conn, $editsqls);
        if($result){
            $showalert = true;
            header("location: ../erp/erp_driverdetails.php");
        }
     }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Driver Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    .button {
        display: flex;
        justify-content: center;
        margin: 20px 0px;
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
    <h1 class="text-center">Update Staff Details</h1>
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="container">
            <div style="border: 1px solid black;padding:15px;border-radius:10px;margin-bottom:20px">
                <div class="row my-3">
                    <div class="col">
                        <label for="first" class="form-label requireds">First name</label>
                        <input type="text" class="form-control" name="first" id="first" placeholder="First name"
                            aria-label="First name" value="<?php echo $editrow['dri_first_name']?>">
                    </div>
                    <div class="col">
                        <label for="last" class="form-label requireds">Last name</label>
                        <input type="text" class="form-control" name="last" id="last" placeholder="Last name"
                            aria-label="Last name" value="<?php echo $editrow['dri_last_name']?>">
                    </div>
                    <div class="col">
                        <label for="driver_id" class="form-label">Staff Id</label>
                        <input type="text" class="form-control" name="driver_id" placeholder="Staff Id"
                            aria-label="Admission number" id="driver_id" value="<?php echo $editrow['dri_driver_id']?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" aria-label="Default select example" name="gender" id="gender">
                            <option value="<?php echo $editrow['dri_gender']?>" selected>
                                <?php echo $editrow['dri_gender']?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Transgender">Transgender</option>
                        </select>

                    </div>
                    <div class="col">
                        <label for="mother" class="form-label">Mother's Name</label>
                        <input type="text" class="form-control" name="mother" placeholder="Mother's name"
                            aria-label="Mother name" id="mother" value="<?php echo $editrow['dri_mother_name']?>">
                    </div>
                    <div class="col">
                        <label for="father" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" name="father" placeholder="Father's name"
                            aria-label="Father name" id="father" value="<?php echo $editrow['dri_father_name']?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="dob" class="form-label">DOB</label>
                        <input type="date" class="form-control" id="dob" name="dob"
                            value="<?php echo $editrow['dri_dob']?>">
                    </div>
                    <div class="col">
                        <label for="designation" class="form-label">Designation</label>
                        <select class="form-select" name="designation" id="designation"
                            aria-label="Default select example" onchange="checkInput()">
                            <option value="<?php echo $editrow['dri_designation']?>" selected>
                                <?php echo $editrow['dri_designation']?></option>
                            <option value="Bus Driver">Bus Driver</option>
                            <option value="Conductor">Conductor</option>
                            <option value="Peon">Peon</option>
                            <option value="Guard">Guard</option>
                            <option value="Sweeper">Sweeper</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="bus_no" class="form-label">Bus No.</label>
                        <input type="text" class="form-control" name="bus_no" placeholder="Bus Number"
                            aria-label="bus_no" id="bus_no" value="<?php echo $editrow['dri_bus_no']; ?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="driving_lic" class="form-label">Driving License</label>
                        <input type="text" class="form-control" id="driving_lic" name="driving_lic"
                            value="<?php echo $editrow['dri_dl_no']; ?>" placeholder="Driving License No.">
                    </div>
                    <div class="col">
                        <label for="driving_experience" class="form-label">Driving Experiance(in year)</label>
                        <input type="text" class="form-control" name="driving_experience"
                            placeholder="Driving Experiance" aria-label="driving_experience" id="driving_experience"
                            value="<?php echo $editrow['dri_driving_experiance']; ?>">
                    </div>
                    <div class="col">

                    </div>
                </div>
            </div>
            <div style="border: 1px solid black;padding:15px;border-radius:10px">
                <div class="row my-3">
                    <div class="col">
                        <label for="mobile" class="form-label">Mobile No</label>
                        <input type="text" class="form-control" name="mobile" placeholder="Mobile no" maxlength="10"
                            aria-label="Mobile no" id="mobile" value="<?php echo $editrow['dri_mobile_no']?>">
                    </div>

                    <div class="col">
                        <label for="pan_no" class="form-label">PAN no.</label>
                        <input type="text" class="form-control" name="pan_no" placeholder="PAN No." aria-label="pan_no"
                            id="pan_no" value="<?php echo $editrow['dri_pan_no']?>">
                    </div>
                    <div class="col">
                        <label for="aadhar" class="form-label">Aadhar No(Pattern XXXX XXXX XXXX)</label>
                        <input type="text" class="form-control" name="aadhar" placeholder="Aadhar no" maxlength="12"
                            aria-label="Aadhar no" id="aadhar" value="<?php echo $editrow['dri_aadhar_no']?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="village" class="form-label">Village</label>
                        <input type="text" class="form-control" name="village" placeholder="Village"
                            aria-label="Village" id="village" value="<?php echo $editrow['dri_village']?>">
                    </div>
                    <div class="col">
                        <label for="post" class="form-label">Post</label>
                        <input type="text" class="form-control" name="post" placeholder="Post" aria-label="Post"
                            id="post" value="<?php echo $editrow['dri_post']?>">
                    </div>
                    <div class="col">
                        <label for="district" class="form-label">District</label>
                        <input type="text" class="form-control" name="district" placeholder="District"
                            aria-label="District" id="district" value="<?php echo $editrow['dri_district']?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="email" class="form-label">Email-Address</label>
                        <input type="email" class="form-control" name="email" placeholder="Email-Address"
                            aria-label="email" id="email" value="<?php echo $editrow['dri_gmail_id']?>">
                    </div>
                    <div class="col">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" name="state" placeholder="State" aria-label="State"
                            id="state" value="<?php echo $editrow['dri_state']?>">
                    </div>
                    <div class="col">
                        <label for="pincode" class="form-label">Pincode</label>
                        <input type="text" class="form-control" name="pincode" placeholder="Pincode"
                            aria-label="Pincode" id="pincode" maxlength="6"
                            value="<?php echo $editrow['dri_pincode']?>">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="formFile" class="form-label">Upload Profile Photo(.jpeg/.jpg/.png)</label>
                        <input class="form-control" type="file" id="formFile" name="profile_new_imgs">
                        <input class="form-control" type="hidden" id="formFile" name="profile_old_imgs"
                            value="<?php echo $editrow['dri_profile_photo']?>">
                    </div>
                    <div class="col">
                        <img src="<?php echo "../profileimage/".$editrow['dri_profile_photo'] ?>"
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
        </div>
        <div class="button"><button type="submit" class="btn btn-success" name="passupdate">Update</button></div>
        </div>
    </form>
    <script>
    function checkInput() {
        const value = document.getElementById("designation").value;
        const div = document.getElementById("id");
        const div1 = document.getElementById("id1");
        const div2 = document.getElementById("id2");
        const div4 = document.getElementById("id4");
        const div5 = document.getElementById("id5");

        if (value === "Bus Driver") {
            div.style.display = "block";
            div1.style.display = "block";
            div2.style.display = "block";
            div4.style.display = "none";
            div5.style.display = "none";
        } else if (value === "Conductor") {
            div.style.display = "block";
            div4.style.display = "none";
            div5.style.display = "block";
            div1.style.display = "none";
            div2.style.display = "none";
        } else {
            div.style.display = "none";
            div1.style.display = "none";
            div2.style.display = "none";
            div4.style.display = "block";
            div5.style.display = "block";
        }
    }
    </script>
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