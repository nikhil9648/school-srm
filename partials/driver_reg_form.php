<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
$showalert=false;
$showerror = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $existsql = "SELECT * FROM `driver_details`";
        $result = mysqli_query($conn, $existsql);
        $sno = 0;
        // $numrows = mysqli_num_rows($result);
        while($row = mysqli_fetch_assoc($result)){
            $sno = $row['Sno'];
        }
        if($_POST['designation'] == "Bus Driver"){
            $bus_no = $_POST['bus_no'];
            $dl_license = $_POST['driving_lic'];
            $driving_experience = $_POST['driving_experience'];
        }
        else if($_POST['designation'] == "Conductor"){
            $bus_no = $_POST['bus_no'];
            $dl_license = 0;
            $driving_experience = 0;
        }
        else{
            $bus_no = 0;
            $dl_license = 0;
            $driving_experience = 0;
        }
        $firstname = $_POST['first'];
        $lastname = $_POST['last'];
        $driver_id = 8000+($sno+1);
        $mothername = $_POST['mother'];
        $fathername = $_POST['father'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $designation = $_POST['designation'];
        $pan_no = $_POST['pan_no'];
        $password = $_POST['password'];
        $mobileno = $_POST['mobile'];
        $aadharno = $_POST['aadhar'];
        $village = $_POST['village'];
        $post = $_POST['post'];
        $district = $_POST['district'];
        $gmailid = $_POST['email'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];
        $df_name = md5(time());
        $file_name = $_FILES['profile']['name'];
        $file = $df_name.$file_name;
        $tempname = $_FILES['profile']['tmp_name'];
        $folder = '../profileimage/'.$df_name.$file_name;
        move_uploaded_file($tempname, $folder);
        $existsql = "SELECT * FROM `driver_details` WHERE dri_driver_id = '$driver_id' AND dri_aadhar_no = '$aadharno'";
        $result = mysqli_query($conn, $existsql);
        $numrows = mysqli_num_rows($result);
        if($numrows>0){
            $showerror = "This Driver id or Aadhar number are already registered.";
            header("location:/school/partials/admissionform.php");
        }
        else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `driver_details` (`dri_first_name`, `dri_last_name`, `dri_driver_id`, `dri_bus_no`, `dri_gender`, `dri_dob`, `dri_designation`, `dri_password`, `dri_aadhar_no`, `dri_pan_no`, `dri_dl_no`, `dri_profile_photo`, `dri_village`, `dri_post`, `dri_district`, `dri_pincode`, `dri_state`, `dri_father_name`, `dri_mother_name`, `dri_mobile_no`, `dri_gmail_id`, `dri_driving_experiance`) VALUES ('$firstname', '$lastname', '$driver_id', '$bus_no', '$gender', '$dob', '$designation', '$hash', '$aadharno', '$pan_no', '$dl_license', '$file', '$village', '$post', '$district', '$pincode', '$state', '$fathername', '$mothername', '$mobileno', '$gmailid', '$driving_experience')";
            $resultn = mysqli_query($conn, $sql);
            if($resultn){
                header("location: ../erp/erp_driverdetails.php");
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
    <title>Staff Registration</title>
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
    <h1 class="text-center">Staff Registration</h1>
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="container">
            <div style="border: 1px solid black;padding:15px;border-radius:10px;margin-bottom:20px">
                <div class="row my-3">
                    <div class="col">
                        <label for="first" class="form-label requireds">First name</label>
                        <input type="text" class="form-control" name="first" id="first" placeholder="First name"
                            aria-label="First name" required>
                    </div>
                    <div class="col">
                        <label for="last" class="form-label requireds">Last name</label>
                        <input type="text" class="form-control" name="last" id="last" placeholder="Last name"
                            aria-label="Last name">
                    </div>
                    <div class="col">
                        <label for="dob" class="form-label">DOB</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="">
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
                        <label for="department" class="form-label">Designation</label>
                        <select class="form-select" name="designation" id="designation"
                            aria-label="Default select example" onchange="checkInput()">
                            <option selected>Select</option>
                            <option value="Bus Driver">Bus Driver</option>
                            <option value="Conductor">Conductor</option>
                            <option value="Peon">Peon</option>
                            <option value="Guard">Guard</option>
                            <option value="Sweeper">Sweeper</option>
                        </select>
                    </div>
                    <div class="col" style="display: none;" id="id">
                        <label for="bus_no" class="form-label">Bus No.</label>
                        <input type="text" class="form-control" name="bus_no" placeholder="Bus Number"
                            aria-label="bus_no" id="bus_no">
                    </div>
                    <div class="col" style="display: none;" id="id1">
                        <label for="driving_experience" class="form-label">Driving Experiance(in year)</label>
                        <input type="text" class="form-control" name="driving_experience"
                            placeholder="Driving Experiance" aria-label="driving_experience" id="driving_experience">
                    </div>
                    <div class="col" id="id4">
                    </div>
                    <div class="col" id="id5">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col" style="display: none;" id="id2">
                        <label for="driving_lic" class="form-label">Driving License No.</label>
                        <input type="text" class="form-control" id="driving_lic" name="driving_lic" value=""
                            placeholder="Driving License No.">
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
                        <input type="text" class="form-control" name="mobile" placeholder="Mobile no" maxlength="10"
                            aria-label="Mobile no" id="mobile">
                    </div>
                    <div class="col">
                        <label for="aadhar" class="form-label">Aadhar No(Pattern XXXX XXXX XXXX)</label>
                        <input type="text" class="form-control" name="aadhar" placeholder="Aadhar no" maxlength="12"
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
                        <label for="formFile" class="form-label">Upload Profile Photo(.jpeg/.jpg/.png)</label>
                        <input class="form-control" type="file" id="formFile" name="profile">
                    </div>
                    <div class="col">
                        <label for="pan_no" class="form-label">PAN no.</label>
                        <input type="text" class="form-control" name="pan_no" placeholder="PAN No." aria-label="pan_no"
                            id="pan_no">
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
            <div class="button"><button type="submit" class="btn btn-success" name="submit">Submit</button></div>
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
                        } else if(value === "Conductor") {
                            div.style.display = "block";
                            div4.style.display = "none";
                            div5.style.display = "block";
                            div1.style.display = "none";
                            div2.style.display = "none";
                        }else {
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