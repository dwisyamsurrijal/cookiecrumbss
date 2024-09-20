<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between w-full">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm gap-y-5 sm:rounded-lg">

                <div class="flex flex-row items-center justify-between item-card">
                    <div class="flex flex-row items-center gap-x-3">
                        <div>
                            <p class="text-base text-slate-500">
                                Total Transaksi
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                Rp {{number_format($productTransaction->total_amount,0,'.',',')}}
                            </h3>
                        </div>
                    </div>
                    <div>
                        <p class="text-base text-slate-500">
                            Tanggal Transaksi
                        </p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            {{$productTransaction->formatted_created_at}}
                        </h3>
                    </div>
                    @if ($productTransaction->status == 'berhasil')
                        <span class="px-3 py-1 text-white bg-green-500 rounded-full">
                            <p class="text-sm font-bold text-white">BERHASIL</p>
                        </span>

                        @elseif ($productTransaction->status == 'dibatalkan')
                        <span class="px-3 py-1 text-white bg-red-500 rounded-full">
                            <p class="text-sm font-bold text-white">DIBATALKAN</p>
                        </span>
                        
                    @elseif($productTransaction->proof)
                    <span class="px-3 py-1 text-white bg-blue-500 rounded-full">
                            <p class="text-sm font-bold text-white">DIPROSES</p>
                        </span>
                    @else
                        <span class="px-3 py-1 text-white text-center bg-orange-500 rounded-full">
                            <p class="text-sm font-bold text-white">BELUM DIBAYAR</p>
                        </span>
                    @endif
                </div>
                <hr class="my-3">
                <div class="flex flex-row justify-between">
                <h3 class="text-xl font-bold text-indigo-950">
                    Daftar Item
                </h3>
                <h3 class="text-xl font-bold text-indigo-950">
                    Jumlah
                </h3>
                </div>

                <div class="grid grid-cols-1 gap-x-24">
                    <div class="flex flex-col col-span-1 gap-y-5">
                        @forelse($productTransaction->transactionDetails as $detail)
                            <div class="flex flex-row items-center justify-between item-card">
                                <div class="flex flex-row items-center gap-x-3">
                                    <img src="{{Storage::url($detail->product->photo)}}" alt="" class="w-[70px] h-[55px]">
                                    <div>
                                        <h3 class="text-xl font-bold text-indigo-950">
                                            {{$detail->product->name}}
                                        </h3>
                                        <p class="text-base text-slate-500">
                                           Rp {{number_format($detail->product->price * $detail->quantity, 0, ',', '.')}}
                                        </p>
                                    </div>
                                </div>
                                <p>{{$detail->quantity}}</p>
                            </div>
                        @empty
                        @endforelse

                        <h3 class="text-xl font-bold text-indigo-950">
                            Detail Pengiriman
                        </h3>
                        <div class="flex flex-row items-center gap-4 justify-between item-card">
                            <p class="text-base text-slate-500">
                                Alamat</p>
                            <h3 class="text-base text-right font-bold text-indigo-950">
                                {{$productTransaction->address}}
                            </h3>
                        </div>
                        <div class="flex flex-row items-center justify-between item-card">
                            <p class="text-base text-slate-500">
                                Kota</p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{$productTransaction->city}}
                            </h3>
                        </div>
                        <div class="flex flex-row items-center justify-between item-card">
                            <p class="text-base text-slate-500">
                                Nomor Pos</p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{$productTransaction->post_code}}
                            </h3>
                        </div>
                        <div class="flex flex-row items-center justify-between item-card">
                            <p class="text-base text-slate-500">
                                No. Telepon</p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{$productTransaction->phone_number}}
                            </h3>
                        </div>
                        <div class="flex flex-col item-start item-card">
                            <p class="text-base text-slate-500">
                                Catatan</p>
                            <h3 class="text-lg font-bold text-indigo-950">
                                {{$productTransaction->notes}}
                            </h3>
                        </div>

                        <div class="flex flex-col item-start item-card">
                            <h3 class="text-xl font-bold text-indigo-950">
                                Bukti Pembayaran :
                            </h3>
                            <img src="{{Storage::url($productTransaction->proof)}}"
                                alt="bukti transfer" class="w-[300px] h-[400px]">
                        </div>
                    </div>
                </div>
                <hr class="my-3">

                @role('owner')
                @if ($productTransaction->status == 'berhasil')
                    <a href="{{route('product_transactions.index')}}" class="py-3 text-white text-center bg-indigo-700 rounded-full w-full">
                        Kembali ke Transaksi Produk
                    </a>
                    @elseif ($productTransaction->status == 'dibatalkan')
                    <a href="{{route('product_transactions.index')}}" class="py-3 text-white text-center bg-indigo-700 rounded-full w-full">
                        Kembali ke Transaksi Produk
                    </a>
                @else
                    <form method="POST" action="{{ route('product_transactions.update', $productTransaction) }}">
                        @csrf
                        @method('PUT')
                        <button class="py-3 text-white bg-indigo-700 rounded-full w-full hover:bg-indigo-800">
                            Menyetujui Pembelian
                        </button>
                    </form>
                    <form method="POST" action="{{ route('product_transactions.cancel', $productTransaction) }}">
                        @csrf
                        @method('PUT')
                        <button class="py-3 text-white bg-red-700 rounded-full w-full hover:bg-red-800">
                            Batalkan Pesanan
                        </button>
                    </form>
                @endif
                @endrole

                @role('buyer')
                <div class="flex gap-5">
                <a href="https://wa.me/6281280309073" class="px-5 py-3 text-white text-center bg-indigo-700 rounded-full w-full">
                    Kontak Admin
                </a>
                
                
                @if ($productTransaction->status == 'diproses' && !$productTransaction->proof)
                    <a href="{{ route('product_transactions.upload_proof', $productTransaction) }}" class="px-5 py-3 text-white text-center bg-indigo-700 rounded-full w-full">
                        Unggah Bukti Pembayaran
                    </a>
                    @endif
                
                </div>
                <a href="{{route('front.index')}}" class="px-5 py-3 text-white text-center bg-amber-500 rounded-full w-full">
                    Kembali Belanja
                </a>
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>