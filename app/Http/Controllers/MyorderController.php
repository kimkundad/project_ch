<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\department;

class MyorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $department = department::all();
      $data['department'] = $department;

      $objs = DB::table('users')
          ->select(
          'users.*'
          )
          ->where('users.id', Auth::user()->id)
          ->first();


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
            ->where('submitcourses.status', '=', 2)
            ->where('users.id', Auth::user()->id)
            ->get();

          $data['coursess'] = $coursess;

        //  dd($objs);
      $data['objs'] = $objs;


        return view('my_order.index', $data);
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
