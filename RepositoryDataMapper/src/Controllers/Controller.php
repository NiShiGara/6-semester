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

    public function __invoke($result)
    {
        echo $this->twig->render('main.html.twig',['t' => $result]);
    }

    public function __FindInvoke($result,$value)
    {
        echo $this->twig->render('find.html.twig',['val' => $value]);
        echo $this->twig->render('find.html.twig',['t' => $result]);
    }

    public function __FindFormInvoke()
    {
        echo $this->twig->render('findForm.html.twig');
    }
}