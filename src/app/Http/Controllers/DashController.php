<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Company;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (Auth::user()->role)
        {
            case 'admin':
                $nousers=User::all()->count();
                $nobookings = DB::table('company_users')->count();
                $noowners = User::where('role','owner')->count();
                $owners = User::where('role','owner')->paginate(5);
                $revenue = DB::table('company_users')->sum('price')*0.10;
                $reviews = Review::
                join('users','users.id','=','reviews.user_id')
                ->join('companies','companies.company_id','=','reviews.company_id')
                ->paginate(5);
                $users = DB::table('company_users')
                    ->join('users','users.id','=','company_users.user_id')
                    ->paginate(5);
                $owners_display=true;
                return view('admin.pages.index',compact('owners_display','owners','noowners','reviews','nousers','nobookings','revenue','users'));
                break;
            case 'owner':
                $owners=[];
                $owners_display=false;
                $noowners = User::where('role','owner')->count();
                // $ids_count = Company::where('user_id',Auth::user()->id)->first();
                $id = Company::where('user_id',Auth::user()->id)->first();
                if ($id!=null){
                    $id1 = $id->company_id;
                    $reviews = Review::join('users','users.id','=','reviews.user_id')
                                      ->join('companies','companies.company_id','=','reviews.company_id')
                                      ->where('reviews.company_id',$id1)
                                      ->paginate(5);
                }else{
                    $reviews=[];
                }
                $nousers=User::all()->count();
                $nobookings = DB::table('companies')->where('user_id',Auth::user()->id)->sum('company_bookings_count');
                // $revenue = 0;
                // $users=[];
                // foreach ($ids as $key => $value) {
                    // $id = $value->company_id;
                    $revenue = DB::table('company_users')->where('company_id',$id)->sum('price')*0.9;
                    $users = DB::table('company_users')
                    ->join('users','users.id','=','company_users.user_id')
                    ->where('company_id',$id)
                    ->distinct()
                    ->paginate(5);
                    // $users[] = $users_object[0];
                //   }
                if ($id==null){
                    $nobookings=0;
                    $revenue = 0;
                    $users = [];
                }
                return view('admin.pages.index',compact('owners_display','owners','noowners','reviews','nousers','nobookings','revenue','users'));
                break;
        }
        // $users = DB::table('company_users')
        // ->select('*', 'company_users.status as booking_status')
        // ->join('companies','companies.company_id','=','company_users.company_id')
        // ->where('company_users.user_id',Auth::user()->id)
        // ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //

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
}