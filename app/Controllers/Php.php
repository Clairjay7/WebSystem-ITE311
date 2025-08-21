<?php

namespace App\Controllers;

class Php extends BaseController
{
	public function index()
	{
		return view('template');
	}

	public function about()
	{
		return view('about');
	}

	public function contact()
	{
		return view('contact');
	}
}



