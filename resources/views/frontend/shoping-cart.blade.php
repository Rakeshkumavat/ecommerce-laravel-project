@extends('frontend.layouts.main')
@section('main-container')



    <!-- Breadcrumb Section Begin -->
<!--     <section class="breadcrumb-section set-bg" data-setbg="{{url('frontend/img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @php $total_amount = 0;@endphp
                                @if(session('cart_data'))
                                @foreach(session('cart_data') as $id => $details)
                                    @php $total_amount += $details['amount'] * $details['order_quantity'];@endphp
                                <tr class="js_product_tr" data-id="{{$details['id']}}">
                                    <td class="shoping__cart__item">
                                        <img src="assets/images/product/{{$details['image']}}" class="js_image"  alt="" width=70px height=70px>
                                        <h5 class="js_chnage_name">{{$details['name']}}</h5>
                                    </td>
                                    <td class="shoping__cart__price product_amount">
                                        {{number_format($details['amount'],2)}}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty" data-id="{{$details['id']}}">
                                                <input type="text" class="quantity js_quantity"   value="{{ $details['order_quantity'] }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total js_quantity_total">
                                        {{ number_format($details['amount']*$details['order_quantity'],2 )}} 
                                    </td>
                                    <td class="shoping__cart__item__close"><a href="{{route('remove.from.cart',$id)}}" class="remove-from-cart"><span class="icon_close "></span></a>
                                        
                                    </td>
                                </tr>
                                @endforeach
                               @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
<!--                 <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div> -->
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <!-- <h5>Discount Codes</h5> -->
                            <form action="#">
                                <!-- <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button> -->
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout js_total">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Total <span class="js_all_product_total">
                            @if(!empty($total_amount))
                             {{number_format($total_amount,2)}}</span></li>
                            @else
                                0
                            @endif</span></li>
                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->


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


        $("body").on("click", ".remove-from-cart", function(e) {
            e.preventDefault();
            if (confirm('Are you sure want to delete?')) {
                t = $(this);
                row_id = t.parents('.js_product_tr').attr('data-id');
                tast = $('.product_amount').empty();
                console.log(tast);
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'get',
                    error: function() {},
                    beforeSend: function() {
                        t.prop('disabled', true);
                    },
                    complete: function() {
                        t.prop('disabled', false);
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.status) {
                            // window.location="{{route('show_cart')}}"
                              console.log(response.status) 
                               t.parents(".js_product_tr").remove();
                        }
                    }
                });
            }

        });

        $("body").on("click", ".quantity", function(e) {
            e.preventDefault();
            t = $(this);
            row_id = t.find('.pro-qty').attr('data-id');
            console.log(row_id)
            product_quantity = t.find('.js_quantity').val();
            product_value = t.parents(".js_product_tr").find(".product_amount").html();
            // product_value_change = parseFloat(product_value);
           
            
            var multiply  = parseFloat(product_value)* parseFloat(product_quantity);
            t.parents(".js_product_tr").find('.js_quantity_total').text(multiply.toFixed(2));
           
             total =  t.parents(".js_product_tr").find('.js_quantity_total').html();
            

                $('.js_all_product_total').text(total);

            console.log(total);
            $.ajax({
                url: "{{route('add.to.quantity')}}",
                type: 'get',
                data:{'product_id':row_id,'product_quantity':product_quantity},
                error: function() {},
                beforeSend: function() {
                    t.prop('disabled', true);
                },
                complete: function() {
                    t.prop('disabled', false);
                },
                success: function(response) {
                    console.log(response)
                   
                }
            });

        });





</script>
@endsection
