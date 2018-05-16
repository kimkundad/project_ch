
@extends('layouts.app')
@section('stylesheet')
<link href="{{url('assets/css/select-project.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/css/confirm.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('./assets/datepicker/css/datepicker.css')}}">
<link rel="stylesheet" href="{{url('assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css')}}">

<style type="text/css">

.btn-fb {
    border: 1px solid #3b5998;
    color: white;
    background-color: #5A73AA;
    border-radius: 2px;
    float: left;
}
.btn-mini.border-btn {
    padding: 2px 12px;
    font-size: 13px;
}
.btn-wishlist {
    padding: 2px 7px !important;
    font-size: 14px;
    padding: 5px;
    -moz-transition: 0.8s;
    -webkit-transition: 0.8s;
    -o-transition: 0.8s;
    transition: 0.8s;
    opacity: 0.85;
    margin-top: 15px;
    margin-left: 4px;
    font-size: 12px

}
.head-lines {
    position: absolute;
    /* bottom: 0; */
    /* left: 0; */
    display: block;
    width: 50px;
    height: 3px;
    background-color: #00c402;
    margin: 0;
}
h2{

  margin-bottom: 30px;
}
h4{
  margin-top: 20px;
}
.extra-paddingright {
    padding-left: 5px;
}

    .course-overall-wrapper{

    }
</style>

@stop('stylesheet')
@section('content')

<?php
function DateThaif($strDate)
{
$strYear = date("Y",strtotime($strDate))+543;
$strMonth= date("n",strtotime($strDate));
$strDay= date("j",strtotime($strDate));
$strHour= date("H",strtotime($strDate));
$strMinute= date("i",strtotime($strDate));
$strSeconds= date("s",strtotime($strDate));
$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
$strMonthThai=$strMonthCut[$strMonth];
return "$strDay $strMonthThai";
}
 ?>
<?php
function DateThai($strDate)
{
$strYear = date("Y",strtotime($strDate))+543;
$strMonth= date("n",strtotime($strDate));
$strDay= date("j",strtotime($strDate));
$strHour= date("H",strtotime($strDate));
$strMinute= date("i",strtotime($strDate));
$strSeconds= date("s",strtotime($strDate));
$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
$strMonthThai=$strMonthCut[$strMonth];
return "$strDay $strMonthThai $strYear";
}
 ?>

<div class="content-section-a">
<div class="container" >


    <div class="row">
        <div class="col-md-12 " >
         <h2>{{$objs->title_course}} <span class="head-lines"></span></h2>

          <div class="col-xs-12  col-md-6 extra-paddingright ">

            <div class="">
            <div class="col-md-12 course-overall-wrapper">
              <h4>สรุปข้อมูลคำสั่งซื้อ</h4>
              <img src="{{url('assets/uploads/'.$objs->image_course)}}" class="img-responsive">
            <table class="table table-striped">
                <tr>
                  <td>ชื่อสั่งสินค้า</td>
                  <td class="text-right">{{$user->name}}</td>
                </tr>
                <tr>
                  <td>ชื่อสินค้า</td>
                  <td class="text-right">{{$objs->title_course}}</td>
                </tr>

                <tr>
                  <td>จัดจำหน่ายโดย</td>
                  <td class="text-right">lazada</td>
                </tr>
                <tr>
                  <td>ตัวเลือกในการจัดส่ง</td>
                  <td class="text-right">สามารถเก็บเงินปลายทางได้</td>
                </tr>

                <tr>
                  <td><i class="fa fa-bus"></i> ตัวเลือกในการจัดส่ง</td>
                  <td class="text-right"> จัดส่งแบบธรรมดา</td>
                </tr>
                <tr>
                  <td><i class="fa fa-diamond"></i> การคืนสินค้า และ การรับประกัน</td>
                  <td class="text-right"> คืนสินค้าได้ภายใน 7 วัน, ไม่มีการรับประกันสินค้า</td>
                </tr>

                <tr>
                  <br>
                  <td><h3> ยอดรวมทั้งสิ้น</h3></td>
                  <td class="text-right"><h3> @if($objs->price_course == 0)
                      Free course
                                              @else
                                        {{$objs->price_course}}  บาท
                                              @endif
                                               </h3></td>
                </tr>
              </table>
              </div>
              </div>

          </div>




          <div class="col-xs-12  col-md-6">

            <div class="">
            <div class="col-md-12 course-overall-wrapper">
              <h4>ข้อมูลการจัดส่ง</h4>


              <hr>

              <form action="{{url('/submit_course/'.$objs->id)}}" method="post" enctype="multipart/form-data" name="product">


                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="exampleInputPassword1">ชื่อบัญชีผู้ใช้</label>
                  <input type="text" class="form-control input-sm" name="name" value="{{Auth::user()->name}}">
                  @if ($errors->has('name'))
                      <span class="help-block">
                          <strong class="text-danger">กรอกชื่อนักเรียนด้วยนะจ๊ะ</strong>
                      </span>
                  @endif
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">เบอร์โทร</label>
                  <input type="text" class="form-control input-sm" name="phone" value="{{old('phone', Auth::user()->phone)}}">
                  @if ($errors->has('phone'))
                      <span class="help-block">
                          <strong class="text-danger">กรอกเบอร์โทรนักเรียนด้วยนะจ๊ะ</strong>
                      </span>
                  @endif
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" class="form-control input-sm" id="exampleInputEmail1" name="email" value="{{Auth::user()->email}}" readonly>
                </div>



                <div class="form-group">
                  <label for="exampleInputPassword1">ที่อยู่การจัดส่งสินค้า *</label>
                  <textarea class="form-control" rows="5" name="address" id="comment">{{old('address', Auth::user()->address)}}</textarea>
                  @if ($errors->has('address'))
                      <span class="help-block">
                          <strong class="text-danger">กรอกที่อยู่การจัดส่งสินค้าด้วยนะจ๊ะ </strong>
                      </span>
                  @endif
                </div>

                <button type="submit" class="btn btn-success1 btn-lg btn-block"><i class="fa fa-upload"></i> บันทึกและไปขั้นตอนต่อไป</button>
              </form>
              <br><br>
              </div>
              </div>

          </div>


        </div>
    </div>



</div>
</div>
@endsection


@section('scripts')
<script src="{{asset('/assets/datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{url('assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js')}}"></script>
<script>
$('.datepicker').datepicker()
$.fn.datepicker.defaults.format = "yyyy-mm-dd";
</script>



@stop('scripts')
