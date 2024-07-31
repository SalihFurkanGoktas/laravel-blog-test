<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TestController extends Controller
{
	public function index(Request $request): View {
		
//		$allContent = $request->all();
//		var_dump($allContent);	
		
//		echo $request->message;
//		echo "hello";

		return view('test.index');

	}	

	public function store(Request $request)//: RedirectResponse
	{
		//$allContent = $request->all();
		//var_dump($allContent)
		if (Session::get('magicNum') !== null) {
			$yes = Session::get('magicNum') + 1;
		
		dd(session()->all());
		}else { 
			$yes = 50;	
		}
		return redirect(route('test.index'))->with('magicNum',$yes);
	}

	public function edit(Request $request): RedirectResponse
	{
		var_dump($request);
		die();
	}
}
