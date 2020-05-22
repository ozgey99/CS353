<?php
include "header.php";
include "config.php";

$id = $_GET['id'];
$imgsrc = "img/type=footballer&id=".$id.".png";

$result = mysqli_query($cn, "select name, age, value, nationality from footballer where id=".$id);
$footballer_info = $result->fetch_assoc();

$result2 = mysqli_query($cn, "select plays.salary as sal, plays.contract_end as contract, 
                                        club.name as club, club.league as league from plays,club 
                                        where club.id=plays.club_id and footballer_id =".$id);
$plays_info = $result2->fetch_assoc();

$result3 = mysqli_query($cn, "select position as pos from footballer_positions where id=".$id);
//$positions_info = $result3->fetch_array();

$result4 = mysqli_query($cn, "select trophy from footballer_trophy where id=".$id);
//$trophy_info = $result4->fetch_array();

$result5 = mysqli_query($cn, "select agent.name as agent from manages, agent where manages.agent_id=agent.id and manages.footballer_id=".$id);
$agent_info = $result5->fetch_assoc();
?>

<html lang="en">
<head>
    <title>Footballer</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .profile-card{
            width: 400px;
        }
        .image-container{
            position: relative;
        }
    </style>
</head>
<body>
<div class="wrapper" style="margin: auto">
    <div class="profile-card" >
        <div class="image-container">
            <img src="<?php echo $imgsrc; ?>" style="width: auto; height: 200px">
            <div class="title">
                <h2><?php echo $footballer_info['name']; ?></h2>
            </div>
        </div>
        <div class="main-container">
            <p>Age: <?php echo $footballer_info['age']; ?></p>
            <p>Value: <?php echo $footballer_info['value']; ?></p>
            <p>Nationality: <?php echo $footballer_info['nationality']; ?></p>
            <p>Club: <?php echo $plays_info['club']; ?></p>
            <p>Salary: <?php echo $plays_info['sal']; ?></p>
            <p>Contract End: <?php echo $plays_info['contract']; ?></p>
            <p>League: <?php echo $plays_info['league']; ?></p>
            <p>Agent: <?php echo $agent_info['agent']; ?></p>
            <p>Positions: <?php while($positions_info = $result3->fetch_array()){
                    echo $positions_info['pos']." ";} ?></p>
            <p>Trophies: <?php while($trophy_info = $result4->fetch_array()){
                    echo $trophy_info['trophy']." - ";}?></p>
        </div>
    </div>
</div>
</body>

</html>


