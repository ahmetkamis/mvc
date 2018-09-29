<?php
/**
 * @package     Model.php
 * @author      Ahmet Kamis <hi@ahmetkamis.com>
 * @copyright   2018 © Ahmet Kamis
 *
 */


class Model {

    public $Database;

    public function __construct() {

        echo "Base Model Contstruct\n";

        $this->Database = Database::getInstance(DB_HOST,DB_NAME,DB_USER,DB_PASS, DB_CHARSET, DB_TIMEZONE_OFFSET);

    }

    public function create() {

    }

    public function save() {

    }

    public function update() {

    }

    public function get() {

    }


    function __get($name)
    {
        // TODO: Implement __get() method.
    }

    function __set($name, $value)
    {
        // TODO: Implement __set() method.
    }
    function __isset($name)
    {
        // TODO: Implement __isset() method.
    }
    function __unset($name)
    {
        // TODO: Implement __unset() method.
    }

}