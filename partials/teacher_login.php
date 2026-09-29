<?php
$showalert=false;
if($_SERVER['REQUEST_METHOD']=="POST"){
    include '../backend/connection.php';
    $teacher_id = $_POST['usernameteacher'];
    $password = $_POST['passwordteacher'];
    $sql = "SELECT * FROM `class` WHERE cl_schoolid = '$teacher_id'";
    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);
    if($numrows==1){
        $row = mysqli_fetch_assoc($result);
        $cl_teacher_id = $row['cl_schoolid'];
        $cl_classteachers = $row['cl_class_teacher'];
        $pass = $row['cl_password'];
        $cl_firstname = $row['cl_Firstname'];
        if(password_verify($password, $pass)){
            session_start();
            $_SESSION['cl_loggedin'] = true;
            $_SESSION['cl_first_name'] = $cl_firstname;
            $_SESSION['cl_teacher_id'] = $cl_teacher_id;
            $_SESSION['cl_classesteacher'] = $cl_classteachers;
            header("location: ../teacher/teacher_dashboard.php");
        }
        else{
            $showalert= "password does not match";
            // header("location: /school/partials/teacher_login.php");
        }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
    <script src="../javascript/function.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "poppins", sans-serif;
         }
        body {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url('../img/2.jpg') no-repeat;
    background-size: cover;
    background-position: center;
}

/* DARK OVERLAY */
body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    z-index: 0;
}

/* KEEP CONTENT ABOVE OVERLAY */
body * {
    position: relative;
    z-index: 1;
}
         
         .wrapper {
             width: 420px;
             background-color:black;
             /* background: transparent; */
             border: 2px solid rgba(255, 255, 255, .2);
             /* backdrop-filter: blur(20px); */
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
         .alert{
            top: 0;
         }
    </style>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="body"></div>
    <?php
//     if(isset($_SESSION['cl_loggedin']) && $_SESSION['cl_loggedin']==false){
//                 echo '<div class="danger alert-warning alert-dismissible fade show" role="alert">
//   <strong>Error!</strong> "You are not logged in please try again." 
//   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
// </div>';
//             }
if($showalert){
    echo '<div class="alert alert-danger alert-dismissible fade show logout" id="hello" role="alert">
<strong>Unsuccessful!</strong>  '. $showalert .'
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
            ?>
    <div class="wrapper">
        <form method="post">
            <h1>Teacher Login</h1>
            <div class="input-box">
                <input type="text" name="usernameteacher" placeholder="Username" required>
            </div>
            <div class="input-box">
                <input type="password" name="passwordteacher" placeholder="Password" required>
            </div>
            <div class="remember-forget">
                <label><input type="checkbox"> Remember me</label>
                <a href="../teacher/teacher_forget.php">Forget password</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="register-link my-4">
                <p>Don't have an account? <a href="../contact.php">Contact Admin Office</a></p>
            </div>

        </form>

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