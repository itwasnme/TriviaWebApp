<?php

class TriviaController {

    private $command;
    private $db;
    private $gm;

    public function __construct($command) {
        $this->command = $command;
        $this->db = new Database();
        $this->gm = new GameManager();
    }

    public function run() {
        switch($this->command) {
            case "question":
                $this->question();
                break;
            case "statistics":
                $this->statistics();
                break;
            case "userData":
                $this->statistics_json();
                break;
            case "play":
                $this->stop_play();
                break;
            case "home":
                $this->home();
                break;
            case "newUser":
                $this->register();
                break;
            case "login":
                $this->login();
                break;
            case "register":
                $this->register();
                break;
            case "logout":
                $this->destroySession();
                // fallthrough
            default:
                $this->landing();
                break;
        }
    }

    private function stop_play()
    {
        unset($_SESSION["cheat"]); //Attempt to avoid cheating by reloading questions... (bugs?)

        $question_text = $_SESSION["active_question"]["question_text"];
        $chosen_answer = html_entity_decode($_POST["chosen_answer"]);
        $correct_answer = html_entity_decode($_SESSION["active_question"]["correct_answer"]);
        $answers = array();
        foreach ($_SESSION["active_question"]["answers"] as $answer)
            array_push($answers, html_entity_decode($answer));

        # Process chosen answer
        $is_correct = (strcmp($correct_answer, $chosen_answer) == 0);
        {
            $category = $_SESSION["active_question"]["category"];
            $game_id = $_SESSION["active_question"]["game_id"];
            $player_id = $_SESSION["user_id"];
            $game_won = $this->gm->handle_player_answered($game_id, $is_correct, $category, $player_id);
        }

        if ($is_correct)
            if ($game_won)
                $msg = "You were right, and you won the game!!";
            else
                $msg = "You were right! Now it's your opponents turn...";
        else
            $msg = "You were wrong!";

        include("templates/question_answered.php");
    }

    private function load_random_question() {
        /*
         * category 9 is general knowledge
         * category 17 is science and nature
         * category 21 is sports
         * category 23 is history
         * category 25 is art
         * */
        $categories = array(9, 17, 21, 23, 25);
        $random_category = $categories[rand(0, count($categories) - 1)];

        $api_url = "https://opentdb.com/api.php?amount=1&category=" . $random_category . "&difficulty=easy&type=multiple";

        $triviaData = json_decode(file_get_contents($api_url), true);

        return $triviaData["results"][0];
    }

    private function start_play()
    {
        $game_id = $_POST["game_id"];

        ////Attempt to avoid cheating by reloading questions... (bugs?)
        $this->gm->swap_turns2($game_id, $_SESSION["user_id"]);

        # Update when the last turn started to now.
        $this->gm->update_last_played($game_id);

        # Load a random question.
        $question = $this->load_random_question();

        # Create scrambled answers array
        $question_text = $question["question"];
        $answers = $question["incorrect_answers"];
        array_push($answers, $question["correct_answer"]);
        shuffle($answers);

        # Store some data in session for processing when answered.
        $active_question = array(
            "correct_answer" => $question["correct_answer"],
            "category" => $question["category"],
            "game_id" => $game_id,
            "started" => time(),
            "question_text" => $question_text,
            "answers" => $answers
        );

        $_SESSION["active_question"] = $active_question;
        include("templates/question.php");
    }

    private function home()
    {
        $user_info = [
            "id" => $_SESSION["user_id"],
            "name" => $_SESSION["name"]
        ];

        # POST with intent to create a new page.
        if (isset($_POST["friendID"]) && $friend_id = $_POST["friendID"])
        {

            # Verify this friend ID is a different ID.
            if ($friend_id == $_SESSION["user_id"])
                $error_msg = "Type in friends ID, not yours!";

            # Verify this friend ID exists.
            else if (!$this->db->player_id_exists($friend_id))
                $error_msg = "The player id " . $friend_id . " doesn't belong to a real player!";

            # Verify a max of 3 games between players.
            else if (count($this->gm->get_player_games($_SESSION["user_id"], $friend_id)) >= 3)
                $error_msg = "You've already got 3 ongoing games with player " . $friend_id . "!";

            else
            {
                // Note the order here matters.
                // Making this user play first will make this user go first.
                $this->gm->create_game($_SESSION["user_id"], $friend_id);
                $success_msg = "A game was created between you and player " . $friend_id . ".";
            }
        }

        else if (isset($_POST["game_id"]) && !isset($_SESSION["cheat"]))
        {
            $_SESSION["cheat"] = 1; //Attempt to avoid cheating by reloading questions... (bug?)
            $this->start_play();
            return;
        }

        if( isset($_SESSION["cheat"]) && $_SESSION["cheat"] == 1){ //Attempt to avoid cheating by reloading questions...(bug?)
          unset($_SESSION["cheat"]);
        }

        # GET on the page.
        $games = $this->gm->get_player_games($_SESSION["user_id"]);

        # Probably can throw this logic into the sql query if we want
        $players_turn_games = array();
        $friends_turn_games = array();
        foreach ($games as $game)
        {
            if ($game["turn"] == $user_info["id"])
                array_push($players_turn_games, $game);

            else
                array_push($friends_turn_games, $game);
        }
        include("templates/home.php");
    }

