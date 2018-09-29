<?php
/**
 * @package     init.php
 * @author      Ahmet Kamis <hi@ahmetkamis.com>
 * @copyright   2018 © Ahmet Kamis
 *
 */


define('APP_DIR', __DIR__);

#load config
require_once APP_DIR.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR.'Config.php';

#load app
require_once APP_DIR.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR.'Route.php';
require_once APP_DIR.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR.'Model.php';
require_once APP_DIR.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR.'Controller.php';
require_once APP_DIR.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR.'App.php';

#load models
require_once APP_DIR.DIRECTORY_SEPARATOR.'App'.DIRECTORY_SEPARATOR.'Models'.DIRECTORY_SEPARATOR.'Test.php';

#load controllers
require_once APP_DIR.DIRECTORY_SEPARATOR.'App'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'Test.php';

#load helpers
require_once APP_DIR.DIRECTORY_SEPARATOR.'App'.DIRECTORY_SEPARATOR.'Helpers'.DIRECTORY_SEPARATOR.'Database.php';