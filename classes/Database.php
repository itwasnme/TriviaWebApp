<?php

class Database {
    private $mysqli;

    public function __construct() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $string = file_get_contents("database/info.json");
        $info_json = json_decode($string, true);
        $this->mysqli = new mysqli(  //Used to create a new instance of the mysqli class, which represents a connection to a MySQL database.
            $info_json["host"], 
            $info_json["username"], 
            $info_json["password"], 
            $info_json["database"]);
    }

    public function query($query, $bparam=null, ...$params) {
        error_log($query);
        $stmt = $this->mysqli->prepare($query);

        if ($bparam != null)
            $stmt->bind_param($bparam, ...$params);

        if (!$stmt->execute()) {
            return false;
        }

        if (($res = $stmt->get_result()) !== false) {
            return $res->fetch_all(MYSQLI_ASSOC);
        }

        return true;
    }

    public function player_id_exists($id)
    {
        $data = $this->query("select * from players where id = ?;", "s", $id);

        return !(empty($data));
    }
}
