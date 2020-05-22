<html>
    <head>
        <title>Scout Online</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <h1 style="color: whitesmoke; alignment: center; font-family: Verdana; font-size: xx-large">
        Scout Online
    </h1>

    <body style="background-color: #1d2124; background-image: url('football.jpg'); background-size: cover; color: antiquewhite; alignment: center; font-family: Verdana; font-size: large">
        <p>Looking to add new players to your team? Sign up for free as a club.</p>
        <p>You can make and respond to transfer offers, view reports and information about footballers.</p>
        <p>You can also sign up as an agency/scout in order to submit reports on footballers.</p>
        <p>If you're a journalist, you can subscribe to teams and keep up with the latest transfers.</p>
    </body>

    <div class="row" style="color: #1d2124">
        <div class="col-md-1 ml-md-auto" align="center">
            <button type="button" class="btn btn-outline-light btn-lg" onclick="window.location.href='/login.php'">
                Login
            </button>
        </div>
        <div class="col-md-3 ml-md-auto">
            <button type="button" class="btn btn-outline-light btn-lg" onclick="window.location.href='/signup_journalist.php'">
                Sign up as a Journalist
            </button>
        </div>
        <div class="col-md-3 ml-md-auto">
            <button type="button" class="btn btn-outline-light btn-lg" onclick="window.location.href='/signup_agency.php'">
                Sign up as an Agency
            </button>
        </div>
        <div class="col-md-3 ml-md-auto">
            <button type="button" class="btn btn-outline-light btn-lg" onclick="window.location.href='/signup_agent.php'">
                Sign up as an Agent
            </button>
        </div>
        <div class="col-md-2 ml-md-auto">
            <button type="button" class="btn btn-outline-light btn-lg" onclick="window.location.href='/signup_scout.php'">
                Sign up as a Scout
            </button>
        </div>
    </div>

</html>
