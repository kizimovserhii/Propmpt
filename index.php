<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';

use app\Controllers\RouteController;
use Pecee\SimpleRouter\SimpleRouter as Router;

RouteController::loadRoutes();

Router::start();