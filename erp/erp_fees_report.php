<?php
include '../backend/connection.php';
session_start();
if(!isset($_SESSION['loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
?>
<?php
if(isset($_GET['delete_id'])){
$delete = $_GET['delete_id'];
$delete_sql = "DELETE FROM `class` WHERE `cl_Sno` = $delete";
$delete_result = mysqli_query($conn, $delete_sql);
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRM ERP | Fees Report</title>
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
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../erpstyle.css">
    <style>
        tr .red{
            color:red;
        }
        tr .green{
            color:green;
        }
    </style>
    <script src="../javascript/function.js"></script>
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
            <h3 style="margin-left:20px">Fees Report</h3>
            <div class="teachersrecord">
                <table class="table table-bordered" id="mytable" style="font-size:12px;">
                    <thead>
                        <tr>
                            <th scope="col">Sno</th>
                            <th scope="col">Stu_Name</th>
                            <th scope="col">Adm. no</th>
                            <th scope="col">Class</th>
                            <th scope="col">Prev Pending</th>
                            <th scope="col">Adm. Fees</th>
                            <th scope="col">Apr</th>
                            <th scope="col">May</th>
                            <th scope="col">Jun</th>
                            <th scope="col">Jul</th>
                            <th scope="col">Aug</th>
                            <th scope="col">Sep</th>
                            <th scope="col">Oct</th>
                            <th scope="col">Nov</th>
                            <th scope="col">Dec</th>
                            <th scope="col">Jan</th>
                            <th scope="col">Feb</th>
                            <th scope="col">Mar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $sql = "SELECT * FROM `tution_fees`";
                    $result = mysqli_query($conn, $sql);
                    
                    $sno = 0;
                    while($row= mysqli_fetch_assoc($result) ){
                        $sno= $sno+1;
                        $admission_no = $row['stu_admission_no'];
                        $fees_sql = "SELECT * FROM `studentsdetail` WHERE admission_number = '$admission_no'";
                        $fees_result = mysqli_query($conn, $fees_sql);
                        $rows = mysqli_fetch_assoc($fees_result);
                        $con_sql = "SELECT * FROM `convenience_fees` WHERE stu_conve_admissionno = '$admission_no'";
                        $con_result = mysqli_query($conn, $con_sql);
                        $conv_row = mysqli_fetch_assoc($con_result);
                        echo "<tr>
                              <th scope='row'>".$sno."</th>
                              <td>".$rows['first_name'] ." ". $rows['middle_name']. " ". $rows['last_name']."</td>
                              <td>".$row['stu_admission_no']."</td>
                              <td>".$rows['class'] ."</td>";
                              if($row['stu_previous_pending_fees'] == 0){
                              echo "<td class='green'>NA</td>"; }else{
                                echo "<td class='red'>".$row['stu_previous_pending_fees']."</td>
                                ";}
                               if($row['stu_admission_fees'] == 0){
                                    echo "<td class='red'>Pen</td>"; 
                                }
                              else{
                                echo "<td class='green'>". $row['stu_admission_fees']."</td>";
                                }
                              if($row['stu_tuition_apr'] == 0){
                                    echo "<td class='red'>Pen</td>"; 
                                }
                              else{
                                echo "<td class='green'>". $row['stu_tuition_apr'] + $conv_row['stu_conve_apr']."</td>";
                                }
                              if($row['stu_tuition_may'] == 0){
                                    echo "<td class='red'>Pen</td>"; 
                                }
                              else{
                                echo "<td class='green'>". $row['stu_tuition_may'] + $conv_row['stu_conve_may'] ."</td>";
                                }
                              if($row['stu_tuition_jun'] == 0){
                                    echo "<td class='red'>Pen</td>"; 
                                }
                              else{
                                echo "<td class='green'>". $row['stu_tuition_jun'] + $conv_row['stu_conve_jun'] ."</td>";
                                }
                              if($row['stu_tuition_jul'] == 0){
                                    echo "<td class='red'>Pen</td>"; 
                                }
                              else{
                                echo "<td class='green'>". $row['stu_tuition_jul'] + $conv_row['stu_conve_jul'] ."</td>";
                                }
                                if($row['stu_tuition_aug'] == 0){
                                    echo "<td class='red'>Pen</td>"; 
                                }
                              else{
                                echo "<td class='green'>". $row['stu_tuition_aug'] + $conv_row['stu_conve_aug'] ."</td>";
                                }
                                if($row['stu_tuition_sep'] == 0){
                                    echo "<td class='red'>Pen</td>"; 
                                }
                              else{
                               echo "<td class='green'>". $row['stu_tuition_sep'] + $conv_row['stu_conve_sep'] ."</td>";
                                }
                                if($row['stu_tuition_oct'] == 0){
                                    echo "<td class='red'>Pen</td>"; 
                                }
                              else{
                                echo "<td class='green'>". $row['stu_tuition_oct'] + $conv_row['stu_conve_oct'] ."</td>";
                                }
                                if($row['stu_tuition_nov'] == 0){
                                    echo "<td class='red'>Pen</td>"; 
                                }
                              else{
                                echo "<td class='green'>". $row['stu_tuition_nov'] + $conv_row['stu_conve_nov'] ."</td>";
                                }
                                if($row['stu_tuition_dec'] == 0){
                                    echo "<td class='red'>Pen</td>"; 
                                }
                              else{
                                echo "<td class='green'>". $row['stu_tuition_dec'] + $conv_row['stu_conve_dec'] ."</td>";
                                }
                                if($row['stu_tuition_jan'] == 0){
                                    echo "<td class='red'>Pen</td>"; 
                                }
                              else{
                               echo "<td class='green'>". $row['stu_tuition_jan'] + $conv_row['stu_conve_jan'] ."</td>";
                                }
                                if($row['stu_tuition_feb'] == 0){
                                    echo "<td class='red'>Pen</td>"; 
                                }
                              else{
                                echo "<td class='green'>". $row['stu_tuition_feb'] + $conv_row['stu_conve_feb'] ."</td>";
                                }
                                if($row['stu_tuition_mar'] == 0){
                                    echo "<td class='red'>Pen</td>"; 
                                }
                              else{
                                echo "<td class='green'>". $row['stu_tuition_mar'] + $conv_row['stu_conve_mar'] ."</td>";
                                }
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

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            Sno = e.target.id.substr(1, );
            if (confirm("Are you sure you want to delete this Teacher record!")) {
                window.location = `../erp/erp_teachers.php?delete_id=${Sno}`;
            } else {

            }
        })
    })
    </script>
</body>

</html>