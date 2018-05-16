
@extends('layouts.app')
@section('stylesheet')
<link rel="stylesheet" href="{{url('assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css')}}">
<link href="{{url('assets/css/select-project.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/css/confirm.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/date/css/bootstrap-datepicker.standalone.css')}}">
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
    h4 span{
      font-size: 14px;
      color: #26b899;
    }
    .bank{
    padding-right: 0px;
    padding-left: 0px;
    }

    hr {
    margin-top: 10px;
    margin-bottom: 10px;
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
         <h3>{{$courseinfo->title_course}} <span class="head-lines"></span></h3>

          <div class="col-xs-12  col-md-6 extra-paddingright ">

            <div class="">
            <div class="col-md-12 course-overall-wrapper">
              <h4>บิลเลขที่ {{$courseinfo->Oid}}</h4>



              <img src="{{url('assets/uploads/'.$courseinfo->image_course)}}" class="img-responsive">
            <table class="table table-striped">
                <tr>
                  <td>ชื่อผู้เรียน</td>
                  <td class="text-right">kimkundad</td>
                </tr>
                <tr>
                  <td>ชื่อสินค้า</td>
                  <td class="text-right">{{$courseinfo->title_course}}</td>
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
                  <td class="text-right"><h3 > <input type="number" class="form-control" id="total_2" value="{{$courseinfo->price_course}}" > </h3></td>
                </tr>
              </table>
              </div>
              </div>

          </div>




          <div class="col-xs-12  col-md-6">

            <div class="">
            <div class="col-md-12 course-overall-wrapper">
              <h4>แจ้งโอนเงิน <span>( โอนเงินผ่านธนาคาร )</span></h4>
              <hr>

              @foreach($bank as $banks)
              <div class="col-md-6 bank">
                  <div class="media">
                    <div class="media-left">
                      <a href="#">
                        <img class="media-object img-circle " src="{{url('assets/images/bank/'.$banks->image)}}" height="60" alt="...">
                      </a>
                    </div>
                  <div class="media-body" style="text-align:left">
                   <p class="t-gray"> {{$banks->bank_name}}<br>{{$banks->bank_number}}<br>{{$banks->bank_owner}}</p>
                  </div>
            </div>
              </div>
              @endforeach

        <!--      <div class="col-md-6 bank">
                  <div class="media">
                    <div class="media-left">
                      <a href="#">
                        <img class="media-object img-circle " src="{{url('assets/image/kbank.png')}}" height="60" alt="...">
                      </a>
                    </div>
                  <div class="media-body" style="text-align:left">
                   <p class="t-gray"> ธนาคารกสิกรไทย<br>860-0-24048-8<br>kimkundad</p>
                  </div>
            </div>
              </div>

              <div class="col-md-6 bank">
                  <div class="media">
                    <div class="media-left">
                      <a href="#">
                        <img class="media-object img-circle " src="{{url('assets/image/scb.png')}}" height="60" alt="...">
                      </a>
                    </div>
                  <div class="media-body" style="text-align:left">
                   <p class="t-gray"> ธนาคารไทยพาณิชย์<br>860-0-24048-8<br>kimkundad</p>
                  </div>
            </div>
          </div> -->

              <br>

              <div class="col-md-12">
                  <form action="{{url('/bil_course/'.$courseinfo->Oid)}}" method="post" enctype="multipart/form-data" name="product">
                    <input type="hidden" name="_method" value="put">
                    {{ csrf_field() }}
               <div class="form-group">
                  <label for="exampleInputPassword1">เลือกธนาคารที่โอน</label>
                  <select class="form-control" name="bankname" required="">
                    <option value="">--เลือกธนาคาร--</option>
                    @foreach($bank as $banks)
                    <option value="{{$banks->id}}">{{$banks->bank_name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">ยอดโอน</label>
                  <input type="number" class="form-control" name="totalmoney" id="totals" value="{{$courseinfo->price_course}}" required="">
              
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">จำนวนสินค้าในคลังที่มี</label>
                  <input type="number" class="form-control" value="{{$courseinfo->discount}}"  readonly>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">ใส่จำนวนสินค้าที่สั่งซื้อ</label>
                  <input type="number" class="form-control" onblur="findTotal()" value="1" id="number" name="item_oriduct" required="">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">สลิปโอนเงิน (*ถ้ามี)</label>
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="input-append">
                      <div class="uneditable-input">
                        <i class="fa fa-file fileupload-exists" style="float:left; margin-right:8px;"></i>
                        <span class="fileupload-preview"></span>
                      </div>
                      <span class="btn btn-default btn-file">
                        <span class="fileupload-exists">Change</span>
                        <span class="fileupload-new">Select file</span>
                        <input type="file" name="image"/>
                      </span>
                      <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                    </div>
                  </div>

                </div>

                <div class="form-group col-md-6 bank" style="width: 48%; margin-right:15px;">
                  <label for="exampleInputEmail1">วันที่โอน</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </span>
                    <input type="text" data-plugin-datepicker name="day" class="form-control datepicker" required="">
                  </div>

                </div>

                <div class="form-group col-md-6 bank" style="width: 48%; ">
                  <label for="exampleInputEmail1">เวลาที่โอน</label>
                  <input type="text" class="form-control" name="timer" placeholder="10.52น." >
                </div>




                <div class="col-md-12" style="padding-left:0px; padding-right:0px;">
                <button type="submit" class="btn btn-success1 btn-lg btn-block"><i class="fa fa-upload"></i> บันทึกข้อมูล</button>
                <br>
              </div>

              </form>

              </div>





              </div>
              </div>

          </div>


        </div>
    </div>



</div>
</div>
@endsection

@section('scripts')
<script src="{{url('assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js')}}"></script>
<script src="{{url('assets/date/js/bootstrap-datepicker.js')}}"></script>
<script>
function findTotal(){

  var sum_1 = {{$courseinfo->price_course}};

  var value = parseInt(document.getElementById('number').value, 0);

//  var totals = document.getElementsByName('totals_1');



document.getElementById('total_2').value = sum_1*value;
document.getElementById('totals').value = sum_1*value;
}

$.fn.datepicker.defaults.format = "yyyy-mm-dd";
$('.datepicker').datepicker({
});
</script>

@stop('scripts')
