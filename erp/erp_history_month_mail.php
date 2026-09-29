<?php
include __DIR__ . '/../backend/connection.php';
include __DIR__ . '/../emailsender/email.php';

date_default_timezone_set('Asia/Kolkata');

$today = date('d');
$lastDay = date('t');

if ($today != $lastDay) {
    exit;
}

$monthStart = date('Y-m-01');
$monthEnd = date('Y-m-t');

$monthStartDisplay = date('d-m-Y', strtotime($monthStart));
$monthEndDisplay = date('d-m-Y', strtotime($monthEnd));


$receiptSql = "SELECT * FROM `reciept`
WHERE STR_TO_DATE(reciept_date, '%d-%m-%Y')
BETWEEN '$monthStart' AND '$monthEnd'";

$receiptResult = mysqli_query($conn, $receiptSql);
$receiptRows = [];

if ($receiptResult && mysqli_num_rows($receiptResult) > 0) {
    while ($row = mysqli_fetch_assoc($receiptResult)) {
        $receiptRows[] = $row;
    }
}

$submittedSql = "SELECT f.*, 
TRIM(CONCAT(s.first_name, ' ', COALESCE(s.middle_name, ''), ' ', s.last_name)) AS stu_name
FROM `student_fees_submitted` f
LEFT JOIN `studentsdetail` s ON f.stu_admission_no = s.admission_number
WHERE DATE(f.created_at) BETWEEN '$monthStart' AND '$monthEnd'";
$submittedResult = mysqli_query($conn, $submittedSql);
$submittedRows = [];

if ($submittedResult && mysqli_num_rows($submittedResult) > 0) {
    while ($row = mysqli_fetch_assoc($submittedResult)) {
        $submittedRows[] = $row;
    }
}

$cash = 0;
$online = 0;
$submittedTotal = 0;
$submittedOnline = 0;
$submittedOffline = 0;

$receiptTable = '<h3 style="color:#007BFF; margin:16px 0 8px;">Receipt Entries</h3>';
$receiptTable .= '<table cellpadding="10" cellspacing="0" border="1" style="border-collapse:collapse;font-family:Arial;width:100%;margin-bottom:10px;">
<thead style="background-color:#007BFF;color:white;">
<tr>
<th>Sno</th>
<th>Receipt No</th>
<th>Admission No</th>
<th>Student Name</th>
<th>Payment Mode</th>
<th>Submitted By</th>
<th>Amount</th>
</tr>
</thead>
<tbody>';

if (count($receiptRows) > 0) {
    $sno = 1;
    foreach ($receiptRows as $row) {
        $amount = (float)$row['total_fee'];

        if ($row['payment_method'] === 'Cash') {
            $cash += $amount;
        } elseif ($row['payment_method'] === 'Online') {
            $online += $amount;
        }

        $receiptTable .= '<tr style="background-color:#f9f9f9;">';
        $receiptTable .= '<td>' . $sno . '</td>';
        $receiptTable .= '<td>' . htmlspecialchars($row['reciept_no']) . '</td>';
        $receiptTable .= '<td>' . htmlspecialchars($row['admission_no']) . '</td>';
        $receiptTable .= '<td>' . htmlspecialchars($row['stu_name']) . '</td>';
        $receiptTable .= '<td>' . htmlspecialchars($row['payment_method']) . '</td>';
        $receiptTable .= '<td>' . htmlspecialchars($row['erp_teacher_name']) . '</td>';
        $receiptTable .= '<td>' . $amount . '</td>';
        $receiptTable .= '</tr>';
        $sno++;
    }
} else {
    $receiptTable .= '<tr style="background-color:#f9f9f9;"><td colspan="7" style="text-align:center;">No receipt records found for this month.</td></tr>';
}

$receiptTable .= '</tbody></table>';

