<!DOCTYPE html>
<html>

<head>
    <title>Report Card</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link rel="stylesheet" href="../tc.css"> -->
    <style>
    body {
        font-family: Arial;
        background: #f2f2f2;
        font-size: 22px;
    }

    .tranfer img {
        position: fixed;
        opacity: 0.08;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .report {
        width: 900px;
        margin: auto;
        background: white;
        padding: 15px;
        border: 3px solid #2c7a7b;
        border-style: double;
        border-width: 5px;
        
    }

    .header {
        text-align: center;
        border-bottom: 2px solid #2c7a7b;
        padding-bottom: 10px;
    }

    .header .container1 h1 {
        color: #2c7a7b;
        margin: 0;
        font-size: 40px;
        font-weight: bold;
    }

    .school-info {
        font-size: 18px;
        font-weight: 500;
    }

    .top-info {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        border-bottom: 2px solid #2c7a7b;
        padding-bottom: 10px;
    }

    .info-left,
    .info-right {
        width: 70%;
        font-size: 14px;
    }

    .photo {
        width: 80px;
        height: 100px;
        border: 1px solid black;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 13px;
    }

    table,
    th,
    td {
        border: 1px solid #2c7a7b;
    }

    th {
        background: #e6fffa;
    }

    td,
    th {
        padding: 5px;
        text-align: center;
    }
    
    .left {
        text-align: left;
    }

    .main_table tr {
        height: auto;
    }

    .main_table th,
    .main_table td {
        padding: 4px 6px;
        line-height: 1.15;
        vertical-align: middle;
    }

    .main_table tbody {
        display: table-row-group;
        height: auto;
        overflow: visible;
    }

    .main_table tbody tr {
        height: auto;
    }


    .footer {
        margin-top: 35px;
        display: flex;
        justify-content: space-between;
    }

    .print-btn {
        margin-top: 10px;
        text-align: center;
    }

    @media print {
        .print-btn {
            display: none;
        }

        body {
            background: white;
        }
    }
    </style>
</head>

<body>

    <div class="report">
        <div class="tranfer">
            <img src="../img/logo.png" alt="">
        </div>
        <div class="header flex items-center">
            <img src="../img/logo.png" class="w-32" alt="">
            <div class="container1">
                <h1>SRM MODERN PUBLIC SCHOOL</h1>
                <div class="school-info">
                    Senior Secondary School(10+2) Affiliated to CBSE, New Delhi<br>
                    Bariyar Shah Bhadar Amethi (UP),9793237340, www.srmmps.com, srmmps2010@gmail.com
                </div>
                <h4 class="italic text-red-600 font-bold">PROGRESS REPORT : 2026-27</h4>
            </div>
        </div>

        <div class="top-info">
            <div class="info-left">
                <span class="text-[#2c7a7b]">Admission No </span>: <b>1627</b><br>
                <span class="text-[#2c7a7b]">Student Name </span>: <b>AVINASH SAHU</b><br>
                <span class="text-[#2c7a7b]">Father's Name </span>: <b>SURESH KUMAR SAHU</b><br>
                <span class="text-[#2c7a7b]">Mother's Name </span>: <b>AMRAWATI SAHU</b>
            </div>

            <div class="info-right">
                <span class="text-[#2c7a7b]">Class </span>: <b>9 - Science</b><br>
                <span class="text-[#2c7a7b]">DOB </span>: <b>08-Aug-2012</b><br>
                <span class="text-[#2c7a7b]">Affiliation No. </span>: <b>2133678</b><br>
                <span class="text-[#2c7a7b]">School Code </span>: <b>71792</b><br>

            </div>

            <img src="student.jpg" class="photo">
        </div>

        <!-- SUBJECT TABLE -->
        <table class="main_table" style="table-layout: fixed; width: 100%;font-size: 16px;">
            <thead>
        <tr>
            <th class="left">Subjects</th>  
            <th>Periodic Test 1 (20)</th>
            <th>Half Yearly (80)</th>    
            <th>Total (100)</th>
            <th>Periodic Test 2 (20)</th>    
            <th>Yearly Exam (80)</th>
            <th>Total (100)</th>
            <th>Grand Total (200)</th>
        </tr>
    </thead>
            <!-- <tr>
                <th class="left">Subjects</th>
                <th>Term 1 (20)</th>
                <th>Term 1 (80)</th>
                <th>Total</th>
                <th>Term 2 (20)</th>
                <th>Term 2 (80)</th>
                <th>Total</th>
                <th>Grand Total</th>
            </tr> -->
<tbody style="height: 300px; max-height: 300px;overflow-y: auto;">
            <tr style="height:15px; max-height:15px;">
                <td class="left">English</td>
                <td>19</td>
                <td>69</td>
                <td>88</td>
                <td>15</td>
                <td>66</td>
                <td>81</td>
                <td>169</td>
            </tr>
            <tr style="height:15px; max-height:15px;">
                <td class="left">English</td>
                <td>19</td>
                <td>69</td>
                <td>88</td>
                <td>15</td>
                <td>66</td>
                <td>81</td>
                <td>169</td>
            </tr>
            <tr>
                <td class="left" style="height:15px; max-height:15px;">IT</td>
                <td>16</td>
                <td>80</td>
                <td>96</td>
                <td>20</td>
                <td>68</td>
                <td>88</td>
                <td>184</td>
            </tr>
            <tr>
                <td class="left" style="height:10px; max-height:10px;">Maths</td>
                <td>20</td>
                <td>76</td>
                <td>96</td>
                <td>20</td>
                <td>73</td>
                <td>93</td>
                <td>189</td>
            </tr>
            <tr class="mb-10">
                <td class="left" style="height:10px; max-height:10px;">Science</td>
                <td>15</td>
                <td>49</td>
                <td>64</td>
                <td>17</td>
                <td>51</td>
                <td>68</td>
                <td>132</td>
            </tr>
            
            <tr>
                <td class="left" style=""></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
</tbody>
</table>
<table style="margin-top: 0; table-layout: fixed; font-size: 16px;">
            <tr>
                <td class="left"><b>Total</b></td>
                <td>15</td>
                <td>49</td>
                <td>478 / 600</td>
                <td>17</td>
                <td>14</td>
                <td>477 / 600</td>
                <td><b>955 / 1200</b></td>
            </tr>

            <tr>
                <td class="left"><b>Percentage</b></td>
                <td></td>
                <td></td>
                <td>79.58%</td>
                <td></td>
                <td></td>
                <td>89.58%</td>
                <td><b>90%</b></td>
            </tr>

            <tr>
                <td class="left"><b>Rank</b></td>
                <td></td>
                <td></td>
                <td>7</td>
                <td></td>
                <td></td>
                <td>8</td>
                <td><b>9</b></td>
            </tr>

            <tr>
                <td class="left"><b>Attendance</b></td>
                <td colspan="7">186 / 220</td>
            </tr>

        </table>

        <!-- CO SCHOLASTIC -->
        <h4 class="text-center font-bold text-[#2c7a7b] mt-1">Co-Scholastic Areas (3 Point Grading Scale A,B,C)</h4>
        <table style="font-size: 16px;">
            <tr>
                <th>Activity</th>
                <th>Term 1</th>
                <th>Term 2</th>
            </tr>

            <tr>
                <td>Work Education(Pre-Vocational Education)</td>
                <td>A</td>
                <td>A</td>
            </tr>
            <tr>
                <td>Health & Physical Education</td>
                <td>A</td>
                <td>A</td>
            </tr>
            <tr>
                <td>Discipline</td>
                <td>A</td>
                <td>B</td>
            </tr>
        </table>
        <div style="height:100px;"></div>
        <!-- FOOTER -->
        <div class="footer">
            <div>
                <span class="text-[#2c7a7b]"> Remark:</span> Excellent
            </div>
            <div>
                <span class="text-[#2c7a7b]"> Result:</span> Passed
            </div>
            <div>
                <span class="text-[#2c7a7b]"> Division:</span> Second
            </div>
        </div>

        <br>

        <div class="footer">
            <div>Class Teacher</div>
            <div>Principal</div>
        </div>

        <div class="print-btn">
            <button onclick="window.print()">Print</button>
        </div>

    </div>

</body>

</html>













<?php
include '../backend/connection.php';
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../partials/erp_login.php");
    exit;
}

