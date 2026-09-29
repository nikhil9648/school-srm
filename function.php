<?php 
// include './backend/connection.php';
function reciept(){
    $sql = "SELECT * FROM `reciept`";
    $result = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Calendar</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
</head>
<body>
    <div class="calendar-container">
        <div class="calendar-header">
            <button id="prevMonth">&#10094;</button>
            <h2 id="monthYear"></h2>
            <button id="nextMonth">&#10095;</button>
        </div>
        <div class="calendar-body">
            <div class="calendar-weekdays">
                <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
            </div>
            <div class="calendar-days" id="calendarDays"></div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const monthYear = document.getElementById("monthYear");
            const calendarDays = document.getElementById("calendarDays");
            const prevMonthBtn = document.getElementById("prevMonth");
            const nextMonthBtn = document.getElementById("nextMonth");
            
            let currentDate = new Date();

            function renderCalendar() {
                calendarDays.innerHTML = "";
                const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
                const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
                monthYear.textContent = firstDay.toLocaleDateString("en-US", { month: "long", year: "numeric" });

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
                    if (day === new Date().getDate() && currentDate.getMonth() === new Date().getMonth() && currentDate.getFullYear() === new Date().getFullYear()) {
                        dayDiv.classList.add("today");
                    }
                    calendarDays.appendChild(dayDiv);
                }
            }
            
            prevMonthBtn.addEventListener("click", function () {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar();
            });
            
            nextMonthBtn.addEventListener("click", function () {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar();
            });
            
            renderCalendar();
        });
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f4f4f4;
        }
        .calendar-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
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
</body>
</html>