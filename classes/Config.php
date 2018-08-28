<?php

// put your code here
class Config {

    private $_host = 'localhost';
    private $_username = 'root';
    private $_password = 'root';
    private $_database = 'newsarticledatabase';
    protected $connection;

    public function __construct() {
        if (!isset($this->connection)) {

            $this->connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

            if (!$this->connection) {
                echo 'Cannot connect';
                exit;
            } 
        }

        return $this->connection;
    }

}

?>
   