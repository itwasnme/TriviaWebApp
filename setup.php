<?php

spl_autoload_register(function ($classname){
  include "classes/$classname.php";
});


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); //let errors be reported

$string = file_get_contents("database/info.json");
$info_json = json_decode($string, true);

$db = new mysqli($info_json["host"], $info_json["username"],
                 $info_json["password"], $info_json["database"],);

$db ->query("drop table if exists users;");
$db->query("create table players(
    id int not null auto_increment,
    name text not null,
    email text not null,
    password text not null,
    wins int not null default 0,
    losses int not null default 0,
    general_knowledge_correct int not null default 0,
    science_correct int not null default 0,
    sports_correct int not null default 0,
    history_correct int not null default 0,
    art_correct int not null default 0,
    primary key (id)
);");

$db ->query("drop table if exists games;");
$db->query("create table games(
    id int not null auto_increment,
    p1_id int not null,
    p1_correct_answers int not null default 0,
    p2_id int not null,
    p2_correct_answers int not null default 0,
    turn int not null,
    last_played_date date default null,
    primary key (id)
);");
