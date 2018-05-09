<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cardmoney;
use App\department;
use App\Http\Requests;

class WalletController extends Controller
{
    //

    public function index(){
      $department = department::all();
      $data['department'] = $department;

      $objs = cardmoney::all();
      $data['objs'] = $objs;

      return view('wallet.index', $data);
    }
}
