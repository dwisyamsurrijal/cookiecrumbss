<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between w-full">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ Auth::user()->hasRole('owner') ? __('Pesanan Masuk') : __('Pesanan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="py-10 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                @forelse($product_transactions as $transaction)
                    <div class="p-6 text-gray-900">
                        <table class="mx-auto table-auto">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">ID Transaksi</th>
                                    <th class="px-4 py-2">User</th>
                                    <th class="px-4 py-2">Total transaksi</th>
                                    <th class="px-4 py-2">Tanggal</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="justify-between font-bold text-center">
                                    <td class="px-4 py-2 border">{{$transaction->id}}</td>
                                    <td class="px-4 py-2 border">{{$transaction->user->name}}</td>
                                    <td class="px-4 py-2 border">Rp {{$transaction->total_amount}}</td>
                                    <td class="px-4 py-2 border">{{$transaction->created_at}}</td>
                                    @if($transaction->is_paid)
                                        <td class="px-4 py-2 border">
                                            <p
                                                class="inline-flex items-center px-4 py-1 text-xs font-bold tracking-widest text-white uppercase bg-green-500 border border-transparent rounded-full">
                                                Berhasil
                                            </p>
                                        </td>
                                    @else
                                        <td class="px-4 py-2 border">
                                            <p
                                                class="inline-flex items-center px-4 py-1 text-xs font-bold tracking-widest text-white uppercase bg-orange-500 border border-transparent rounded-full">
                                                Diproses
                                            </p>
                                        </td>
                                    @endif
                                    <td class="px-4 py-2 border">
                                        <a href="{{route('product_transactions.show', $transaction)}}"
                                            class="inline-flex items-center px-4 py-2 text-xs font-bold tracking-widest text-white uppercase bg-yellow-800 border border-transparent rounded-full">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr class="my-3">
                @empty
                    <p class="font-semibold text-center">Belum ada transaksi</p>
                @endforelse
                <div class="p-4 mt-4">
                    {{ $product_transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>