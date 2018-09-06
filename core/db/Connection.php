<?php

class Connection
{
    public static function make($config) {
        try {
            return new PDO(
                $config['connection'].';dbname='.$config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            $msg = 'Error connecting to database: ' . $e->getMessage();
            throw new Exception($msg);
        }
    }
}
