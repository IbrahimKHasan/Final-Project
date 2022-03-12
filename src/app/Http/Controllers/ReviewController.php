<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Company;
use Illuminate\Support\Facades\DB;


class ReviewController extends Controller
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
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        Review::create([
            'user_id'=>Auth::user()->id,
            'company_id'=>$data['company_id'],
            'review_rate'=>$data['rate'],
            'review_body'=>$data['review_body']
        ]);
        $rate = Review::where('company_id',$data['company_id'])->avg('review_rate');
        $count = Review::where('company_id',$data['company_id'])->count();
        Company::where('company_id',$data['company_id'])->update([
                'company_rate'=>round($rate,1),
                'company_rate_count'=>$count,
            ]);
        Alert::success('Review Sent Successfully');
        return redirect()->route('company.show',$data['company_id'])->with('success','Review Sent Successfully');
        // $not_available_time = DB::table('company_user')->where('company_id',$data['company_id'])->select('date')->get();
        // foreach ($not_available_time as $value) {
        //     if ($value->date ==date("Y-m-d")){
        //         Company::where('company_id',$data['company_id'])->update([
        //             'status'=>'Not Available',
        //         ]);
        //     }
        // }
        // $reviews = Review::where('company_id',$data['company_id'])
        // ->join('users','users.id','=','reviews.user_id')
        // ->orderBy('reviews.created_at','desc')
        // ->get();
        // $rate = Review::where('company_id',$data['company_id'])->avg('review_rate');
        // $count = Review::where('company_id',$data['company_id'])->count();
        // $user = Review::where('user_id',Auth::user()->id)->count();
        // if ($user==1){
        //     $check = true;
        // }else{
        //     $check = false;
        // }
        // $company=Company::where('company_id',$data['company_id'])->first();
        // Company::where('company_id',$data['company_id'])->update([
        //     'company_rate'=>round($rate,1),
        //     'company_rate_count'=>$count,
        // ]);
        $company_id = $data['company_id'];
        // return view('public.pages.singlepage',compact('company','not_available_time','reviews','rate','count','check'));
        // header("location:http://127.0.0.1:8000/company/$company_id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
