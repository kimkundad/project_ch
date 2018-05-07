<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\blog;

class BlogController extends Controller
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


        $objs = blog::all();
        $data['objs'] = $objs;
        $data['header'] = 'บทความ';
        $data['i'] = $i=0;
        return view('admin.blog.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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


        $data['header'] = 'เพิ่มบทความ';
        $data['method'] = 'post';
        $data['url'] = url('admin/blog');
        return view('admin.blog.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
           'image' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
           'title' => 'required',
           'detail' => 'required',
           'detail_website' => 'required'
       ]);

       $file = $request->file('image');
       $path = 'assets/blog/';
       $filename = time()."-".$file->getClientOriginalName();

       $file->move($path, $filename);


       $package = new blog;
       $package->image = $filename;
       $package->title_blog = $request['title'];
       $package->detail_blog = $request['detail'];
       $package->detail_blog_website = $request['detail_website'];
       $package->save();

       return redirect(url('admin/blog'))->with('success_blog','เพิ่มบทความสำเร็จแล้วค่ะ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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


        $objs = blog::find($id);
        $data['objs'] = $objs;
        $data['header'] = 'แก้ไขบทความ';
        $data['url'] = url('admin/blog/'.$id);
        $data['method'] = "put";
        return view('admin.blog.edit',$data);
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
        $file = $request->file('image');


     if($file == NULL){

       $this->validate($request, [
            'title' => 'required',
            'detail' => 'required',
            'detail_website' => 'required'
        ]);

       $package = blog::find($id);
       $package->title_blog = $request['title'];
       $package->detail_blog = $request['detail'];
       $package->detail_blog_website = $request['detail_website'];
       $package->save();

       return redirect(url('admin/blog/'.$id.'/edit'))->with('success_blog_edit','แก้ไขบทความสำเร็จแล้วค่ะ');

     }else{

       $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
            'title' => 'required',
            'detail' => 'required',
            'detail_website' => 'required'
        ]);


       $path = 'assets/blog/';
       $filename = time()."-".$file->getClientOriginalName();

       $file->move($path ,$filename);

       $package = blog::find($id);
       $package->image = $filename;
       $package->title_blog = $request['title'];
       $package->detail_blog = $request['detail'];
       $package->detail_blog_website = $request['detail_website'];
       $package->save();

       return redirect(url('admin/blog/'.$id.'/edit'))->with('success_blog_edit','แก้ไขบทความสำเร็จแล้วค่ะ');

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
        $objs = DB::table('blogs')
          ->select(
             'blogs.*',
             'blogs.image'
             )
          ->where('blogs.id', $id)
          ->first();

      $file_path = 'assets/blog/'.$objs->image;
      unlink($file_path);
      $obj = blog::find($id);
      $obj->delete();

    //  echo $objs->image;;
      return redirect(url('admin/blog'))
      ->with('deleteblog','ทำการลบ บทความ สำเร็จ');
    }
}
