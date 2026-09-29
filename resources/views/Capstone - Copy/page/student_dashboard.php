<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | Classroom Monitoring System</title>
    <link rel="stylesheet" href="../style/student_dashboard.css">
</head>

<body>
    <div class="container">
        <header>
            <div class="logo">
                <h2>Classroom Monitoring System</h2>
            </div>

            <nav>
                <a href="student_dashboard.php">Dashboard</a>
                <a href="#">Classrooms</a>
                <a href="#">Schedules</a>
                <a href="#">Report an Issue</a>
            </nav>
        </header>

        <div class="dashboard">
            <h1>Student Dashboard</h1>
            <p>View classroom availability and schedules.</p>
            <div class="summary">
                <div class="card">
                    <h3>Total Classrooms</h3>
                    <p>20</p>
                </div>
                <div class="card">
                    <h3>Available</h3>
                    <p>12</p>
                </div>
                <div class="card">
                    <h3>Occupied</h3>
                    <p>6</p>
                </div>
                <div class="card">
                    <h3>Unavailable</h3>
                    <p>2</p>
                </div>
            </div>

            <div class="classrooms">
                <h2>Classroom Status</h2>
                <input type="text" name="search" id="search" placeholder="Search classroom...">
                <div class="room">
                    <h3>IT 101</h3>
                    <p>IT Building</p>
                    <span class="available">Available</span>
                </div>
                <div class="room">
                    <h3>IT 102</h3>
                    <p>IT Building</p>
                    <span class="occupied">Occupied</span>
                </div>
                <div class="room">
                    <h3>IT 103</h3>
                    <p>New IT Building</p>
                    <span class="available">Available</span>
                </div>
                <div class="room">
                    <h3>IT 104</h3>
                    <p>New IT Building</p>
                    <span class="unavailable">Unavailable</span>
                </div>
            </div>

            <div class="schedule">
                <h2>Today's Schedule</h2>
                <table>
                    <tr>
                        <th>Time</th>
                        <th>Room</th>
                        <th>Subject</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td>7:00 AM - 9:00 AM</td>
                        <td>IT 101</td>
                        <td>Web Development</td>
                        <td>Occupied</td>
                    </tr>
                    <tr>
                        <td>9:00 AM - 11:00 AM</td>
                        <td>IT 102</td>
                        <td>Database Management</td>
                        <td>Occupied</td>
                    </tr>
                    <tr>
                        <td>1:00 PM - 3:00 PM</td>
                        <td>IT 103</td>
                        <td>Networking</td>
                        <td>Occupied</td>
                    </tr>
                </table>
            </div>

            <div class="report">

                <h2>Facility Issue?</h2>
                <p>Found a problem inside a classroom?</p>

                <button type="button" class="report-button">
                    Report an Issue
                </button>
            </div>
        </div>
    </div>

</body>
</html>