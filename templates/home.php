<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Trivia Game | Home</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nicolas Meneses and Eric Chandrasekhar">
        <meta name="description" content="Home page for Trivia Game">
        <meta name="keywords" content="Trivia Game Online , Fun Games, Play with Friends, Game's home page">

        <?php include "templates/common_components/common_links.html"?>

        <style>

            .footer_Design {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                color: white;
                background-color: black;
                text-align: center;
                height: 30px;
            }

        </style>
    </head>


    <body style="background-color: aqua; font-family: 'Comic Neue', cursive;">

        <?php
            $navlinks = array(
                "Home" => "?command=home",
                //"Trivia Question" => "?command=question", Used for sprint 2 to show question screen?
                "Account Statistics" => "?command=statistics",
                "Logout" => "?command=logout"
            );
            include "templates/common_components/navbar.php";
        ?>

        <!-- Home page would go here, either in an include or just straight up. -->

        <section class="container" style="min-height: calc(100vh - 111px)">

            <div  class="row" >

                <div class="col-6">

<!-- Hold off on this for now. We can add it in if we want later.
                    <div style="padding: 3%; margin-top: 10%">
                        <button type="button" class="btn btn-primary" style="height: 100px; width: 50%; background-color: lawngreen; color: black">PLAY  NOW!</button>
                    </div>
-->

                    <div style="padding: 3%; margin-top: 14%">

                        <?php
                        if (isset($error_msg))
                            echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error_msg .   "</div>";

                        if (isset($success_msg))
                            echo "<div class=\"alert alert-success\" role=\"alert\">" . $success_msg .   "</div>";
                        ?>
                        <h3> <script src="scripts/addContentToHome.js"></script> <?=$_SESSION["name"]?>!</h3>

                        <form action="?command=home" method="post">
                            <div class="col-6">
                                <label  style="margin-top: 1%" for="friendID" class="form-label">Enter player user id</label>
                                <input style="margin: 0px; padding: 0px;" type="number" class="form-control" name="friendID" id="friendID">
                                <label  style="margin-top: 1%" class="form-label">
                                    (Your player user id is <?php echo $user_info["id"] ?>)
                                </label>
                            </div>

                            <button type="submit" class="btn btn-secondary" style="height: 100px; width: 50%; background-color: lightgray; color: black">PLAY WITH A FRIEND</button>
                        </form>
                    </div>

                </div>

                <div class="col-6">

                        <div  style="margin: 10px; margin-top: 8%">
                            <h2 style="text-align: center"> Your Turn! </h2>
                            <?php
                                if (empty($players_turn_games))
                                    echo "<h3 style=\"text-align: center\"> No games! </h3>";
                            ?>
                            <ul class="list-group">
                            <?php
                                foreach ($players_turn_games as $game)
                                {
                                    echo "<li class=\"list-group-item list-group-item-secondary row\" style=\"font-size: 27px; background-color: lightgreen\">";
                                    echo $game["p1_name"] . " ";
                                    echo $game["p1_correct_answers"] . " - " . $game["p2_correct_answers"] . " ";
                                    echo $game["p2_name"];
                                    echo "<form action=\"?command=home\" method=\"post\">";
                                        echo "<button type=\"submit\" name=\"game_id\" value=\"" . $game["id"] . "\" class=\"btn btn-primary\" style=\"height: 10%; width: 20%; float: right\">Play</button> </li>";
                                    echo "</form>";
                                }
                            ?>
                            </ul>
                        </div>

                         <div  style="margin: 10px; margin-top: 6%; margin-bottom: 13%">
                            <h2 style="text-align: center">Opponent's Turn</h2>
                            <?php
                                if (empty($friends_turn_games))
                                    echo "<h3 style=\"text-align: center\"> No games! </h3>";
                            ?>
                              <ul class="list-group">
                                <?php
                                    foreach ($friends_turn_games as $game)
                                    {
                                        echo "<li class=\"list-group-item list-group-item-secondary row\" style=\"font-size: 27px; background-color: lightgreen\">";
                                        echo $game["p1_name"] . "&emsp; ";
                                        echo $game["p1_correct_answers"] . " - " . $game["p2_correct_answers"] . "&emsp; ";
                                        echo $game["p2_name"];
                                    }
                                ?>
                            </ul>
                        </div>
                </div>
            </div>
        </section>

        <?php include "templates/common_components/footer.html"?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>
</html>
