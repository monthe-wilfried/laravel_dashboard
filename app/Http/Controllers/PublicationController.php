<?php

namespace App\Http\Controllers;

use App\Author;
use App\Http\Requests\PublicationRequest;
use App\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

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
        $publications = Publication::orderBy('created_at', 'asc')->paginate(20);
        $publication_trashed = Publication::onlyTrashed()->get();
        return view('admin.publications.index', compact('publications', 'publication_trashed'));
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
        $input = $request->except('authors', 'author_ids');

        $publication = Publication::findOrFail($id);
        $publication->update($input);

        $authors = $request->authors;
        $author_ids = $request->author_ids;
        $i = 0;
        foreach ($authors as $author){
            $new_author = Author::findOrFail($author_ids[$i]);
            $new_author->update(['name'=>$author]);
            $i = $i + 1;
        }

        return redirect()->route('publications.index')
            ->withStatus('Publication successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash()
    {
        //
        $publicationsTrashCount = count(Publication::onlyTrashed()->get());
        $publicationsCount = count(Publication::all());
        $publications = Publication::onlyTrashed()->paginate(15);
        return view('admin.publications.trash', compact('publications', 'publicationsCount', 'publicationsTrashCount'));
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
     * @return string
     */
    public function trash_process(Request $request)
    {
        //
        $publications = Publication::findOrFail($request->checkBoxArray);
        $option = $request->select;

        foreach ($publications as $publication){
            if ($option == 'restore'){
                $publication->restore();
                return back()->withStatus('Restored Successfully.');
            }
            elseif ($option == 'delete'){
                $publication->forcedelete();
                return back()->withStatus('Permanently deleted.');
            }
            else{
                return back();
            }
        }




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
            $authors = $publication->authors;
            $publication->authors()->detach($authors);
            $publication->delete();
        }
        return back()->withStatus('Publication successfully deleted');
    }
}
