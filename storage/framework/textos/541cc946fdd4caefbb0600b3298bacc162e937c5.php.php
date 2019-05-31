<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class CustomValDemoController extends Controller
{
	public function customVali()
	{
		return view('customVali');
	}
	public function customValiPost(Request $request)
	{
		$this->validate($request, [
	        'title' => 'required|is_odd_string',
	    ]);
		print_r('done');
	}
}