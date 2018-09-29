<?php
/**
 * @package     index.php
 * @author      Ahmet Kamis <hi@ahmetkamis.com>
 * @copyright   2018 © Ahmet Kamis
 *
 */

require_once "init.php";

$App = new App();

//$App->Test()->SelamYaz();

$test = new TestModel();
$test->SelamYaz();

$post = new Post();