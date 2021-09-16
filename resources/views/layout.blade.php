<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title')</title>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha512-rO2SXEKBSICa/AfyhEK5ZqWFCOok1rcgPYfGOqtX35OyiraBg6Xa4NnBJwXgpIRoXeWjcAmcQniMhp22htDc6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />

 <!-- <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" /> -->


    <meta  
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1"
    />
    <script type="application/x-javascript">
      addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
    </script>

    <link
      href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800"
      rel="stylesheet"
      type="text/css"
    />


    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 
    
  </head>
  <body>
    <div class="header">
      <div class="top-header">
        <div class="container">
          <div class="top-header-left">
            <ul class="support">
              <li>
                <a href="#"><label> </label></a>
              </li>
              <li>
                <a href="#">24x7 live<span class="live"> support</span></a>
              </li>
            </ul>
            <ul class="support">
              <li class="van">
                <a href="#"><label> </label></a>
              </li>
              <li>
                <a href="#"
                  >Free shipping <span class="live">on order over 500</span></a
                >
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="top-header-right">
          <div class="down-top">
              <select class="in-drop">
                <option value="English" class="in-of">English</option>
                
              </select>
            </div>
            <div class="down-top top-down">
              <select class="in-drop">
                <option value="Dollar" class="in-of">Dollar</option>
                 
              </select>
            </div>
                      @guest
                          
                        @else

                    &nbsp;
                    &nbsp;&nbsp;&nbsp;
              <span  class="in-of"><span> </span>{{ Auth::user()->name }}</span>
                 
                        @endguest

                     

           
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="bottom-header">
        <div class="container" style="padding:0px !important">
          <div class="header-bottom-left">
            <div class="logo">
              <a href="/"><img src="{{ asset('assets/images/logo.png') }}" alt=" " /></a>
            </div>
            
            <div class="clearfix"></div>
          </div>
          <div class="header-bottom-right">
             
          @guest
                          
                          @else
  
                          <div class="account">
                        @if(Auth::user()->role==="admin")
                          <a href="/admin/orders"><span> </span>Admin Dashboard</a>
                        
                           
                        @else
                        
                          <a href="/customer-orders"><span> </span>MY ORDERS</a>
                        
                        @endif

            </div>
                          @endguest
           
               
             
           
            

              @guest
                            @if (Route::has('login'))
                            <ul class="login">
              <li>
                            <a href="{{ route('login') }}"><span> </span>{{ __('Login') }}</a>
</li> </ul> 
                            @endif

                            
                        @else
                        <ul class="login">
              <li>
                        <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <span> </span>{{ __('Logout') }}</a>
                                                     </li> </ul> 

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                        @endguest


                
               
              
              <li><a href="#">&nbsp;&nbsp; </a></li>
            </ul>
           

            <div  class="dropdown  btn btn-danger" style="  margin-top:-30px;margin-left:10px !important;color:white">
            <div class=" " data-toggle="dropdown">
              <a href="#" style="color:white"><span> </span>  <i class="fa fa-shopping-cart" aria-hidden="true"></i> CART {{ count((array) session('cart')) }}</a>
            </div>

              <!-- <button type="button" class="btn btn-info" >
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
                <span class="badge badge-pill badge-danger"
                  >{{ count((array) session('cart')) }}</span
                >
              </button> -->


              <div class="dropdown-menu">
                <div class="row total-header-section">
                  <div class="col-lg-6 col-sm-6 col-6">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span class="badge badge-pill badge-danger"
                      >{{ count((array) session('cart')) }}</span
                    >
                  </div>

                  <?php $total = 0 ?>
                  @foreach((array) session('cart') as $id => $details)
                  <?php $total += $details['price'] * $details['qty'] ?>
                  @endforeach

                  <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                    <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                  </div>
                </div>

                @if(session('cart')) @foreach(session('cart') as $id =>
                $details)
                <div class="row cart-detail">
                  <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                    <img src="{{ $details['photo'] }}" />
                  </div>
                  <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                    <p>{{ $details['name'] }}</p>
                    <span class="price text-info">
                      ${{ $details['price'] }}</span
                    >
                    <span class="count"> Quantity:{{ $details['qty'] }}</span>
                  </div>
                </div>
                @endforeach @endif
                <div class="row">
                  <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                    <a
                      href="{{ url('cart') }}"
                      class="btn btn-warning btn-block text-center"
                      >Checkout</a
                    >
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div> <br>
      <div  style="width:70%;margin:auto;border:none"> @yield('content')</div>
    </div>

    @yield('scripts')
  </body>
</html>


 