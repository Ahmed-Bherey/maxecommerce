<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationalYear;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index(){

        
        return view('admin.pages.index');
    }
}
