<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Hash;
use App\course;
use App\typecourses;
use App\Http\Requests;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use Excel;
use File;
use App\question;
use App\option;
use App\example;
use App\category;
use App\department;
use App\video_list;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $objs = DB::table('courses')
            ->select(
            'courses.*',
            'users.*',
            'users.id as u_id',
            'courses.id as c_id'
            )
            ->leftjoin('users', 'users.id', '=', 'courses.user_id')
            ->where('courses.ch_status', 1)
            ->get();
          //  dd($objs);
        $course = typecourses::all();
        $department = department::all();
        $data['department'] = $department;
        $data['course'] = $course;
        $data['objs'] = $objs;
        $data['datahead'] = "คอร์สเรียนทั้งหมด";
        return view('admin.course.index', $data);
    }


    public function new_course(){

      $objs = DB::table('courses')
          ->select(
          'courses.*',
          'users.*',
          'users.id as u_id',
          'courses.id as c_id'
          )
          ->leftjoin('users', 'users.id', '=', 'courses.user_id')
          ->where('courses.ch_status', 0)
          ->get();
        //  dd($objs);
      $course = typecourses::all();
      $department = department::all();
      $data['department'] = $department;
      $data['course'] = $course;
      $data['objs'] = $objs;
      $data['datahead'] = "คอร์สเรียนทั้งหมด";
      return view('admin.course.index_new', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



     public function post_status(Request $request){

        //  $user = course::findOrFail($request->course_id);


        //  $course_id = $request->course_id;


    $user = course::findOrFail($request->course_id);

          if($user->ch_status == 1){
              $user->ch_status = 0;
          } else {
              $user->ch_status = 1;
          }


  return response()->json([
  'data' => [
    'success' => $user->save(),
  ]
]);


}



    public function create()
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

        $department = department::all();
        $course = typecourses::all();
        $data['course'] = $course;
        $data['department'] = $department;
        $data['method'] = "post";
        $data['url'] = url('admin/course');
        $data['header'] = "เพิ่มคอร์ส";
        return view('admin.course.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function add_video_course(Request $request)
     {
       $image = $request->file('image');

       //dd($image);
       $file = $request->file('file');

       $this->validate($request, [
            'image' => 'required',
            'file' => 'required',
            'course_id' => 'required',
            'name_video' => 'required'
        ]);


        $destinationPath = 'assets/videos';
        $input['file'] = time().'.'.$file->getClientOriginalExtension();
        $request->file('file')->move($destinationPath, $input['file']);
        ///

        ////
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

         $img = Image::make($image->getRealPath());
         $img->resize(640, 360, function ($constraint) {
         $constraint->aspectRatio();
     })->save('assets/uploads/'.$input['imagename']);


        $obj = new video_list();
        $obj->course_id = $request['course_id'];
        $obj->course_video_name = $request['name_video'];
        $obj->course_video = $input['file'];
        $obj->course_video_url = "https://learnsbuy.com/assets/videos/".$input['file'];
        $obj->thumbnail_img = $input['imagename'];
        $obj->save();





        return redirect(url('admin/course/'.$request['course_id'].'/edit'))->with('success_course_video','เพิ่มข้อมูล Video สำเร็จ');


     }


    public function store(Request $request)
    {
      $image = $request->file('image');

      $this->validate($request, [
           'image' => 'required|mimes:jpg,jpeg,png,gif|max:10048',
           'name' => 'required',
           'price' => 'required',
           'detail' => 'required',
           'discount' => 'required',
           'code_course' => 'required',
           'name_department' => 'required'
       ]);

       $input['imagename'] = time().'.'.$image->getClientOriginalExtension();


        $destinationPath = asset('assets/uploads/');
        $img = Image::make($image->getRealPath());
        $img->resize(500, 500, function ($constraint) {
        $constraint->aspectRatio();
      })->save('assets/uploads/'.$input['imagename']);

      $obj = new course();
      $obj->user_id = Auth::user()->id;
      $obj->title_course = $request['name'];
      $obj->detail_course = $request['detail'];
      $obj->price_course = $request['price'];
      $obj->image_course = $input['imagename'];
      $obj->discount = $request['discount'];
      $obj->code_course = $request['code_course'];
      $obj->department_id = $request['name_department'];
      $obj->save();

      return redirect(url('admin/course/'))->with('success_course','เพิ่มข้อมูล '.$request['name'].' สำเร็จ');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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


        //example
        $objs = DB::table('examples')
            ->select(
            'examples.*',
            'examples.id as e_id',
            'courses.*',
            'courses.id as c_id',
            'categories.*'
            )
            ->leftjoin('courses', 'examples.course_id', '=', 'courses.id')
            ->leftjoin('categories', 'examples.category_id', '=', 'categories.id')
            ->where('courses.id', $id)
            ->get();


            foreach ($objs as $obj) {

                $options = DB::table('questions')->where('category_id',$obj->e_id)->count();
                $obj->options = $options;
            }

            //dd($objs);
            $data['objs'] = $objs;
            $data['datahead'] = "แบบฝึกหัดทั้งหมด";
            return view('admin.course.example', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     public function examination($id)
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

      $get_q = DB::table('questions')
          ->select(
          'questions.*'
          )
          ->where('questions.category_id', $id)
          ->orderBy('order_sort', 'asc')
          ->get();
      //dd($get_q);
      $data['get_q'] = $get_q;

        $objs = DB::table('courses')
            ->select(
            'courses.*',
            'questions.*',
            'questions.name_questions'
            )
            ->Join('questions', 'courses.id', '=', 'questions.category_id')
            ->where('courses.id', $id)->orderBy('order_sort', 'asc')->get();
            //->Join('options', 'questions.id_questions', '=', 'options.question_id')
            //->where('categorys.id_category', $id)
            //->get();

        $objss = DB::table('courses')
            ->select(
            'courses.*'
            )
            ->where('courses.id', $id)
            ->first();

        foreach ($objs as $obj) {
            $optionsRes = [];
            $options = DB::table('options')->where('question_id',$obj->id_questions)->get();
            foreach ($options as $option) {
                $optionsRes[] = $option;
            }
            $obj->options = $optionsRes;

        }

       // dd($objs);

        $data['url'] = url('admin/examination/'.$id);
        $data['method'] = "put";
        $data['objs'] = $objs;
        $data['objss'] = $objss;
        $data['header'] = "จัดการแบบสอบถาม";
        return view('admin.course.examination', $data);
    }





    public function edit($id)
    {


      $course = typecourses::all();
      $department = department::all();
      $courseinfo = course::find($id);
      $data['department'] = $department;

      $data['course'] = $course;
      $data['courseinfo'] = $courseinfo;
      $data['method'] = "put";
      $data['url'] = url('admin/course/'.$id);
      $data['header'] = "แก้ไขคอร์ส";
      return view('admin.course.edit', $data);
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
        $image = $request->file('image');


        if($image != NULL){

          $this->validate($request, [
               'image' => 'required|mimes:jpg,jpeg,png,gif|max:10048',
               'name' => 'required',
               'price' => 'required',
               'detail' => 'required',
               'discount' => 'required',
               'code_course' => 'required',
               'name_department' => 'required',
           ]);


           $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = asset('assets/uploads/');
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
          })->save('assets/uploads/'.$input['imagename']);


           $obj = course::find($id);
           $obj->title_course = $request['name'];
           $obj->detail_course = $request['detail'];
           $obj->price_course = $request['price'];
           $obj->image_course = $input['imagename'];
           $obj->discount = $request['discount'];
           $obj->code_course = $request['code_course'];
           $obj->department_id = $request['name_department'];
           $obj->save();

           return redirect(url('admin/course/'.$id.'/edit'))->with('success_course','แก้ไขข้อมูล '.$request['name'].' สำเร็จ');


        }else{


          $this->validate($request, [
               'name' => 'required',
               'price' => 'required',
               'detail' => 'required',
               'discount' => 'required',
               'code_course' => 'required',
               'name_department' => 'required',
           ]);

           $obj = course::find($id);
           $obj->title_course = $request['name'];
           $obj->detail_course = $request['detail'];
           $obj->price_course = $request['price'];
           $obj->discount = $request['discount'];
           $obj->code_course = $request['code_course'];
           $obj->department_id = $request['name_department'];
           $obj->save();

           return redirect(url('admin/course/'.$id.'/edit'))->with('success_course','แก้ไขข้อมูล '.$request['name'].' สำเร็จ');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $objs = DB::table('courses')
      ->where('courses.id', $id)
      ->first();

      $destinationPath = 'assets/uploads/'.$objs->image_course;
      File::delete($destinationPath);



      $obj = DB::table('courses')
      ->where('courses.id', $id)
      ->delete();

      return redirect(url('admin/course/'))->with('delete','ลบข้อมูล สำเร็จ');
    }
}
