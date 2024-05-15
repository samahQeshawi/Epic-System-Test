<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\CouponsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Design;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CouponsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.coupons.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.coupons.create');

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
            'discount' => 'required',
            'status' => 'required',
            'code' => 'required|unique:coupons,code',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        Coupon::create($data);
        $msg = 'تم حفظ التغييرات';
        alert()->success($msg);
        return redirect()->route('coupons.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      dd('show coupon');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('dashboard.coupons.edit',['coupon' => $coupon]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $data = $request->validate([
            'name' => 'required|array',
            'name.ar'=>'required',
            'name.en'=>'required',
            'discount' => 'required',
            'status' => 'required',
            'code' => 'required|unique:coupons,code,'.$coupon->id,
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        $coupon->update($data);
        $msg = 'تم حفظ التغييرات';
        alert()->success($msg);
        return  back()->with(['coupon' => $coupon]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coupon::where('id', $id)->delete();
        return redirect()->route('coupons.index');
    }
}
