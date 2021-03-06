<?php

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
use App\department;
use App\Users;
use App\submitcourse;
use App\bank;
use Mail;
use Swift_Transport;
use Swift_Message;
use Swift_Mailer;
use App\qrcode;
use App\comment;


class CourseinfoController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $department = department::all();
      $data['department'] = $department;
      $courseinfo = course::find($id);

      $count_course = DB::table('submitcourses')
        ->select(
           'submitcourses.*'
           )
        ->where('submitcourses.course_id', $id)
        ->count();


        $comment_course = DB::table('comments')
          ->select(
             'comments.*',
             'comments.id as c_id',
             'comments.created_at as created_att',
             'users.*',
             'users.id as u_id'
             )
          ->leftjoin('users', 'users.id', '=', 'comments.user_id')
          ->where('comments.course_id', $id)
          ->get();

          //dd($comment_course);

      $coursess = DB::table('courses')
        ->select(
           'submitcourses.*',
           'submitcourses.user_id as Uid',
           'submitcourses.id as Oid',
           'users.*',
           'courses.*'
           )
        ->where('courses.id', $id)
        ->leftjoin('submitcourses', 'courses.id', '=', 'submitcourses.course_id')
        ->leftjoin('users', 'users.id', '=', 'submitcourses.user_id')
        ->get();


        $video_list = DB::table('video_lists')
         ->select(
         DB::raw('video_lists.*')
         )
         ->where('course_id', $id)
         ->orderBy('order_sort', 'asc')
         ->get();


    //  dd($coursess);
      $data['header'] = "แก้ไขคอร์ส";
      //dd($courseinfo);
      return view('course.courseinfo')->with([
           'video_list' => $video_list,
           'courseinfos' =>$coursess,
           'count_course' => $count_course,
           'comment_course' => $comment_course,
           'objs' => $courseinfo,
           'department' => $department
         ]);
    }



    public function checkmycourse($id)
    {
      $department = department::all();
      $data['department'] = $department;
      $bank = DB::table('banks')
        ->get();


        $coursess = DB::table('courses')
          ->select(
             'courses.*'
             )
          ->where('courses.id', $id)
          ->first();

    //  dd($data);

   return view('confirm_course.pay_course')->with([
        'courseinfo' =>$coursess,
        'bank' => $bank,
        'bill' =>"บิลเลขที่"
      ]);
    }





    public function confirm_course($id)
    {
      $department = department::all();
      $data['department'] = $department;

      $courseinfo = course::find($id);

      $user = DB::table('users')
        ->select(
           'users.*'
           )
        ->where('users.id', Auth::user()->id)
        ->first();


        $coursess = DB::table('courses')
          ->select(
             'courses.*'
             )
          ->where('courses.id', $id)
          ->first();

      //dd($count_course);
      return view('confirm_course.index')->with([
        'objs' =>$courseinfo,
        'user' =>$user
      ]);





    }



    public function pay_course(Request $request, $id)
    {

      $department = department::all();
      $data['department'] = $department;

      $coursess = DB::table('submitcourses')
        ->select(
           'submitcourses.*',
           'submitcourses.user_id as Uid',
           'submitcourses.id as Oid',
           'users.*',
           'courses.*'
           )
        ->where('submitcourses.user_id', Auth::user()->id)
        ->where('submitcourses.id', $id)
        ->leftjoin('users', 'users.id', '=', 'submitcourses.user_id')
        ->leftjoin('courses', 'courses.id', '=', 'submitcourses.course_id')
        ->first();

    //  dd($data);

    /*  return view('confirm_course.pay_course')->with([
        'objs' =>$courseinfo,
        'bill' =>"บิลเลขที่"
      ]); */

      return redirect(url('pay_course/'.$id))->with('hbd','กรอกวันเกิดนักเรียนด้วยนะจ๊ะ');


    }






















    public function submit_course(Request $request, $id)
    {
      $department = department::all();
      $data['department'] = $department;
      $bank = DB::table('banks')
        ->get();


      $this->validate($request, [
           'name' => 'required',
           'phone' => 'required',
           'address' => 'required',
       ]);

       $package = Users::find(Auth::user()->id);
       $package->name = $request['name'];
       $package->phone = $request['phone'];
       $package->address = $request['address'];
       $package->save();






        $package = new submitcourse();
        $package->user_id = Auth::user()->id;
        $package->course_id = $id;
        $package->save();

        $the_id = $package->id;


        $coursess = DB::table('submitcourses')
          ->select(
             'submitcourses.*',
             'submitcourses.user_id as Uid',
             'submitcourses.id as Oid',
             'users.*',
             'courses.*'
             )
          ->where('submitcourses.user_id', Auth::user()->id)
          ->where('submitcourses.id', $the_id)
          ->leftjoin('users', 'users.id', '=', 'submitcourses.user_id')
          ->leftjoin('courses', 'courses.id', '=', 'submitcourses.course_id')
          ->first();

      //  dd($data);

     return view('confirm_course.pay_course')->with([
          'courseinfo' =>$coursess,
          'bank' => $bank,
          'bill' =>"บิลเลขที่"
        ]);







    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }



    public function bil_course(Request $request, $id)
    {
      $department = department::all();
      $data['department'] = $department;
      $this->validate($request, [
           'bankname' => 'required',
           'totalmoney' => 'required',
           'item_oriduct' => 'required',
           'day' => 'required'
       ]);


       $countobj = DB::table('submitcourses')
         ->select(
            'submitcourses.*'
            )
         ->where('submitcourses.user_id', Auth::user()->id)
         ->where('submitcourses.id', $id)
         ->first();



         $image = $request->file('image');


        if($image == NULL){

         $package = submitcourse::find($id);
         $package->end_time = $request['item_oriduct'];
         $package->bank_id = $request['bankname'];
         $package->money_tran = $request['totalmoney'];
         $package->date_tran = $request['day'];
         $package->time_tran = $request['timer'];
         $package->status = 1;
         $package->save();

       }else{

         $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

          $destinationPath = asset('assets/images/avatar');
          $img = Image::make($image->getRealPath());
          $img->resize(500, 500, function ($constraint) {
          $constraint->aspectRatio();
        })->save('assets/bill/'.$input['imagename']);



        $package = submitcourse::find($id);
        $package->end_time = $request['item_oriduct'];
        $package->bank_id = $request['bankname'];
        $package->money_tran = $request['totalmoney'];
        $package->date_tran = $request['day'];
        $package->time_tran = $request['timer'];
        $package->status = 1;
        $package->bill_image = $input['imagename'];
        $package->save();

       }


         $coursess = DB::table('submitcourses')
           ->select(
              'submitcourses.*',
              'submitcourses.user_id as Uid',
              'submitcourses.id as Oid',
              'users.*',
              'banks.*',
              'courses.*'
              )
           ->where('submitcourses.user_id', Auth::user()->id)
           ->where('submitcourses.id', $id)
           ->leftjoin('users', 'users.id', '=', 'submitcourses.user_id')
           ->leftjoin('courses', 'courses.id', '=', 'submitcourses.course_id')
           ->leftjoin('banks', 'banks.id', '=', 'submitcourses.bank_id')
           ->first();





         // send email
           $data_toview = array();
         //  $data_toview['pathToImage'] = "assets/image/email-head.jpg";
           date_default_timezone_set("Asia/Bangkok");
           $data_toview['data'] = $coursess;
           $data_toview['datatime'] = date("d-m-Y H:i:s");

           $email_sender   = 'home221b@gmail.com';
           $email_pass     = 'kid1412194';

       /*    $email_sender   = 'info@acmeinvestor.com';
           $email_pass     = 'Iaminfoacmeinvestor';  */
           $email_to       =  $coursess->email;
           //echo $admins[$idx]['email'];
           // Backup your default mailer
           $backup = \Mail::getSwiftMailer();

           try{

                       //https://accounts.google.com/DisplayUnlockCaptcha
                       // Setup your gmail mailer
                       $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'SSL');
                       $transport->setUsername($email_sender);
                       $transport->setPassword($email_pass);

                       // Any other mailer configuration stuff needed...
                       $gmail = new Swift_Mailer($transport);

                       // Set the mailer as gmail
                       \Mail::setSwiftMailer($gmail);

                       $data['emailto'] = $email_sender;
                       $data['sender'] = $email_to;
                       //Sender dan Reply harus sama

                       Mail::send('mails.index', $data_toview, function($message) use ($data)
                       {
                           $message->from($data['sender'], 'Nubthong Su Sanon Shop');
                           $message->to($data['sender'])
                           ->replyTo($data['sender'], 'Nubthong Su Sanon Shop.')
                           ->subject('ใบเสร็จสำหรับการสั่งสินค้า ');

                           //echo 'Confirmation email after registration is completed.';
                       });


                       Mail::send('mails.index', $data_toview, function($message) use ($data)
                       {
                           $message->from($data['sender'], 'Nubthong Su Sanon Shop');
                           $message->to($data['emailto'])
                           ->replyTo($data['sender'], 'Nubthong Su Sanon Shop.')
                           ->subject('ใบเสร็จสำหรับการสั่งสินค้า');

                           //echo 'Confirmation email after registration is completed.';
                       });

           }catch(\Swift_TransportException $e){
               $response = $e->getMessage() ;
               echo $response;

           }


           // Restore your original mailer
           Mail::setSwiftMailer($backup);
           // send email










          return view('confirm_course.bil_course')->with([
               'courseinfo' =>$coursess,
               'bill' =>"บิลเลขที่"
             ]);





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
