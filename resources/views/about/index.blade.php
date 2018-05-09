
@extends('layouts.app')
@section('stylesheet')
<link href="{{url('assets/css/select-project.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/css/confirm.css')}}" rel="stylesheet" type="text/css" />
@stop('stylesheet')
@section('content')

<style>
.text-green{
      color: #038206;
}
h2 span, h3 span, h4 span, h5 span, h6 span {
    color: #038206;
}
ul.list_order {
    margin: 0 0 30px;
    padding: 0;
    line-height: 30px;
    font-size: 14px;
}
ul.list_order li {
    position: relative;
    padding-left: 40px;
    margin-bottom: 10px;
}
ul.list_order li span {
    background-color: #038206;
    color: #fff;
    position: absolute;
    left: 0;
    top: 0;
    text-align: center;
    font-size: 18px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    line-height: 30px;
}
 ul.list_order {
    list-style: none;
}
</style>
<div class="container" >
    <div class="row">
        <div class="col-md-12 " >
          <h3>เกี่ยวกับเรา Nubthong Su Sanon Shop</h3>
          <h4 class="text-green">ยินดีต้อนรับสู่ ห้างสรรพสินค้าช้อปปิ้งออนไลน์แบบครบวงจร และการขายปลายทางชั้นนำของประเทศไทย</h4>
          <hr>
          <div class="body-project">

                    <div class="row">

                      <div class="col-md-6">
                        <img src="{{url('assets/image/shoppping_cart_integration_blog.jpeg')}}" class="img-responsive">
                      </div>

                      <div class="col-md-6">
                        <p>ห้างสรรพสินค้าช้อปปิ้งออนไลน์ที่ใหญ่ที่สุดในเอเชียตะวันออกเฉียงใต้ ดำเนินธุรกิจในประเทศอินโดนีเซีย มาเลเซีย ฟิลิปปินส์ สิงคโปร์ ไทย และเวียดนาม ลาซาด้ายังเป็นผู้บุกเบิกตลาดอีคอมเมิร์ซในภูมิภาคนี้
                          โดยมอบประสบการณ์การช้อปปิ้งและช่องทางการขายปลีกที่สะดวกสบายสำหรับผู้บริโภคและมอบแพลตฟอร์มสำหรับผู้ค้าให้สามารถเข้าถึงฐานลูกค้าที่ใหญ่ที่สุดในเอเชียตะวันออกเฉียงใต้ได้อย่างง่ายดาย</p>
                          <p>ด้วยผลิตภัณฑ์หลากหลายประเภท ครอบคลุมทั้งผลิตภัณฑ์สุขภาพและความงาม เครื่องใช้และของตกแต่งบ้าน แฟชั่น โทรศัพท์มือถือและแท็บเล็ต อุปกรณ์อิเล็คทรอนิคส์และเครื่องใช้ไฟฟ้าภายในบ้าน และอื่นๆ อีกมากมาย ลาซาด้าจึงเป็นแหล่งช้อปปิ้งออนไลน์ที่รวมผลิตภัณฑ์ที่คุณมองหาไว้ในที่เดียว
                            นอกจากผลิตภัณฑ์ที่หลากหลายจากแบรนด์สินค้าทั้งในประเทศและต่างประเทศแล้ว คุณยังจะได้พบกับผลิตภัณฑ์เอ็กซ์คลูซีฟที่มีจำหน่ายที่ลาซาด้าเท่านั้นอีกด้วย</p>
                            <p>ตระหนักถึงความปลอดภัยของระบบการจ่ายเงินออนไลน์ เราจึงมีวิธีการชำระเงินที่หลากหลายให้ลูกค้าได้เลือก ซึ่งรวมถึงการชำระเงินสดเมื่อส่งสินค้า (Cash-on-Delivery) โดยคุณจะชำระเงินต่อเมื่อได้รับสินค้าเท่านั้น นอกจากนี้ ลาซาด้ายังมีระบบรับรองคุณภาพผลิตภัณฑ์ โดยผลิตภัณฑ์ทุกชิ้นบนเว็บไซต์ลาซาด้าได้รับการรับรองว่าเป็นของแท้ ใหม่
                              ไม่ชำรุดหรือแตกหัก อย่างไรก็ตาม หากเกิดข้อผิดพลาดใดๆ คุณสามารถคืนสินค้าได้ภายใน 7 วัน โดยได้รับเงินคืนเต็มจำนวน ภายใต้นโยบาย </p>
                      </div>

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
