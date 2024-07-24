<?php 
    class DB{
        public $connection;
        protected $servername = "localhost";
        protected $db_username = "root";
        protected $db_password = "";
        protected $db_name = "dmc_global";

        function __construct(){
            $this->connection = mysqli_connect($this->servername, $this->db_username,$this->db_password);
            mysqli_select_db($this->connection, $this->db_name);
            mysqli_set_charset($this->connection, "utf8");//set utf8 for vietnamese characters

            if (mysqli_connect_errno()) {
                die("Database connection failed: " . mysqli_connect_error());
            }
        }
    }
?>