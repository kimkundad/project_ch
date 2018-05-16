<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nubthong Su Sanon Shop ซื้อของออนไลน์</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    <link rel="manifest" href="{{url('/manifest.json')}}">
    @yield('stylesheet')
    <style>
        body, body, h1, h2, h3, h4, h5, h6 {
    font-family: 'Prompt', sans-serif;

}
footer-menu {
    background-color: #222;
    padding-top: 60px;
    border-top: 4px solid #555;
    color: #ccc;
}

        .fa-btn {
            margin-right: 6px;
        }
        .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover {
    color: #555;
    background-color: #32d191;
}
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{url('assets/image/logo/Learnsbuy_WebLogo_300.png')}}" height="45" title="logo">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">

                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="font-size:15px;">
                        <span style="font-size:14px;">
                          หมวดหมู่สินค้า
                          <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                    @if(isset($department))
                    @foreach($department as $departments)
                    <li><a href="{{ url('category_all/'.$departments->id) }}"> {{$departments->name_department}}</a></li>
                    @endforeach
                    @endif
                    </ul>
                  </li>

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->


                    <li><a href="{{ url('/news') }}"><i class="fa fa-bullseye"></i> ข่าวสาร</a></li>

                    @if (Auth::guest())
                        <li><a href="{{url('login')}}"><i class="fa fa-sign-in"></i> Login</a></li>
                        <li><a href="{{url('register')}}"><i class="fa fa-lock"></i> Register</a></li>
                    @else
                        <li><a href="{{ url('/user_course') }}"><i class="fa fa-cart-plus"></i> สินค้าของฉัน</a></li>

                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span style="font-size:12px;"><i class="fa fa-heart-o"></i>
                                  {{ Auth::user()->user_coin }}</span> | {{ substr(Auth::user()->name,0,15) }}
                                  <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                              <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i> Profile</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer>


        <div class="footer-menu" style="background: url({{url('assets/image/escheresque_ste.png')}}); ">
        <div class="container" >
            <div class="row">

                <div class="col-md-4">
                    <h4>เกี่ยวกับเรา<span class="head-line"></span></h4>
                    <p>เป็นสมาชิกกับเราและรับสิทธิพิเศษรวมทั้งข่าวสารและโปรโมชั่นสุดพิเศษอย่างต่อเนื่อง เพราะคุณคือคนสำคัญของเรา
                      เราจึงทุ่มเทที่จะสร้างประสบการณ์การชอปปิ้งที่ดีที่สุดให้กับคุณ หากคุณมีคำถามใดๆ พวกเรารอตอบคุณอยู่เพียงต่อสายโทรศัพท์หรืออีเมลล์หาเราเท่านั้น </p>

                   <ul>
                    <li><span>Tel:</span> 091-751-0192 </li>
                    <li><span>Email:</span> home221b@gmail.com </li>
                    <li><span>Website:</span> http://1siamsquare.org </li>
                    <li><span>Line Id:</span> @kimkundad  </li>
                   </ul>

                </div>

                <div class="col-md-2">
                    <h4>หน้าหลัก<span class="head-line"></span></h4>
                    <ul>

                    <li><a href="{{ url('/about') }}" style="color: #ccc;"><i class="fa fa-info"></i> เกี่ยวกับเรา</a></li>
                    <li><a href="{{ url('/contact') }}" style="color: #ccc;"><i class="fa fa-phone-square"></i> ติดต่อเรา</a></li>

                    </ul>
                </div>

                <div class="col-md-2">
                    <h4>บริการ<span class="head-line"></span></h4>
                    <ul>


                    </ul>
                </div>

                <div class="col-md-4">
                    <h4>ติดตามข่าวสาร<span class="head-line"></span></h4>
                    <p>คุณสามารถติดตามข่าวสาร โปรโมชั่น และคอร์สใหม่ ๆ ของเราได้จากช่องทางต่อไปนี้</p>

                <ul class="social-icons">
                    <li>
                        <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a class="google" href="#"><i class="fa fa-google-plus"></i></a>
                    </li>
                    <li>
                        <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a class="google" href="#"><i class="fa fa-youtube"></i></a>
                    </li>

                    <li>
                        <a class="facebook" href="#"><i class="fa fa-instagram"></i></a>
                    </li>


                </ul>

                </div>

                <div class="col-lg-12" style="border-top: 1px solid rgba(255,255,255,.06); margin-top:30px;">
                    <p class="copyright small" style="padding-top: 15px; color: #ccc;">เว็บไซต์ Nubthong Su Sanon Shop แสดงผลได้ดีกับบราวเซอร์  <img src="{{url('assets/image/chrome-512.png')}}" style="height:25px;"> <img src="{{url('assets/image/appicns_Firefox.png')}}" style="height:25px;"> <img src="{{url('assets/image/500px-Internet_Explorer_4_and_5_logo.svg.png')}}" style="height:25px;"> <img src="{{url('assets/image/safari_PNG28.png')}}" style="height:25px;">  เวอร์ชั่นล่าสุด</p>
                    <p class="copyright small" style="padding: 3px 0; color: #ccc;">Copyright © Your Company 2014. All Rights Reserved. Check our <a href="{{url('terms')}}" style="font-size: 14px; color: #ccc;">Terms of service.</a> To learn more about how we use your information, see our <a href="{{url('privacypolicy')}}" style="color: #ccc; font-size: 14px;">Privacy Policy.</a></p>
                </div>
            </div>
        </div>
        </div>


    </footer>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}




    @yield('scripts')
</body>
</html>