function getSubjectsForClass($stuClass)
{
    $classKey = trim((string) $stuClass);
    $classAliases = [
        '1st' => '1',
        '2nd' => '2',
        '3rd' => '3',
        '4th' => '4',
        '5th' => '5',
        '6th' => '6',
        '7th' => '7',
        '8th' => '8',
        '9th' => '9',
        '10th' => '10',
        'SKG' => 'UKG'
    ];
    $classKey = $classAliases[$classKey] ?? $classKey;

    $subjectsByClass = [
        'PG' => ['English', 'Maths', 'Hindi'],
        'LKG' => ['English', 'Maths', 'Hindi', 'Art', 'GK'],
        'UKG' => ['English', 'Maths', 'Hindi', 'Art', 'GK'],
        '1' => ['English', 'Hindi', 'Maths', 'Science', 'Grammar', 'SST', 'GK', 'Computer', 'Art', 'Conversation'],
        '2' => ['English', 'Hindi', 'Maths', 'Science', 'Grammar', 'SST', 'GK', 'Computer', 'Art', 'Conversation'],
        '3' => ['English', 'Hindi', 'Maths', 'Science', 'Grammar', 'SST', 'GK', 'Computer', 'Art', 'Conversation'],
        '4' => ['English', 'Hindi', 'Maths', 'Science', 'Grammar', 'SST', 'GK', 'Computer', 'Art', 'Conversation'],
        '5' => ['English', 'Hindi', 'Maths', 'Science', 'Grammar', 'SST', 'GK', 'Computer', 'Art', 'Conversation'],
        '6' => ['English', 'Hindi', 'Maths', 'Science', 'Grammar', 'SST', 'GK', 'Computer', 'Art', 'Conversation'],
        '7' => ['English', 'Hindi', 'Maths', 'Science', 'Grammar', 'SST', 'GK', 'Computer', 'Art', 'Conversation'],
        '8' => ['English', 'Hindi', 'Maths', 'Science', 'Grammar', 'SST', 'GK', 'Computer', 'Art', 'Conversation'],
        '9' => ['English', 'Hindi', 'Maths', 'Science', 'SST', 'IT'],
        '10' => ['English', 'Hindi', 'Maths', 'Science', 'SST', 'IT'],
        '11' => ['English', 'Hindi', 'Maths', 'Physics', 'Chemistry', 'Biology'],
        '12' => ['English', 'Hindi', 'Maths', 'Physics', 'Chemistry', 'Biology'],
        'default' => ['English', 'Hindi', 'Mathematics', 'Science', 'SST'],
    ];

    return $subjectsByClass[$classKey] ?? $subjectsByClass['default'];
}

function getExamTypeFromId($examId)
{
    return ($examId === '2') ? 'Half Yearly' : 'Unit Test';
}

function getSubjectIdByName($conn, $subjectName)
{
    $subjectSafe = mysqli_real_escape_string($conn, $subjectName);
    $sql = "SELECT id as subject_id FROM subjects WHERE subject_name = '$subjectSafe' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        // Fallback for legacy schema where PK column may still be `id`.
        $legacySql = "SELECT id as subject_id FROM subjects WHERE subject_name = '$subjectSafe' LIMIT 1";
        $result = mysqli_query($conn, $legacySql);
    }
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return intval($row['subject_id']);
    }
    return null;
}

function getAvailableTableName($conn, $preferred, $fallback)
{
    $checkPreferred = mysqli_query($conn, "SHOW TABLES LIKE '$preferred'");
    if ($checkPreferred && mysqli_num_rows($checkPreferred) > 0) {
        return $preferred;
    }

    $checkFallback = mysqli_query($conn, "SHOW TABLES LIKE '$fallback'");
    if ($checkFallback && mysqli_num_rows($checkFallback) > 0) {
        return $fallback;
    }

    return $preferred;
}

function getSubjectPkColumn($conn)
{
    $check = mysqli_query($conn, "SHOW COLUMNS FROM subjects LIKE 'subject_id'");
    if ($check && mysqli_num_rows($check) > 0) {
        return 'subject_id';
    }
    return 'id';
}

