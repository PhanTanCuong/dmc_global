<?php

namespace Core;

class DB
{
    public $connection;
    protected $servername = "localhost";
    protected $db_username = "root";
    protected $db_password = "";
    protected $db_name = "dmc_global";

    function __construct()
    {
        // in order to be sure we will see every error occurred in the script
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $this->connection = mysqli_connect($this->servername, $this->db_username, $this->db_password);
        mysqli_select_db($this->connection, $this->db_name);
        mysqli_set_charset($this->connection, "utf8"); //set utf8 for vietnamese characters

        // Check if connection is successful
        if (!$this->connection) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        // Select the database
        if (!mysqli_select_db($this->connection, $this->db_name)) {
            die("Database selection failed: " . mysqli_error($this->connection));
        }

        // Set the charset to utf8 for Vietnamese characters
        if (!mysqli_set_charset($this->connection, "utf8")) {
            die("Error loading character set utf8: " . mysqli_error($this->connection));
        }
    }
}
