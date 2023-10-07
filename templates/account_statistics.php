<!DOCTYPE html>
<html lang="en">
	<head >
        <title>Trivia Game | Statistics </title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Eric Chandrasekhar and Nicolas Meneses">
        <meta name="description" content="Account Statistics for Trivia Game">
        <meta name="keywords" content="Trivia Game Online , Fun Games, Play with Friends">

        <link rel="stylesheet" href="styles/statistics_styling.css" />
        <?php include "templates/common_components/common_links.html"?>
    </head>
    <body style="font-family: 'Comic Neue', cursive;">


        <?php
            $navlinks = array(
                "Home" => "?command=home",
                "Account Statistics" => "?command=statistics",
                "Logout" => "?command=logout"
            );
            include "templates/common_components/navbar.php";
        ?>

        <div class="row" style="background-color: #A2EBF1;" onmouseover="changeColor(this, '#ADD8E6')" onmouseout="changeColor(this, '#A2EBF1')">
            <h2  class="statistics_header" style="font-size:35px" onmouseover="resize(this, '40px')" onmouseout="resize(this, '35px')"> <b> Hello <?=$_SESSION["name"]?>, these are your game stats! </b> </h2>
        </div>
        <div class="row" style="background-color: #84E9F1" onmouseover="changeColor(this, '#ADD8E6')" onmouseout="changeColor(this, '#84E9F1')">
            <h3 class="statistics_header"> <b>Wins</b> </h3>
            <div class="row statistics_description">
                <p class="col" style="font-size:35px"> Total </p>
                <p class="col" style="font-size:35px"> Last 7 Days </p>
            </div>
            <div class="row statistics_values">
                <p class="col" style="font-size:25px"> <?=$statisticsWins?> </p>
                <p class="col" style="font-size:25px"> <?=$statisticsWins?> </p>
            </div>
        </div>
        <div class="row" style="background-color: #58E4F0" onmouseover="changeColor(this, '#ADD8E6')" onmouseout="changeColor(this, '#58E4F0')">
            <h3 class="statistics_header"> <b>Losses</b> </h3>
            <div class="row statistics_description">
                <p class="col" style="font-size:35px"> Total </p>
                <p class="col" style="font-size:35px"> Last 7 Days </p>
            </div>
            <div class="row statistics_values">
                <p class="col" style="font-size:25px"> <?=$statisticsLosses?>  </p>
                <p class="col" style="font-size:25px"> <?=$statisticsLosses?>  </p>
            </div>
        </div>
        <div class="row" style="background-color: #2ADFEE;" onmouseover="changeColor(this, '#ADD8E6')" onmouseout="changeColor(this, '#2ADFEE')">
            <h3 class="statistics_header"> <b>Category Performance</b> </h3>
            <div class="row statistics_description">
                <p class="col" style="font-size:35px"> Best </p>
                <p class="col" style="font-size:35px"> Worst </p>
            </div>
            <div class="row statistics_values" style="margin-bottom:2%">
                <p class="col" style="font-size:25px"> <?=$bestCategory?>  </p>
                <p class="col" style="font-size:25px"> <?=$worstCategory?>  </p>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
				<script src="scripts/styleStatistics.js"></script>
        <?php include "templates/common_components/footer.html" ?>
    </body>
</html>
