<?php

namespace App\Controllers;

use App\Models\Contact;



class HomeController extends Controller
{
    public function index()
    {

        $contactModel = new Contact();

        $contactModel->delete(17);

        return 'Eliminado';

        //return $contactModel->where("name", "Diego Montoya")->get(); //' OR 'a' = 'a

        /* return $this->view('home', [
            'title' => 'Home de la Página',
            'description' => 'This es Home Page 404'
        ]);*/
    }
}
