<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
	 * Exibe a tela inicial da aplicação.
	 * 
	 * @return \Illuminate\View\View
	 */
	public function index() {
		return view('home');
	}

}
