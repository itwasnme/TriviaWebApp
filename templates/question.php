<!DOCTYPE html>
<html lang="en">
	<head>
			<title>Trivia Game | Question </title>
			<meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="author" content="Eric Chandrasekhar and Nicolas Meneses">
            <meta name="description" content="Example Question for Trivia Game">
            <meta name="keywords" content="Trivia Game Online , Fun Games, Play with Friends">

            <link rel="stylesheet" href="styles/question_styling.css" />
            <?php include "templates/common_components/common_links.html" ?>
    </head>
    <body class="bg-info" style="background-color: aqua; font-family: 'Comic Neue', cursive;">

        <?php
            $navlinks = array(
                //"Home" => "?command=home",
                //"Trivia Question" => "?command=question",
                //"Account Statistics" => "?command=statistics",
                "Logout" => "?command=logout"
            );
            include "templates/common_components/navbar.php";
            #var_dump($question);
        ?>

        <div class="question">
        <h1> <?php echo $question_text; ?> </h1>
        </div>
        <div style=" text-align: center;">
            <div class="row">
                <div class="col">
                    <form action="?command=play" method="post">
                        <input type="hidden" name="chosen_answer" value='<?php echo $answers[0]; ?>'/>
                        <button type="submit" class="col answer_choice bg-primary" style="text-decoration: none">
                            <strong style="color: black;"> <?php echo $answers[0]; ?> </strong>
                        </button>
                    </form>
                </div>
                <div class="col">
                    <form action="?command=play" method="post">
                        <input type="hidden" name="chosen_answer" value='<?php echo $answers[1]; ?>'/>
                        <button type="submit" class="col answer_choice bg-primary" style="text-decoration: none">
                            <strong style="color: black;"> <?php echo $answers[1]; ?> </strong>
                        </button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form action="?command=play" method="post">
                        <input type="hidden" name="chosen_answer" value='<?php echo $answers[2]; ?>'/>
                        <button type="submit" class="col answer_choice bg-primary" style="text-decoration: none">
                            <strong style="color: black;"> <?php echo $answers[2]; ?> </strong>
                        </button>
                    </form>
                </div>
                <div class="col">
                    <form action="?command=play" method="post">
                        <input type="hidden" name="chosen_answer" value='<?php echo $answers[3]; ?>'/>
                        <button type="submit" class="col answer_choice bg-primary" style="text-decoration: none">
                            <strong style="color: black;"> <?php echo $answers[3]; ?> </strong>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row timer">
             <!-- <h1> 9 </h1> -->
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

        <?php include "templates/common_components/footer.html" ?>

    </body>
</html>
