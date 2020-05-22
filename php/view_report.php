<?php
    include 'config.php';
    include 'header.php';

    $uid = $_SESSION['id'];
    $reportID = $_POST['select'];

    $result = mysqli_query($cn, "select report.id as reportID, report.date as date, report.rating as rating, 
                report.comment as comment, scout.name as scout, footballer.name footballer 
                from report, reports, footballer_report, scout, club, footballer
                where report.id = '$reportID'
                and report.id = reports.report_id 
                and report.id = footballer_report.report_id
                and reports.scout_id = scout.id
                and club.id = reports.club_id
                and club.id = '$uid'
                and footballer_report.footballer_id = footballer.id");

    $row = $result->fetch_assoc();
    ?>
<br>
    <button type='button' class='btn-danger' onclick="window.location.href='club_reports.php'">
    Close
    </button> <br> <?php
    echo "<p><b>Footballer: </b>".$row['footballer']."</p>
        <p><b>Scout: </b>".$row['scout']."</p>
        <p><b>Rating: </b>".$row['rating']."</p>
        <p><b>Date: </b>".$row['date']."</p>
        <p><b>Comment: </b>".$row['comment']."</p>";







