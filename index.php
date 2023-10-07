<?php

// Register the autoloader
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

session_start();

// Parse the query string for command
$command = "landing";
if (isset($_GET["command"]))
    $command = $_GET["command"];

// If the user's email is not set in the the SESSION, then it's not
// a valid session (they didn't get here from the login page),
// so we should send them over to log in first before doing
// anything else!
if (!isset($_SESSION["email"]) && $command != "login" && $command!= "newUser") { // TODO: update this with verification method
    // they need to see the login
    $command = "landing";
}

// Instantiate the controller and run
$trivia_game = new TriviaController($command);
$trivia_game->run();
