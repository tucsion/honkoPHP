<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Indexcontroller extends Controller
{
	//后台主页
    public function index()
    {
    	return view('admin.index');
    }
}
