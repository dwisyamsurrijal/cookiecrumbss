@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Upload Bukti Pembayaran</h1>
    <div class="mt-4">
        <h2>Detail Transaksi</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Produk</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Quantity</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Harga</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($productTransaction->transactionDetails as $detail)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $detail->product->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $detail->quantity }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($detail->price * $detail->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            <h3 class="text-lg font-medium">Total Harga: Rp {{ number_format($productTransaction->total_amount, 2) }}</h3>
        </div>
    </div>
    <form method="POST" action="{{ route('product_transactions.upload_proof.post', $productTransaction->id) }}" enctype="multipart/form-data" class="mt-4">
        @csrf
        <div class="mt-4">
            <label for="proof" class="block text-sm font-medium text-gray-700">Bukti Pembayaran</label>
            <input id="proof" name="proof" type="file" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md ms-4 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Upload
            </button>
        </div>
    </form>
</div>
@endsection