function fetchSubjectsWithIds($conn, $stuClass)
{
    $subjects = getSubjectsForClass($stuClass);
    $subjectsWithIds = [];
    $subjectPk = getSubjectPkColumn($conn);

    foreach ($subjects as $subject) {
        $subjectId = getSubjectIdByName($conn, $subject);
        if (!$subjectId) {
            $subjectSafe = mysqli_real_escape_string($conn, $subject);
            mysqli_query($conn, "INSERT IGNORE INTO subjects (subject_name) VALUES ('$subjectSafe')");

            $idSql = "SELECT `$subjectPk` as subject_id FROM subjects WHERE subject_name = '$subjectSafe' LIMIT 1";
            $idRes = mysqli_query($conn, $idSql);
            if ($idRes && mysqli_num_rows($idRes) > 0) {
                $idRow = mysqli_fetch_assoc($idRes);
                $subjectId = intval($idRow['subject_id']);
            }
        }
        if ($subjectId) {
            $subjectsWithIds[] = ['name' => $subject, 'id' => $subjectId];
        }
    }

    return $subjectsWithIds;
}

function fetchAllSessions($conn)
{
    $sessions = [];
    $sessionTable = getAvailableTableName($conn, 'session', 'sessions');
    $sql = "SELECT id, session_name FROM `$sessionTable` ORDER BY session_name DESC";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sessions[] = $row;
        }
    }
    return $sessions;
}

function fetchAllExams($conn)
{
    $exams = [];
    $examTable = getAvailableTableName($conn, 'exam', 'exams');
    $sql = "SELECT id, exam_name FROM `$examTable` ORDER BY exam_name ASC";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $exams[] = $row;
        }
    }
    return $exams;
}

function getGradeFromMarks($marks)
{
    if ($marks >= 90) return 'A1';
    if ($marks >= 80) return 'A2';
    if ($marks >= 70) return 'B1';
    if ($marks >= 60) return 'B2';
    if ($marks >= 50) return 'C1';
    return 'C2';
}

function fetchStudentsByClass($conn, $stuClass)
{
    $students = [];
    $classSafe = mysqli_real_escape_string($conn, $stuClass);
    $sql = "SELECT Sno,
                   TRIM(CONCAT_WS(' ', first_name, middle_name, last_name)) AS full_name,
                   class
            FROM studentsdetail
            WHERE status IN ('Active', 'New Admission')
              AND `class` = '$classSafe'
            ORDER BY full_name";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $students[] = $row;
        }
    }

    return $students;
}

function fetchMarksMap($conn, $stuClass, $sessionId, $examId)
{
    $marksMap = [];
    $classSafe = mysqli_real_escape_string($conn, $stuClass);
    $sessionId = intval($sessionId);
    $examId = intval($examId);
    $sessionTable = getAvailableTableName($conn, 'session', 'sessions');
    $subjectPk = getSubjectPkColumn($conn);
    
    // Fetch session name from session ID.
    $sessionRes = mysqli_query($conn, "SELECT session_name FROM `$sessionTable` WHERE id = $sessionId LIMIT 1");
    $sessionRow = $sessionRes ? mysqli_fetch_assoc($sessionRes) : null;
    if (!$sessionRow) {
        return $marksMap;
    }
    $sessionName = $sessionRow['session_name'];
    $sessionNameSafe = mysqli_real_escape_string($conn, $sessionName);
    
    $sql = "SELECT sd.Sno, s.subject_name, m.marks_obtained
            FROM marks m
            JOIN studentsdetail sd ON m.admission_no = sd.admission_number
            JOIN subjects s ON m.subject_id = s.`$subjectPk`
            WHERE m.exam_id = $examId
              AND m.`session` = '$sessionNameSafe'
              AND m.`class` = '$classSafe'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $marksMap[$row['Sno']][$row['subject_name']] = $row['marks_obtained'];
        }
    }

    return $marksMap;
}

function fetchSessionExamMarksMap($conn, $stuClass, $sessionId)
{
    $examNames = [];
    $marksMap = [];
    $classSafe = mysqli_real_escape_string($conn, $stuClass);
    $sessionId = intval($sessionId);
    $sessionTable = getAvailableTableName($conn, 'session', 'sessions');
    $examTable = getAvailableTableName($conn, 'exam', 'exams');
    $subjectPk = getSubjectPkColumn($conn);

    $sessionRes = mysqli_query($conn, "SELECT session_name FROM `$sessionTable` WHERE id = $sessionId LIMIT 1");
    $sessionRow = $sessionRes ? mysqli_fetch_assoc($sessionRes) : null;
    if (!$sessionRow) {
        return [$examNames, $marksMap];
    }
    $sessionName = $sessionRow['session_name'];
    $sessionNameSafe = mysqli_real_escape_string($conn, $sessionName);

    $examRes = mysqli_query($conn, "SELECT id, exam_name FROM `$examTable` ORDER BY id ASC");
    if ($examRes) {
        while ($row = mysqli_fetch_assoc($examRes)) {
            $examNames[] = $row['exam_name'];
        }
    }

    $sql = "SELECT sd.Sno, e.exam_name, s.subject_name, m.marks_obtained
            FROM marks m
            JOIN studentsdetail sd ON m.admission_no = sd.admission_number
            JOIN `$examTable` e ON m.exam_id = e.id
            JOIN subjects s ON m.subject_id = s.`$subjectPk`
            WHERE m.`session` = '$sessionNameSafe'
              AND m.`class` = '$classSafe'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $marksMap[$row['Sno']][$row['exam_name']][$row['subject_name']] = $row['marks_obtained'];
        }
    }

    return [$examNames, $marksMap];
}

$success_msg = '';
$error_msg = '';

$allSessions = fetchAllSessions($conn);
$allExams = fetchAllExams($conn);

$defaultSessionId = $allSessions[0]['id'] ?? 1;
$defaultExamId = $allExams[0]['id'] ?? 1;


$update_class = $_POST['update_class'] ?? '10';
$update_session_id = intval($_POST['update_session_id'] ?? $defaultSessionId);
$update_exam_id = intval($_POST['update_exam_id'] ?? $defaultExamId);

$print_class = $_POST['print_class'] ?? '10';
$print_session_id = intval($_POST['print_session_id'] ?? $defaultSessionId);
$print_exam_id = intval($_POST['print_exam_id'] ?? $defaultExamId);