    private function landing()
    {
        include("templates/landing_page.php");
    }

    // Available at ?command=userData
    private function statistics_json()
    {
        //Instead of calling get_player_statistics, get json for the user's statistics data!
        $jsonData = $this->db->query("select wins, losses, general_knowledge_correct, science_correct, sports_correct, history_correct, art_correct
        from players where id = ?;", "i",  $_SESSION["user_id"])[0];
        // this isn't working on the cs server
        // $jsonData["rank"] = $this->db->query("select rank from (select *, ROW_NUMBER() OVER(ORDER BY wins) rank from players) user WHERE user.id= ?;", "i", $_SESSION["user_id"])[0]["rank"];
        echo json_encode($jsonData, JSON_PRETTY_PRINT);
    }

    private function statistics()
    {
      $data = $this ->gm->get_player_statistics($_SESSION["user_id"]);
      $statisticsWins = $data["wins"];
      $statisticsLosses = $data["losses"];
      $bestCategory = $data["bestC"];
      $worstCategory = $data["worstC"];
      // TDB in GameManager.php (get_player_statistics nethod):
      // Query for user's rank position based on numner of wins
      // Query for User's number of wins and losses in the last 7 days
      include("templates/account_statistics.php");
    }


    private function destroySession() {
        session_destroy();
    }

    private static function update_session_data($data)
    {
        $_SESSION["name"] = $data["name"];
        $_SESSION["email"] = $data["email"];
        $_SESSION["user_id"] = $data["id"];
    }

    # Currently this method is a login/signup combo.
    # We should split this view into login/signup if we wanna make it cleaner.
    private function login() {
        $logged_in = false;
        if (isset($_POST["email"])) {
            $data = $this->db->query("select * from players where email = ?;", "s", $_POST["email"]);

            // Error checking for user
            if ($data === false){
                $error_msg = "Error checking for user";
              }

            // User exists, authenticate them.
            else if (!empty($data))
            {
                if (password_verify($_POST["password"], $data[0]["password"]))
                {
                    // If authenticated, fill session data.
                    TriviaController::update_session_data($data[0]);
                    $logged_in = true;
                }else{
                  $error_msg = "Invalid username and password combination!";
                }
            }else{
              $error_msg = "Invalid username and password combination!";
            }
        }

        if ($logged_in)
        {
            header("Location: ?command=home");
            include("templates/home.php");
        }
        else
        {
            include("templates/login.php");
        }
    }

    private function register() {
      $logged_in = false;
      if (isset($_POST["email"])) {
          $data = $this->db->query("select * from players where email = ?;", "s", $_POST["email"]);

          // Error checking for user
          if ($data === false)
              $error_msg = "Error checking for user";

          // User exists, authenticate them.
          else if (!empty($data))
          {
            $error_msg = "A username with that email already exists!";
          }

          // User doesn't exist, create one.
          else
          { //REGEX REQUIREMENT HERE
            if(preg_match("/^[a-zA-Z]{3,20}$/", $_POST["name"]))
            {
                  $insert = $this->db->query("insert into players (name, email, password) values (?, ?, ?);",
                          "sss", $_POST["name"], $_POST["email"],
                          password_hash($_POST["password"], PASSWORD_DEFAULT));

                  if ($insert === false)
                  {
                      $error_msg = "Error inserting user";
                  }
                  else
                  {
                      $data = $this->db->query("select * from players where email = ?;", "s", $_POST["email"]);
                      TriviaController::update_session_data($data[0]);
                      $logged_in = true;
                  }
              }
              else
              {
                echo "<b> Invalid name! </b>";
              }
          }
      }

      if ($logged_in)
      {
          header("Location: ?command=home");
          include("templates/home.php");
      }
      else
      {
          include("templates/register.php");
      }
    }

    /* Used for sprint 2 to show question screen?
    public function question() {
        include("templates/question.php");
    }
    */
}
