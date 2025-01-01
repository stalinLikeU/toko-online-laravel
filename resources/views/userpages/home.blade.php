@extends('userpages.master')
@section('title','Home')
@section('content')
    <section class="hero bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Selamat Datang di Marketplace UMKM Banyumas</h1>
            <p class="lead">Temukan produk lokal berkualitas dari UMKM sekitaran Banyumas. Dukung perekonomian lokal
                dengan berbelanja produk handmade, kerajinan tangan, dan karya seni khas Banyumas.</p>
            <a href="#" class="btn btn-light btn-lg">Jelajahi Produk</a>
        </div>
    </section>
    <section class="container mt-5">
        <h2 class="text-center mb-4">Beberapa Product Kami</h2>
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
        <a href="{{route('products')}}" class="btn btn-primary btn-lg btn-block mt-4 mb-4 d-flex justify-content-center mx-auto">Lihat Semua Produk</a>
    </section>
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2025 Marketplace UMKM Banyumas | Semua Hak Dilindungi</p>
    </footer>
@endsection
