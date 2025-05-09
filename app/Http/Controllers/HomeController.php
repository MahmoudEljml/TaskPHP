<?php

namespace App\Http\Controllers;

class HomeController
{
    public  function index()
    {
        echo 'welcome to index page';
    }

    public function about()
    {
        echo 'welcome to about page';
    }

    public function go()
    {
        echo 'welcome to go page';
    }
}