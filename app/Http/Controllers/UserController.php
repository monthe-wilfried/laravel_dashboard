<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Professorship;
use App\Role;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::orderBy('name', 'asc')->paginate(15);
        return view('admin.users.index', compact('users'));
    }
    /**
 * Show the form for editing a user
 *
 */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $professorships = Professorship::pluck('name', 'id')->all();
        return view('admin.users.edit', compact('user', 'professorships'));

    }
    /**
     * Show the user
     *
     */
    public function show($id)
    {

    }
    /**
     * Show the form for creating a user
     *
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        $professorships = Professorship::pluck('name', 'id')->all();
        return view('admin.users.create', compact('roles', 'professorships'));
    }
    /**
     * create a user
     *
     */
    public function store(UserRequest $request)
    {
        $input = $request->all();
        if($file = $request->file('file')){
            $name = time().$file->getClientOriginalName();
            $file->move('black/img', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        $input['password'] = Hash::make($request->get('password'));
        $user = User::create($input);
        return redirect()->route('user.index')
            ->withStatus(__('User successfully created.'));

    }
    /**
     * Update the profile
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_active'=>$request->is_active]);
        return redirect()->back();
    }

    public function userUpdate(Request $request)
    {
        $input = $request->all();
        $user = User::findOrFail($request->user_id);
        if($file = $request->file('file')){
            $name = time().$file->getClientOriginalName();
            $file->move('black/img/', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        $user->update($input);
        return back()->withStatus(__('Profile successfully updated.'));

    }

    public function destroy($id)
    {
//        $user = User::findOrFail($id);
//        unlink(url('/')."/black/img/".$user->photo->file);

//        $user->delete();
//        return back()->withStatus(__('User successfully deleted.'));
    }




}
