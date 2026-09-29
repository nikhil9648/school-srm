<?php
session_start();
// echo $otp;
if($_SERVER['REQUEST_METHOD']=="POST"){
    include '../backend/connection.php';
    include '../emailsender/email.php';
    $teacher_id = $_POST['teacher_id'];
    $email = $_POST['email'];
    $sql = "SELECT * FROM `class` WHERE cl_gmail = '$email'";
    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);
    if($numrows==1){
        $otp = rand(10000, 99999);
        $msg = "Your OTP for password reset is <b>".$otp."</b> This code is valid for 10 minutes. Do not share it with anyone for security reasons. If you did not request this, please ignore this message or contact support immediately.";
        smtp_mailer($email,"Forget Password", $msg);
            $_SESSION['teacher_otp'] = $otp;
            header("location: ../teacher/teacher_verify_otp.php?teacher_id=$teacher_id");
    }
    else{
        header("location: ../teacher/teacher_forget.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style_login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "poppins", sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: url('../img/2.jpg') no-repeat;
        background-size: cover;
        background-position: center;
    }

    .wrapper {
        width: 420px;
        background-color: black;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, .2);
        backdrop-filter: blur(80px);
        box-shadow: 0 0 10px rgba(0, 0, 0, .2);
        color: #fff;
        border-radius: 10px;
        padding: 30px 40px;
    }

    .wrapper h1 {
        font-size: 36px;
        text-align: center;
    }

    .wrapper .input-box {
        width: 100%;
        height: 100%;
        background: transparent;
        margin: 30px 0;
    }

    .input-box input {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgb(255, 255, 255, .2);
        border-radius: 40px;
        font-size: 16px;
        color: #fff;
        padding: 20px 45px 20px 20px;
    }

    .input-box input::placeholder {
        color: #fff;
    }

    .input-box i {
        position: incline;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
    }

    .wrapper .remember-forget {
        display: flex;
        justify-content: space-between;
        font-size: 14.5px;
        margin: -15px 0 15px;
    }

    .remember-forget a {
        color: #fff;
        text-decoration: none;
    }

    .remember-forget a:hover {
        text-decoration: underline;
    }

    .wrapper .btn {
        width: 100%;
        height: 45px;
        background: #fff;
        border: none;
        outline: none;
        border-radius: 40px;
        box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        cursor: pointer;
        font-size: 16px;
        color: #333;
        font-weight: 600px;
    }

    .wrapper .register-link {
        font-size: 14.5px;
        text-align: center;
        /* margin-top: 20 0 15px; */
        margin-top: 10px;
    }

    .register-link p a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
    }

    .register-link p a:hover {
        text-decoration: underline;
    }
    </style>
</head>
<body>
    <div class="wrapper">
        <form action="" method="post">
            <h1>Forget Password</h1>
            <div class="input-box">
                <input type="text" placeholder="Enter Teacher'Id Number" name="teacher_id" required>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Enter Regiesterd Email I'd" name="email" required>
            </div>
            <button type="submit" class="btn">Send OTP</button>
            <div class="register-link my-4">
                <p>Don't have an account? <a href="contact.php">Contact Admin Office</a></p>
            </div>
        </form>
    </div>
</body>

</html>