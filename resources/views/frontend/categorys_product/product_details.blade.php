
@extends('frontend.layouts.main')
@section('main-container')



    <!-- Breadcrumb Section Begin -->
   <!--  <section class="breadcrumb-section set-bg" data-setbg="{{url('frontend/img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Vegetable’s Package</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <a href="./index.html">Vegetables</a>
                            <span>Vegetable’s Package</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ url('assets/images/product',$product->image)}}" alt="">
                        </div>
                       <!--  <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="{{url('frontend/img/product/details/product-details-2.jpg')}}"
                                src="{{url('frontend/img/product/details/thumb-1.jpg')}}" alt="">
                            <img data-imgbigurl="{{url('frontend/img/product/details/product-details-3.jpg')}}"
                                src="{{url('frontend/img/product/details/thumb-2.jpg')}}" alt="">
                            <img data-imgbigurl="{{url('frontend/img/product/details/product-details-5.jpg')}}"
                                src="{{url('frontend/img/product/details/thumb-3.jpg')}}" alt="">
                            <img data-imgbigurl="{{url('frontend/img/product/details/product-details-4.jpg')}}"
                                src="{{url('frontend/img/product/details/thumb-4.jpg')}}" alt="">
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{$product->name}}</h3>
                        <div class="product__details__price">₹{{number_format($product->amount,2)}}</div>
                        <p>{{$product->description}}</p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                            </div>
                        </div>
                        <a href="{{route('shoping_cart',$product->id)}}" class="primary-btn addCart">ADD TO CARD</a>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Weight</b> <span>0.5 kg</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{url('frontend/img/product/product-1.jpg')}}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{url('frontend/img/product/product-2.jpg')}}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{url('frontend/img/product/product-3.jpg')}}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{url('frontend/img/product/product-7.jpg')}}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->



    <!-- Js Plugins -->
    <script src="{{url('frontend/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{url('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{url('frontend/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{url('frontend/js/jquery-ui.min.js')}}"></script>
    <script src="{{url('frontend/js/jquery.slicknav.js')}}"></script>
    <script src="{{url('frontend/js/mixitup.min.js')}}"></script>
    <script src="{{url('frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{url('frontend/js/main.js')}}"></script>


</body>

</html>
<script type="text/javascript">
$(function () {

    $("body").on("click", ".addCart", function(e) {
            e.preventDefault();
            // $('body').html('vikas')

            var url = $(this).attr('href');
            console.log(url)
            $.ajax({
                url:url,
                type: 'get',
                data:{},
                // dataType:'html'
                success: function(response) {
                    console.log(response);
                    if (response.status) {
                        $('#my_cart_data').html(response.data.item_count)
                    }  

                }
            });
       
    });

});

</script>
@endsection
