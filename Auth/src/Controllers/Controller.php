<?php

namespace App\Controllers;

use Twig\Environment;

class Controller
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function mainFormInvoke()
    {
        echo $this->twig->render('main.html.twig');
    }

    public function loggedFormInvoke()
    {
        echo $this->twig->render('logged.html.twig');
    }

    public function errorFormInvoke()
    {
        echo $this->twig->render('error.html.twig');
    }
}