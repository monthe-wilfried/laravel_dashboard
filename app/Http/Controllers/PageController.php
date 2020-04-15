<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display icons page
     *
     * @return \Illuminate\View\View
     */
    public function icons()
    {
        return view('admin.pages.icons');
    }

    /**
     * Display maps page
     *
     * @return \Illuminate\View\View
     */
    public function maps()
    {
        return view('pages.maps');
    }

    /**
     * Display tables page
     *
     * @return \Illuminate\View\View
     */
    public function tables()
    {
        return view('pages.tables');
    }

    /**
     * Display notifications page
     *
     * @return \Illuminate\View\View
     */
    public function notifications()
    {
        return view('pages.notifications');
    }

    /**
     * Display rtl page
     *
     * @return \Illuminate\View\View
     */
    public function rtl()
    {
        return view('pages.rtl');
    }

    /**
     * Display typography page
     *
     * @return \Illuminate\View\View
     */
    public function typography()
    {
        return view('pages.typography');
    }

    /**
     * Display upgrade page
     *
     * @return \Illuminate\View\View
     */
    public function upgrade()
    {
        return view('pages.upgrade');
    }


    public function media()
    {
        $photos = Photo::paginate(20);
        return view('admin.pages.media', compact('photos'));
    }
    /**
     * Delete a Photo
     *
     * @return \Illuminate\View\View
     */
    public function delete(Request $request)
    {
        $photo = Photo::findOrFail($request->photo_id);
        if ($photo->file){
            unlink(Photo::deletePhoto($photo->file));
        }
        $photo->delete();
        return back()->withStatus('Photo deleted successfully.');
    }
    /**
     * Delete group of images
     *
     * @return \Illuminate\View\View
     */
    public function destroy($id)
    {

    }
}
