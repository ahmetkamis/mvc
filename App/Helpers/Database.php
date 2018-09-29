<?php
/**
 * @author      Ahmet Kamis
 * @web         www.ahmetkamis.com
 * @email       hi@ahmetkamis.com
 * @copyright   2017
 * @version     1.0
 */

class Database extends PDO
{
    public $dbh; //database handler!

    private static $instance;

    public $error = '';
    
    public function __construct($host,$name,$user,$pass, $charset, $timezone_offset)
    {

        echo "Database class construct \n";

        try {
            //$initArr = array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '+00:00'");
            parent::__construct('mysql:host=' . $host .';dbname=' . $name, $user, $pass);
        }
        catch (\PDOException $e) {
            echo $e->getMessage();
            die('database connection error.');
        }

        //db charset.
        if (defined('DB_CHARSET')) {
            $this->query('SET NAMES `' . $charset . '`');
        }
        else {
            $this->query('SET NAMES `UTF-8`');
        }

        //timezone offset.
        if (defined('DB_TIMEZONE_OFFSET'))  {
            $this->exec("SET time_zone = '".$timezone_offset."'");
        }

        //additional options
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); //def. fetch mode is object.
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); //err. mode is exception
        $this->setAttribute(PDO::ATTR_TIMEOUT, 59); //timeout 59 secs.


    }
    
    //instance for db connection
    public static function getInstance($host,$name,$user,$pass, $charset, $timezone_offset)
    {
        if (!isset(self::$instance))
        {
            $object = __CLASS__;
            self::$instance = new $object($host,$name,$user,$pass, $charset, $timezone_offset);
        }
        return self::$instance;
    }
    
    
    // PDO::fetch()
    public function getSingle ($query, $bind = []) {
        
        try {
            $prep = $this->prepare($query);
            $prep->execute($bind);
            $return = $prep->fetch(PDO::FETCH_OBJ);
        }
        catch(PDOException $e) {
            $return = false;
            $this->error = $e->errorInfo;
        }
        
        return $return;   
    }
    
    // PDO::fetchAll()
    public function getMultiple ($query, $bind = []) {
        
        try {
            $prep = $this->prepare($query);
            $prep->execute($bind);
            $return = $prep->fetchAll(PDO::FETCH_OBJ);
        }
        catch(PDOException $e) {
            $return = false;
            $this->error = $e->errorInfo;
        }
        return $return;
    
    }    
    
    //PDO:rowCount()
    public function getCount ($query, $bind = []) {
        try {
            $prep = $this->prepare($query);
            $prep->execute($bind);

            //new - rowCount() has bug
            //so we do it with fetchAll()
            $rows = $prep->fetchAll();
            $rowCount = count($rows);
            //end new

            return $rowCount;
        }
        catch(PDOException $e) {
            $return = false;
            $this->error = $e->errorInfo;
        }
        return $return;
    }

    //PDO:Query
    public function singleQuery ($query, $bind = []) {
        try {
            $prep = $this->prepare($query);
            $prep->execute($bind);
            $return = true;
        }
        catch(PDOException $e) {
            $return = false;
            $this->error = $e->errorInfo;
        }
        return $return;
    }

   /**
    * 
    * Update()
    * 
    * Updates multiple values for a table. 
    * 
    * @param $tableName (string) name of the table to update.
    * @param $bind[] (array) values to change.
    *        ['column_name' => 'new value'] ['name' => 'new name', 'email' => 'newemail@email.com', ...];
    * @param $where[] (array) where clause ['user_id' = 1];
    * 
    * @return (bool)
    * */ 
   public function Update ($tableName, $bind = [], $where=[]) {
        #check the args if they are set and array and not empty **/
        if ( (isset($tableName)) && (!empty($tableName)) && (count($bind) > 0) && (count($where) > 0) ) {  
            foreach ($bind as $key => $val) { //set array values for pdo bind
                $columNames[] = $key.'=:'.$key;
            }        
            foreach ($where as $key => $val) { //set where condition array values for pdo bind
                $whereColumns[] = $key.'=:'.$key;
            }
            $bindMerged = array_merge($bind, $where); //merge those two array for bind
            $query = 'UPDATE '.$tableName.' SET '.implode(',',$columNames).' WHERE '.implode(' AND ',$whereColumns);
            
            try {
                $prep = $this->prepare($query);
                $prep->execute($bindMerged);
                $return = true; //need to get the catch, so, return is not here.
            }
            catch(PDOException $e) {
                $this->error = $e->errorInfo;
                $return = false;
            }
            return $return;
        }
        else {
            $this->error = "Method arguments are not valid.";
            return false;
        }
    }
    
    /**
     * 
     * Insert()
     * 
     * Inserts a new row to table.
     * 
     * @param $tableName (string) name of the table to instert.
     * @param $bind (array) values to be inserted to table. 
     *        ["colum_name" => "value", "another_colum" => "another_value", .....]
     * 
     * @return (bool)
     * 
     * */
    public function Insert ($tableName, $bind = []) {
        #check the args if they are set and array and not empty **/
        if ( (isset($tableName)) && (!empty($tableName)) && (is_array($bind)) && (count($bind) > 0) ) {
            
            $query = 'INSERT INTO '.$tableName.' ('.implode(", ",array_keys($bind)).') VALUES (:'.implode(", :",array_keys($bind)).')';

            try {
                $prep = $this->prepare($query);
                $prep->execute($bind);
                $return = true; //need to get the catch, so, return is not here.
            }
            catch(PDOException $e) {
                $this->error = $e->errorInfo;
                $return = false;
            }
            
            return $return;

        }
        else {
            $this->error = "Method arguments are not valid.";
            return false;
        }
    } 
    
    
    public function getError() {
        return $this->error;
    }     
}