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
use App\users;
use App\submitcourse;
use Mail;
use Swift_Transport;
use Swift_Message;
use Swift_Mailer;
use App\history_pay;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $course_message = DB::table('submitcourses')
        ->select(
           'submitcourses.*',
           'submitcourses.user_id as Uid',
           'submitcourses.id as Oid',
           'submitcourses.created_at as Dcre',
           'users.*',
           'users.id as Ustudent',
           'courses.*',
           'banks.*',
           'courses.id as Ucourse'
           )
        ->leftjoin('users', 'users.id', '=', 'submitcourses.user_id')
        ->leftjoin('courses', 'courses.id', '=', 'submitcourses.course_id')
        ->leftjoin('banks', 'banks.id', '=', 'submitcourses.bank_id')
        ->where('submitcourses.status', '=', 1)
        ->count();

      $data['course_message'] = $course_message;

      $message_user = DB::table('messages')
      ->select(
      DB::raw('messages.*, max(messages.id) as id'),
      'users.*'
      )
      ->leftjoin('users', 'users.id', '=', 'messages.chat_user_id')
      ->where('messages.chat_user_id', '>', 1)
      ->where('messages.seen', 0)
      ->groupBy('messages.chat_user_id')
      ->get();
      $data['message_user'] = $message_user;


      $message = DB::table('messages')
       ->select(
       DB::raw('messages.*')
       )
       ->where('chat_user_id', '>', 1)
       ->where('seen', 0)
       ->groupBy('chat_user_id')
       ->get();

       $s = 0;
       foreach ($message as $obj) {
          $s++;

           $obj->options = $s;
       }
     $data['count_message'] = $s;

      $coursess = DB::table('submitcourses')
        ->select(
           'submitcourses.*',
           'submitcourses.user_id as Uid',
           'submitcourses.id as Oid',
           'submitcourses.created_at as Dcre',
           'users.*',
           'users.id as Ustudent',
           'courses.*',
           'banks.*',
           'courses.id as Ucourse'
           )
        ->leftjoin('users', 'users.id', '=', 'submitcourses.user_id')
        ->leftjoin('courses', 'courses.id', '=', 'submitcourses.course_id')
        ->leftjoin('banks', 'banks.id', '=', 'submitcourses.bank_id')
        ->where('submitcourses.status', '=', 1)
        ->orderBy('submitcourses.id', 'desc')
        ->get();

      $data['objs'] = $coursess;
      $data['datahead'] = "รายการสั่งซื้อทั้งหมด";
      return view('admin.order.index', $data);
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

      $course_message = DB::table('submitcourses')
        ->select(
           'submitcourses.*',
           'submitcourses.user_id as Uid',
           'submitcourses.id as Oid',
           'submitcourses.created_at as Dcre',
           'users.*',
           'users.id as Ustudent',
           'courses.*',
           'banks.*',
           'courses.id as Ucourse'
           )
        ->leftjoin('users', 'users.id', '=', 'submitcourses.user_id')
        ->leftjoin('courses', 'courses.id', '=', 'submitcourses.course_id')
        ->leftjoin('banks', 'banks.id', '=', 'submitcourses.bank_id')
        ->where('submitcourses.status', '=', 1)
        ->count();

      $data['course_message'] = $course_message;

      $message_user = DB::table('messages')
      ->select(
      DB::raw('messages.*, max(messages.id) as id'),
      'users.*'
      )
      ->leftjoin('users', 'users.id', '=', 'messages.chat_user_id')
      ->where('messages.chat_user_id', '>', 1)
      ->where('messages.seen', 0)
      ->groupBy('messages.chat_user_id')
      ->get();
      $data['message_user'] = $message_user;


      $message = DB::table('messages')
       ->select(
       DB::raw('messages.*')
       )
       ->where('chat_user_id', '>', 1)
       ->where('seen', 0)
       ->groupBy('chat_user_id')
       ->get();

       $s = 0;
       foreach ($message as $obj) {
          $s++;

           $obj->options = $s;
       }
     $data['count_message'] = $s;


      $coursess = DB::table('submitcourses')
        ->select(
           'submitcourses.*',
           'submitcourses.user_id as Uid',
           'submitcourses.id as Oid',
           'submitcourses.created_at as Dcre',
           'users.*',
           'users.id as Ustudent',
           'courses.*',
           'banks.*',
           'courses.id as Ucourse',
           'courses.user_id as c_user'
           )
        ->where('submitcourses.id', $id)
        ->leftjoin('users', 'users.id', '=', 'submitcourses.user_id')
        ->leftjoin('courses', 'courses.id', '=', 'submitcourses.course_id')
        ->leftjoin('banks', 'banks.id', '=', 'submitcourses.bank_id')
        ->first();


        $user_owner = DB::table('courses')
          ->select(
             'courses.*',
             'users.*'
             )
          ->leftjoin('users', 'users.id', '=', 'courses.user_id')
          ->where('courses.user_id', $coursess->c_user)
          ->first();

      //dd($user_owner);
      $data['method'] = "put";
      $data['url'] = url('admin/order_shop/'.$id);
      $data['courseinfo'] = $coursess;
      $data['user_owner'] = $user_owner;
      $data['datahead'] = "จัดการคำสั่งซื้อทั้งหมด";
      return view('admin.order.edit', $data);
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
      $this->validate($request, [
     'status' => 'required',
     'item_oriduct' => 'required'
    ]);


    date_default_timezone_set("Asia/Bangkok");

               $data_date = date("Y-m-d H:i:s");



               $get_info = DB::table('submitcourses')
                 ->select(
                    'submitcourses.*'
                    )
                 ->where('submitcourses.id', $id)
                 ->first();

                 $get_info2 = DB::table('courses')
                   ->select(
                      'courses.*'
                      )
                   ->where('courses.id', $get_info->course_id)
                   ->first();

                 $item_oriduct = 0;
                 $item_oriduct = $get_info2->discount - $request['item_oriduct'];

    $upobj = DB::table('submitcourses')
        ->select(
        'submitcourses.*'
        )
        ->where('id', $id)
        ->update(array(
          'status' => $request['status']
        ));


        $st_c = DB::table('courses')
            ->select(
            'courses.*'
            )
            ->where('id', $get_info->course_id)
            ->update(array(
              'discount' => $item_oriduct
            ));




        $status_user = $request->get('status');





          $coursess = DB::table('submitcourses')
            ->select(
               'submitcourses.*',
               'submitcourses.user_id as Uid',
               'submitcourses.id as Oid',
               'users.*',
               'banks.*',
               'courses.*'
               )
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

                        Mail::send('mails.index2', $data_toview, function($message) use ($data)
                        {
                            $message->from($data['sender'], 'Nubthong Su Sanon Shop');
                            $message->to($data['sender'])
                            ->replyTo($data['sender'], 'Nubthong Su Sanon Shop.')
                            ->subject('ทำรายการสำหรับการสั่งซื้อสินค้า Nubthong Su Sanon Shop สำเร็จ');

                            //echo 'Confirmation email after registration is completed.';
                        });

            }catch(\Swift_TransportException $e){
                $response = $e->getMessage() ;
                echo $response;

            }


            // Restore your original mailer
            Mail::setSwiftMailer($backup);
            // send email










       return redirect(url('admin/order_shop/'.$id.'/edit'))->with('edit_order','แก้ไขข้อมูล สำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $obj = DB::table('submitcourses')
      ->where('submitcourses.id', $id)
      ->delete();

      return redirect(url('admin/order_shop/'))->with('delete','ลบข้อมูล สำเร็จ');
    }
}
