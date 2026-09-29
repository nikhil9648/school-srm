<?php
include '../backend/connection.php';

$sql = "CREATE TABLE IF NOT EXISTS `student_marks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_sno` int(11) NOT NULL,
  `admission_no` varchar(20) NOT NULL,
  `class` varchar(10) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `marks` int(3) NOT NULL,
  `total_marks` int(3) NOT NULL DEFAULT 100,
  `exam_type` varchar(50) NOT NULL DEFAULT 'Half-Yearly',
  `grade` varchar(5) DEFAULT NULL,
  `date_added` date NOT NULL DEFAULT CURRENT_DATE,
  PRIMARY KEY (`id`),
  KEY `student_sno` (`student_sno`),
  CONSTRAINT `student_marks_ibfk_1` FOREIGN KEY (`student_sno`) REFERENCES `studentsdetail` (`Sno`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (mysqli_query($conn, $sql)) {
    echo "✅ student_marks table created or already exists successfully.";
} else {
    echo "❌ Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

