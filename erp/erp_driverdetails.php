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

$result = mysqli_query($conn, "SELECT dri_profile_photo FROM driver_details WHERE Sno = '$delete'");
$row = mysqli_fetch_assoc($result);

if ($row) {
    $photo = '../profileimage/' . $row['dri_profile_photo'];
    if (file_exists($photo)) {
        unlink($photo);
    }
    mysqli_query($conn, "DELETE FROM driver_details WHERE Sno = '$delete'");
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
            <div class="teachersrecord">
                <form action="../erp/erp_driverIdcard.php" method="post">
                <table class="table table-bordered" id="mytable">
                    <thead>
                        <tr>
                            <th scope="col">Sno</th>
                            <th scope='col'><input type='checkbox' onclick='toggleSelectAll(this)' id='select-all'></th>
                            <th scope="col">Profile Photo</th>
                            <th scope="col">Staff I'd</th>
                            <th scope="col">Staff Name</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $sql = "SELECT * FROM `driver_details`";
                    $result = mysqli_query($conn, $sql);
                    // $total_driver = ;
                    $_SESSION['total_driver'] = mysqli_num_rows($result);
                    $sno = 0;
                    while($row= mysqli_fetch_assoc($result)){
                        $sno= $sno+1;
                        echo "<tr>
                              <th scope='row'>".$sno."</th>
                              <th scope='col'><input type='checkbox' class='studentid' name='select[]' value=".$row['dri_driver_id']."></th>
                              <td><img src='../profileimage/".$row['dri_profile_photo']."'></td>
                              <td>".$row['dri_driver_id']."</td>
                              <td>".$row['dri_first_name'] ." ". $row['dri_last_name']."</td>
                              <td>".$row['dri_mobile_no']."</td>
                              <td>".$row['dri_designation']."</td>
                              <td><a href='../erp/erp_driver_view.php?driver_id=".$row['Sno']."'><button class='edit btn btn-sm btn-primary' id = ".$row['Sno']." type='button'> View </button></a> <a href='../partials/driver_edit_reg_form.php?driver_id=".$row['Sno']."'><button class='edit btn btn-sm btn-primary' id = ".$row['Sno']." type='button'> Edit </button></a> <button class='delete btn btn-sm btn-primary' id =d".$row['Sno']." type='button'> Delete </button></td>
                              </tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <?php
                echo "<div style='display:flex;justify-content:center;margin-top:10px;'><a
                        href='../erp/erp_driverIdcard.php'><button type='submit' id='submit'
                            class='btn btn-success'>Generate Id Card</button></a></div>
            </div>";
            ?>
                </form>
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
            if (confirm("Are you sure you want to delete this student record!")) {
                window.location = `../erp/erp_driverdetails.php?delete_id=${Sno}`;
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
    </script>
</body>

</html>