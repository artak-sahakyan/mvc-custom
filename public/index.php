<?php
use app\components\Router;

define('ROOT', dirname(dirname(__FILE__).'../'));
require_once(ROOT.'/configs/db.php');
require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/components/Database.php');
require_once(ROOT.'/components/BaseModel.php');
require_once(ROOT.'/models/AdminModel.php');
require_once(ROOT.'/models/TaskModel.php');
require_once(ROOT.'/components/BaseController.php');
require_once(ROOT.'/components/Session.php');

$router = new Router();
echo $router->run();