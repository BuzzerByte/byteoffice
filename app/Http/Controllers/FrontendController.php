<?php
namespace buzzeroffice\Http\Controllers;

class FrontendController extends Controller
{
    public function home()
    {
        return view('front.index');
    }
}
