<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\BannersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Package;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BannersDataTable $dataTable)
    {
        return $dataTable->render('dashboard.banners.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.banners.create');

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
            'link' => 'required|url',
        ]);

        Banner::create($data);
        $msg = 'تم حفظ التغييرات';
        alert()->success($msg);
        return redirect()->route('banners.create');

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
        $banner = Banner::find($id);
        return view('dashboard.banners.edit',['banner' => $banner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {

        $data = $request->validate([
            'name' => 'required|array',
            'name.ar'=>'required',
            'name.en'=>'required',
            'image' => 'sometimes|image',
            'link' => 'required|url',
        ]);


        $banner->update($data);
        $msg = 'تم حفظ التغييرات';
        alert()->success($msg);
        return  back()->with(['banner' => $banner]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Banner::where('id', $id)->delete();
        return  redirect()->route('banners.index');
    }
}
