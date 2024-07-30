<?php

namespace app\controllers;


use app\core\Application;
use app\core\Constant;
use app\core\Controller;

class HomeController extends Controller
{
    public function home()
    {
        return $this->view("home", "main", null);
    }

    public function authorizeRoles(): array
    {
        //Treba biti prazan niz da mogu svi da pristupe
        return [];
    }
}