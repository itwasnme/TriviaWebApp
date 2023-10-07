<!DOCTYPE html>

<html lang="en">

    <!-- index -->
    <head>
        <title>Trivia Game | Landing Page</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nicolas Meneses">
        <meta name="description" content="Landing page for Trivia Game">
        <meta name="keywords" content="Trivia Game Online , Fun Games, Play with Friends">

        <?php include "templates/common_components/common_links.html" ?>

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


            .button_Design:hover{
                box-shadow: 0 12px 16px 0 rgba(0,0,0,0.20), 0 15px 45px 0 rgba(0,0,0,0.19);
            }
        </style>

    </head>

    <body style="background-color: aqua; font-family: 'Comic Neue', cursive;">

        <?php
            $navlinks = array(
                "Sign in" => "?command=login"
            );
            include "templates/common_components/navbar.php";
        ?>

        <!-- Landing page would go here, either in an include or just straight up. -->
        <section>
            <div class="col-12">
                <div style="margin-top: 5%">
                    <h1 style="font-size: 75px; color: black; text-align: center;" onmouseover="resize(this, '85px')" onmouseout="resize(this, '75px')"> THE ULTIMATE ONLINE TRIVIA GAME!</h1>
                </div>
                <div class="col-lg-7" style="float:none;margin:auto; margin-top: 5%; color: #e04a95; font-size: 90px">
                   <h2 style="font-size: 45px; margin-bottom: 10%; text-align: center" onmouseover="resize(this, '51px')" onmouseout="resize(this, '45px')">Join random players around the world or play with friends. </h2>
                    <div style="text-align: center">
                        <button type="button" class="btn btn-primary button_Design" style="height: 22%; width: 50%; background-color: yellowgreen; font-size: 40px; color: black" onclick="window.location.href='?command=newUser';">JOIN NOW!</button>
                    </div>
                </div>
            </div>
        </section>

        <?php include "templates/common_components/footer.html" ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script src="scripts/styleLandingPage.js"></script>
    </body>
</html>
