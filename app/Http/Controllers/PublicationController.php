<?php

namespace App\Http\Controllers;

use App\Author;
use App\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $publications = Publication::orderBy('created_at', 'asc')->paginate(10);
        return view('admin.publications.index', compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
        return view('admin.publications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->except('authors');

        $publication = Publication::create($input);

        $authors = $request->authors;
        foreach ($authors as $author){
            $name = Author::create(['name'=>$author]);
            $name->publications()->sync($publication->id);
        }

        return redirect()->route('publications.index')
            ->withStatus('Publication successfully created.');
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
        $publication = Publication::findOrFail($id);
        return view('admin.publications.edit', compact('publication'));
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
        $input = $request->except('authors');

        $publication = Publication::findOrFail($id);
        $publication->update($input);

        $authors = $request->authors;
        foreach ($authors as $author){
            $new_author  = new Author();
            $new_author->update($author);
        }

        return redirect()->route('publications.index')
            ->withStatus('Publication successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        //
        $publications = Publication::findOrFail($request->checkBoxArray);
        foreach ($publications as $publication){
            $publication->delete();
        }
        return back()->withStatus('Publication successfully deleted');
    }
}
