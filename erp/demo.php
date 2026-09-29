<?php
include '../backend/connection.php';

// GET ALL CLASSES
$classes = mysqli_query($conn,"
SELECT DISTINCT class 
FROM studentsdetail 
WHERE transport_fac='Yes'
ORDER BY class
");

$grand_total = 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Transport Class-wise Print</title>

<style>
body {
    font-family: Arial;
    font-size: 18px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th, td {
    border: 1px solid black;
    padding: 6px;
    text-align: center;
}

.class-heading {
    text-align: center;
    margin: 20px 0 10px;
    font-size: 18px;
    font-weight: bold;
}

.page-break {
    page-break-after: always;
}

@media print {
    .no-print {
        display: none;
    }
}
</style>

</head>

<body>

<div class="no-print">
    <button onclick="window.print()">Print</button>
</div>

<h2 style="text-align:center;">Transport Students (YES)</h2>

<?php
while($c = mysqli_fetch_assoc($classes)){

    $class = $c['class'];

    $res = mysqli_query($conn,"
    SELECT admission_number, first_name, middle_name, last_name, class 
    FROM studentsdetail
    WHERE transport_fac='Yes' AND class='$class'
    ORDER BY admission_number
    ");

    $data = [];
    while($row = mysqli_fetch_assoc($res)){
        $data[] = $row;
    }

    // 🔥 CLASS TOTAL
    $total = count($data);
    $grand_total += $total;

    echo "<div class='class-heading'>Class $class (Total: $total)</div>";

    echo "<table>";

    echo "<tr>
        <th>Adm No</th>
        <th>Name</th>
        <th>Class</th>

        <th>Adm No</th>
        <th>Name</th>
        <th>Class</th>
    </tr>";

    for($i = 0; $i < $total; $i += 2){

        echo "<tr>";

        // LEFT
        if(isset($data[$i])){
            echo "<td>".$data[$i]['admission_number']."</td>";
            echo "<td>".trim(
                $data[$i]['first_name']." ".
                $data[$i]['middle_name']." ".
                $data[$i]['last_name']
            )."</td>";
            echo "<td>".$data[$i]['class']."</td>";
        } else {
            echo "<td></td><td></td><td></td>";
        }

        // RIGHT (FIXED BUG 🔥)
        if(isset($data[$i+1])){
            echo "<td>".$data[$i+1]['admission_number']."</td>";
            echo "<td>".trim(
                $data[$i+1]['first_name']." ".
                $data[$i+1]['middle_name']." ".
                $data[$i+1]['last_name']
            )."</td>";
            echo "<td>".$data[$i+1]['class']."</td>";
        } else {
            echo "<td></td><td></td><td></td>";
        }

        echo "</tr>";
    }

    echo "</table>";

    echo "<div class='page-break'></div>";
}
?>

<!-- 🔥 GRAND TOTAL -->
<h2 style="text-align:center;">Grand Total Students: <?= $grand_total ?></h2>

<script>
window.onload = function(){
    window.print();
}
</script>

</body>
</html>