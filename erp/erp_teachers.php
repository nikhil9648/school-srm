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
// $delete_sql = "DELETE FROM `class` WHERE `cl_Sno` = $delete";
// $delete_result = mysqli_query($conn, $delete_sql);
$result = mysqli_query($conn, "SELECT cl_profile_photo FROM class WHERE cl_Sno = '$delete'");
$row = mysqli_fetch_assoc($result);
if ($row) {
    $photo = '../profileimage/' . $row['cl_profile_photo'];
    if (file_exists($photo)) {
        unlink($photo);
    }
    mysqli_query($conn, "DELETE FROM class WHERE cl_Sno = '$delete'");
}
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRM | Teacher</title>
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
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
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
            <div class="student_idcard"
                style="display: flex; justify-content: left;gap:10px; margin-left:10px;margin-bottom:10px; align-items: center;">
                <div class="student_search" style="border: 1px solid black; padding:10px; border-radius: 10px;">
                    <div class="search_student">
                        <h5>Print Teachers Record</h5>
                        <?php
                        if(isset($_POST['teacher'])){
                            $teacher = $_POST['teacher'];
                        }
                        else{
                            $teacher = 0;
                        } 
                        ?>
                        <form class="byclass_search" action="" method="post">
                            <div class="mb-3">
                                <label for="teacher" class="form-label">Teacher's</label>
                                <select type="text" class="form-control" id="teacher" name="teacher"
                                    aria-describedby="emailHelp" style="width: 200px;">
                                    <option selected>Select</option>
                                    <option value="all">All</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success" style="margin-top:17px;">Search</button>
                        </form>
                    </div>
                </div>
                </div>
                <?php
                if(isset($_POST['teacher']) && $teacher != 0){
                    ?>
                <table class="table table-bordered print_record">
                    <thead>
                        <tr>
                            <th scope="col">Sno</th>
                            <th scope="col">Teacher Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Mobile No.</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    if ($teacher == "all") {
                        $sql = "SELECT * FROM `class`";
                    } else {
                        // $sql = "SELECT * FROM `studentsdetail` WHERE class = '$idcard_class'";
                    }
                    // $sql = "SELECT * FROM `studentsdetail` Where class = '$class'";
                    $result = mysqli_query($conn, $sql);
                    $snos = 0;
                    while($rows = mysqli_fetch_assoc($result)){
                        $snos= $snos+1;
                        // $date = $rows['dob'];
                        // list($year, $month, $day) = explode('-', $date);
                        echo "<tr>
                              <th scope='row'>".$snos."</th>
                              <td>".$rows['cl_schoolid']."</td>
                              <td>".$rows['cl_Firstname'] . " ". $rows['cl_lastname']."</td>
                              <td>".$rows['cl_mobile']."</td>
                              <td>".$rows['cl_department']."</td>
                              <td>".$rows['cl_village'] ." ". $rows['cl_post']. " ". $rows['cl_district']. " ". $rows['cl_pin']."</td>
                              </tr>";
                    }
                   ?>
                    </tbody>
                </table>
                <button style="display:flex;justify-content:center;align-items:center;margin:10px 0px;"
                    class="btn btn-success btn-print" onclick="printPage()">Print Record</button>
                <?php }
                ?>
                <!-- </div> -->
            <div class="teachersrecord">
                <form action="../erp/erp_teacherIdcard.php" method="post">
                    <table class="table table-bordered" id="mytable">
                        <thead>
                            <tr>
                                <th scope="col">Sno</th>
                                <th scope='col'><input type='checkbox' onclick='toggleSelectAll(this)' id='select-all'></th>
                                <th scope="col">Profile Photo</th>
                                <th scope="col">Teacher I'd</th>
                                <th scope="col">Teacher Name</th>
                                <th scope="col">Designation</th>
                                <th scope="col">Class Teacher</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    $sql = "SELECT * FROM `class`";
                    $result = mysqli_query($conn, $sql);
                    $sno = 0;
                    while($row= mysqli_fetch_assoc($result)){
                        $sno= $sno+1;
                        echo "<tr>
                              <th scope='row'>".$sno."</th>
                              <th scope='col'><input type='checkbox' class='studentid' name='select[]' value=".$row['cl_schoolid']."></th>
                              <td><img src='../profileimage/".$row['cl_profile_photo']."'></td>
                              <td>".$row['cl_schoolid']."</td>
                              <td>".$row['cl_Firstname'] ." ". $row['cl_lastname']."</td>
                              <td>".$row['cl_department']."</td>
                              <td>".$row['cl_class_teacher']."</td>
                              <td><a href='../erp/erp_teacher_view_data.php?teacher_id=".$row['cl_Sno']."'><button class='edit btn btn-sm btn-primary' id = ".$row['cl_Sno']." type='button'> View </button></a> <a href='../partials/teachers_edit_reg_form.php?teacher_id=".$row['cl_Sno']."'><button class='edit btn btn-sm btn-primary' id = ".$row['cl_Sno']." type='button'> Edit </button></a> <button class='delete btn btn-sm btn-primary' id =d".$row['cl_Sno']." type='button'> Delete </button></td>
                              </tr>";
                    }
                    ?>
                        </tbody>
                    </table>
                    <?php
                echo "<div style='display:flex;justify-content:center;margin:10px 0px;'><a
                        href='../erp/erp_teacherIdcard.php'><button type='submit' id='submit'
                            class='btn btn-success'>Generate Id Card</button></a></div>
            </div>";
            ?>
                </form>
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

        function toggleSelectAll(source) {
            const checkboxes = document.querySelectorAll('input[name="select[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
        }

        function printPage() {
            var originalContent = document.body.innerHTML;
            var contentToPrint = document.querySelector('.print_record');
            // console.log('' + print)
            document.body.innerHTML = contentToPrint.outerHTML;
            window.print();
            document.body.innerHTML = originalContent;
        }
        </script>
</body>
</html>