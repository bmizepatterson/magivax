<?php

class Query
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$table}");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
