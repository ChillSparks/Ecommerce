<!DOCTYPE html>
<html lang="en">
  @include('header')

  <body>
    <!--================Header Menu Area =================-->
    @include('menus')
    <!--================Header Menu Area =================-->
  <style>
    .tracking_form,.middle{
      margin:auto;
      text-align:center;
      padding:10px;
    }
    p{
      color:#797979 !important;
    }
  </style>
    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div
            class="banner_content d-md-flex justify-content-between align-items-center"
          >
            <div class="mb-3 mb-md-0">
              <p>Are you new member? Register <a href="/register">here</a></p>
              
            </div>
            <div class="page_link">
              <a href="/">Home</a>
              <a href="/login">Login</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Tracking Box Area =================-->
    <section class="tracking_box_area section_gap">
        <div class="container">
            <div class="tracking_box_inner">
            <h2 class="middle">Forgot Password</h2>
            <h4 class="middle">Enter Your Email Address</h4>
                <form class="row tracking_form" action="{{route('check')}}" method="post" >
                @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{Session::get('fail')}}
                        </div>
                @elseif(Session::get('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
                @endif    

                @csrf
                    <div class="col-md-12 form-group">
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                        <input type="email" class="form-control" id="email" name="email" 
                         placeholder="Email Address">
                        
                    </div>
                    <div class="col-md-12 form-group">
                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                        <input type="password" class="form-control" id="password" name="password" 
                         placeholder="Enter Password">
                        
                    </div>
                    <div class="col-md-12 form-group">
                        <span class="text-danger">@error('cpassword'){{ $message }}@enderror</span>
                        <input type="password" class="form-control" id="cpassword" name="cpassword" 
                         placeholder="Confirm Password">
                        
                    </div>


                    <div class="col-md-12 form-group">
                        <button type="submit" class="btn submit_btn">Reset Password</button>
                        <a href="/login" class="btn submit_btn">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--================End Tracking Box Area =================-->

    <!--================ start footer Area  =================-->
    @include('footer')
    <!--================ End footer Area  =================-->




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/stellar.js"></script>
    <script src="vendors/lightbox/simpleLightbox.min.js"></script>
    <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="vendors/isotope/isotope-min.js"></script>
    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="vendors/jquery-ui/jquery-ui.js"></script>
    <script src="vendors/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendors/counter-up/jquery.counterup.js"></script>
    <script src="js/theme.js"></script>
</body>

</html>