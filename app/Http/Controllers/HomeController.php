<?php

namespace App\Http\Controllers;

use App\Professorship;
use App\Publication;
use App\User;

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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = count(User::all());
        $publications = count(Publication::all());
        $professorships = count(Professorship::all());
        return view('admin.dashboard', compact('users', 'publications', 'professorships'));
    }
}
