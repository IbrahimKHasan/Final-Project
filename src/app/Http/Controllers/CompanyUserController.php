<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\CompanyUser;
use Illuminate\Http\Request;

class CompanyUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\CompanyUser  $companyUser
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyUser $companyUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyUser  $companyUser
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyUser $companyUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyUser  $companyUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $company_id=$request->company_id;
        DB::table('company_users')->where('booking_id',$id)->update([
            'status'=>$request->status
        ]);

        if ($request->status == 'in progress'){
            DB::table('companies')->where('company_id',$company_id)->update([
                'status'=>'Not Available'
            ]);
        }else{
            DB::table('companies')->where('company_id',$company_id)->update([
                'status'=>'Available'
            ]);
        }
        return redirect()->route('admin.index')->with('success','Booking Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyUser  $companyUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyUser $companyUser)
    {
        //
    }
}
