<link rel="stylesheet" href="style.css">
<script src="../javascript/function.js"></script>
<div class="sidebar">
    <ul>
        <li onclick=hidesidebar()><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                <!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path fill="#ffffff"
                    d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></li>
        <li><a href="index.php" class="nav-link">Home</a></li>
        <li><a href="about.php" class="nav-link">About</a></li>
        <li><a href="admission.php" class="nav-link">Admission</a></li>
        <li><a href="fees.php" class="nav-link">Fees</a></li>
        <li><a href="gallery.php" class="nav-link">Gallery</a></li>
        <li><a href="download.php" class="nav-link">Download</a></li>
        <li><a href="contact.php" class="nav-link">Contact Us</a></li>
        <li><a href="partials/erp_login.php"><button type="button" class="btn btn-outline-warning">Login
                    ERP</button></a></li>
        <li><a href="partials/student_login.php"><button type="button" class="btn btn-outline-warning">Login
                    Student</button></a></li>
    </ul>
</div>
<div class="container1">
    <h5 style="color: white;"><Span>Affiliation No.- 2133678</Span><span>   School Code -71792</span></h5>
    <div class="button">
        <a href="partials/erp_login.php"><button type="button" class="btn btn-outline-warning hideonmobile">Login ERP</button></a>
        <a href="partials/student_login.php"><button type="button" class="btn btn-outline-warning hideonmobile">Login
                Student</button></a>
    </div>
   <li onclick=showsidebar() class="hideondesktop showondesktop" style="margin-top:-22px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path fill="#ffffff"
                    d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
            </svg></li>
</div>
<div class="container2">
    <img src="img/logo.png" alt="">
    <div class="schoolnamesrm">
        <h1>SRM Modern Public School</h1>
        <p>Bariyarshah Bhadar Amethi(UP)</p>
    </div>
</div>
<!-- <hr> -->
<div class="container3 hideonmobile">
    <ul>
        <li><a href="index.php" class="nav-link">Home</a></li>
        <li><a href="about.php" class="nav-link">About</a></li>
        <li><a href="admission.php" class="nav-link">Admission</a></li>
        <li><a href="fees.php" class="nav-link">Fees</a></li>
        <li><a href="gallery.php" class="nav-link">Gallery</a></li>
        <li><a href="download.php" class="nav-link">Download</a></li>
        <li><a href="contact.php" class="nav-link">Contact Us</a></li>
</div>
<script>
    function showsidebar(){
        const sidebar = document.querySelector('.sidebar')
        sidebar.style.display="flex"
    }
    function hidesidebar(){
        const sidebar = document.querySelector('.sidebar')
        sidebar.style.display="none"
    }
</script>