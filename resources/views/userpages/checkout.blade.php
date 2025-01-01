@extends('userpages.master')
@section('title',"Checkout")
@section('content')
    <div class="container px-5 py-5">
        <form method="POST" action="{{ route('checkout.process-checkout') }}">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card shadow-lg">
                        <img class="card-img-top" src="{{$product->image}}" alt="{{$product->name}}">
                        <div class="card-body">
                            <h3 class="card-title">{{ $product->name }}</h3>
                            <p class="fs-5 text-muted">Rp.{{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="card-text">{{ $product->description }}</p>
                            <button class="btn btn-primary w-100 mt-3" type="submit">
                                <i class="bi-cart-fill me-1"></i> Proses Pembayaran
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="bg-light p-4 rounded shadow-lg">
                        <h4 class="mb-4">Informasi Pengiriman</h4>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea name="address" id="address" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Telepon</label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                        </div>
                    </div>
                    <div class="bg-light p-4 rounded shadow-lg mt-4">
                        <h4 class="mb-4">Pilih Metode Pembayaran</h4>
                        <select name="payment_method" id="payment_method" class="form-select">
                            <option value="credit_card">Kartu Kredit</option>
                            <option value="bank_transfer">Transfer Bank</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" name="product_id" value="{{$product->id}}">
        </form>
    </div>
@endsection
