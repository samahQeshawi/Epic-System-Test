<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Design;
use App\Models\InvitationType;
use Illuminate\Http\Request;
use App\DataTables\InvitationTypesDataTable;

class InvitationTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InvitationTypesDataTable $dataTable)
    {
        return $dataTable->render('dashboard.types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.types.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|array',
            'name.ar'=>'required',
            'name.en'=>'required',
        ]);

        InvitationType::create($data);

        $msg = 'تم حفظ التغييرات';
        alert()->success($msg);
        return redirect()->route('invitation-types.create');

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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = InvitationType::find($id);
        return view('dashboard.types.edit',['type' => $type]);
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
        $data = $request->validate([
            'name' => 'required|array',
            'name.ar'=>'required',
            'name.en'=>'required',
        ]);

        $type =  InvitationType::where('id',$id)->update($data);
        $msg = 'تم حفظ التغييرات';
        alert()->success($msg);
        return  back()->with(['type' => $type]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InvitationType::where('id', $id)->delete();

        return redirect()->route('invitation-types.index');
    }
}
