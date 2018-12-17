<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
     
   
    public function jobTitle()
    {
        return view('jobTitle');
    }

    public function LicenseType()
    {
        return view('LicenseType');
    }
     
    public function Nationality()
    {
        return view('Nationality');
    }

    public function TUV()
    {
        return view('TUV');
    }
     
    public function Educational()
    {
        return view('Educational');
    }
 


    public function users()
    {
        return view('users');
    }

    public function ViewName()
    {
        return view('ViewName');
    }
    
    public function Permission()
    {
        return view('Permission');
    }
    public function Absence()
    {
        return view('Absence');
    }
    

}
