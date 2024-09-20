<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between w-full">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ Auth::user()->hasRole('owner') ? __('Pesanan Masuk') : __('Pesanan') }}
            </h2>
        </div>

        @section('title', 'Pesanan')

    @section('favicon')
    <link rel="icon" type="image/png" href="{{asset('assets/aplikasilogo.png')}}">
    @endsection
        

        <form action="{{ route('product_transactions.search') }}" method="GET" class="mt-4 w-full">
            <div class="flex items-center">
                <input type="search" name="keyword" class="w-full p-2 border rounded-md" placeholder="Cari berdasarkan id transaksi atau nama user">
            </div>
        </form>
        @isset(request()->keyword)
            <a href="{{ route('product_transactions.index') }}" class="inline-flex items-center px-4 py-2 mt-2 font-bold tracking-widest text-white bg-blue-500 border border-transparent rounded-md hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-300">Tampilkan Semua Transaksi</a>
        @endisset
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">ID Transaksi</th>
                                    <th class="px-4 py-2">User</th>
                                    <th class="px-4 py-2">Total transaksi</th>
                                    <th class="px-4 py-2">Tanggal</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($product_transactions as $transaction)
                                    <tr class="text-center border-b">
                                        <td class="px-4 py-2 border">{{ $transaction->id }}</td>
                                        <td class="px-4 py-2 border">{{ $transaction->user->name }}</td>
                                        <td class="px-4 py-2 border">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 border">{{ $transaction->formatted_created_at }}</td>
                                        <td class="px-4 py-2 border">
                                            @if($transaction->status==='berhasil')
                                            <p class="inline-flex items-center px-4 py-1 text-xs font-bold tracking-widest text-white uppercase bg-green-500 border border-transparent rounded-full">Berhasil</p>
                                            @elseif($transaction->status === 'dibatalkan')
                                                <p class="inline-flex items-center px-4 py-1 text-xs font-bold tracking-widest text-white uppercase bg-red-500 border border-transparent rounded-full">Dibatalkan</p>
                                            @elseif($transaction->proof)
                                                <p class="inline-flex items-center px-4 py-1 text-xs font-bold tracking-widest text-white uppercase bg-blue-500 border border-transparent rounded-full">Diproses</p>
                                            @else
                                                <p class="inline-flex items-center px-4 py-1 text-xs font-bold tracking-widest text-white uppercase bg-orange-500 border border-transparent rounded-full">Belum dibayar</p>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <a href="{{ route('product_transactions.show', $transaction) }}" class="inline-flex items-center px-4 py-2 mb-1 text-xs font-bold tracking-widest text-white uppercase bg-yellow-800 border border-transparent rounded-full">Lihat Detail</a>
                                            @role('buyer')
                                                <a href="{{ route('product_transactions.pdf', $transaction) }}" class="inline-flex items-center px-4 py-2 mb-1 text-xs font-bold tracking-widest text-white uppercase bg-blue-500 border border-transparent rounded-full">Cetak PDF</a>
                                            @endrole
                                            @role('owner')
                                                <form action="{{ route('product_transactions.destroy', $transaction) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-bold tracking-widest text-white uppercase bg-red-600 border border-transparent rounded-full">Hapus</button>
                                                </form>
                                            @endrole
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-4 font-semibold text-center">Belum ada transaksi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-4 mt-4">
                    {{ $product_transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>