<?php

define('ALLOW_MISSING', 0);
define('MUST_EXIST', 1);
define('ALLOW_MULTIPLES', 2);

class Query
{
    const DB_ACTION_CREATE = 1;
    const DB_ACTION_READ   = 2;
    const DB_ACTION_UPDATE = 3;
    const DB_ACTION_DELETE = 4;
    protected $pdo;
    protected $reads = 0;
    protected $writes = 0;
    protected $queryStart;
    protected $queryTime = 0;
    protected $tables;
    protected $columns = array();

    /**
     * Constructor
     * 
     * @param PDO object $pdo A PDO object representing a connection to a DB
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Initialize any SQL query
     * 
     * @param int $action database action (constant Query::DB_ACTION_*)
     */
    protected function startQuery($action)
    {
        switch ($action) {
            case self::DB_ACTION_READ:
                $this->reads++;
                break;
            case self::DB_ACTION_CREATE:
            case self::DB_ACTION_UPDATE:
            case self::DB_ACTION_DELETE:
                $this->writes++;
        }
        $this->queryStart = microtime(true);
    }
    
    /**
     * Conclude any SQL query, logging the time it took
     */
    protected function endQuery()
    {
        $this->queryTime += microtime(true) - $this->queryStart;
    }

    /**
     * Initialize any SQL query
     * 
     * @param int $action database action (constant Query::DB_ACTION_*)
     */
    public function getAll($table)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$table}");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Queries the DB and returns a single record object
     * 
     * @param string $query The SQL query with param placeholders
     * @param array $params An array of parameters
     * @param int $strictness What to do if no result or more than 1 result 
     *          Use ALLOW_MISSING, MUST_EXIST, ALLOW MULTIPLES
     * @return false | single record object
     */
    public function getRecord($query, $params, $strictness = ALLOW_MISSING) 
    {
        if (strpos($query, 'SELECT') !== 0) {
            throw new Exception('Use Query::getRecord ONLY to run SELECT statements.');
        }
        
        $this->startQuery(self::DB_ACTION_READ);
        $stmt = $this->prepareExecute($query, $params, self::DB_ACTION_READ);
        
        $fetch = $stmt->fetchAll();
        if (!is_null($fetch) and $fetch === false) {
            // fetch failed
            $this->reads--;
            throw new Exception('Failed to fetch results for query: ' . "\n" . $stmt->queryString);
        } else if (!count($fetch) and $strictness == MUST_EXIST) {
            // No results found
            throw new Exception('No record found for query: ' . "\n" . $stmt->queryString);
        } else if (count($fetch) > 1 and $strictness != ALLOW_MULTIPLES) {
            // More than one result found
            throw new Exception('More than one record found for query: ' . "\n" . $stmt->queryString);
        } else {
            $this->endQuery();
            if (!count($fetch)) {
                return false;
            } else {
                return reset($fetch);
            }
        }
    }
    
    /**
     * Queries the DB and returns a single field from a record object
     *
     * @param string $table
     * @param string $field
     * @param array $params An array of parameters
     * @param int $strictness What to do if no result or more than 1 result 
     *          Use ALLOW_MISSING, MUST_EXIST, ALLOW MULTIPLES
     * @return string
     */
    public function getField($table, $field, $params = array(), $strictness = ALLOW_MISSING) {
        if (!is_array($params)) {
            throw new Exception('$params must be an array.');
        }
        if (!in_array($table, $this->get_tables(true))) {
            throw new Exception("Table $table not found in database.");
        }        
        $select = "SELECT $field FROM $table";
        $queryparams = array();        
        if (!empty($params)) {
            $where = " WHERE ";
            $i = 1; // There's at least one parameter
            foreach ($params as $param => $value) {
                $where .= "$param = ?";
                $queryparams[] = $value;
                if ($i < count($params)) {
                    $where .= " AND ";
                }
                $i++;
            }
        }        
        $query = $select.$where;
        $record = $this->getRecord($query, $queryparams, $strictness);
        return $record->$field;
    }
    
    /**
     * Queries the DB and returns an array of record object
     * 
     * @param string $query The SQL query with param placeholders
     * @param array $params An array of parameters
     * @return array of record objects
     */
    public function getRecords($query, $params) 
    {
        if (strpos($query, 'SELECT') !== 0) {
            throw new coding_exception('Use Query::getRecords ONLY to run SELECT statements.');
        }
        
        $this->startQuery(self::DB_ACTION_READ);
        $stmt = $this->prepareExecute($query, $params, self::DB_ACTION_READ);
        
        $fetch = $stmt->fetchAll();
        if ($fetch === false) {
            // fetch failed
            $this->reads--;
            throw new Exception('Failed to fetch results for query: ' . "\n" . $query);
        } else {
            $this->endQuery();
            return $fetch;
        }
    }

    /**
     * Runs a sql INSERT statement
     * 
     * @param string $query The SQL query with param placeholders
     * @param array $params An array of parameters
     * @return int id of new record
     */
    public function insertRecord($query, $params)
    {
        if (strpos($query, 'INSERT INTO') !== 0) {
            throw new Exception('Use Query::insertRecord ONLY to run INSERT statements.');
        }
        
        $this->startQuery(self::DB_ACTION_CREATE);
        if ($this->prepareExecute($query, $params, self::DB_ACTION_CREATE)) {
            $this->endQuery();
            return $this->pdo->lastInsertId();
        } else {
            // insert failed
            $this->writes--;
            return false;
        }
    }

    /**
     * Runs a sql UPDATE statement
     * 
     * @param string $query The SQL query with param placeholders
     * @param array $params An array of parameters
     * @return true for success
     */
    public function updateRecord($query, $params) 
    {
        if (strpos($query, 'UPDATE') !== 0) {
            throw new Exception('Use Query::updateRecord ONLY to run UPDATE statements.');
        }
        
        $this->startQuery(self::DB_ACTION_UPDATE);
        if ($this->prepareExecute($query, $params, self::DB_ACTION_UPDATE)) {
            $this->endQuery();
            return true;
        }
        return false;
    }

    /**
     * Runs a sql DELETE statement
     * 
     * @param string $query The SQL query with param placeholders
     * @param array $params An array of parameters
     * @return true|false
     */
    public function deleteRecord($query, $params = array()) 
    {
        if (strpos($query, 'DELETE') !== 0) {
            throw new coding_exception('Use Query::deleteRecord ONLY to run DELETE statements.');
        }
        
        $this->startQuery(self::DB_ACTION_DELETE);
        $deleteSuccess = (bool) $this->prepareExecute($query, $params, self::DB_ACTION_DELETE);
        $this->endQuery();
        if (!$deleteSuccess) {
            $this->writes--;
        }
        return $deleteSuccess;
    }

    /**
     * Prepare and execute a sql statement
     * 
     * @param string $query The SQL query with param placeholders
     * @param array $params An array of parameters
     * @param int $action database action (constant Query::DB_ACTION_*)
     * @return PDO statement object
     */
    protected function prepareExecute($query, $params, $action)
    {
        if (!is_array($params)) {
            throw new Exception('$params must be an array.');
        }
        if (!in_array($action, array(
            self::DB_ACTION_CREATE,
            self::DB_ACTION_READ,
            self::DB_ACTION_UPDATE,
            self::DB_ACTION_DELETE,
        ))) {
            throw new Exception('Bad action passed to Query::prepare_execute.');
        }        
        try {
            $stmt = $this->pdo->prepare($query);
        } catch (Exception $e) {
            throw new Exception('There was a problem preparing the SQL statement:' . "\n" . $query);
        }        
        try {
            $stmt->execute($params);
        } catch (Exception $e) {
            $debug = 'Debug info: '.$this->debugInfo($stmt);
            throw new Exception("There was a problem executing the SQL statement:\n$query\n$debug");
        }        
        return $stmt;
    }

    /**
     * Get the PDO-provided debug information about a statement
     * 
     * @param PDO_statement $stmt The PDO statement objecty
     * @return string
     */
    protected function debuginfo($stmt) 
    {
        ob_start();
        $stmt->debugDumpParams();
        $debuginfo = ob_get_clean();
        return $debuginfo;
    }

    /**
     * Returns the number of reads done by this database.
     * @return int Number of reads.
     */
    public function perfGetReads() 
    {
        return $this->reads;
    }
    
    /**
     * Returns the number of writes done by this database.
     * @return int Number of writes.
     */
    public function perfGetWrites() 
    {
        return $this->writes;
    }
    
    /**
     * Time waiting for the database engine to finish running all queries.
     * @return float Number of seconds with microseconds
     */
    public function perfGetQueriesTime() 
    {
        return $this->queryTime;
    }
    
    /**
     * Get a list of the tables in the database 'magivax'
     * @param bool $usecache
     * @return array
     */
    public function getTables($usecache = true) 
    {
        if ($usecache and $this->tables !== null) {
            return $this->tables;
        }
        $this->startQuery(self::DB_ACTION_READ);
        $stmt = $this->pdo->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'magivax'");
        $tables = $stmt->fetchAll();
        $this->endQuery();
        foreach ($tables as $table) {
            $this->tables[] = $table->table_name;
        }        
        return $this->tables;
    }
    
    /**
     * Get a list of columns in a given table
     * @param str table
     * @param bool $usecache
     * @return array
     */
    public function getColumns($table, $usecache = true) 
    {
        if ($usecache and isset($this->columns[$table])) {
            return $this->columns[$table];
        }        
        $this->startQuery('read');
        $stmt = $this->connection->query(
            "SELECT column_name FROM information_schema.columns 
             WHERE table_schema = 'magivax' AND table_name = '{$table}'"
        );
        $columns = $stmt->fetchAll();
        $this->endQuery();
        foreach ($columns as $column) {
            $this->columns[$table][] = $column->column_name;
        }        
        return $this->columns[$table];
    }
}
