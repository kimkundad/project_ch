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


class ProuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $objs = DB::table('users')
          ->select(
          'users.*'
          )
          ->where('users.id', Auth::user()->id)
          ->first();
        //  dd($objs);
      $data['objs'] = $objs;

        $product = DB::table('courses')
            ->select(
            'courses.*',
            'departments.*',
            'departments.id as e_id',
            'courses.id as c_id'
            )
            ->leftjoin('departments', 'departments.id', '=', 'courses.department_id')
            ->where('courses.user_id', Auth::user()->id)
            ->get();
          //  dd($product);

        $data['product'] = $product;
        return view('my_pro.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */







    public function create()
    {
      $objs = DB::table('users')
          ->select(
          'users.*'
          )
          ->where('users.id', Auth::user()->id)
          ->first();
        //  dd($objs);
      $data['objs'] = $objs;

        $department = department::all();

        $data['department'] = $department;
        $data['method'] = "post";
        $data['url'] = url('product_user');

        return view('my_pro.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



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

      return redirect(url('product_user/'))->with('success_course','เพิ่มข้อมูล '.$request['name'].' สำเร็จ');

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








    public function edit($id)
    {


      $objs = DB::table('users')
          ->select(
          'users.*'
          )
          ->where('users.id', Auth::user()->id)
          ->first();
        //  dd($objs);
      $data['objs'] = $objs;



      $department = department::all();



      $courseinfo = DB::table('courses')
          ->select(
          'courses.*'
          )
          ->where('courses.user_id', Auth::user()->id)
          ->first();


      $data['department'] = $department;


      $data['courseinfo'] = $courseinfo;
      $data['method'] = "put";
      $data['url'] = url('product_user/'.$id);

      return view('my_pro.edit', $data);
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

           return redirect(url('product_user/'.$id.'/edit'))->with('success_course','แก้ไขข้อมูล '.$request['name'].' สำเร็จ');


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

           return redirect(url('product_user/'.$id.'/edit'))->with('success_course','แก้ไขข้อมูล '.$request['name'].' สำเร็จ');

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

      return redirect(url('product_user/'))->with('delete','ลบข้อมูล สำเร็จ');
    }
}
