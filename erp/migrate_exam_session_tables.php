<?php
include '../backend/connection.php';

// Create exam table
$exam_sql = "CREATE TABLE IF NOT EXISTS `exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_exam` (`exam_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (mysqli_query($conn, $exam_sql)) {
    echo "✅ Exam table created or already exists.\n";
} else {
    echo "❌ Error creating exam table: " . mysqli_error($conn) . "\n";
}

// Insert default exams if not already present
$default_exams = ['Unit Test', 'Half Yearly', 'Annual Exam'];
foreach ($default_exams as $exam) {
    $exam_safe = mysqli_real_escape_string($conn, $exam);
    $insert_sql = "INSERT IGNORE INTO exam (exam_name) VALUES ('$exam_safe')";
    mysqli_query($conn, $insert_sql);
}

// Create session table
$session_sql = "CREATE TABLE IF NOT EXISTS `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_session` (`session_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (mysqli_query($conn, $session_sql)) {
    echo "✅ Session table created or already exists.\n";
} else {
    echo "❌ Error creating session table: " . mysqli_error($conn) . "\n";
}

// Insert default sessions if not already present
$default_sessions = ['2025-2026', '2026-2027', '2024-2025'];
foreach ($default_sessions as $sess) {
    $sess_safe = mysqli_real_escape_string($conn, $sess);
    $insert_sql = "INSERT IGNORE INTO session (session_name) VALUES ('$sess_safe')";
    mysqli_query($conn, $insert_sql);
}

echo "\n✅ Migration complete! Exam and Session tables are ready.\n";

mysqli_close($conn);
?>
