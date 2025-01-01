@extends('userpages.master')
@section('title','Products')
@section('content')
    <div class="container mt-4">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-12 col-sm-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>
                            <a href="{{route('checkout.checkout-form',$product->id)}}" class="btn btn-primary mt-auto">Checkout</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
