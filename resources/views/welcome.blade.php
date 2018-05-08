@extends('layouts.app')
@section('stylesheet')
<link href="{{url('assets/css/select-project.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/css/golf-style.css')}}" rel="stylesheet" type="text/css">
<link href="{{url('assets/css/slide-show.css')}}" rel="stylesheet" type="text/css">
<style type="text/css">
.descript-t {
    float: right;
    height: 40px;
}
.content-section-b {
    padding: 50px 0;
     background-color: #f5f5f5;
}
footer {
    margin-top: 0px;

  }
  .banner {
      border-bottom: 1px solid #e0e0e0;
      background-color: #fff;
  }
  @media (min-width: 1200px)
          {
            #search_container {
                margin-bottom: 22px;
            }
            .t_v_midden{
              border-right: 1px solid #e0e0e0;
            }

            .start-detail{
              margin-left: 30px;
            }
          }

#first-slider .slide1 {
    background-image: url({{url('assets/image/bg_180226_0002.jpg')}});
}
#first-slider .slide2 {
    background-image: url({{url('assets/image/bg_180226_0002.jpg')}});
}
#first-slider .slide3 {
    background-image: url({{url('assets/image/bg_180226_0002.jpg')}});
}
#first-slider .slide4 {
    background-image: url({{url('assets/image/bg_180226_0002.jpg')}});
}
#first-slider h3{
    color: #000 !important;
}
#first-slider h4 {
    color: #666 !important;
        font-size: 22px !important;
}
.carousel-control .fa-angle-right {
    color: #666;
    border: 3px solid #666;
}
.carousel-control .fa-angle-left {
    color: #666;
    border: 3px solid #666;
}

</style>
@stop('stylesheet')
@section('content')








<div class="content-section-a">
        <div class="container" >
 <!--   <div class="row">
        <div class="col-md-12" >

            <h3>ครูพี่โฮม ตัวเตอร์ภาษาญี่ปุ่น</h3>
            <p>พบกับเฉลยข้อสอบ PAT 7.3 ภาษาญี่ปุ่นล่าสุด ติวสอบวัดระดับภาษาญี่ปุ่น <b>N1 N2 N3 N4 N5</b>
                <br>กวดวิชาภาษาญี่ปุ่น ติวไวยากรณ์ ศัพท์ คันจิ N1 N2 N3 N4 N5 กับครูพี่โฮม <br>
                อัพเดตเนื้อหาใหม่ล่าสุด 2559 รับสมัครแล้ว !!</p>
        </div>
    </div>  -->


    <div class="row">

      <div class="col-md-3">
        <div class="media-text__media">
<img src="{{url('assets/images/trust-security-dropbox-vflBuZ3Dn.svg')}}" alt="">
        </div>

      </div>

      <div class="col-md-6" style="padding-right: 0px; ">
        <h1 class="entry-title">ห้างสรรพสินค้าออนไลน์</h1>
        <p class="lead-th" style="text-decoration:none">เราคือห้างสรรพสินค้าออนไลน์ที่ จัดส่งสินค้ารวดเร็ว เชื่อถือได้ และมอบความสะดวกสบายในการเลือกซื้อสินค้าแก่ลูกค้า
        ด้วยการนำเสนอสินค้ามากมายหลากหลายชนิด ไม่ว่าจะเป็น แฟชั่น อุปกรณ์อิเล็กทรอนิคส์ ของเล่น อุปกรณ์กีฬา ไปจนถึงเครื่องใช้ในบ้าน พร้อมมอบสิ่งที่ดีที่สุด ให้แก่ลูกค้าเสมอ
        ไม่ว่าจะเป็นวิธีการชำระเงินปลายทาง หรือบริการการคืนสินค้าฟรี และศูนย์บริการลูกค้าที่พร้อมจะให้คำแนะนำตลอดการเลือกซื้อสินค้า เราไม่เคยหยุดที่จะหาสิ่งที่ดีที่สุดให้คุณ เพราะเราคือห้างสรรพสินค้าที่อยู่เพียงแค่ปลายนิ้ว</p>




          <div class="row " style="padding-left:17px;">

            <p class="news-app-detail" style="float:right; margin-right: 45px;">
    <a class="news-app-box" href="#" target="_blank"> "สมัครเป็นส่วนหนึ่งของเวป วันนี้ ทั้ง
        <img src="{{url('assets/images/app.png')}}" data-pin-nopin="true"> และ <img src="{{url('assets/images/play.png')}}" data-pin-nopin="true"></a></p>

          </div>


      </div>




