<?php

class Connection
{
    public static function make() {
        try {
            return PDO('mysql:host=localhost:8889;dbname=magivax', 'magivax_user', 'anti-anti-vax');
        } catch (PDOException $e) {
            die('Error connecting to database: ' . $e->getMessage());
        }
    }
}
