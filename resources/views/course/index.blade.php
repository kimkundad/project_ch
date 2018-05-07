
@extends('layouts.app')
@section('stylesheet')
<link href="{{url('assets/css/select-project.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/css/confirm.css')}}" rel="stylesheet" type="text/css" />
@stop('stylesheet')
@section('content')
<div class="container" >
    <div class="row">
        <div class="col-md-12 " >
          <h3>คอร์สเรียนทั้งหมด</h3>
          <hr>
          <div class="body-project">

                    <div class="row">

                      @if(isset($objs))
                      @foreach($objs as $obj)

                      <div class="col-sm-4 col-md-3">
                            <div class="thumbnail">
                              <a href="{{url('/courseinfo/'.$obj->A)}}">
                              <img src="{{url('assets/uploads/'.$obj->image_course)}}" >
                              </a>
                              <div class="caption" style="padding: 3px;">
                                <div class="descript bold">
                                    <a href="{{url('/courseinfo/'.$obj->A)}}" data-dismiss="modal" data-toggle="modal" data-target="#show_detail54"> {{$obj->title_course}}</a>
                                </div>
                                <div class="descript" style="border-bottom: 1px dashed #999;">
                                    {{$obj->type_name}} เรียน {{$obj->day_course}}, {{$obj->time_course}}
                                </div>

                                <div class="descript" style="height: 20px;">
                                  <div class="descript-t">
                                  <div class="postMetaInline-authorLockup">
                                    <div >
                                      <span class="readingPrice">
                                    <span class="text-primary">{{$obj->code_course}}</span>, ฿ {{$obj->price_course}} บาท
                                      </span>
                                    </div>
                                  </div>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>

                      @endforeach
                      @endif
















                    </div>



          </div>
        <!--    <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Your Application's Landing Page.
                </div>
            </div> -->



        </div>
    </div>
</div>
@endsection