<div class="col-md-3" style="padding-left: 15px;">

        <div class="home-downstat">
              <h2 class="text-center">สมัครเป็นส่วนหนึ่งของเวป</h2>
           <a href="{{url('register')}}" style="    width: 100%;" class="ui facebook fluid button"><i class="fa fa-facebook icon-fa"></i> สมัครหรือล็อกอินด้วย Facebook</a>

           <a href="{{url('register')}}" style="margin-top:12px;     width: 100%;" class="ui google plus fluid button"><i class="fa fa-google-plus icon-fa"></i> สมัครหรือล็อกอินด้วย Google</a>

            <a class="ui fluid button" href="{{url('register')}}" style="margin-top:12px;   width: 100%;"><i class="fa fa-envelope icon-fa"></i> สมัครหรือล็อกอินด้วย Email</a>
            <p class="text-center" style="margin-top:15px;">สบายใจ หายห่วง เพราะเรา ไม่มีนโยบายเก็บหรือแชร์ข้อมูลส่วนตัวของคุณ</p>
        </div>

      </div>




    </div>







</div></div>









<div class="content-section-b">
        <div class="container" >


          <div class="row">
        <div class="col-md-12 " >
          <h3>คอร์สใหม่ล่าสุด </h3>

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
                                <span class="text-primary">{{$obj->code_course}}</span>, ฿ @if($obj->price_course == 0)
                                    Free Course
                                                            @else
                                                      {{$obj->price_course}}  บาท
                                                            @endif
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
                  <!--    <div class="col-sm-4 col-md-3">
                        <div class="thumbnail">
                          <a href="{{url('/courseinfo')}}">
                          <img src="{{url('assets/image/1480125677senseino-ln-02.png')}}" >
                          </a>
                          <div class="caption" style="padding: 3px;">
                            <div class="descript bold">
                                <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#show_detail54"> เรียนออนไลน์ภาษาจีนระดับต้น 2 บทที่ 1-10</a>
                            </div>
                            <div class="descript" style="border-bottom: 1px dashed #999;">
                                ภาษาจีนระดับต้น 2 เรียนวันจันทร์, พุธ 20.00 น.
                            </div>

                            <div class="descript" style="height: 20px;">
                              <div class="descript-t">
                              <div class="postMetaInline-authorLockup">
                                <div >
                                  <span class="readingPrice">
                                ฿ 2,500 บาท
                                  </span>
                                </div>
                              </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>  -->





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
</div>

<!--
<div class="footer-mailchimp">
        <div class="container text-center">


                <h2>ติดตามเพิ่มเติมได้ที่เมนู "ติวญี่ปุ่นฟรี" </h2>
                <h4>ฝากอีเมลของคุณไว้ ทางทีมงานของเรายินดีที่จะติดต่อกลับไปโดยเร็วที่สุด</h4>
                <div id="mc_embed_signup">
                    <form role="form" action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank" novalidate="">
                    <div class="input-group input-group-lg">
                    <input type="email" name="EMAIL" class="form-control" id="mce-EMAIL" placeholder="Email address...">
                    <span class="input-group-btn">
                    <button type="submit" name="subscribe" id="mc-embedded-subscribe" class="btn btn-default">Subscribe!</button>
                    </span>
                    </div>
                    <div id="mce-responses">
                    <div class="response" id="mce-error-response" style="display:none"></div>
                    <div class="response" id="mce-success-response" style="display:none"></div>
                    </div>
                    </form>
                </div>

        </div>
        </div>      -->

@endsection

@section('scripts')
<script type="text/javascript" src="{{url('assets/js/slide-show.js')}}"></script>
@stop('scripts')
