<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfDeleteRequest;
use App\Http\Requests\ProfessorshipRequest;
use App\Professorship;
use Illuminate\Http\Request;

class ProfessorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $professorships = Professorship::orderBy('name', 'asc')->paginate(15);
        return view('admin.professorships.index', compact('professorships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfessorshipRequest $request)
    {
        //
        $input = $request->all();
        Professorship::create($input);
        return back()->withStatus('Professorship successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //
        $professorship = Professorship::findOrFail($id);
        return view('admin.professorships.edit', compact('professorship'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
    }

    /**
     * delete the specified resource from storage.
     *
     * @param  int  $id
     * @return string
     */
    public function delete(ProfDeleteRequest $request)
    {
        //
        $professorships = Professorship::findOrFail($request->checkBoxArray);
        foreach ($professorships as $professorship){
            $professorship->delete();
        }
        return back()->withStatus('Successfully deleted');




    }
}
