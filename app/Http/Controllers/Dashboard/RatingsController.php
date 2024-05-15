<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\RatingsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvitationResource;
use App\Http\Resources\PackageResource;
use App\Http\Resources\RatingResource;
use App\Models\Package;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(RatingsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.ratings.index');

    }

    public function edit($id)
    {
        $rating = Rating::find($id);
        return view('dashboard.ratings.edit',['rating' => $rating]);
    }

    public function update(Request $request, $id)
    {
        if($request->status){
            $status = 'active';
        }else{
            $status = 'not_active';
        }
        $rating =  Rating::where('id',$id)->update(['status' => $status]);

        $msg = 'تم حفظ التغييرات';
        alert()->success($msg);
        return  back()->with(['rating' => $rating]);
    }

    public function destroy($id)
    {
        Rating::where('id', $id)->delete();
        return redirect()->route('ratings.index');
    }
}
