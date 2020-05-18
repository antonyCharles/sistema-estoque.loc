<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LoginRepository;
use Auth;
use Cookie;

class HomeController extends Controller
{

    public function Index()
	{
		return view('home.index');
	}

	public function SemAcesso()
	{
		return view('home.semAcesso');
	}
}
