<?php
include '../backend/connection.php';
include '../emailsender/email.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
date_default_timezone_set('Asia/Kolkata');

$selected_date = date("d-m-Y");
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty($_POST['selected_date'])){
        $selected_date = date("d-m-Y");
    } else {
        $selected_date = date("d-m-Y", strtotime($_POST['selected_date']));
    }
}
$selected_date_input = date("Y-m-d", strtotime($selected_date));
$sql = "SELECT * FROM `reciept` Where reciept_date = '$selected_date'";
$result = mysqli_query($conn, $sql);

$cash = 0;
$online = 0;
$submitted_total = 0;
$submitted_online = 0;
$submitted_offline = 0;

$submitted_sql = "SELECT f.*, TRIM(CONCAT(s.first_name, ' ', COALESCE(s.middle_name, ''), ' ', s.last_name)) as stu_name FROM `student_fees_submitted` f LEFT JOIN `studentsdetail` s ON f.stu_admission_no = s.admission_number WHERE DATE_FORMAT(f.created_at, '%d-%m-%Y') = '$selected_date'";
$submitted_result = mysqli_query($conn, $submitted_sql);

$receipt_count = ($result) ? mysqli_num_rows($result) : 0;
$submitted_count = ($submitted_result) ? mysqli_num_rows($submitted_result) : 0;