$submittedTable = '<h3 style="color:#28a745; margin:16px 0 8px;">Submitted Fee Entries</h3>';
$submittedTable .= '<table cellpadding="10" cellspacing="0" border="1" style="border-collapse:collapse;font-family:Arial;width:100%;margin-bottom:10px;">
<thead style="background-color:#28a745;color:white;">
<tr>
<th>Sno</th>
<th>Receipt No</th>
<th>Admission No</th>
<th>Student Name</th>
<th>Online Payment</th>
<th>Cash Payment</th>
<th>Submitted By</th>
<th>Total Paid</th>
</tr>
</thead>
<tbody>';

if (count($submittedRows) > 0) {
    $subSno = 1;
    foreach ($submittedRows as $row) {
        $rowOnline = isset($row['online_payment']) ? (float)$row['online_payment'] : 0;
        $rowOffline = isset($row['offline_payment']) ? (float)$row['offline_payment'] : 0;
        $rowTotal = isset($row['total_paid']) ? (float)$row['total_paid'] : 0;

        $submittedTotal += $rowTotal;
        $submittedOnline += $rowOnline;
        $submittedOffline += $rowOffline;

        $submittedTable .= '<tr style="background-color:#f9f9f9;">';
        $submittedTable .= '<td>' . $subSno . '</td>';
        $submittedTable .= '<td>' . htmlspecialchars($row['reciept_no']) . '</td>';
        $submittedTable .= '<td>' . htmlspecialchars($row['stu_admission_no']) . '</td>';
        $submittedTable .= '<td>' . htmlspecialchars($row['stu_name']) . '</td>';
        $submittedTable .= '<td>' . $rowOnline . '</td>';
        $submittedTable .= '<td>' . $rowOffline . '</td>';
        $submittedTable .= '<td>' . htmlspecialchars($row['submitted_by']) . '</td>';
        $submittedTable .= '<td>' . $rowTotal . '</td>';
        $submittedTable .= '</tr>';
        $subSno++;
    }
} else {
    $submittedTable .= '<tr style="background-color:#f9f9f9;"><td colspan="8" style="text-align:center;">No submitted fee records found for this month.</td></tr>';
}

$submittedTable .= '</tbody></table>';

$totalCash = $cash + $submittedOffline;
$totalOnline = $online + $submittedOnline;
$grandTotal = $cash + $online + $submittedTotal;

$totalTable = '<h3 style="margin:16px 0 8px;">Monthly Totals</h3>';
$totalTable .= '<table cellpadding="10" cellspacing="0" border="1" style="border-collapse:collapse;font-family:Arial;width:50%;">';
$totalTable .= '<tbody>';
$totalTable .= '<tr style="background-color:#f9f9f9;"><td style="background-color:#007BFF;color:white;">Total Cash</td><td>' . $totalCash . '</td></tr>';
$totalTable .= '<tr style="background-color:#f9f9f9;"><td style="background-color:#007BFF;color:white;">Total Online</td><td>' . $totalOnline . '</td></tr>';
$totalTable .= '<tr style="background-color:#f9f9f9;"><td style="background-color:#007BFF;color:white;">Grand Total</td><td>' . $grandTotal . '</td></tr>';
$totalTable .= '</tbody></table>';

$msg = '<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Daily Fees Report</title>
</head>
<body style="font-family:Arial,sans-serif;">
<h2 style="color:green;">
    Fees Report (' . $monthStartDisplay . ' to ' . $monthEndDisplay . ')
</h2>'
. $receiptTable
. $submittedTable
. $totalTable .
'</body>
</html>';

// smtp_mailer('mauryaji2562003@gmail.com', 'Fees Report(' . $date . ')', $msg);
// smtp_mailer('rajeshmaurya5005@gmail.com', 'Fees Report(' . $date . ')', $msg);
smtp_mailer(
    'mauryaji2562003@gmail.com',
    'Fees Report (' . $monthStartDisplay . ' to ' . $monthEndDisplay . ')',
    $msg
);
?>