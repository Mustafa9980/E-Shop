@extends('layouts.front')

@section('title')
Welcome to E-shop
@endsection

@section('content')
@include('layouts.inc.slider')

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="owl-carousel featured-carousel owl-theme">
                @foreach ($featured_products as $product )
                <div class="item">
                    <div class="card">
                        <a href="{{ url('category/'.$product->category->slug .'/'.$product->slug) }}">

                        <img src="{{ asset('assets/uploads/products/'. $product->image) }}" alt=" products image">
                        <div class="card-body">
                            <h5>{{ $product->name }}</h5>
                            <span class="float-start">{{ $product->selling_price }}</span>
                            <span class="float-end"><s>{{ $product->original_price }}</s></span>

                        </div>
                        </a>
                    </div>
                </div>
                @endforeach
                
            </div>
            
         

        </div>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <h2> Trending Category</h2>
            <div class="owl-carousel featured-carousel owl-theme">
                @foreach ($trending_category as $tcate )
                
                <div class="item">
                    <a href="{{ url('view-category/'.$tcate->slug) }}" >
                    <div class="card">
                        <img src="{{ asset('assets/uploads/category/'. $tcate->image) }}" alt=" category image">
                        <div class="card-body">
                            <h5>{{ $tcate->name }}</h5>
                           <p>
                            {{ $tcate->description }}
                           </p>

                        </div>
                    </div>
                </a>
                </div>
                @endforeach
                
            </div>
            
         

        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>

$('.featured-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})


</script>


@endsection
