<?php

namespace App\Controllers;

class ThanksController
{
    public function index()
    {
        sleep(3);

        return view('thanks.twig');
    }
}
