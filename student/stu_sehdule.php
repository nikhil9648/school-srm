<?php include '../backend/connection.php';
session_start();
if(!isset($_SESSION['stu_loggedin']) ){ 
    header("Location: ../partials/erp_login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student I'd</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../student/student_style.css">
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="../javascript/function.js"></script>
    <style>
    .calendar-container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        max-width:400px;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .calendar-header button {
        background: #007BFF;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .calendar-body {
        display: flex;
        flex-direction: column;
    }

    .calendar-weekdays,
    .calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
    }

    .calendar-weekdays div,
    .calendar-days div {
        padding: 10px;
        text-align: center;
    }

    .day {
        background: #e0e0e0;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .day:hover {
        background: #007BFF;
        color: white;
    }

    .today {
        background: #FF5733;
        color: white;
    }
    </style>
</head>

<body>
    <div class="student_dashboard">
        <div class="section1 hideonmobile">
            <?php include '../student/student_sidebar.php' ;?>
        </div>
        <div class="student_main">
            <div class="navbar">
                <?php include '../student/stu_header.php';
                include '../student/stu_mobile_sidebar.php'; ?>
<hr>
<!-- <h1>Calender</h1> -->
                <div class="calendar-container">
                    <div class="calendar-header">
                        <button id="prevMonth">&#10094;</button>
                        <h2 id="monthYear"></h2>
                        <button id="nextMonth">&#10095;</button>
                    </div>
                    <div class="calendar-body">
                        <div class="calendar-weekdays">
                            <div>Sun</div>
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                        </div>
                        <div class="calendar-days" id="calendarDays"></div>
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
        function showsidebar() {
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = "flex"
        }

        function hidesidebar() {
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = "none"
        }
        </script>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const monthYear = document.getElementById("monthYear");
            const calendarDays = document.getElementById("calendarDays");
            const prevMonthBtn = document.getElementById("prevMonth");
            const nextMonthBtn = document.getElementById("nextMonth");

            let currentDate = new Date();

            function renderCalendar() {
                calendarDays.innerHTML = "";
                const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
                const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
                monthYear.textContent = firstDay.toLocaleDateString("en-US", {
                    month: "long",
                    year: "numeric"
                });

                let startDay = firstDay.getDay();
                for (let i = 0; i < startDay; i++) {
                    let emptyDiv = document.createElement("div");
                    emptyDiv.classList.add("empty");
                    calendarDays.appendChild(emptyDiv);
                }

                for (let day = 1; day <= lastDay.getDate(); day++) {
                    let dayDiv = document.createElement("div");
                    dayDiv.textContent = day;
                    dayDiv.classList.add("day");
                    if (day === new Date().getDate() && currentDate.getMonth() === new Date().getMonth() &&
                        currentDate.getFullYear() === new Date().getFullYear()) {
                        dayDiv.classList.add("today");
                    }
                    calendarDays.appendChild(dayDiv);
                }
            }

            prevMonthBtn.addEventListener("click", function() {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar();
            });

            nextMonthBtn.addEventListener("click", function() {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar();
            });

            renderCalendar();
        });
        </script>
</body>

</html>