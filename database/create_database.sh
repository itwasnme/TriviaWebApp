!/bin/bash

db_name=`jq -r .database info.json`

./connect_to_database.sh << EOF

DROP DATABASE IF EXISTS $db_name;
CREATE DATABASE if NOT EXISTS $db_name; 

CONNECT $db_name;

CREATE TABLE players (
    id int not null auto_increment,
    name text not null,
    email text not null,
    password text not null,
    wins int not null default 0,                  -- game wins
    losses int not null default 0,                -- game losses
    
    -- category correct answers
    general_knowledge_correct int not null default 0,
    science_correct int not null default 0,
    sports_correct int not null default 0,
    history_correct int not null default 0,
    art_correct int not null default 0,
    --
    
    primary key (id)
); # todo add question stuff

CREATE TABLE games (
    id int not null auto_increment,
    p1_id int not null,                         -- the user who started the game, and played first.
    p1_correct_answers int not null default 0,  -- num correct trivia answers for p1
    p2_id int not null,               
    p2_correct_answers int not null default 0,
    turn int not null,                          -- the current turn (should be either p1_id or p2_id)
    last_played_date date default null,         -- datetime that last turn was played
    primary key (id)
);

EOF
