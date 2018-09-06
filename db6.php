<?php
    class db
    {
        private $dsn = "mysql:dbname=db_stud; host=localhost";
        private $username = "root";
        private $password = '';
        private static $instance;

        private function __construct()
        {
            $this->connection = new PDO($this->dsn, $this->username, $this->password);
        }

        public static function getinstance()
        {
            if(!self::$instance)
            {
                self::$instance = new db;
            }

            return self::$instance->connection;
        }
    }
?>