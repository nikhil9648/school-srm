<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRM ERP | Fees Reciept</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/brands.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js">
    </script>
    <script defer src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../erpstyle.css">
    <script src="../javascript/function.js"></script>
</head>

<body>
    <?php
    include '../partials/youtubeinsta.php';
    ?>
    <div class="sectionerp">
        <div class="section1 hideonmobile">
            <?php include '../erp/erp_sidebar.php'; ?>
        </div>
        <div class="section2">
            <?php
            include '../erp/erp_header.php';
            ?>
            <?php
             $session = "2026-2027";
                if(isset($_POST['session'])){
                    $session = $_POST['session'];
                }
            ?>
            <form class="byclass_search" action="" method="post">
                    <div class="mb-3"
                        style="display:flex;align-items:center;justify-content:right;margin-right:63px;height:10px;">
                        <select class="form-control" name="session" style="width:200px;" onchange="this.form.submit()">
                            <option value="2025-2026" <?php if($session=="2025-2026") echo "selected"; ?>>2025-2026
                            </option>
                            <!-- <option value="All">All</option> -->
                            <option value="2026-2027" <?php if($session=="2026-2027") echo "selected"; ?>>2026-2027
                            </option>
                            <option value="2027-2028" <?php if($session=="2027-2028") echo "selected"; ?>>2027-2028
                            </option>
                        </select>
                    </div>
                </form>
            <div class="teachersrecord">
                <table class="table table-bordered" id="mytable">
                    <thead>
                        <tr>
                            <th scope="col">Sno</th>
                            <th scope="col">Reciept No</th>
                            <th scope="col">Stu Name</th>
                            <th scope="col">Adm. No</th>
                            <th scope="col">Class</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $existsql = "SELECT * FROM `reciept`";
                        $resultexist = mysqli_query($conn, $existsql);
                        // $existrow = mysqli_fetch_assoc($resultexist);
                    $sno = 0;
                    while($existrow= mysqli_fetch_assoc($resultexist)){
                        $admissionm_no = $existrow['admission_no'];
                        $sql = "SELECT * FROM `studentsdetail` where admission_number = '$admissionm_no'";
                    $result = mysqli_query($conn, $sql);
                    $row= mysqli_fetch_assoc($result);
                        $sno= $sno+1;
                        echo "<tr>
                              <th scope='row'>".$sno."</th>
                              <td>".$existrow['reciept_no']."</td>
                              <td>".$existrow['stu_name']."</td>
                              <td>".$existrow['admission_no']."</td>
                              <td>".$existrow['class']."</td>
                              <td>".$existrow['reciept_date']."</td>
                              <td><a href='../erp/download_reciept.php?fee_reciept=".$existrow['reciept_no']."'><button class='edit btn btn-sm btn-success' id = ".$existrow['reciept_no']."> View Reciept </button></a></td>
                              </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>




        </div>
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
    <script>
    $(document).ready(function() {
        $('#mytable').DataTable();
    });
    </script>
</body>

</html>