<?php
    $admission_no = $_SESSION['stu_admission_no'];
     $sql = "SELECT * FROM `studentsdetail` WHERE admission_number = '$admission_no'";
     $result = mysqli_query($conn, $sql);
     $row = mysqli_fetch_assoc($result);

?>
<nav class="navbar bg-body-tertiary hideonmobile">
    <div class="container-fluid">
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
</nav>
<div class="hideondesktop showondesktop menu"><a class="btn" data-bs-toggle="offcanvas" href="#offcanvasExample"
        role="button" aria-controls="offcanvasExample"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path
                d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
        </svg></a></div>
<div class="student_profile">
    <img src="../profileimage/<?php echo $row['profile_photo'];?>" alt="">
    <div class="nameinfo">
        <h6><?php echo $row['first_name'];?></h6>
        <p>class <?php echo $row['class'];?></p>
    </div>
</div>
</div>
