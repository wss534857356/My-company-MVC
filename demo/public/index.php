<?php
/**
 * Created by PhpStorm.
 * User: wengshenshun
 * Date: 2015/10/28
 * Time: 0:16
 */
define('DS',DIRECTORY_SEPARATOR);
define('ROOT',dirname(dirname(__FILE__)));
$url = $_GET['url'];
require_once(ROOT.DS.'library'.DS.'bootstrap.php');