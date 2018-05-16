<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\course;
use App\typecourses;
use App\Http\Requests;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use Excel;
use File;
use App\users;
use App\submitcourse;
use Mail;
use Swift_Transport;
use Swift_Message;
use Swift_Mailer;
use App\history_pay;

class PaymoneyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {


       $coursess = DB::table('submitcourses')
         ->select(
            'submitcourses.*',
            'submitcourses.user_id as Uid',
            'submitcourses.id as Oid',
            'submitcourses.created_at as Dcre',
            'submitcourses.discount as discount_1',
            'users.*',
            'users.id as Ustudent',
            'courses.*',
            'banks.*',
            'courses.id as Ucourse'
            )
         ->leftjoin('courses', 'courses.id', '=', 'submitcourses.course_id')
         ->leftjoin('users', 'users.id', '=', 'courses.user_id')
         ->leftjoin('banks', 'banks.id', '=', 'submitcourses.bank_id')
         ->where('submitcourses.status', '=', 2)
         ->where('submitcourses.discount', '=', 0)
         ->orderBy('submitcourses.id', 'desc')
         ->get();

       $data['objs'] = $coursess;
       $data['datahead'] = "รายการรอเบิกจ่ายทั้งหมด";
       return view('admin.pay_money.index', $data);
     }


     public function index2()
     {


       $coursess = DB::table('submitcourses')
         ->select(
            'submitcourses.*',
            'submitcourses.user_id as Uid',
            'submitcourses.id as Oid',
            'submitcourses.created_at as Dcre',
            'submitcourses.discount as discount_1',
            'users.*',
            'users.id as Ustudent',
            'courses.*',
            'banks.*',
            'courses.id as Ucourse'
            )
         ->leftjoin('courses', 'courses.id', '=', 'submitcourses.course_id')
         ->leftjoin('users', 'users.id', '=', 'courses.user_id')
         ->leftjoin('banks', 'banks.id', '=', 'submitcourses.bank_id')
         ->where('submitcourses.status', '=', 2)
         ->where('submitcourses.discount', '=', 1)
         ->orderBy('submitcourses.id', 'desc')
         ->get();

       $data['objs'] = $coursess;
       $data['datahead'] = "รายการเบิกจ่ายตรวจสอบแล้ว";
       return view('admin.pay_money.index2', $data);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function post_status_pay(Request $request){

        //  $user = course::findOrFail($request->course_id);


        //  $course_id = $request->course_id;


    $user = submitcourse::findOrFail($request->course_id);

          if($user->discount == 1){
              $user->discount = 0;
          } else {
              $user->discount = 1;
          }


  return response()->json([
  'data' => [
    'success' => $user->save(),
  ]
]);


}



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
