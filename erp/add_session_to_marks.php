
<?php
include '../backend/connection.php';

$sql = "ALTER TABLE `student_marks` ADD COLUMN IF NOT EXISTS `session` VARCHAR(10) AFTER `exam_type` DEFAULT NULL";
if (mysqli_query($conn, $sql)) {
    echo "✅ Added 'session' column to student_marks table.";
} else {
    echo "❌ Error: " . mysqli_error($conn);
}

$fk_check = "SET FOREIGN_KEY_CHECKS = 0";
mysqli_query($conn, $fk_check);
mysqli_close($conn);
?>
Run once, then delete.