$show_insert_table = false; // Insert UI removed; backend insert logic preserved but not exposed
$show_update_table = isset($_POST['load_update']) || isset($_POST['save_update_marks']);
$show_print_view = isset($_POST['load_print']);

// Insert section removed from UI. Backend insert handling retained but disabled by default.

if (isset($_POST['save_update_marks']) && isset($_POST['update_marks']) && is_array($_POST['update_marks'])) {
    // Fetch session name from session_id
    $sessionTable = getAvailableTableName($conn, 'session', 'sessions');
    $sessionRes = mysqli_query($conn, "SELECT session_name FROM `$sessionTable` WHERE id = $update_session_id LIMIT 1");
    $sessionName = 'Unknown';
    if ($sessionRes && $sessionRow = mysqli_fetch_assoc($sessionRes)) {
        $sessionName = $sessionRow['session_name'];
    }
    $sessionNameSafe = mysqli_real_escape_string($conn, $sessionName);
    
    $subjects = fetchSubjectsWithIds($conn, $update_class);
    $sectionSafe = mysqli_real_escape_string($conn, $_POST['update_section'] ?? '');

    foreach ($_POST['update_marks'] as $studentSno => $subjectMarks) {
        $studentSno = intval($studentSno);
        $studentRes = mysqli_query($conn, "SELECT admission_number, `class`, section FROM studentsdetail WHERE Sno = $studentSno LIMIT 1");
        $studentRow = $studentRes ? mysqli_fetch_assoc($studentRes) : null;

        if (!$studentRow) {
            continue;
        }

        $admissionNo = mysqli_real_escape_string($conn, $studentRow['admission_number']);
        $stuClassSafe = mysqli_real_escape_string($conn, $studentRow['class']);
        $studentSectionSafe = mysqli_real_escape_string($conn, $sectionSafe ?: ($studentRow['section'] ?? ''));

        foreach ($subjects as $subjectInfo) {
            $subjectName = $subjectInfo['name'];
            $subjectId = intval($subjectInfo['id']);
            $subjectKey = str_replace(' ', '_', $subjectName);
            $marks = intval($subjectMarks[$subjectKey] ?? 0);
            if ($marks < 0 || $marks > 100) {
                continue;
            }

            // Check if mark already exists
            $checkSql = "SELECT id FROM marks WHERE admission_no = '$admissionNo' AND exam_id = $update_exam_id AND subject_id = $subjectId AND `session` = '$sessionNameSafe' AND `class` = '$stuClassSafe' LIMIT 1";
            $checkRes = mysqli_query($conn, $checkSql);

            if ($checkRes && mysqli_num_rows($checkRes) > 0) {
                $existing = mysqli_fetch_assoc($checkRes);
                $markId = intval($existing['id']);
                $updateSql = "UPDATE marks
                              SET marks_obtained = $marks, section = '$studentSectionSafe', updated_at = NOW()
                              WHERE id = $markId";
                mysqli_query($conn, $updateSql);
            } else {
                $insertSql = "INSERT INTO marks
                              (admission_no, session, exam_id, subject_id, `class`, section, marks_obtained, max_marks, created_at, updated_at)
                              VALUES
                              ('$admissionNo', '$sessionNameSafe', $update_exam_id, $subjectId, '$stuClassSafe', '$studentSectionSafe', $marks, 100, NOW(), NOW())";
                mysqli_query($conn, $insertSql);
            }
        }
    }

    $success_msg = "<div class='alert alert-success mt-3'>Update marks saved successfully.</div>";
    $show_update_table = true;
}

$update_students = $show_update_table ? fetchStudentsByClass($conn, $update_class) : [];
$print_students = $show_print_view ? fetchStudentsByClass($conn, $print_class) : [];

$update_marks_map = $show_update_table ? fetchMarksMap($conn, $update_class, $update_session_id, $update_exam_id) : [];
$print_exam_names = [];
$print_marks_map = [];
if ($show_print_view) {
    list($print_exam_names, $print_marks_map) = fetchSessionExamMarksMap($conn, $print_class, $print_session_id);
}

$update_subjects = fetchSubjectsWithIds($conn, $update_class);
$print_subjects = fetchSubjectsWithIds($conn, $print_class);

// Fetch display names for sessions and exams
$sessionTable = getAvailableTableName($conn, 'session', 'sessions');
$examTable = getAvailableTableName($conn, 'exam', 'exams');

$update_session_name = 'Unknown';
$update_exam_name = 'Unknown';
$sessionRes = mysqli_query($conn, "SELECT session_name FROM `$sessionTable` WHERE id = $update_session_id");
if ($sessionRes && $row = mysqli_fetch_assoc($sessionRes)) {
    $update_session_name = $row['session_name'];
}
$examRes = mysqli_query($conn, "SELECT exam_name FROM `$examTable` WHERE id = $update_exam_id");
if ($examRes && $row = mysqli_fetch_assoc($examRes)) {
    $update_exam_name = $row['exam_name'];
}

$print_session_name = 'Unknown';
$print_exam_name = 'Unknown';
$sessionRes = mysqli_query($conn, "SELECT session_name FROM `$sessionTable` WHERE id = $print_session_id");
if ($sessionRes && $row = mysqli_fetch_assoc($sessionRes)) {
    $print_session_name = $row['session_name'];
}
$examRes = mysqli_query($conn, "SELECT exam_name FROM `$examTable` WHERE id = $print_exam_id");
if ($examRes && $row = mysqli_fetch_assoc($examRes)) {
    $print_exam_name = $row['exam_name'];
}

