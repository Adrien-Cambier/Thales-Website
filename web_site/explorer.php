<?php
    /*

    */
    class Explorer
    {
        private $db_path;
        public $dbh;
    
        public function __construct($db_path)
        {
            $this->db_path = $db_path;
        }
    
        /*
            Opens the database.

            Return - true - in case of success.
                   - false - otherwise.
        */
        public function open_database() 
        {
            // Checks if the database exists
            if (! is_file($this->db_path))
            {
                return false;
            }
 
            try
            {
                $this->dbh = new PDO("sqlite:" . $this->db_path);
                return true;
            }
            catch (PDOException $e) 
            {
                return false;
            }
        }

        /*
            Runs SQL queries (no SQL injections possible).
        */
        public function run_sql_query($query, $params_to_bind = array())
        {
            $statement = $this->dbh->prepare($query);
            
            /*
                Binds params (if any) to avoid SQL injections. 
            */
            foreach ($params_to_bind as $param => $value)
            {
                $statement->bindValue($param, $value);
            }
            
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        /*
            Displays an error.

            msg - the error msg.
        */
        public function display_error($msg)
        {
            echo "[ERROR]: $msg";
        }
    }
?>