<?php

include 'Config.php';

/**
 * Description of CRUD
 * retrieve data, delete, update, insert from database
 * @author Moomal
 */
class Articles extends Config {

    public function __construct() {
        parent::__construct();
    }

    public function readAll($table, $rows = '*', $where = null, $order = null, $limit = null) {
        $q = 'SELECT ' . $rows . ' FROM ' . $table;
        if ($where != null)
        {  $q .= ' WHERE ' . $where;}
        if ($order != null)
        {$q .= ' ORDER BY ' . $order;}
        if ($limit != null)
        {$q .= ' LIMIT ' . $limit;}

        $result = $this->connection->query($q);
        if ($result) {
            $rows = array();

            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }

            return $rows;
        } else {
            return false;
        }
    }

    public function execute($query) {
        $result = $this->connection->query($query);

        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    public function escape_string($text) {
        return $this->connection->real_escape_string($text);
    }

    //for getting a certain amount of words for the title and text in the view all page for admin

    function get_snippet($str, $wordCount) {
        return implode(
                '', array_slice(
                        preg_split(
                                '/([\s,\.;\?\!]+)/', $str, $wordCount * 2 + 1, PREG_SPLIT_DELIM_CAPTURE
                        ), 0, $wordCount * 2 - 1
                )
        );
    }

}