function renderStudentGradeSheet($student, $subjects, $examNames, $marksMap, $session)
{
    $studentMarks = $marksMap[$student['Sno']] ?? [];
    $totalMarks = 0;
    $marksCount = 0;

    foreach ($examNames as $examName) {
        foreach ($subjects as $subject) {
            $subjectName = is_array($subject) ? $subject['name'] : $subject;
            if (isset($studentMarks[$examName][$subjectName]) && $studentMarks[$examName][$subjectName] !== '') {
                $totalMarks += intval($studentMarks[$examName][$subjectName]);
                $marksCount++;
            }
        }
    }

    $average = $marksCount > 0 ? round($totalMarks / $marksCount, 2) : 0;
    $grade = getGradeFromMarks((int) round($average));
    $fullName = htmlspecialchars(trim($student['full_name']));
    $className = htmlspecialchars($student['class']);
  ?>
<div class="border rounded-3 p-3 mb-4 bg-white print-normal-sheet">
    <div class="text-center mb-3">
        <h5 class="mb-0">SRM Modern Public School</h5>
        <div class="small text-muted">Session Exam Marksheet</div>
        <div class="small">Class <?php echo $className; ?> | Session <?php echo htmlspecialchars($session); ?> | All Exams</div>
    </div>
    <div class="row mb-3 small">
        <div class="col-md-4"><strong>Name:</strong> <?php echo $fullName; ?></div>
        <div class="col-md-4"><strong>Sno:</strong> <?php echo $student['Sno']; ?></div>
        <div class="col-md-4"><strong>Grade:</strong> <?php echo $marksCount ? $grade : 'N/A'; ?></div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Subject</th>
                    <?php foreach ($examNames as $examName) { ?>
                    <th><?php echo htmlspecialchars($examName); ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subjects as $subject) {
                    $subjectName = is_array($subject) ? $subject['name'] : $subject;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($subjectName); ?></td>
                    <?php foreach ($examNames as $examName) {
                        $markValue = $studentMarks[$examName][$subjectName] ?? 'N/A';
                    ?>
                    <td><?php echo htmlspecialchars((string) $markValue); ?></td>
                    <?php } ?>
                </tr>
                <?php } ?>
                <tr class="table-light">
                    <th>Average</th>
                    <td colspan="<?php echo max(count($examNames), 1); ?>"><?php echo $marksCount ? number_format($average, 2) . '%' : 'N/A'; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
    return ob_get_clean();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRM ERP | Marks</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/brands.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../erpstyle.css">
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
    <script src="../javascript/function.js"></script>
    <style>
    .marks-panel {
        background: #f8fafc;
        border: 1px solid rgba(15, 23, 42, 0.08);
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05);
    }

    .marksheet-preview {
        background: #fff;
        border-radius: 16px;
        border: 1px solid rgba(15, 23, 42, 0.08);
        padding: 16px;
    }

    .print-area {
        page-break-after: always;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        #printContainer,
        #printContainer * {
            visibility: visible;
        }

        #printContainer {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }
    </style>
</head>

