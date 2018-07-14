<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
      $title  = 'Welcome to RBC Community 12 Summer Hack Project!';
      return view("pages.index")->with('title', $title);
    }
    public function about(){
      $title  = 'About this forum';
      return view("pages.about")->with('title', $title);
    }
    public function services(){
      $data = array(
        'title' => 'Services we provide in this discussion forum',
        'services' => ['Tagging', '24/7 Service', 'Writing Anonymous Responses and Posts']
      );
      return view("pages.services")->with($data);
    }
}
