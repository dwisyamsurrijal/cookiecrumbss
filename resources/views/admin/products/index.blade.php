<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between w-full">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Atur Produk') }}
            </h2>
            <a href="{{route('admin.products.create')}}"
                class="inline-flex items-center px-4 py-2 font-bold tracking-widest text-white bg-blue-800 border border-transparent rounded-full text-md">Tambah
                Produk</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="py-10 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="mx-auto table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Id</th>
                                <th class="px-4 py-2">Nama Kue</th>
                                <th class="px-4 py-2">Harga</th>
                                <th class="px-4 py-2">Foto</th>
                                <th class="px-4 py-2">Stok</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        @forelse ($products as $product)
                            <tbody>
                                <tr>
                                    <td class="px-4 py-2 border">{{ $product->id }}</td>
                                    <td class="px-4 py-2 border">{{ $product->name }}</td>
                                    <td class="px-4 py-2 border">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 border">
                                        <img src="{{ Storage::url($product->photo) }}" alt="{{ $product->name }}"
                                            class="w-[100px] h-[60px]">
                                    </td>
                                    <td class="px-4 py-2 border">{{ $product->stock }}</td>
                                    <td class="px-4 py-2 border">
                                        <a href="{{route('admin.products.edit', $product)}}"
                                            class="inline-flex items-center px-4 py-2 text-xs font-bold tracking-widest text-white uppercase bg-yellow-800 border border-transparent rounded-full">Edit</a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}"
                                            class="inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')"
                                                class="inline-flex items-center px-4 py-2 text-xs font-bold tracking-widest text-white uppercase bg-red-800 border border-transparent rounded-full">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                        @empty
                            <p class="font-semibold text-center">Belum ada produk yang ditambahkan</p>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4 mt-4 ">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>