<?php

namespace projeto_laravel\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
				$hoje= Carbon::now();
				$dt = $hoje->toFormattedDateString(); 
				//$hoje =$datahoje->date;
        return view('home')->with('hoje',$dt);
				//return response()->json($datahoje->month);
				//return response()->json($dt);

    }


}
