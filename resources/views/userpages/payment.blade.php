@extends('userpages.master')
@section('title',"Payment")
@section('style')
    <style>
        .card-header {
            background: linear-gradient(135deg, #007bff, #6f42c1);
        }
        .btn-primary {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }
        .btn-primary:hover {
            background-color: #0056b3 !important;
            border-color: #0056b3 !important;
        }
        .alert-light {
            background-color: #f8f9fa !important;
        }
        .text-muted {
            color: #6c757d !important;
        }
    </style>
@endsection
@section('content')
    <div class="container py-5" style="min-height: 85vh;">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-xl border-0 rounded-lg">
                    <div class="card-header bg-gradient-primary text-white text-center py-4">
                        <h2 class="fw-bold mb-0">Proses Pembayaran</h2>
                    </div>
                    <div class="card-body p-5">
                        <div class="alert alert-light border rounded-3 shadow-sm mb-4">
                            <h4 class="text-primary">Total Pembayaran</h4>
                            <p class="display-4 text-success fw-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="d-grid gap-2">
                            <button id="payButton" class="btn btn-lg btn-primary rounded-pill">
                                <i class="bi bi-credit-card-fill me-2"></i> Bayar Sekarang
                            </button>
                        </div>
                        <div class="mt-5 text-center">
                            <p class="text-muted">Dengan mengklik tombol "Bayar Sekarang", Anda akan diarahkan ke halaman pembayaran yang aman.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        const snapToken = "{{ $snapToken }}";
        document.getElementById("payButton").addEventListener("click", function () {
            snap.pay(snapToken, {
                onSuccess: function (result) {
                    fetch("{{ route('checkout.storeTransaction') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            user_id: {{ auth()->user()->id }},
                            product_id: {{ $product->id }},
                            amount: result.gross_amount,
                            payment_method: result.payment_type,
                            transaction_status: 'success',
                            transaction_id: result.transaction_id,
                        })
                    }).then(response => response.json())
                        .then(() => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Pembayaran Berhasil!',
                                text: 'Terima kasih telah melakukan pembayaran.',
                                confirmButtonText: 'Lanjutkan ke Produk',
                                confirmButtonColor: '#3085d6',
                            }).then(() => {
                                window.location.href = "{{ route('home', $product->id) }}";
                            });
                        }).catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan!',
                            text: 'Ada masalah saat menyimpan transaksi.',
                            confirmButtonText: 'Tutup',
                            confirmButtonColor: '#d33'
                        });
                    });
                },
                onPending: function () {
                    Swal.fire({
                        icon: 'info',
                        title: 'Pembayaran Tertunda!',
                        text: 'Pembayaran Anda sedang diproses, harap tunggu.',
                        confirmButtonText: 'Tutup',
                        confirmButtonColor: '#ff9f00'
                    });
                },
                onError: function (result) {
                    fetch("{{ route('checkout.storeTransaction') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            user_id: {{ auth()->user()->id }},
                            product_id: {{ $product->id }},
                            amount: result.gross_amount,
                            payment_method: result.payment_type,
                            transaction_status: 'failed',
                            transaction_id: result.transaction_id,
                        })
                    }).then(response => response.json())
                        .then(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Pembayaran Gagal!',
                                text: 'Ada masalah dengan transaksi Anda, harap coba lagi.',
                                confirmButtonText: 'Tutup',
                                confirmButtonColor: '#d33'
                            });
                        }).catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan!',
                            text: 'Ada masalah saat menyimpan transaksi.',
                            confirmButtonText: 'Tutup',
                            confirmButtonColor: '#d33'
                        });
                    });
                }
            });
        });
    </script>
@endsection
