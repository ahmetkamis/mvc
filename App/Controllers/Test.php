<?php
/**
 * @package     Test.php
 * @author      Ahmet Kamis <hi@ahmetkamis.com>
 * @copyright   2018 © Ahmet Kamis
 *
 */


class TestController extends Controller {


    function __construct()
    {
        echo "TestController construct";
    }

    function index() {
        echo "TestController/Index";
    }


}