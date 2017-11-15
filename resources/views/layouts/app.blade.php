<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>quanlynhanghi.net</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <!-- <link href="{{ url('/') }}/public/bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- styles -->
    <link href="{{ url('/') }}/public/bootstrap/css/styles.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ url('/') }}/public/css/style.css" rel="stylesheet">

    <!-- sweetalert -->
    <script src="{{ url('/') }}/public/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/sweetalert/sweetalert.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <style type="text/css">

      #loading{
        position: fixed;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);;
        z-index: 999;
        opacity: 1;
      }

      #loading .circle {
        width: 200px;
        height: 200px;
        background: #003a34;
        border-radius: 50%;
        overflow: hidden;
        border: 6px solid #fff;
        box-shadow: 0 0 1px rgba(0, 0, 0, .7),
          inset 0 0 1px rgba(0, 0, 0, .7),
          0 4px 4px rgba(0, 0, 0, .3),
          inset 0px 0px 0px 29px rgba(0, 58, 52, 1),
          inset 0px 0px 0px 30px rgba(50, 120, 80, 1),
          inset 0px 0px 0px 59px rgba(0, 58, 52, 1),
          inset 0px 0px 0px 60px rgba(50, 120, 80, 1),
          inset 0px 0px 0px 89px rgba(0, 58, 52, 1),
          inset 0px 0px 0px 90px rgba(50, 120, 80, 1);
        position: absolute;
        top:50%;
        left:50%;
        margin-top:-100px; /* this is half the height of your div*/  
        margin-left:-100px;
        z-index: 1000;
      }

      #loading .tr {
        width: 200px;
        height: 200px;
        position: relative;
        animation: rt 3s infinite linear;
        border-radius: 50%;
        overflow: hidden;
        left: -6px;
        top: -6px;
      }

      #loading .tr:after {
        content: '';
        width: 50%;
        height: 50%;
        top: 0px;
        background: linear-gradient(-90deg, rgba(0,58,52,.5) 0%,rgba(0,0,0,0) 100%),
        linear-gradient(to bottom, rgba(0,244,0,1) 0%,rgba(0,58,52,0) 100%);
        transform:rotate(90deg);
        position: absolute;
        border-top: 1px solid #29eb2b;
      }

      @keyframes rt {
        from {
          transform:rotate(0deg);
        }
        to {
          transform:rotate(360deg);
        }
      }

      #map {
        height: 400px;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div id="loading" style="display: none;">
      <div class="circle">
        <div class="tr"></div>
      </div>
    </div>
    <div class="header">
         <div class="container-fuild">
            <div class="row">
               <div class="col-md-5 col-lg-6">
                  <!-- Logo -->
                  <div class="logo">
                     <h1><a href="{{ url('/') }}">{{ config('app.name', 'Quanlynhanghi.net') }}</a></h1>
                  </div>
               </div>
               <div class="col-md-4 col-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="input-group form" style="display: none;">
                           <input type="text" class="form-control" placeholder="Search...">
                           <span class="input-group-btn">
                             <button class="btn btn-primary" type="button">Search</button>
                           </span>
                      </div>
                    </div>
                  </div>
               </div>
               <div class="col-md-3 col-lg-2">
                  <div class="navbar navbar-inverse" role="banner">
                      <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                        <ul class="nav navbar-nav">
                          @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                            <li><a href="{{ route('register') }}">Đăng ký</a></li>
                          @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/') }}/user/{{ Auth::user()->id }}/postImages">Thêm ảnh</a>
                                        <a href="{{ url('/') }}/user/{{ Auth::user()->id }}">Sửa thông tin</a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Thoát
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                          @endif
                        </ul>
                      </nav>
                  </div>
               </div>
            </div>
         </div>
    </div>

    <div class="page-content">
        <div class="row">
          <div class="col-md-3 col-lg-2">
            <div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="current"><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> QL. nhà nghỉ</a></li>
                    <li><a href="{{ url('/roomtype') }}"><i class="glyphicon glyphicon-calendar"></i> QL. phòng</a></li>
                    <li><a href="{{ url('/service') }}"><i class="glyphicon glyphicon-list-alt"></i> QL. dịch vụ</a></li>
                    <li><a href="{{ url('/order') }}"><i class="glyphicon glyphicon-calendar"></i> QL. giao dịch</a></li>
                    @if(false)
                    <li><a href="{{ url('/ql-khach-hang') }}"><i class="glyphicon glyphicon-book"></i> QL. khách hàng</a></li>
                    <li><a href="{{ url('/ql-nhan-vien') }}"><i class="glyphicon glyphicon-user"></i> QL. nhân viên</a></li>
                    @endif
                </ul>
             </div>
          </div>
          <div class="col-md-9 col-lg-10">
            @yield('content')
          </div>
        </div>
    </div>

    <div class="footer">
         <div class="container">
         
            <div class="copy text-center">
               Copyright 2017 <a href='#'>{{ config('app.name', 'quanlynhanghi.net') }}</a>
            </div>
            
         </div>
      </div>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- <script src="{{ url('/') }}/public/bootstrap/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/public/bootstrap/js/custom.js"></script>
  </body>
</html>