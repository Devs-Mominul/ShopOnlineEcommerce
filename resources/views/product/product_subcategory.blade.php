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
                        <li><a href="index.html">Home</a></li>
                        <li>Recently Viewed</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<!-- start of themart-interestproduct-section -->
<section class="themart-interestproduct-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="wpo-section-title">
                    <h2>Recently Viewed Product</h2>
                </div>
            </div>
        </div>
        <div class="product-wrap">
            <div class="row">
               @forelse ($products_subcategory as $product)
               <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="product-item">
                    <div class="image">
                        <img width="100%" height="300px" src="{{ asset('uploads/product/preview/') }}/{{ $product->preview }}" alt="">
                        <div class="tag new">New</div>
                    </div>
                    <div class="text">
                        <h2><a href="product-single.html">{{ $product->product_name }}</a></h2>
                        <div class="rating-product">
                            <i class="fi flaticon-star"></i>
                            <i class="fi flaticon-star"></i>
                            <i class="fi flaticon-star"></i>
                            <i class="fi flaticon-star"></i>
                            <i class="fi flaticon-star"></i>
                            <span>130</span>
                        </div>
                        <div class="price">
                            <span class="present-price">${{ $product->after_discount }}</span>
                            <del class="old-price">${{ $product->price }}</del>
                        </div>
                        <div class="shop-btn">
                            <a class="theme-btn-s2" href="product.html">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-info text-center">
                <h3>No Product Found</h3>
            </div>

               @endforelse

            </div>
        </div>
    </div>
</section>
<!-- end of themart-interestproduct-section -->


@endsection
