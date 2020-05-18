<html lang="en">
<head>
    <title>Subscribe</title>

    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">

    <br>
    <style>
        .button {
            background-color: #4CAFBB;
            border: none;
            color: white;
            padding: 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 16px 2px;
            border-radius: 4px;

        }

    </style>


    <div align="right">
        <button type="button" class="button" onclick="window.location.href='/cs353/php/home_journalist.php'">
            Home
        </button>

        <button type="button" class="button" onclick="window.location.href='/cs353/php/profile_journalist.php'">
            Profile
        </button>
    </div>


    <br>

</head>

<body>

<form name="myForm" action="subscription_check.php" onsubmit="return check()" method="post">
    <div class="container">
        <div class="panel panel-default">
            <br>
            <h2 align = "center">Subscribe to a Club!</h2>
            <div class="panel-body">
                <div class="form-group"  align="center">

                    <select name="club" id="club" class="form-control" style="width:350px">
                        <option value=""> Select Club </option>


                        <?php
                        require('config.php');
                        $sql = "SELECT id, name FROM club;";
                        $result = mysqli_query($cn, $sql);
                        while($row = $result->fetch_assoc()){
                            echo "<option value=". $row['id'].">" .$row['name']."</option>";
                        }
                        ?>


                    </select>
                </div>


                <div align = "center">
                    <input name="policy" id="policy" type="checkbox">
                    I have read the <a href="policy.txt" target="_blank">Terms and Conditions</a>.

                </div>

                <div class="form-group" align = "center">

                    <button name="submitt" type="submit" class="button" >Subscribe!</button>

                </div>


            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    function check() {

        var x = document.forms["myForm"]["club"].value;
        if(x === ""){
            alert("Please select a club");
            return false;
        }

        var y = document.getElementById("policy");
        if(y.checked === false){
            alert("Please confirm that you have read the terms and conditions");
            return false;
        }

    }
</script>

</body>
</html>