?>
<?php
if(isset($_GET['delete_id'])){
$delete = $_GET['delete_id'];
$delete_sql = "DELETE FROM `reciept` WHERE `Sno` = $delete";
$delete_result = mysqli_query($conn, $delete_sql);
if($delete_result){
    echo '<script>alert("Reciept Deleted Successfully"); window.location="../erp/erp_history_fees.php";</script>';
}
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School</title>
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
    <style>
    main {
        display: flex;
        justify-content: space-between;
    }

    input {
        padding: 0px
    }

    section {
        width: 400px;

    }

    .total {
        width: 400px;
    }
    </style>
</head>

<body>

    <?php
    include '../partials/youtubeinsta.php';
    $showalert = false;
    $showerror = false;
    ?>
    <div class="sectionerp">
        <div class="section1 hideonmobile">
            <?php include '../erp/erp_sidebar.php'; ?>
        </div>
        <div class="section2">
            <?php
            include '../erp/erp_header.php';
            ?>
            <div class="studentrecord">
                <main>
                    <?php 
                    if($receipt_count == 0 && $submitted_count == 0){
                        echo '<h4 style="color:red;"> No Records Found </h4>';
                    }else{
                        if($selected_date == date("d-m-Y")){
                            echo '<h4 style="color:green;"> Today </h4>';
                        } else {
                            echo '<h4 style="color:blue;"> '. $selected_date .' </h4>';
                        }
                    }
                    ?>

                    <form action="" method="post">
                        <div class="input-group mb-3" style="width:250px;">
                            <input type="date" class="form-control" name="selected_date" value="<?php echo $selected_date_input; ?>">
                            <button class="btn btn-success" type="submit" id="button-addon2">Search</button>
                        </div>
                    </form>
                </main>
                <?php
                if($receipt_count > 0){?>
                <table class="table table-bordered" style="width:70vw; margin-bottom:10px;">
                    <thead>
                        <tr>
                            <th scope="col">Sno</th>
                            <th scope="col">Reciept No</th>
                            <th scope="col">Admission No</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Payment Mode</th>
                            <th scope="col">Subm. by</th>
                            <th scope="col">Reciept</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sno = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        $sno= $sno+1;
                        echo '<tr>
                              <th scope="row">'.$sno.'</th>
                              <td>'.$row['reciept_no'].'</td>
                              <td>'.$row['admission_no'].'</td>
                              <td>'.$row['stu_name'].'</td>
                              <td>'.$row['payment_method'].'</td>
                              <td>'.$row['erp_teacher_name'].'</td>
                              <td><a href="../erp/download_reciept.php?fee_reciept='.$row['reciept_no'].'"><button class="edit btn btn-sm btn-success" id = "'.$row['reciept_no'].'"> View </button></a> <button class="delete btn btn-sm btn-danger" type="button" id = "d'.$row['Sno'].'"> Delete </button></td>
                              <th scope="row" style="color:red;">'.$row['total_fee'].'</th>
                              </tr>';
                              if($row['payment_method']=="Cash"){
                                $cash += $row['total_fee'];
                            }
                            elseif ($row['payment_method']=="Online") {
                                    $online += $row['total_fee'];
                            }
                    }
                   ?>
                    </tbody>
                </table>
                <?php } else { ?>
                <!-- <h5 style="color:orange;">No Receipt entries found for <?php echo $selected_date; ?></h5> -->
                <?php } ?>
                
                <!-- Fee Submissions Table -->
                <?php if($submitted_count == 0){ 
                    // echo '<h5 style="color:orange;">No Fee Submissions found for '. $selected_date .'</h5>';
                } else { ?>
                <table class="table table-bordered" style="width:70vw; margin-bottom:10px;">
                    <thead>
                        <tr>
                            <th scope="col">Sno</th>
                            <th scope="col">Reciept No</th>
                            <th scope="col">Admission No</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Online Payment</th>
                            <th scope="col">Cash Payment</th>
                            <th scope="col">Subm. by</th>
                            <th scope="col">Reciept</th>
                            <th scope="col">Total Paid</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sub_sno = 1;
                        while($sub_row = mysqli_fetch_assoc($submitted_result)){
                            $row_online_payment = isset($sub_row['online_payment']) ? (float)$sub_row['online_payment'] : 0;
                            $row_offline_payment = isset($sub_row['offline_payment']) ? (float)$sub_row['offline_payment'] : 0;
                            $submitted_total += $sub_row['total_paid'];
                            $submitted_online += $row_online_payment;
                            $submitted_offline += $row_offline_payment;
                            echo '<tr>
                                  <th scope="row">'.$sub_sno.'</th>
                                  <td>'.$sub_row['reciept_no'].'</td>
                                  <td>'.$sub_row['stu_admission_no'].'</td>
                                  <td>'.$sub_row['stu_name'].'</td>
                                  <td>'.$row_online_payment.'</td>
                                  <td>'.$row_offline_payment.'</td>
                                  <td>'.$sub_row['submitted_by'].'</td>
                                  <td><a href="erp_updated_reciept.php?id='.$sub_row['id'].'"><button class="edit btn btn-sm btn-success"> View </button></a></td>
                                  <th scope="row" style="color:green;">'.$sub_row['total_paid'].'</th>
                                  </tr>';
                            $sub_sno++;
                        }
                        ?>
                    </tbody>
                </table>
                <?php } ?>
                <?php if($receipt_count > 0 || $submitted_count > 0){ ?>
                <section>
                    <table class="table table-bordered" style="width:250px; right:0;">
                        <tbody>
                            <tr>
                                <td>Total Cash</td>
                                <th scope="row"><?php echo $cash + $submitted_offline;?></th>
                            </tr>
                            <tr>
                                <td>Total Online</td>
                                <th scope="row"><?php echo $online + $submitted_online;?></th>
                            </tr>
                            <tr>
                                <td><b>GRAND TOTAL</b></td>
                                <th scope="row" style="color:blue;font-size:1.3em;"><?php echo $cash + $online + $submitted_total;?></th>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <?php } ?>
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
    function toggleSelectAll(source) {
        const checkboxes = document.querySelectorAll('input[name="select[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = source.checked;
        });
    }
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            Sno = e.target.id.substr(1, );
            if (confirm("Are you sure you want to delete this Reciept!")) {
                window.location = `../erp/erp_history_fees.php?delete_id=${Sno}`;
            } else {

            }
        })
    })
    </script>
</body>

</html>











<!-- mail send format a data -->