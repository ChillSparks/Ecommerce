<!DOCTYPE html>
<html lang="en">
  @include('header')

  <body>
    <!--================Header Menu Area =================-->
  @include('menus')
    <!--================Header Menu Area =================-->

    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div
            class="banner_content d-md-flex justify-content-between align-items-center"
          >
            <div class="mb-3 mb-md-0">
              <h2>Cart</h2>
              <p>Very us move be blessed multiply night</p>
            </div>
            <div class="page_link">
              <a href="index.html">Home</a>
              <a href="cart.html">Cart</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Cart Area =================-->
    <section class="cart_area">
      <div class="container">
        <form method="post" action="{{route('updatecart')}}">
          @csrf

          @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{Session::get('fail')}}
                        </div>
          @elseif(Session::get('success'))
          <div class="alert alert-success">
              {{Session::get('success')}}
          </div>
          @endif  
        <div class="cart_inner">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Product</th>
                  <th scope="col">Price</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach($cart as $c)
                <input type="hidden" value="{{$c->id}}" name="proid[]">
                <tr>
                  <td>
                    <div class="media">
                      <div class="d-flex">
                        <img
                          src="../../img/product/{{$c->image}}"
                          alt="" width="100px" height="100px"
                        />
                      </div>
                      <div class="media-body">
                        <p>{{$c->name}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <h5>${{$c->price}}</h5>
                  </td>
                  <td>
                    <div class="product_count">
                      <input
                        type="text"
                        name="qty[]"
                        id="qty{{$c->id}}"
                        maxlength="12"
                        value="{{$c->cartqty}}"
                        title="Quantity:"
                        class="input-text qty"
                      />
                      <button
                        onclick="var result = document.getElementById('qty{{$c->id}}'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                        class="increase items-count"
                        type="button"
                      >
                        <i class="lnr lnr-chevron-up"></i>
                      </button>
                      <button
                        onclick="var result = document.getElementById('qty{{$c->id}}'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                        class="reduced items-count"
                        type="button"
                      >
                        <i class="lnr lnr-chevron-down"></i>
                      </button>
                    </div>
                  </td>
                  <td>
                    <h5>${{$c->cartqty*$c->price}}</h5>
                  </td>
                </tr>
                @endforeach

                <tr class="bottom_button">
                  <td>
                    <button type="submit" class="gray_btn" >Update Cart</button>
                  </td>
                  <td></td>
                  <td></td>
                  <td>
                    <div class="cupon_text">
                      <input type="text" placeholder="Coupon Code" />
                      <a class="main_btn" href="#">Apply</a>
                      <a class="gray_btn" href="#">Close Coupon</a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td>
                    <h5>Subtotal</h5>
                  </td>
                  <td>
                    <h5>$2160.00</h5>
                  </td>
                </tr>

          </form>
        
          <form method="post" action="{{route('order')}}">
            @csrf
                <tr class="shipping_area">
                  <td></td>
                  <td></td>
                  <td>
                    <h5>Shipping</h5>
                    
                  </td>
                  <td>
                    <div class="shipping_box">
                      <ul class="list">
                        <li onclick="activeclass(this.id);" id="flat" class="active">
                          <a>Flat Rate: $5.00</a>
                        </li>
                        <li onclick="activeclass(this.id);" id="free" class="">   
                          <a>Free Shipping</a>
                        </li>
                        <li onclick="activeclass(this.id);" id="delivery" class="">
                          <a>Local Delivery: $2.00</a>
                        </li>

                        <input type="hidden" name="for_radio" id="for_radio">
                      </ul>
            
                      <div class="mt-10">
                      
                        <textarea class="single-textarea" name="delivery_note" placeholder="Delivery Note" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Message'"></textarea>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr class="out_button_area">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <div class="checkout_btn_inner">
                      <a class="gray_btn" href="#">Continue Shopping</a>
                      <button type="submit" class="main_btn">Proceed to checkout</button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      </form>
    </section>
    <!--================End Cart Area =================-->

    <!--================ start footer Area  =================-->
      @include('footer')
    <!--================ End footer Area  =================-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>

document.getElementById("for_radio").value="flat";

        function activeclass(val)
        {
            if(document.getElementById("flat").id==val)
            {
              document.getElementById("flat").className="active";
              document.getElementById("for_radio").value="flat";
            }
            if(document.getElementById("flat").id!=val)
              document.getElementById("flat").className="";
            if(document.getElementById("free").id==val)
            {
              document.getElementById("free").className="active";
              document.getElementById("for_radio").value="free";
            }
            if(document.getElementById("free").id!=val)
              document.getElementById("free").className="";
            if(document.getElementById("delivery").id==val)
            {
              document.getElementById("delivery").className="active";
              document.getElementById("for_radio").value="delivery";
            }
            if(document.getElementById("delivery").id!=val)
              document.getElementById("delivery").className="";

           
           

        }
       

    </script>
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
