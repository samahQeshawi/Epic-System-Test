<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\DesignsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Design;
use Illuminate\Http\Request;

class DesignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DesignsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.designs.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.designs.create');

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
            'image' => 'required|image',
            'details' => 'required|array',
            'details.ar'=>'required',
            'details.en'=>'required',
        ]);

        Design::create($data);
        $msg = 'تم حفظ التغييرات';
        alert()->success($msg);
        return redirect()->route('designs.create');

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
        $design = Design::find($id);
        return view('dashboard.designs.edit',['design' => $design]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Design $design)
    {
        $data = $request->validate([
            'name' => 'required|array',
            'name.ar'=>'required',
            'name.en'=>'required',
            'image' => 'sometimes|image',
            'details' => 'required|array',
            'details.ar'=>'required',
            'details.en'=>'required',
        ]);

        $design->update($data);
        $msg = 'تم حفظ التغييرات';
        alert()->success($msg);
        return  back()->with(['design' => $design]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Design::where('id', $id)->delete();
        return redirect()->route('designs.index');
    }
}
