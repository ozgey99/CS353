<?php
    include "header.php";
    include "config.php";

    $id = $_GET['id'];
    $imgsrc = "img/type=club&id=".$id.".png";

    $result = mysqli_query($cn, "select * from club where id=".$id);
    $club_info = $result->fetch_assoc();

    $result2 = mysqli_query($cn, "select footballer.name as footballer, footballer.id as footballerID 
                                        from plays,footballer where plays.footballer_id=footballer.id 
                                        and plays.club_id=".$id);
    //$footballers_info = $result2->fetch_assoc();
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
                <h2><?php echo $club_info['name']; ?></h2>
            </div>
        </div>
        <div class="main-container">
            <p>Budget: <?php echo $club_info['budget']; ?></p>
            <p>League: <?php echo $club_info['league']; ?></p>
            <p>City: <?php echo $club_info['city']; ?></p>
            <p>Director: <?php echo $club_info['director']; ?></p>
            <p>Value: <?php echo $club_info['value']; ?></p>
            <p>Number of Players: <?php echo $club_info['num_of_players']; ?></p>
            <p>Players: <?php while($row = $result2->fetch_array()){
                            $footballer_link = "/profile_footballer.php?type=footballer&id=".$row['footballerID'];
                            echo "<a href='$footballer_link'>".$row['footballer']."</a>  ";
                } ?></p>

        </div>
    </div>
</div>
</body>

</html>


