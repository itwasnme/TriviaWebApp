<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Trivia Game | Register</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Eric Chandrasekhar and Nicolas Meneses">
        <meta name="description" content="Login for Trivia Game">
        <meta name="keywords" content="Trivia Game Online , Fun Games, Play with Friends, Game's Register page">

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

        </style>
    </head>

    <body style="background-color: aqua; font-family: 'Comic Neue', cursive;">
        <?php
            $navlinks = array(
              "Sign in" => "?command=login"
            );
            include "templates/common_components/navbar.php";
        ?>

        <div class="row justify-content-center">

            <?php
            if (isset($error_msg))
                echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error_msg .   "</div>";
            ?>
            <div class="col-4" style="margin-top:5%;">
            <form action="?command=newUser" method="post" onsubmit="return validate();">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" required="required" class="form-control" id="email" name="email"/>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name"/>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" required="required" class="form-control" id="password" name="password"/>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </div>
                <div class="text-center" style="margin: 20px; font-Size: 80%;">
                <a href='?command=login'>Have an Account Already? Log in! </a>
                </div>
            </form>
            </div>
        </div>

        <?php include "templates/common_components/footer.html"?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script src="scripts/registerValidation.js"> </script>

    </body>
</html>
