<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\PackagesDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Package;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PackagesDataTable $dataTable)
    {
        return $dataTable->render('dashboard.packages.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.packages.create');

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
            'price' => 'required',
            'num_invitations' => 'required',
            'details' => 'required|array',
            'details.ar'=>'required',
            'details.en'=>'required',
        ]);

        Package::create($data);
        $msg = 'تم حفظ التغييرات';
        alert()->success($msg);
        return redirect()->route('packages.create');

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
        $package = Package::find($id);
        return view('dashboard.packages.edit',['package' => $package]);
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
            'price' => 'required',
            'num_invitations' => 'required',
            'details' => 'required|array',
            'details.ar'=>'required',
            'details.en'=>'required',
        ]);

        $package =  Package::where('id',$id)->update($data);
        $msg = 'تم حفظ التغييرات';
        alert()->success($msg);
        return  back()->with(['package' => $package]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Package::where('id', $id)->delete();
        return redirect()->route('packages.index');
    }
}
