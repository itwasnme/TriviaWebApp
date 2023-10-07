<?php


class GameManager {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function get_player_games($id, $id2=NULL)
    {
        # Add on a few new columns... p1_name and p2_name, to the returned games records.
        $base_query = "SELECT * from games inner join (select id as temp_p1_id, name as p1_name from players) p1_u on games.p1_id=p1_u.temp_p1_id inner join (select id as temp_p2_id, name as p2_name from players) p2_u on games.p2_id=p2_u.temp_p2_id ";

        if (isset($id2))
            return $this->db->query($base_query . "where (p1_id = ? and p2_id=?) or (p1_id = ? and p2_id = ?);", "ssss", $id, $id2, $id2, $id);

        return $this->db->query($base_query . "where p1_id = ? or p2_id = ?;", "ss", $id, $id);
    }

    public function create_game($p1_id, $p2_id)
    {
        $insert = $this->db->query("insert into games (p1_id, p2_id, turn) values (?, ?, ?);",
            "sss", $p1_id, $p2_id, $p1_id);

        if ($insert === false)
            error_log("Error inserting game between " . $p1_id . " and " . $p2_id . ".");
    }

    public function update_last_played($game_id)
    {
        $update = $this->db->query("UPDATE games SET last_played_date=now() WHERE id=?;",
            "s", $game_id);

        if ($update === false)
            error_log("Error updating game between " . $game_id .".");
    }

    public function finish_game($game_id, $winner_id, $loser_id)
    {
        // Update win/loss of player
        $this->db->query("UPDATE players SET wins = wins +1 WHERE id=?;",
            "s", $winner_id);
        $this->db->query("UPDATE players SET losses = losses + 1 WHERE id=?;",
            "s", $loser_id);

        $this->db->query("DELETE FROM games WHERE id=?;", "s", $game_id);
    }

    private function determine_if_player_one($game_id, $user_id)
    {
        $result = $this->db->query("SELECT * FROM games WHERE id=? AND p1_id=?;",
            "ss", $game_id, $user_id);

        $is_player_one = count($result);
        return $is_player_one;
    }

    private function swap_turns($game_id, $is_player_one)
    {
        $update = true;
        if ($is_player_one == true)
            $update = $this->db->query("UPDATE games SET turn=p2_id WHERE id=?;",
                "s", $game_id);
        else
            $update = $this->db->query("UPDATE games SET turn=p1_id WHERE id=?;",
                "s", $game_id);

        if ($update === false)
            error_log("Error updating game turns for " . $game_id .".");
    }

    private function check_if_game_won($game_id)
    {
        $score_limit = 5;
        $result = $this->db->query("SELECT * FROM games WHERE id=? AND p1_correct_answers >= ? OR p2_correct_answers >= ?;",
            "sss", $game_id, $score_limit, $score_limit);

        if (count($result) > 0)
        {
            $game = $result[0];

            // The game has finished. Clean it up!
            if ($game["p1_correct_answers"] > $game["p2_correct_answers"])
            {
                $winner_id = $game["p1_id"];
                $loser_id = $game["p2_id"];
            }
            else
            {
                $winner_id = $game["p2_id"];
                $loser_id = $game["p1_id"];
            }
            $this->finish_game($game_id, $winner_id, $loser_id);
        }

        return count($result) > 0;
    }

    public function handle_player_answered($game_id, $is_correct, $category, $player_id)
    {
        $this->update_last_played($game_id);
        $is_player_one = $this->determine_if_player_one($game_id, $player_id);

        # Update correct answers if correct.
        if ($is_correct === true)
        {

          ////Update wins per category
            if($category == "General Knowledge"){
              $this->db->query("UPDATE players SET general_knowledge_correct = general_knowledge_correct+1
                WHERE id = ?;", "i", $player_id);
            }
            if($category == "History"){
              $this->db->query("UPDATE players SET history_correct = history_correct+1
                WHERE id = ?;", "i", $player_id);
            }
            if($category == "Sports"){
              $this->db->query("UPDATE players SET sports_correct = sports_correct+1
                WHERE id = ?;", "i", $player_id);
            }
            if($category == "Science & Nature"){
              $this->db->query("UPDATE players SET science_correct = science_correct+1
                WHERE id = ?;", "i", $player_id);
            }
            if($category == "Art"){
              $this->db->query("UPDATE players SET art_correct = art_correct+1
                WHERE id = ?;", "i", $player_id);
            }
         ////

            $query = "UPDATE games SET ";

            if ($is_player_one)
                $query .= "p1_correct_answers = p1_correct_answers + 1";
            else
                $query .= "p2_correct_answers = p2_correct_answers + 1";

            $query .= " WHERE id=?;";
            $update = $this->db->query($query, "s", $game_id);

            if ($update === false)
                error_log("Error updating correct answers for game " . $game_id .".");

            # TODO: update category wins here too.
        }

        # Update turn.
      //$this->swap_turns($game_id, $is_player_one); -> Prevent cheating by reloading the page?
        return $this->check_if_game_won($game_id);
    }

    # Public swap method..
    public function swap_turns2($game_id, $user_id)
    {
        $is_player_one = $this->determine_if_player_one($game_id, $user_id);
        $this->swap_turns($game_id, $is_player_one);
    }

    # Get data for the statistics screen...
    public function get_player_statistics($user_id)
    {
      //Store wins per category (category is key).
      $categoryArray = array();
      //Array to be returned with all statistical data...
      $statistics = array();
      $statData = $this->db->query("select wins, losses, general_knowledge_correct, science_correct, sports_correct, history_correct, art_correct
      from players where id = ?;", "i",  $user_id);
      //Get data in array...
      foreach ($statData as $key => $value)
      {
        foreach ($value as $key1 => $value1)
        {
            if($key1=="wins") $statistics["wins"] = $value1;
            if($key1=="losses") $statistics["losses"] = $value1;
            //Store wins per Category...
            if($key1=="general_knowledge_correct") $categoryArray["General knowledge"] = $value1;
            if($key1=="science_correct") $categoryArray["Science"] = $value1;
            if($key1=="sports_correct") $categoryArray["Sports"] = $value1;
            if($key1=="history_correct") $categoryArray["History"] = $value1;
            if($key1=="art_correct") $categoryArray["Art"] = $value1;
        }
      }
      //Store best and word category using $caregoryArray
      $statistics["bestC"] = array_keys($categoryArray, max($categoryArray))[0];
      $statistics["worstC"] = array_keys($categoryArray, min($categoryArray))[0];
      // TDB:
      // Query for user's rank position based on numner of wins
      // Query for User's number of wins and losses in the last 7 days

      return $statistics;
    }

}
