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
    <body class="bg-info" style="background-color: aqua; font-family: 'Comic Neue', cursive; text-align: center;">

        <?php
            $navlinks = array(
                "Home" => "?command=home",
                "Account Statistics" => "?command=statistics",
                "Logout" => "?command=logout"
            );
            include "templates/common_components/navbar.php";
            #var_dump($question);
        ?>
				<div
			</div>

        <?php
            if ($is_correct)
                echo "<div class=\"alert alert-success\" role=\"alert\">" . $msg .   "</div>";
            else
                echo "<div class=\"alert alert-danger\" role=\"alert\">" . $msg .   "</div>";
        ?>
        <div class="question">
            <h1> <?php echo $question_text; ?> </h1>
        </div>
        <div style=" text-align: center;">
            <div class="row">
                <div class="col">
                    <button type="submit" class="col answer_choice
                    <?php
                        if (strcmp($answers[0], $correct_answer) == 0)
                            echo "bg-success";
                        else if (strcmp($answers[0], $chosen_answer) == 0)
                            echo "bg-danger";
                        else
                            echo "bg-primary";
                    ?>" style="text-decoration: none" disabled>
                        <strong style="color: black;"> <?php echo $answers[0]; ?> </strong>
                    </button>
                </div>
                <div class="col">
                    <button type="submit" class="col answer_choice
                    <?php
                        if (strcmp($answers[1], $correct_answer) == 0)
                            echo "bg-success";
                        else if (strcmp($answers[1], $chosen_answer) == 0)
                            echo "bg-danger";
                        else
                            echo "bg-primary";
                    ?>
                    " style="text-decoration: none" disabled>
                        <strong style="color: black;"> <?php echo $answers[1]; ?> </strong>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="col answer_choice
                    <?php
                        if (strcmp($answers[2], $correct_answer) == 0)
                            echo "bg-success";
                        else if (strcmp($answers[2], $chosen_answer) == 0)
                            echo "bg-danger";
                        else
                            echo "bg-primary";
                    ?> " style="text-decoration: none" disabled>
                        <strong style="color: black;"> <?php echo $answers[2]; ?> </strong>
                    </button>
                </div>
                <div class="col">
                    <button type="submit" class="col answer_choice
                    <?php
                        if (strcmp($answers[3], $correct_answer) == 0)
                            echo "bg-success";
                        else if (strcmp($answers[3], $chosen_answer) == 0)
                            echo "bg-danger";
                        else
                            echo "bg-primary";
                    ?> " style="text-decoration: none" disabled>
                        <strong style="color: black;"> <?php echo $answers[3]; ?> </strong>
                    </button>
                </div>
            </div>
        </div>

				<a href="?command=home" class="btn btn-secondary btn-lg" style="margin: 5%; height: 50px; width: 230px;" role="button" onmouseover="resizehw(this, '55px', '240px')" onmouseout="resizehw(this, '50px', '230px')">Back to Home Page</a>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
				<script src="scripts/styleQuestionAnswered.js"></script>
        <?php include "templates/common_components/footer.html" ?>

    </body>
</html>
