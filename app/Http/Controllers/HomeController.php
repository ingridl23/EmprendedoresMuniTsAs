<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

//controller para emprendedores  general
class HomeController extends Controller
{

    /* public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function index()
    {

        return view('layouts.templateEmprendedoreshome');
    }

    public function formarparte()
    {
        return view("layouts.indexform");
    }

    public function showlogin()
    {
        return view("auth.login");
    }
}
