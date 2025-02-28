<?php

namespace app\Controllers;

class RouteController
{
    public static function loadRoutes(): void
    {
        include_once __DIR__ . '/../../routes/web.php';
    }
}
