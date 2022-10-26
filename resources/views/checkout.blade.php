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
              <h2>Product Checkout</h2>
              <p>Very us move be blessed multiply night</p>
            </div>
            <div class="page_link">
              <a href="index.html">Home</a>
              <a href="checkout.html">Product Checkout</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
      <div class="container">


        <!-- <div class="returning_customer">
          <div class="check_title">
            <h2>
              Returning Customer?
              <a href="#">Click here to login</a>
            </h2>
          </div>
          <p>
            If you have shopped with us before, please enter your details in the
            boxes below. If you are a new customer, please proceed to the
            Billing & Shipping section.
          </p>
          <form
            class="row contact_form"
            action="#"
            method="post"
            novalidate="novalidate"
          >
            <div class="col-md-6 form-group p_star">
              <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                value=" "
              />
              <span
                class="placeholder"
                data-placeholder="Username or Email"
              ></span>
            </div>
            <div class="col-md-6 form-group p_star">
              <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                value=""
              />
              <span class="placeholder" data-placeholder="Password"></span>
            </div>
            <div class="col-md-12 form-group">
              <button type="submit" value="submit" class="btn submit_btn">
                Send Message
              </button>
              <div class="creat_account">
                <input type="checkbox" id="f-option" name="selector" />
                <label for="f-option">Remember me</label>
              </div>
              <a class="lost_pass" href="#">Lost your password?</a>
            </div>
          </form>
        </div> -->


        <!-- <div class="cupon_area">
          <div class="check_title">
            <h2>
              Have a coupon?
              <a href="#">Click here to enter your code</a>
            </h2>
          </div>
          <input type="text" placeholder="Enter coupon code" />
          <a class="tp_btn" href="#">Apply Coupon</a>
        </div> -->


        <div class="billing_details">
          <div class="row">
            <div class="col-lg-8">
              <h3>Add Billing Details</h3>
              <form
                class="row contact_form"
                action="{{route('checkout')}}"
                method="post"
                novalidate="novalidate"
              >
              @csrf
                <div class="col-md-6 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="first"
                    name="name"
                  />
                  <span
                    class="placeholder"
                    data-placeholder="First name"
                  ></span>
                </div>
                <div class="col-md-6 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="last"
                    name="name"
                  />
                  <span class="placeholder" data-placeholder="Last name"></span>
                </div>
               
                <div class="col-md-6 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="number"
                    name="number"
                  />
                  <span
                    class="placeholder"
                    data-placeholder="Phone number"
                  ></span>
                </div>
                <div class="col-md-6 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="compemailany"
                  />
                  <span
                    class="placeholder"
                    data-placeholder="Email Address"
                  ></span>
                </div>
                <div class="col-md-12 form-group p_star">
                  <select class="country_select">
                    <option>Country1</option>
                    <option>Country2</option>
                    <option>Country3</option>
                  </select>
                </div>
                <div class="col-md-12 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="add1"
                    name="add1"
                  />
                  <span
                    class="placeholder"
                    data-placeholder="Address line 01"
                  ></span>
                </div>
                <div class="col-md-12 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="add2"
                    name="add2"
                  />
                  <span
                    class="placeholder"
                    data-placeholder="Address line 02"
                  ></span>
                </div>
                <div class="col-md-12 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="city"
                    name="city"
                  />
                  <span class="placeholder" data-placeholder="Town/City"></span>
                </div>
                <div class="col-md-12 form-group p_star">
                  <select class="country_select" name="state">
                    <option>State1</option>
                    <option>State2</option>
                    <option>State3</option>
                  </select>
                </div>
                <div class="col-md-12 form-group">
                  <input
                    type="text"
                    class="form-control"
                    id="zip"
                    name="zipcode"
                    placeholder="Postcode/ZIP"
                  />
                </div>
  
             
            </div>
            <div class="col-lg-4">
              <div class="order_box">
                <h2>Your Order</h2>
                  <table class="table table-borderless">
                  @php $total=0; @endphp
                  <tr>
                    <td>Product</td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                  </tr>
                  @foreach($data as $d)
                  <tr>
                    <td>{{$d->name}}</td>
                    <td colspan="2">x {{$d->cartqty}}</td>
                   
                    <td>${{$d->price}}</td>
                  </tr>
                  @php
   
                    $total+=$d->cartqty*$d->price;

                  @endphp
                  @endforeach
                  </table>
                 
            
                <ul class="list list_2">
                  <li>
                    <a href="#">Subtotal
                      <span>${{$total}}</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">Shipping
                      <span>Flat rate: $50.00</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">Total
                      <span>${{$total}}</span>
                    </a>
                  </li>
                </ul>

                <button type="submit" class="main_btn">Proceed to Payment</button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!--================End Checkout Area =================-->

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
