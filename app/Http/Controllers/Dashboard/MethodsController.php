<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\DesignsDataTable;
use App\DataTables\MethodsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Method;
use Illuminate\Http\Request;

class MethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MethodsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.methods.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.methods.create');

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
            'title' => 'required|array',
            'title.ar'=>'required',
            'title.en'=>'required',
            'image' => 'required|image',
            'details' => 'required|array',
            'details.ar'=>'required',
            'details.en'=>'required',
        ]);

        Method::create($data);
        $msg = 'تم حفظ التغييرات';
        alert()->success($msg);
        return redirect()->route('methods.create');

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
        $method = Method::find($id);
        return view('dashboard.methods.edit',['method' => $method]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Method $method)
    {
        $data = $request->validate([
            'title' => 'required|array',
            'title.ar'=>'required',
            'title.en'=>'required',
            'image' => 'required|image',
            'details' => 'required|array',
            'details.ar'=>'required',
            'details.en'=>'required',
        ]);

        $method->update($data);
        $msg = 'تم حفظ التغييرات';
        alert()->success($msg);
        return  back()->with(['method' => $method]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Method::where('id', $id)->delete();
        return redirect()->route('methods.index');
    }
}
