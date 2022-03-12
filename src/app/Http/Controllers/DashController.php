<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Company;
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
                $nobookings = DB::table('company_user')->count();
                $revenue = DB::table('company_user')->sum('price')*0.10;
                $users = DB::table('company_user')
                    ->join('users','users.id','=','company_user.user_id')
                    ->get();
                return view('admin.pages.index',compact('nousers','nobookings','revenue','users'));
                break;
            case 'owner':
                $nousers=User::all()->count();
                $nobookings = DB::table('companies')->where('user_id',Auth::user()->id)->sum('company_bookings_count');
                $ids = Company::where('user_id',Auth::user()->id)->get();
                $revenue = 0;
                $users=[];
                foreach ($ids as $key => $value) {
                    $id = $value->company_id;
                    $revenue += DB::table('company_user')->where('company_id',$id)->sum('price')*0.9;
                    $users_object = DB::table('company_user')
                    ->join('users','users.id','=','company_user.user_id')
                    ->where('company_id',$id)
                    ->distinct()
                    ->get();
                    $users[] = $users_object[0];
                  }
                return view('admin.pages.index',compact('nousers','nobookings','revenue','users'));
                break;
            default:
                $nousers=User::all()->count();
                $nobookings = DB::table('company_user')->count();
                $revenue = DB::table('company_user')->sum('price')*0.10;
                return view('admin.pages.index',compact('nousers','nobookings','revenue','users'));
                break;
        }
        // $users = DB::table('company_user')
        // ->select('*', 'company_user.status as booking_status')
        // ->join('companies','companies.company_id','=','company_user.company_id')
        // ->where('company_user.user_id',Auth::user()->id)
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
