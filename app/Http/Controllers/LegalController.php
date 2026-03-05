<?php

namespace App\Http\Controllers;

class LegalController extends Controller
{
    public function privacy()
    {
        return view('legal.privacy');
    }

    public function terms()
    {
        return view('legal.terms');
    }

    public function refunds()
    {
        return view('legal.refunds');
    }

    public function cookies()
    {
        return view('legal.cookies');
    }

    public function allergy()
    {
        return view('legal.allergy');
    }
}