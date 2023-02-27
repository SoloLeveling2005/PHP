<?php

include 'INewsDB.class.php';
//use INewsDB;

const DB_NAME = 'news.db';

class NewsDB implements INewsDB {
    private $_db = 'news.db';
    function __construct()
    {
        $db_file = fopen(DB_NAME, "w");
        fclose($db_file);
//        echo "open\n";
        $this->_db = new SQLite3($this->_db);
        $this->_db->exec("CREATE TABLE IF NOT EXISTS msgs(
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT,
            category INTEGER,
            description TEXT,
            source TEXT,
            datetime INTEGER
        )");
        $this->_db->exec("CREATE TABLE category(
            id INTEGER,
            name TEXT
        )");

    }

    function saveNews($title, $category, $description, $source) {
        $dt = (new DateTimeImmutable())->getTimestamp();
        $req = $this->_db->exec("INSERT INTO msgs (title,category,description,source,datetime) VALUES ('$title', $category, '$description', '$source', $dt)");
        if ($req) {
            return True;
        } else {
            return False;
        }

    }
    function getNews() {

    }
    function showNews($id) {

    }

    function __destruct () {
//        echo "close\n";
        $this->_db->close();
    }
}
