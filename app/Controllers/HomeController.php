<?php

namespace App\Controllers;

use App\Models\User;

class HomeController extends Controller
{
	public function index($request, $response)
	{
		return $this->render($response,'home.twig');
	}
}