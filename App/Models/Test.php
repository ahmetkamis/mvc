<?php
/**
 * @package     Test.php
 * @author      Ahmet Kamis <hi@ahmetkamis.com>
 * @copyright   2018 © Ahmet Kamis
 *
 */


class TestModel extends Model {

    function __construct()
    {
        echo "TestModel construct\n";

        parent::__construct();
    }

    public function SelamYaz() {

        echo "Selam\n";

    }


}