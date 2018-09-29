<?php
/**
 * @package     Post.php
 * @author      Ahmet Kamis <hi@ahmetkamis.com>
 * @copyright   2018 © Ahmet Kamis
 *
 */

class Post extends Model {
    function __construct()
    {
        echo "Post model construct \n";
        parent::__construct();
    }
}