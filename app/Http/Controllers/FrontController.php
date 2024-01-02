<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class FrontController extends Controller
{
    public string $title = 'CBT-LAB | Siswa';
    public function index()
    {
        return view('front.pages.homepage',[
            'title' => $this->title
        ]);
    }
}
