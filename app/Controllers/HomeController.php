<?php

namespace App\Controllers;

use App\Models\Contact;



class HomeController extends Controller
{
    public function index()
    {

        $contactModel = new Contact();

        $contactModel->all();

        return $this->view('home', [
            'title' => 'Home de la Página',
            'description' => 'This es Home Page 404'
        ]);
    }
}
