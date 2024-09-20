<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @section('title', 'Dashboard')

    @section('favicon')
    <link rel="icon" type="image/png" href="{{asset('assets/aplikasilogo.png')}}">
    @endsection

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Selamat Datang Admin!") }}
                </div>
            </div>

            <!-- Statistics -->
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">Informasi</h3>
                    <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-3">
                        <div class="p-4 bg-blue-100 rounded-lg shadow-md">
                            <h4 class="text-xl font-bold">Pendapatan</h4>
                            <p class="text-2xl">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-4 bg-green-100 rounded-lg shadow-md">
                            <h4 class="text-xl font-bold">Total Pesanan</h4>
                            <p class="text-2xl">{{ $totalOrders }}</p>
                        </div>
                        <div class="p-4 bg-yellow-100 rounded-lg shadow-md">
                            <h4 class="text-xl font-bold">Total Produk</h4>
                            <p class="text-2xl">{{ $totalProducts }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Products -->
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">Produk Terbaru</h3>
                    <table class="w-full mt-4 table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Id</th>
                                <th class="px-4 py-2">Nama</th>
                                <th class="px-4 py-2">Harga</th>
                                <th class="px-4 py-2">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentProducts as $product)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $product->id }}</td>
                                    <td class="px-4 py-2 border">{{ $product->name }}</td>
                                    <td class="px-4 py-2 border">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 border">{{ $product->stock }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">Pesanan Terbaru</h3>
                    <table class="w-full mt-4 table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID Transaksi</th>
                                <th class="px-4 py-2">User</th>
                                <th class="px-4 py-2">Total</th>
                                <th class="px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $order->id }}</td>
                                    <td class="px-4 py-2 border">{{ $order->user->name }}</td>
                                    <td class="px-4 py-2 border">Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-2 border">
                                    @if($order->status==='berhasil')
                                            <span
                                                class="inline-block px-4 py-1 text-xs font-bold text-white bg-green-500 rounded-full">Berhasil</span>
                                    @elseif($order->status === 'dibatalkan')
                                            <span
                                                class="inline-block px-4 py-1 text-xs font-bold text-white bg-red-500 rounded-full">Dibatalkan</span>
                                                @elseif($order->proof)
                                                <span
                                                class="inline-block px-4 py-1 text-xs font-bold text-white bg-blue-500 rounded-full">Diproses</span>
                                                @else
                                                <span
                                                class="inline-block px-4 py-1 text-xs font-bold text-white bg-orange-500 rounded-full">Belum Dibayar</span>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>