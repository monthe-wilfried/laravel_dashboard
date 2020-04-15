<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Photo;
use App\Professorship;
use App\Publication;
use App\Role;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

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
        $roles = count(Role::all());
        $photos = count(Photo::all());
        $equipments = count(Equipment::all());
        return view('admin.dashboard', compact('users', 'publications', 'professorships', 'roles', 'photos', 'equipments'));
    }

    /**
     * Show the equipments on the front page.
     *
     * @return \Illuminate\View\View
     */
    public function front()
    {
        $equipments = Equipment::all();
        return view('front', compact('equipments'));
    }

}
