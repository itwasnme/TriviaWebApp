<!DOCTYPE html>
<html lang="en">
	<head>
        <title>Trivia Game | TBD </title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Eric Chandrasekhar">
        <meta name="description" content="TBD Page">
        <meta name="keywords" content="Trivia Game Online , Fun Games, Play with Friends">

        <?php include "templates/common_components/common_links.html" ?>
    </head>
    <body style="background-color: aqua; font-family: 'Comic Neue', cursive;">
        
        <?php
            $navlinks = array(
                "Home" => "?command=home",
                "Trivia Question" => "?command=question",
                "Account Statistics" => "?command=statistics",
                "Logout" => "?command=logout"
            );
            include "templates/common_components/navbar.php";
        ?>

        <h1> Page TBD </h1>
        
        <?php include "templates/common_components/footer.html" ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    

    </body>
</html>

