<?php
    session_start();
    include ('config.php');
    $db = $cn;
    $username = "";
    $password_1="";
    $password_2="";
    $errors = array();
    if(isset($_POST['signup_journalist'])) {
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $name = "";
        $name = mysqli_real_escape_string($db,$_POST['name']);
        $password_1 = mysqli_real_escape_string($db,$_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db,$_POST['password_2']);
        if(empty($username)) {
            array_push($errors,"Username cannot be empty!");
        }
        if(empty($name)) {
            array_push($errors,"Name cannot be empty!");
        }
        if(empty($password_1)) {
            array_push($errors,"Password cannot be empty!");
        }
        if($password_1 != $password_2) {
            array_push($errors,"Passwords do not match!");
        }
        $usernameCheck = "SELECT username FROM user WHERE username='$username'";
        $result = mysqli_query($db,$usernameCheck);
        $usernameResult = mysqli_num_rows($result);
        if($usernameResult > 0) {
            array_push($errors,"This username has taken before, please select another one!");
        }

        if(count($errors) == 0) {
            $password = password_hash($password_1,PASSWORD_DEFAULT);
            //$password = $password_1;
            $sql = "INSERT INTO user(username,password)
                    VALUES ('$username','$password')";
            mysqli_query($db,$sql);

            $query = "SELECT MAX(id) as id FROM user";
            $result = mysqli_query($db,$query);
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                $id = $row['id'];
                $query2 = "INSERT INTO journalist(id,name)
                             VALUES ('$id','$name')";
                mysqli_query($db,$query2);
            }
            else {
                array_push($errors,"ERROR: journalist signup");
            }
        }
        header("Location: login.php");
    }

    if(isset($_POST['signup_agency'])) {
        $agency_name = "";
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $agency_name = mysqli_real_escape_string($db, $_POST['agency_name']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

        if(empty($username)) {
            array_push($errors,"Username cannot be empty!");
        }
        if(empty($agency_name)) {
            array_push($errors,"Name cannot be empty!");
        }
        if(empty($password_1)) {
            array_push($errors,"Password cannot be empty!");
        }
        if($password_1 != $password_2) {
            array_push($errors,"Passwords do not match!");
        }
        $usernameCheck = "SELECT username FROM user WHERE username='$username'";
        $result = mysqli_query($db,$usernameCheck);
        $usernameResult = mysqli_num_rows($result);
        if($usernameResult > 0) {
            array_push($errors,"This username has taken before, please select another one!");
        }

        if(count($errors) == 0) {
            $password = password_hash($password_1,PASSWORD_DEFAULT);
            $sql = "INSERT INTO user(username,password)
                        VALUES ('$username','$password')";
            mysqli_query($db,$sql);

            $query = "SELECT MAX(id) as id FROM user";
            $result = mysqli_query($db,$query);
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                $id = $row['id'];
                $activationKey = random_int(0,999999999);
                $query2 = "INSERT INTO agency(id,name,activation_key)
                            VALUES ('$id','$agency_name','$activationKey')";
                mysqli_query($db,$query2);
            }
            else {
                array_push($errors,"ERROR: agency signup");
            }
        }
        header("Location: login.php");
    }

    if(isset($_POST['signup_agent'])) {
        $name = "";
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

        if(empty($username)) {
            array_push($errors,"Username cannot be empty!");
        }
        if(empty($name)) {
            array_push($errors,"Name cannot be empty!");
        }
        if(empty($password_1)) {
            array_push($errors,"Password cannot be empty!");
        }
        if($password_1 != $password_2) {
            array_push($errors,"Passwords do not match!");
        }
        $usernameCheck = "SELECT username FROM user WHERE username='$username'";
        $result = mysqli_query($db,$usernameCheck);
        $usernameResult = mysqli_num_rows($result);
        if($usernameResult > 0) {
            array_push($errors,"This username has taken before, please select another one!");
        }

        if(count($errors) == 0) {
            $password = password_hash($password_1,PASSWORD_DEFAULT);
            $sql = "INSERT INTO user(username,password)
                        VALUES ('$username','$password')";
            mysqli_query($db,$sql);

            $query = "SELECT MAX(id) as id FROM user";
            $result = mysqli_query($db,$query);
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                $id = $row['id'];
                $query2 = "INSERT INTO agent(id,name)
                                 VALUES ('$id','$name')";
                mysqli_query($db,$query2);
            }
            else {
                array_push($errors,"ERROR: agent signup");
            }
        }
        header("Location: login.php");
    }


    if(isset($_POST['signup_scout'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $activation_key = "";
        $activation_key = mysqli_real_escape_string($db, $_POST['activation_key']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

        if(empty($username)) {
            array_push($errors,"Username cannot be empty!");
        }
        if(empty($activation_key)) {
            array_push($errors,"Name cannot be empty!");
        }
        if(empty($password_1)) {
            array_push($errors,"Password cannot be empty!");
        }
        if($password_1 != $password_2) {
            array_push($errors,"Passwords do not match!");
        }
        $usernameCheck = "SELECT username FROM user WHERE username='$username'";
        $result = mysqli_query($db,$usernameCheck);
        $usernameResult = mysqli_num_rows($result);
        if($usernameResult > 0) {
            array_push($errors,"This username has taken before, please select another one!");
        }

        if(count($errors) == 0) {
            $password = password_hash($password_1,PASSWORD_DEFAULT);
            $sql = "INSERT INTO user(username,password)
                            VALUES ('$username','$password')";
            mysqli_query($db,$sql);

            $query = "SELECT id FROM user WHERE id=(SELECT MAX(id) FROM user)";
            $id = mysqli_query($db,$query);
            if(mysqli_num_rows($result) == 1) {
                $query2 = "INSERT INTO agent(id,name)
                                     VALUES ('$id','$name')";
                mysqli_query($db,$query2);
            }
            else {
                array_push($errors,"ERROR: scout signup");
            }
        }
        header("Location: login.php");
    }

    if(isset($_POST['signup_footballer'])) {
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $age = mysqli_real_escape_string($db, $_POST['age']);
        $value = mysqli_real_escape_string($db, $_POST['value']);
        $team = mysqli_real_escape_string($db, $_POST['team']);
        $position = mysqli_real_escape_string($db,$_POST['position']);
        $nationality = mysqli_real_escape_string($db, $_POST['nationality']);

        if(empty($name)) {
            array_push($errors,"Name cannot be empty!");
        }
        if(empty($age)) {
            array_push($errors,"Age cannot be empty!");
        }
        if(empty($value)) {
            array_push($errors,"Value cannot be empty!");
        }
        if(empty($position)) {
            array_push($errors,"Position cannot be empty!");
        }
        if(empty($nationality)) {
            array_push($errors,"Nationality cannot be empty!");
        }
        $clubCheck = "SELECT id FROM club WHERE name='$team'";
        $clubResult = mysqli_query($db,$clubCheck);
        $result = mysqli_num_rows($clubResult);
        if($result != 1) {
            array_push($errors,"Club does not exist!");
        }


        if(count($errors) == 0) {
            $sql = "INSERT INTO footballer(name,age,value,nationality)
                                VALUES ('$name','$age','$value','$nationality')";
            mysqli_query($db,$sql);
            $query = "SELECT MAX(id) as id FROM footballer";
            $result = mysqli_query($db,$query);
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                $id = $row['id'];
                $query2 = "INSERT INTO footballer_positions(id,position)
                                         VALUES ('$id','$position')";
                mysqli_query($db, $query2);

                if (mysqli_num_rows($clubResult) == 1) {
                    $row = mysqli_fetch_array($clubResult);
                    $club_id = $row['id'];
                    $query4 = "INSERT INTO plays(footballer_id, club_id)
                                VALUES('$id','$club_id')";
                    mysqli_query($db, $query4);

                    $query5 = "SELECT num_of_players FROM club WHERE id='$club_id'";
                    $result = mysqli_query($db, $query5);
                    $row = mysqli_fetch_array($result);
                    $num_of_players = $row['num_of_players'] + 1;
                    $query6 = "UPDATE club SET num_of_players = '$num_of_players' WHERE id = '$club_id'";
                    mysqli_query($db, $query6);

                    $query7 = "SELECT value FROM club WHERE id='$club_id'";
                    $result = mysqli_query($db, $query7);
                    $row = mysqli_fetch_array($result);
                    $new_value = $row['value'] + $value;
                    $query8 = "UPDATE club SET value = '$new_value' WHERE id = '$club_id'";
                    mysqli_query($db, $query8);
                } else {
                    array_push($errors, "ERROR: team id - footballer signup");
                }
            }
            else {
                    array_push($errors, "ERROR: footballer signup");
            }
        }
        
    }

    if(isset($_POST['signup_club'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $league = mysqli_real_escape_string($db, $_POST['league']);
        $city = mysqli_real_escape_string($db, $_POST['city']);
        $director = mysqli_real_escape_string($db, $_POST['director']);
        $budget = mysqli_real_escape_string($db,$_POST['budget']);
        $password_1= mysqli_real_escape_string($db,$_POST['password_1']);
        $password_2= mysqli_real_escape_string($db,$_POST['password_2']);
        $value = 0;
        $num_of_players = 0;

        if(empty($username)) {
            array_push($errors,"Name cannot be empty!");
        }
        if(empty($name)) {
            array_push($errors,"Name cannot be empty!");
        }
        if(empty($league)) {
            array_push($errors,"League cannot be empty!");
        }
        if(empty($city)) {
            array_push($errors,"City cannot be empty!");
        }
        if(empty($budget)) {
            array_push($errors,"Budget cannot be empty!");
        }
        if(empty($password_1)) {
            array_push($errors,"Password cannot be empty!");
        }
        if($password_1 != $password_2) {
            array_push($errors,"Passwords do not match!");
        }
        $clubCheck = "SELECT name FROM club WHERE name='$name'";
        $result = mysqli_query($db,$clubCheck);
        $result2 = mysqli_num_rows($result);
        if($result2 > 0) {
            array_push($errors,"This club exists!");
        }

        $usernameCheck = "SELECT username FROM user WHERE username='$username'";
        $result = mysqli_query($db,$usernameCheck);
        $result2 = mysqli_num_rows($result);
        if($result2 > 0) {
            array_push($errors,"This username exists!");
        }

        if(count($errors) == 0) {
            $password = password_hash($password_1,PASSWORD_DEFAULT);
            $sql = "INSERT INTO user(username,password)
                        VALUES ('$username','$password')";
            mysqli_query($db,$sql);

            $query = "SELECT MAX(id) as id FROM user";
            $result = mysqli_query($db,$query);
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                $id = $row['id'];
                $query2 = "INSERT INTO club(id,name,budget,league,city,director,value,num_of_players)
                        VALUES ('$id','$name','$budget','$league','$city','$director','$value','$num_of_players')";
                mysqli_query($db,$query2);
            }
            else {
                array_push($errors,"ERROR: agent signup");
            }
        }
        header("Location: login.php");
    }
    
?>
