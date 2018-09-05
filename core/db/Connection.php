<?php

class Connection
{
    public static function make($config) {
        try {
            return new PDO(
                $config['connection'].';dbname='.$config['database'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            die('Error connecting to database: ' . $e->getMessage());
        }
    }
}
