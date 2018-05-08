<?php

namespace App\Http\Controllers;


use App\course;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  /*  public function __construct()
    {
        $this->middleware('auth');
    }
*/
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function home()
    {
      $objs = DB::table('courses')
          ->select(
          'courses.*',
          'courses.id as A',
          'typecourses.*'
          )
          ->leftjoin('typecourses', 'typecourses.id', '=', 'courses.type_course')
          ->limit(8)
          ->get();

      $data['objs'] = $objs;
      return view('welcome', $data);
    }

    public function course()
    {
      $objs = DB::table('courses')
          ->select(
          'courses.*',
          'courses.id as A',
          'typecourses.*'
          )
          ->leftjoin('typecourses', 'typecourses.id', '=', 'courses.type_course')
          ->where('typecourses.id', 2)
          ->orderBy('A', 'desc')
          ->get();

      $data['objs'] = $objs;
      return view('course.index', $data);
    }


    public function course_free()
    {
      $objs = DB::table('courses')
          ->select(
          'courses.*',
          'courses.id as A',
          'typecourses.*'
          )
          ->leftjoin('typecourses', 'typecourses.id', '=', 'courses.type_course')
          ->where('typecourses.id', 3)
          ->where('courses.ch_status', 1)
          ->orderBy('A', 'desc')
          ->get();

      $data['objs'] = $objs;
      return view('course.course_free', $data);
    }

    public function Teaching()
    {
      $objs = DB::table('courses')
          ->select(
          'courses.*',
          'courses.id as A',
          'typecourses.*'
          )
          ->leftjoin('typecourses', 'typecourses.id', '=', 'courses.type_course')
          ->where('typecourses.id', 1)
          ->where('courses.ch_status', 1)
          ->orderBy('A', 'desc')
          ->get();

      $data['objs'] = $objs;
      return view('course.teaching', $data);
    }

}
