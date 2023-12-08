@extends('frontend.master')
@section('frontend')
<!-- start wpo-page-title -->
<section class="wpo-page-title">
    <h2 class="d-none">Hide</h2>
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="wpo-breadcumb-wrap">
                    <ol class="wpo-breadcumb-wrap">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Product Page</a></li>
                        <li>Cart</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<!-- cart-area-s2 start -->
<div class="cart-area-s2 section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="single-page-title">
                    <h2>Your Cart</h2>
                    <p>There are 4 products in this list</p>
                </div>
            </div>
        </div>
        <div class="cart-wrapper">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <form action="{{ route('card.update') }}" method="POST">
                        @csrf
                        <div class="cart-item">
                            <table class="table-responsive cart-wrap">
                                <thead>
                                    <tr>
                                        <th class="images images-b">Product</th>
                                        <th class="ptice">Price</th>
                                        <th class="stock">Quantity</th>
                                        <th class="ptice total">Subtotal</th>
                                        <th class="remove remove-b">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sub=0;
                                    @endphp
                                    @foreach ($card as $card)


                                    <tr class="wishlist-item">
                                        <td class="product-item-wish">
                                            <div class="check-box"><input type="checkbox"
                                                    class="myproject-checkbox">
                                            </div>
                                            <div class="images">
                                                <span>
                                                    <img src="{{ asset('uploads/product/preview/') }}/{{ $card->rel_to_product->preview }}" alt="">
                                                </span>
                                            </div>
                                            <div class="product">
                                                <ul>
                                                    <li class="first-cart">{{ $card->rel_to_product->product_name }}</li>
                                                    <li>
                                                        <div class="rating-product">
                                                            <i class="fi flaticon-star"></i>
                                                            <i class="fi flaticon-star"></i>
                                                            <i class="fi flaticon-star"></i>
                                                            <i class="fi flaticon-star"></i>
                                                            <i class="fi flaticon-star"></i>
                                                            <span>130</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td class="ptice cardabc">${{ $card->rel_to_product->after_discount }}</td>
                                        <td class="td-quantity cardabc">
                                            <div class="quantity ">
                                                <input class="text-value quan" type="text" name="quantity[{{ $card->id}}]"  value="{{ $card->quantity }}">
                                                <div class="dec qtybutton" data-price="{{ $card->rel_to_product->after_discount }}" >-</div>
                                                <div data-price="{{ $card->rel_to_product->after_discount }}" class="inc qtybutton">+</div>
                                            </div>
                                        </td>
                                        <td class="ptice cardabc">$<span>{{ $sub+=$card->rel_to_product->after_discount*$card->quantity }}</span></td>
                                        <td class="action">
                                            <ul>
                                                <li class="w-btn"><a data-bs-toggle="tooltip"
                                                        data-bs-html="true" title="" href="{{ route('card.remove',$card->id) }}"
                                                        data-bs-original-title="Remove from Cart"
                                                        aria-label="Remove from Cart"><i
                                                            class="fi ti-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                        <div class="cart-action">

                            <button type="submit" class="theme-btn-s2" href="#"><i class="fi flaticon-refresh"></i> Update Cart</button>
                        </div>
                    </form>





                </div>
                <div class="col-lg-4 col-12">
                   @if($msg)
                   <div class="alert alert-danger">{{ $msg }}</div>
                   @endif
                 <form action="{{ route('card.shop') }}" method="GET">

                    <div class="apply-area">
                        <input type="text" class="form-control" name="coupon" value="{{ @$_GET['coupon'] }}" placeholder="Enter your coupon">
                        <button type="submit" class="theme-btn-s2" type="submit">Apply</button>
                    </div>
                 </form>
                 @php
                     if($type==1){
                        $discount_fainal=$sub*$discount/(100);
                        $total=$sub-$discount_fainal;


                     }
                     else{
                        $discount_fainal=$sub-$discount;
                        $total=$sub-$discount_fainal;

                     }
                 @endphp
                    <div class="mt-4 cart-total-wrap">
                        <h3>Cart Totals</h3>
                        <div class="sub-total">
                            <h4>Subtotal</h4>
                            <span>$ {{ $sub}} </span>
                        </div>
                        <div class="my-3 sub-total">
                            <h4>Discount</h4>
                            <span>{{ $discount_fainal }}%</span>
                        </div>
                        <div class="mb-3 total">
                            <h4>Total</h4>
                            <span>{{ $total }}</span>
                        </div>
                        @php
                            session([
                                'discount'=>$discount_fainal,
                                'total'=>$total,
                                'sub'=>$sub
                            ])
                        @endphp
                        <a class="theme-btn-s2" href="{{ route('checkout') }}">Proceed To CheckOut</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="cart-prodact">
            <h2>You May be Interested in…</h2>
            <div class="row">
              @foreach ($products as $producted)
              <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="product-item">
                    <div class="image">
                        <img height="250px" src="{{ asset('uploads/product/preview') }}/{{ $producted->preview }}" alt="">
                        <div class="tag new">New</div>
                    </div>
                    <div class="text">
                        <h2><a href="{{ route('product_details',$producted->slug) }}">Wireless Headphones</a></h2>
                        <div class="rating-product">
                            <i class="fi flaticon-star"></i>
                            <i class="fi flaticon-star"></i>
                            <i class="fi flaticon-star"></i>
                            <i class="fi flaticon-star"></i>
                            <i class="fi flaticon-star"></i>
                            <span>130</span>
                        </div>
                        <div class="price">
                            <span class="present-price">$120.00</span>
                            <del class="old-price">$200.00</del>
                        </div>
                        <div class="shop-btn">
                            <a class="theme-btn-s2" href="#">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>


              @endforeach
            </div>
            {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
<!-- cart-area end -->

@endsection
@push('frontend_js')
<script>

     var td=document.getElementsByClassName('cardabc');
       var array=Array.from(td);
       array.map((item)=>{
       item.addEventListener('click',function(e){
        if(e.target.className=='inc qtybutton'){
            var price=e.target.dataset.price;
            var quantity=e.target.parentElement.firstElementChild.value;
            var mul=price*quantity;
            item.nextElementSibling.firstElementChild.innerHTML=mul

        }
        if(e.target.className=='dec qtybutton'){
            var price=e.target.dataset.price;
            var quantity=e.target.parentElement.firstElementChild.value;
            var mul=price*quantity;
            item.nextElementSibling.firstElementChild.innerHTML=mul

        }
       })




       })


</script>

@endpush
