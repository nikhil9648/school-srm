<?php
include '../backend/connection.php';

// Create subjects reference table
$subjects_sql = "CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(100) NOT NULL,
  PRIMARY KEY (`subject_id`),
  UNIQUE KEY `unique_subject` (`subject_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (mysqli_query($conn, $subjects_sql)) {
    echo "✅ Subjects table created or already exists.\n";
} else {
    echo "❌ Error creating subjects table: " . mysqli_error($conn) . "\n";
}

// Insert default subjects if not already present
$default_subjects = ['English', 'Hindi', 'Math', 'Mathematics', 'Science', 'Social Studies', 'Social Science', 'EVS', 'Number Work'];
foreach ($default_subjects as $subject) {
    $subject_safe = mysqli_real_escape_string($conn, $subject);
    $insert_sql = "INSERT IGNORE INTO subjects (subject_name) VALUES ('$subject_safe')";
    mysqli_query($conn, $insert_sql);
}

// Create new marks table with the specified structure
$marks_sql = "CREATE TABLE IF NOT EXISTS `marks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admission_no` varchar(20) NOT NULL,
  `session` varchar(10) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class` varchar(10) NOT NULL,
  `section` varchar(10),
  `marks_obtained` int(3) NOT NULL,
  `max_marks` int(3) NOT NULL DEFAULT 100,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_marks` (`admission_no`, `session`, `exam_id`, `subject_id`, `class`),
  FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE RESTRICT,
  KEY `exam_id_idx` (`exam_id`),
  KEY `session_idx` (`session`),
  KEY `class_idx` (`class`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (mysqli_query($conn, $marks_sql)) {
    echo "✅ Marks table created or already exists.\n";
} else {
    echo "❌ Error creating marks table: " . mysqli_error($conn) . "\n";
}

echo "\n✅ Migration complete! You can now use subject_id and exam_id in your application.";

mysqli_close($conn);
?>
