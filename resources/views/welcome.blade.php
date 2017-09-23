<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="{{ asset('bootstrap/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- styles -->
    <link href="{{ asset('bootstrap/css/styles.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
  </head>
  <body>
    <div class="header">
         <div class="container">
            <div class="row">
               <div class="col-md-5">
                  <!-- Logo -->
                  <div class="logo">
                     <h1><a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a></h1>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="input-group form">
                           <input type="text" class="form-control" placeholder="Search...">
                           <span class="input-group-btn">
                             <button class="btn btn-primary" type="button">Search</button>
                           </span>
                      </div>
                    </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="navbar navbar-inverse" role="banner">
                      <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                        <ul class="nav navbar-nav">
                          @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                          @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
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
          <div class="col-md-3">
            <div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="current"><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> QL. khách sạn</a></li>
                    <li><a href="{{ url('/room-type') }}"><i class="glyphicon glyphicon-calendar"></i> QL. phòng</a></li>
                    <li><a href="{{ url('/service') }}"><i class="glyphicon glyphicon-list-alt"></i> QL. dịch vụ</a></li>
                    <li><a href="{{ url('/order') }}"><i class="glyphicon glyphicon-calendar"></i> QL. giao dịch</a></li>
                    @if(false)
                    <li><a href="{{ url('/ql-khach-hang') }}"><i class="glyphicon glyphicon-book"></i> QL. khách hàng</a></li>
                    <li><a href="{{ url('/ql-nhan-vien') }}"><i class="glyphicon glyphicon-user"></i> QL. nhân viên</a></li>
                    @endif
                </ul>
             </div>
          </div>
          <div class="col-md-9">
            @yield('content')
          </div>
        </div>
    </div>

    <footer>
         <div class="container">
         
            <div class="copy text-center">
               Copyright 2017 <a href='#'>{{ config('app.name', 'Laravel') }}</a>
            </div>
            
         </div>
      </footer>

    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('bootstrap/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/custom.js') }}"></script>
  </body>
</html>