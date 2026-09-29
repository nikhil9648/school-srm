<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/brands.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
    footer {
        margin-top: 70px;
        width: 100%;
        bottom: 0;
        background: linear-gradient(to right, #00093c, #2d0b00);
        /* background-color:blue; */
        color: #fff;
        padding: 100px 0 30px;
        border-top-left-radius: 115px;
        font-size: 13px;
        line-height: 20px;
    }

    .row {
        display: flex;
        width: 85%;
        margin: auto;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: space-between;
    }

    .col {
        flex-basis: 25%;
        padding: 10px;

    }
    .col p a{
        text-decoration:none;
        color:white;
    }
    .logos {
        color: white;
        font-size: 30px;
        width: 80px;
        margin-bottom: 60px;
        text-decoration: none;
    }

    .shor {
        margin-top: 30px;
    }

    .col h3 {
        width: fit-content;
        margin-bottom: 40px;
        position: relative;
    }

    .email-id {
        margin-top: 15px;
        margin-bottom: 15px;
        width: fit-content;
        border-bottom: 1px solid #ccc;
    }

    ul li {
        list-style: none;
        margin-bottom: 12px;

    }

    ul li a {
        text-decoration: none;
        color: #fff;
    }

    form {
        padding-bottom: 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #ccc;
        margin-bottom: 15px;

    }

    form .far {
        font-size: 18px;
        margin-right: 10px;

    }

    form input {
        width: 100%;
        background: transparent;
        color: #ccc;
        border: 0;
        outline: none;
    }

    form button {
        background: transparent;
        border: 0;
        outline: none;
        cursor: pointer;
    }

    form button .fas {
        font-size: 16px;
        color: #ccc;

    }

    .social-media {
        display: flex;
        justify-content: center;
        margin-bottom:8px;
    }

    .social-icon {
        background-color: #ffffff;
        height: 46px;
        width: 46px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 0.45rem;
        color: #333;
        border-radius: 50%;
        border: 1px solid #333;
        text-decoration: none;
        font-size: 1.1rem;
        transition: 0.3s;
    }

    .social-icon:hover {
        background-color: #cadefc;
        color: #4481eb;
        border-color: #cbdbf6;
    }

    hr {
        width: 90%;
        border: 0;
        border-bottom: 1 px solid #ccc;
        margin: 20px auto;

    }

    .copy {
        text-align: center;
    }

    .underline {
        width: 100%;
        height: 5px;
        background: #767676;
        border-radius: 3px;
        position: absolute;
        top: px;
        left: 0;

    }

    .underline span {
        width: 15px;
        height: 100%;
        background: #fff;
        border-radius: 3px;
        position: absolute;
        top: 0;
        left: 10px;
        animation: moving 2s linear infinite;
        overflow: hidden;
    }

    @keyframes moving {
        0% {
            left: 0px;
        }

        100% {
            left: 70%;
        }
    }
    </style>
</head>

<body>
    <footer>
        <div class="row">
            <div class="col">
                <a href="#" class="logos">SCHOOL</a>
                <p class="shor">SRM Modern Public School is a center of excellence dedicated to nurturing young minds with a focus
                    on holistic development. Established in 2010, we provide a vibrant learning environment, combining
                    academic rigor with co-curricular activities. Our dedicated faculty fosters creativity, leadership,
                    and values, empowering students to achieve success in an ever-evolving world.</p>
            </div>

            <div class="col">
                <h3>Office <div class="underline"><span></span></div>
                </h3>
                <p style="text-align:start;">SRM Modern public School</p>
                <p style="text-align:start;">Amethi</p>
                <P style="text-align:start;">developed by Nikhil Maurya</P>
                <p class="email-id">srmmps2010@gmail.com</p>
                <h4>9793237340</h4>
            </div>
            <div class="col">
                <h3>Links <div class="underline"><span></span></div>
                </h3>
                <ul>
                    <li><a href="../school/index.php">Home</a></li>
                    <li><a href="../school/about.php">About</a></li>
                    <li><a href="./admission.php">Admission</a></li>
                    <li><a href="./contact.php">Contacts</a></li>
                    <li><a href="./gallery.php">Gallery</a></li>
                    <li><a href="./fees.php">Fee structure</a></li>
                    <li><a href="#">Activity</a></li>
                </ul>
            </div>
            <div class="col">
                <h3>Newletter <div class="underline"><span></span></div>
                </h3>
                <form action="">
                    <i class="far fa-envelope"></i>
                    <input type="email" placeholder="Enter Your Email-id" required>
                    <button type="submit"><i class="fas fa-arrow-right"></i></button>
                </form>
                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
                <p><a href="partials/erp_login.php">ERP login</a></p>
                <p><a href="partials/teacher_login.php">Teacher login</a></p>
                <p><a href="partials/student_login.php">Student login</a></p>
            </div>
        </div>
        <hr>
        <p class="copy">SRM Library &copy; 2024 - All rights reserved</p>
    </footer>
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