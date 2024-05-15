<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\AboutAsDataTable;
use App\Http\Controllers\Controller;
use App\Models\AboutAs;
use App\Models\Design;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AboutAsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.about-us.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.about-us.create');

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
        ]);

        AboutAs::create($data);
        $msg = 'تم حفظ التغييرات';
        alert()->success($msg);
        return redirect()->route('about-us.create');

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
        $about = AboutAs::find($id);
        return view('dashboard.about-us.edit',['about' => $about]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $about = AboutAs::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|array',
            'title.ar'=>'required',
            'title.en'=>'required',
            'image' => 'sometimes|image',
        ]);

        $about->update($data);
        $msg = 'تم حفظ التغييرات';
        alert()->success($msg);
        return  back()->with(['about' => $about]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AboutAs::where('id', $id)->delete();
        return redirect()->route('about-us.index');
    }
}