<body>
    <?php include '../partials/youtubeinsta.php'; ?>
    <div class="sectionerp">
        <div class="section1 hideonmobile">
            <?php include '../erp/erp_sidebar.php'; ?>
        </div>
        <div class="section2">
            <?php include '../erp/erp_header.php'; ?>

            <?php echo $success_msg; ?>
            <?php echo $error_msg; ?>

            <div class="container-fluid mt-4 p-4">
                <div class="marks-panel p-3 p-lg-4">
                    <ul class="nav nav-tabs mb-4" id="marksTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="update-tab" data-bs-toggle="tab" data-bs-target="#update-marks" type="button" role="tab">Update Marks</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="print-tab" data-bs-toggle="tab" data-bs-target="#print-marks" type="button" role="tab">Print Marksheet</button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="update-marks" role="tabpanel">
                            <h4 class="mb-3">Update Marks</h4>
                            <form method="POST" class="mb-4">
                                <div class="row g-3 align-items-end">
                                    <div class="col-lg-3 col-md-4">
                                        <label class="form-label fw-bold">Class</label>
                                        <select name="update_class" class="form-select">
                                            <option value="PG" <?php echo ($update_class == 'PG') ? 'selected' : ''; ?>>
                                                PG</option>
                                            <option value="LKG"
                                                <?php echo ($update_class == 'LKG') ? 'selected' : ''; ?>>LKG</option>
                                            <option value="UKG"
                                                <?php echo ($update_class == 'UKG') ? 'selected' : ''; ?>>UKG</option>
                                            <option value="1" <?php echo ($update_class == '1') ? 'selected' : ''; ?>>
                                                Class 1</option>
                                            <option value="2" <?php echo ($update_class == '2') ? 'selected' : ''; ?>>
                                                Class 2</option>
                                            <option value="3" <?php echo ($update_class == '3') ? 'selected' : ''; ?>>
                                                Class 3</option>
                                            <option value="4" <?php echo ($update_class == '4') ? 'selected' : ''; ?>>
                                                Class 4</option>
                                            <option value="5" <?php echo ($update_class == '5') ? 'selected' : ''; ?>>
                                                Class 5</option>
                                            <option value="6" <?php echo ($update_class == '6') ? 'selected' : ''; ?>>
                                                Class 6</option>
                                            <option value="7" <?php echo ($update_class == '7') ? 'selected' : ''; ?>>
                                                Class 7</option>
                                            <option value="8" <?php echo ($update_class == '8') ? 'selected' : ''; ?>>
                                                Class 8</option>
                                            <option value="9" <?php echo ($update_class == '9') ? 'selected' : ''; ?>>
                                                Class 9</option>
                                            <option value="10" <?php echo ($update_class == '10') ? 'selected' : ''; ?>>
                                                Class 10</option>
                                            <option value="11" <?php echo ($update_class == '11') ? 'selected' : ''; ?>>
                                                Class 11</option>
                                            <option value="12" <?php echo ($update_class == '12') ? 'selected' : ''; ?>>
                                                Class 12</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-4">
                                        <label class="form-label fw-bold">Session</label>
                                        <select name="update_session_id" class="form-select">
                                            <?php foreach ($allSessions as $sess) { ?>
                                            <option value="<?php echo $sess['id']; ?>"
                                                <?php echo ($update_session_id == $sess['id']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($sess['session_name']); ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-4">
                                        <label class="form-label fw-bold">Exam</label>
                                        <select name="update_exam_id" class="form-select">
                                            <?php foreach ($allExams as $exam) { ?>
                                            <option value="<?php echo $exam['id']; ?>"
                                                <?php echo ($update_exam_id == $exam['id']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($exam['exam_name']); ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <button name="load_update" class="btn btn-primary w-100">Load Students</button>
                                    </div>
                                </div>
                            </form>

                            <?php if ($show_update_table) { ?>
                            <form method="POST" class="mb-2">
                                <input type="hidden" name="update_class"
                                    value="<?php echo htmlspecialchars($update_class); ?>">
                                <input type="hidden" name="update_session_id"
                                    value="<?php echo htmlspecialchars($update_session_id); ?>">
                                <input type="hidden" name="update_exam_id"
                                    value="<?php echo htmlspecialchars($update_exam_id); ?>">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover align-middle">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Sno</th>
                                                <th>Student Name</th>
                                                <?php foreach ($update_subjects as $subject) { ?>
                                                <th><?php echo htmlspecialchars($subject['name']); ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($update_students)) { ?>
                                            <?php 
                                            $sno = 0;
                                            foreach ($update_students as $student) { 
                                              $sno++;
                                              ?>
                                            <tr>
                                                <td><?php echo $sno; ?></td>
                                                <td><?php echo htmlspecialchars($student['full_name']); ?></td>
                                                <?php foreach ($update_subjects as $subject) {
                                                            $subjectName = $subject['name'];
                                                            $subjectKey = str_replace(' ', '_', $subjectName);
                                                            $currentMarks = $update_marks_map[$student['Sno']][$subjectName] ?? '';
                                                        ?>
                                                <td style="min-width: 140px;">
                                                    <input type="number"
                                                        name="update_marks[<?php echo $student['Sno']; ?>][<?php echo htmlspecialchars($subjectKey); ?>]"
                                                        min="0" max="100" step="1"
                                                        value="<?php echo htmlspecialchars($currentMarks); ?>"
                                                        class="form-control">
                                                </td>
                                                <?php } ?>
                                            </tr>
                                            <?php } ?>
                                            <?php } else { ?>
                                            <tr>
                                                <td colspan="<?php echo 2 + count($update_subjects); ?>"
                                                    class="text-center py-4">No students found for the selected class.
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-end">
                                    <button type="submit" name="save_update_marks"
                                        class="btn btn-success btn-lg px-5">Save Update Marks</button>
                                </div>
                            </form>
                            <?php } ?>
                        </div>

                        <div class="tab-pane fade" id="print-marks" role="tabpanel">
                            <h4 class="mb-3">Print Marksheet</h4>
                            <form method="POST" class="mb-4">
                                <div class="row g-3 align-items-end">
                                    <div class="col-lg-4 col-md-6">
                                        <label class="form-label fw-bold">Class</label>
                                        <select name="print_class" class="form-select">
                                            <option value="PG" <?php echo ($print_class == 'PG') ? 'selected' : ''; ?>>
                                                PG</option>
                                            <option value="LKG"
                                                <?php echo ($print_class == 'LKG') ? 'selected' : ''; ?>>LKG</option>
                                            <option value="UKG"
                                                <?php echo ($print_class == 'UKG') ? 'selected' : ''; ?>>UKG</option>
                                            <option value="1" <?php echo ($print_class == '1') ? 'selected' : ''; ?>>
                                                Class 1</option>
                                            <option value="2" <?php echo ($print_class == '2') ? 'selected' : ''; ?>>
                                                Class 2</option>
                                            <option value="3" <?php echo ($print_class == '3') ? 'selected' : ''; ?>>
                                                Class 3</option>
                                            <option value="4" <?php echo ($print_class == '4') ? 'selected' : ''; ?>>
                                                Class 4</option>
                                            <option value="5" <?php echo ($print_class == '5') ? 'selected' : ''; ?>>
                                                Class 5</option>
                                            <option value="6" <?php echo ($print_class == '6') ? 'selected' : ''; ?>>
                                                Class 6</option>
                                            <option value="7" <?php echo ($print_class == '7') ? 'selected' : ''; ?>>
                                                Class 7</option>
                                            <option value="8" <?php echo ($print_class == '8') ? 'selected' : ''; ?>>
                                                Class 8</option>
                                            <option value="9" <?php echo ($print_class == '9') ? 'selected' : ''; ?>>
                                                Class 9</option>
                                            <option value="10" <?php echo ($print_class == '10') ? 'selected' : ''; ?>>
                                                Class 10</option>
                                            <option value="11" <?php echo ($print_class == '11') ? 'selected' : ''; ?>>
                                                Class 11</option>
                                            <option value="12" <?php echo ($print_class == '12') ? 'selected' : ''; ?>>
                                                Class 12</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <label class="form-label fw-bold">Session</label>
                                        <select name="print_session_id" class="form-select">
                                            <?php foreach ($allSessions as $sess) { ?>
                                            <option value="<?php echo $sess['id']; ?>"
                                                <?php echo ($print_session_id == $sess['id']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($sess['session_name']); ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <button name="load_print" class="btn btn-primary w-100">Load Session Marksheet</button>
                                    </div>
                                </div>
                            </form>

                            <?php if ($show_print_view) { ?>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <div class="form-check me-3 align-self-center">
                                    <input class="form-check-input" type="checkbox" id="selectAllPrintStudents" checked onchange="toggleAllPrintStudents(this)">
                                    <label class="form-check-label fw-semibold" for="selectAllPrintStudents">Select All</label>
                                </div>
                                <button type="button" class="btn btn-dark"
                                    onclick="printSelectedSection('printSheetArea')">Print Selected Marksheet</button>
                            </div>

                            <?php if (!empty($print_students)) { ?>
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered table-striped align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="width: 80px;">Select</th>
                                            <th style="width: 90px;">Sno</th>
                                            <th>Student Name</th>
                                            <?php foreach ($print_exam_names as $examName) { ?>
                                            <th><?php echo htmlspecialchars($examName); ?> Avg</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($print_students as $student) { ?>
                                        <tr>
                                            <td>
                                                <input class="form-check-input print-student-checkbox" type="checkbox"
                                                    checked value="<?php echo (int) $student['Sno']; ?>"
                                                    id="print_select_<?php echo (int) $student['Sno']; ?>">
                                            </td>
                                            <td><?php echo (int) $student['Sno']; ?></td>
                                            <td><?php echo htmlspecialchars($student['full_name']); ?></td>
                                            <?php foreach ($print_exam_names as $examName) {
                                                $examMarks = $print_marks_map[$student['Sno']][$examName] ?? [];
                                                $examTotal = 0;
                                                $examCount = 0;
                                                foreach ($print_subjects as $subjectInfo) {
                                                    $subjectName = $subjectInfo['name'];
                                                    if (isset($examMarks[$subjectName]) && $examMarks[$subjectName] !== '') {
                                                        $examTotal += intval($examMarks[$subjectName]);
                                                        $examCount++;
                                                    }
                                                }
                                                $examAvg = $examCount > 0 ? number_format($examTotal / $examCount, 2) . '%' : 'N/A';
                                            ?>
                                            <td><?php echo htmlspecialchars($examAvg); ?></td>
                                            <?php } ?>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php } ?>

                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="marksheet-preview" id="printSheetArea">
                                        <div class="mb-3 text-center">
                                            <h5 class="mb-1">Marksheet</h5>
                                            <div class="text-muted small">Class
                                                <?php echo htmlspecialchars($print_class); ?> | Session
                                                <?php echo htmlspecialchars($print_session_name); ?> | All Exams</div>
                                        </div>
                                        <?php if (!empty($print_students)) { ?>
                                        <?php foreach ($print_students as $student) { ?>
                                            <div class="print-area print-item" data-print-id="<?php echo (int) $student['Sno']; ?>">
                                            <?php echo renderStudentGradeSheet($student, $print_subjects, $print_exam_names, $print_marks_map, $print_session_name); ?>
                                        </div>
                                        <?php } ?>
                                        <?php } else { ?>
                                        <div class="alert alert-warning mb-0">No students found for the selected class.
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
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
    function toggleAllPrintStudents(masterCheckbox) {
        const checkboxes = document.querySelectorAll('.print-student-checkbox');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = masterCheckbox.checked;
        });
    }

    function getCheckedPrintStudentIds() {
        return Array.from(document.querySelectorAll('.print-student-checkbox:checked')).map((checkbox) => String(checkbox.value));
    }

    function printSelectedSection(sectionId) {
        const selectedIds = getCheckedPrintStudentIds();
        if (selectedIds.length === 0) {
            alert('Please select at least one student to print.');
            return;
        }

        const section = document.getElementById(sectionId);
        if (!section) {
            alert('Print section not found.');
            return;
        }

        const clone = section.cloneNode(true);
        const itemsToRemove = [];
        clone.querySelectorAll('.print-item').forEach((item) => {
            const itemId = String(item.getAttribute('data-print-id'));
            if (!selectedIds.includes(itemId)) {
                itemsToRemove.push(item);
            } else {
                const checkboxWrap = item.querySelector('.form-check');
                if (checkboxWrap) {
                    checkboxWrap.remove();
                }
            }
        });
        itemsToRemove.forEach((item) => item.remove());

        // Collect all stylesheets and styles
        const allStyles = [];
        document.querySelectorAll('link[rel="stylesheet"]').forEach((link) => {
            allStyles.push(`<link rel="stylesheet" href="${link.href}">`);
        });
        document.querySelectorAll('style').forEach((style) => {
            allStyles.push(`<style>${style.innerHTML}</style>`);
        });

        const printWindow = window.open('', '_blank', 'width=1200,height=800');
        if (!printWindow) {
            alert('Please disable your pop-up blocker to print.');
            return;
        }

        const printContent = `
            <!DOCTYPE html>
<html>

<head>
    <title>Report Card</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link rel="stylesheet" href="../tc.css"> -->
    <style>
    body {
        font-family: Arial;
        background: #f2f2f2;
        font-size: 22px;
    }

    .tranfer img {
        position: fixed;
        opacity: 0.08;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .report {
        width: 900px;
        margin: auto;
        background: white;
        padding: 15px;
        border: 3px solid #2c7a7b;
        border-style: double;
        border-width: 5px;
        
    }

    .header {
        text-align: center;
        border-bottom: 2px solid #2c7a7b;
        padding-bottom: 10px;
    }

    .header .container1 h1 {
        color: #2c7a7b;
        margin: 0;
        font-size: 40px;
        font-weight: bold;
    }

    .school-info {
        font-size: 18px;
        font-weight: 500;
    }

    .top-info {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        border-bottom: 2px solid #2c7a7b;
        padding-bottom: 10px;
    }

    .info-left,
    .info-right {
        width: 70%;
        font-size: 14px;
    }

    .photo {
        width: 80px;
        height: 100px;
        border: 1px solid black;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 13px;
    }

    table,
    th,
    td {
        border: 1px solid #2c7a7b;
    }

    th {
        background: #e6fffa;
    }

    td,
    th {
        padding: 5px;
        text-align: center;
    }
    
    .left {
        text-align: left;
    }

    .main_table tr {
        height: auto;
    }

    .main_table th,
    .main_table td {
        padding: 4px 6px;
        line-height: 1.15;
        vertical-align: middle;
    }

    .main_table tbody {
        display: table-row-group;
        height: auto;
        overflow: visible;
    }

    .main_table tbody tr {
        height: auto;
    }


    .footer {
        margin-top: 35px;
        display: flex;
        justify-content: space-between;
    }

    .print-btn {
        margin-top: 10px;
        text-align: center;
    }

    @media print {
        .print-btn {
            display: none;
        }

        body {
            background: white;
        }
    }
    </style>
</head>

<body>

    <div class="report">
        <div class="tranfer">
            <img src="../img/logo.png" alt="">
        </div>
        <div class="header flex items-center">
            <img src="../img/logo.png" class="w-32" alt="">
            <div class="container1">
                <h1>SRM MODERN PUBLIC SCHOOL</h1>
                <div class="school-info">
                    Senior Secondary School(10+2) Affiliated to CBSE, New Delhi<br>
                    Bariyar Shah Bhadar Amethi (UP),9793237340, www.srmmps.com, srmmps2010@gmail.com
                </div>
                <h4 class="italic text-red-600 font-bold">PROGRESS REPORT : 2026-27</h4>
            </div>
        </div>

        <div class="top-info">
            <div class="info-left">
                <span class="text-[#2c7a7b]">Admission No </span>: <b>1627</b><br>
                <span class="text-[#2c7a7b]">Student Name </span>: <b>AVINASH SAHU</b><br>
                <span class="text-[#2c7a7b]">Father's Name </span>: <b>SURESH KUMAR SAHU</b><br>
                <span class="text-[#2c7a7b]">Mother's Name </span>: <b>AMRAWATI SAHU</b>
            </div>

            <div class="info-right">
                <span class="text-[#2c7a7b]">Class </span>: <b>9 - Science</b><br>
                <span class="text-[#2c7a7b]">DOB </span>: <b>08-Aug-2012</b><br>
                <span class="text-[#2c7a7b]">Affiliation No. </span>: <b>2133678</b><br>
                <span class="text-[#2c7a7b]">School Code </span>: <b>71792</b><br>

            </div>

            <img src="student.jpg" class="photo">
        </div>

        <!-- SUBJECT TABLE -->
        <table class="main_table" style="table-layout: fixed; width: 100%;font-size: 16px;">
            <thead>
        <tr>
            <th class="left">Subjects</th>  
            <th>Periodic Test 1 (20)</th>
            <th>Half Yearly (80)</th>    
            <th>Total (100)</th>
            <th>Periodic Test 2 (20)</th>    
            <th>Yearly Exam (80)</th>
            <th>Total (100)</th>
            <th>Grand Total (200)</th>
        </tr>
    </thead>
            <!-- <tr>
                <th class="left">Subjects</th>
                <th>Term 1 (20)</th>
                <th>Term 1 (80)</th>
                <th>Total</th>
                <th>Term 2 (20)</th>
                <th>Term 2 (80)</th>
                <th>Total</th>
                <th>Grand Total</th>
            </tr> -->
<tbody style="height: 300px; max-height: 300px;overflow-y: auto;">
            <tr style="height:15px; max-height:15px;">
                <td class="left">English</td>
                <td>19</td>
                <td>69</td>
                <td>88</td>
                <td>15</td>
                <td>66</td>
                <td>81</td>
                <td>169</td>
            </tr>
            <tr style="height:15px; max-height:15px;">
                <td class="left">English</td>
                <td>19</td>
                <td>69</td>
                <td>88</td>
                <td>15</td>
                <td>66</td>
                <td>81</td>
                <td>169</td>
            </tr>
            <tr>
                <td class="left" style="height:15px; max-height:15px;">IT</td>
                <td>16</td>
                <td>80</td>
                <td>96</td>
                <td>20</td>
                <td>68</td>
                <td>88</td>
                <td>184</td>
            </tr>
            <tr>
                <td class="left" style="height:10px; max-height:10px;">Maths</td>
                <td>20</td>
                <td>76</td>
                <td>96</td>
                <td>20</td>
                <td>73</td>
                <td>93</td>
                <td>189</td>
            </tr>
            <tr class="mb-10">
                <td class="left" style="height:10px; max-height:10px;">Science</td>
                <td>15</td>
                <td>49</td>
                <td>64</td>
                <td>17</td>
                <td>51</td>
                <td>68</td>
                <td>132</td>
            </tr>
            
            <tr>
                <td class="left" style=""></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
</tbody>
</table>
<table style="margin-top: 0; table-layout: fixed; font-size: 16px;">
            <tr>
                <td class="left"><b>Total</b></td>
                <td>15</td>
                <td>49</td>
                <td>478 / 600</td>
                <td>17</td>
                <td>14</td>
                <td>477 / 600</td>
                <td><b>955 / 1200</b></td>
            </tr>

            <tr>
                <td class="left"><b>Percentage</b></td>
                <td></td>
                <td></td>
                <td>79.58%</td>
                <td></td>
                <td></td>
                <td>89.58%</td>
                <td><b>90%</b></td>
            </tr>

            <tr>
                <td class="left"><b>Rank</b></td>
                <td></td>
                <td></td>
                <td>7</td>
                <td></td>
                <td></td>
                <td>8</td>
                <td><b>9</b></td>
            </tr>

            <tr>
                <td class="left"><b>Attendance</b></td>
                <td colspan="7">186 / 220</td>
            </tr>

        </table>

        <!-- CO SCHOLASTIC -->
        <h4 class="text-center font-bold text-[#2c7a7b] mt-1">Co-Scholastic Areas (3 Point Grading Scale A,B,C)</h4>
        <table style="font-size: 16px;">
            <tr>
                <th>Activity</th>
                <th>Term 1</th>
                <th>Term 2</th>
            </tr>

            <tr>
                <td>Work Education(Pre-Vocational Education)</td>
                <td>A</td>
                <td>A</td>
            </tr>
            <tr>
                <td>Health & Physical Education</td>
                <td>A</td>
                <td>A</td>
            </tr>
            <tr>
                <td>Discipline</td>
                <td>A</td>
                <td>B</td>
            </tr>
        </table>
        <div style="height:100px;"></div>
        <!-- FOOTER -->
        <div class="footer">
            <div>
                <span class="text-[#2c7a7b]"> Remark:</span> Excellent
            </div>
            <div>
                <span class="text-[#2c7a7b]"> Result:</span> Passed
            </div>
            <div>
                <span class="text-[#2c7a7b]"> Division:</span> Second
            </div>
        </div>

        <br>

        <div class="footer">
            <div>Class Teacher</div>
            <div>Principal</div>
        </div>

        <div class="print-btn">
            <button onclick="window.print()">Print</button>
        </div>

    </div>

</body>

</html>
            <body>
                ${clone.outerHTML}
            </body>
            </html>
        `;

        printWindow.document.write(printContent);
        printWindow.document.close();

        // Wait for content to render, then print
        setTimeout(() => {
            printWindow.focus();
            printWindow.print();
        }, 250);
    }

    function printSection(sectionId) {
        const section = document.getElementById(sectionId);
        if (!section) {
            return;
        }

        const printWindow = window.open('', '_blank', 'width=1200,height=800');
        const styles = Array.from(document.querySelectorAll('link[rel="stylesheet"], style'))
            .map((node) => node.outerHTML)
            .join('\n');

        printWindow.document.open();
        printWindow.document.write(`
                <!doctype html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>Print Marksheet</title>
                    ${styles}
                    <style>
                        body { padding: 20px; background: #fff; }
                        .print-area { page-break-after: always; }
                    </style>
                </head>
                <body>
                    ${section.outerHTML}
                </body>
                </html>
            `);
        printWindow.document.close();
        printWindow.focus();
        printWindow.onload = function() {
            printWindow.print();
            printWindow.close();
        };
    }
    </script>
</body>

</html>