<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full">
                        <thead>
                        <tr>
                            <th class="border px-4 py-2">ID</th>
                            <th class="border px-4 py-2">User</th>
                            <th class="border px-4 py-2">Product</th>
                            <th class="border px-4 py-2">Amount</th>
                            <th class="border px-4 py-2">Payment Method</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Transaction ID</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td class="border px-4 py-2">{{ $transaction->id }}</td>
                                <td class="border px-4 py-2">{{ $transaction->user->name }}</td>
                                <td class="border px-4 py-2">{{ $transaction->product->name }}</td>
                                <td class="border px-4 py-2">{{ $transaction->amount }}</td>
                                <td class="border px-4 py-2">{{ $transaction->payment_method }}</td>
                                <td class="border px-4 py-2">{{ $transaction->transaction_status }}</td>
                                <td class="border px-4 py-2">{{ $transaction->transaction_id }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
