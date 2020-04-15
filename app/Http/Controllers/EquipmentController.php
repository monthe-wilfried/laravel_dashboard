<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Http\Requests\EquipmentRequest;
use App\Professorship;
use App\Publication;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $equipments = Equipment::orderBy('created_at', 'asc')->paginate(20);
        $equipment_trashed = Equipment::onlyTrashed()->get();
        return view('admin.equipments.index', compact('equipments', 'equipment_trashed'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
        $professorships =  Professorship::pluck('name', 'id')->all();
        return view('admin.equipments.create', compact('professorships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipmentRequest $request)
    {
        //
        $equipment = $request->all();
        if ($equipment){
            Equipment::create($equipment);
        }
        return redirect()->route('equipments.index')->withStatus('Equipment successfully created.');

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
        $equipment = Equipment::findOrFail($id);
        $professorships = Professorship::pluck('name', 'id')->all();
        return view('admin.equipments.edit', compact('equipment', 'professorships'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentRequest $request, $id)
    {
        //
        $inputs = $request->all();
        $equipment = Equipment::findOrFail($id);
        $equipment->update($inputs);
        return redirect()->route('equipments.index')->withStatus('Equipment successfully updated.');
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        //
        $equipments = Equipment::findOrFail($request->checkBoxArray);
        foreach ($equipments as $equipment){
            $equipment->delete();
        }
        return back()->withStatus('Equipment successfully deleted.');
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

    public function upload(Request $request)
    {

        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/'.$filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }

    }

    /**
     * Show the trash view
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash()
    {
        //
        $equipmentsCount = count(Equipment::all());
        $trashCount = count(Equipment::onlyTrashed()->get());
        $equipments = Equipment::onlyTrashed()->paginate(20);
        return view('admin.equipments.trash', compact('equipmentsCount', 'trashCount', 'equipments'));
    }

    /**
     * Restore and permanently delete the trashed records
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function trash_process(Request $request)
    {
        //
        $equipment_ids = $request->checkBoxArray;
        $option = $request->select;

        if($option == 'delete' and $equipment_ids){
            foreach ($equipment_ids as $equipment_id){
                $equipment = Equipment::onlyTrashed()->whereId($equipment_id)->first();
                $equipment->forceDelete();
            }
            return back()->withStatus('Equipment permanently deleted.');
        }
        elseif ($option == 'restore' and $equipment_ids){
            foreach ($equipment_ids as $equipment_id){
                $equipment = Equipment::onlyTrashed()->whereId($equipment_id)->first();
                $equipment->restore();
            }
            return back()->withStatus('Equipment successfully restored.');
        }
        else{
            return back();
        }
    }


}
