<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('src/output.css')}}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <title>Keranjang Belanja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="min-h-screen py-12 bg-amber-50">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="flex flex-wrap">
                    <!-- Left Column: Form for Product Transaction -->
                    <div class="w-full md:w-1/2 p-6 bg-[#CC9B6D]">
                        <h2 class="mb-4 text-xl font-semibold leading-tight text-gray-800">Form Transaksi</h2>
                        <form method="POST" action="#" enctype="multipart/form-data">
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                                <input id="address" name="address" type="text" required autofocus
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mt-4">
                                <label for="city" class="block text-sm font-medium text-gray-700">Kota</label>
                                <input id="city" name="city" type="text" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mt-4">
                                <label for="post_code" class="block text-sm font-medium text-gray-700">Kode Pos</label>
                                <input id="post_code" name="post_code" type="text" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mt-4">
                                <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor
                                    Telepon</label>
                                <input id="phone_number" name="phone_number" type="text" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mt-4">
                                <label for="proof" class="block text-sm font-medium text-gray-700">Bukti
                                    Transfer</label>
                                <input id="proof" name="proof" type="file" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mt-4">
                                <label for="notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                                <textarea id="notes" name="notes"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"></textarea>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button type="button"
                                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-500 border border-transparent rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                    onclick="window.location='{{route('front.allproduct')}}'">
                                    Kembali Belanja
                                </button>

                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md ms-4 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                    onclick="return confirm('Apakah semua data sudah terisi dengan benar?')">
                                    Checkout
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Right Column: Cart Items -->
                    <div class="w-full md:w-1/2 p-6 bg-[#CC9B6D]">
                        <h2 class="mb-4 text-xl font-semibold leading-tight text-gray-800">Produk di Keranjang</h2>
                        <div class="space-y-4">
                            <!-- Dummy Cart Item 1 -->
                            @forelse($my_carts as $cart)
                                <div
                                    class="relative flex items-center justify-between p-4 mb-4 bg-white rounded-lg shadow-md">
                                    <form action="{{route('carts.destroy', $cart)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="absolute top-0 right-0 px-2 py-1 text-red-500 bg-red-200 rounded-full hover:bg-red-300">x</button>
                                    </form>
                                    <div class="flex items-center">
                                        <img src="{{ Storage::url($cart->product->photo) }}" alt="Produk 1"
                                            class="object-cover w-16 h-16 rounded-md">
                                        <div class="ml-4">
                                            <h4 class="text-lg font-semibold text-gray-800">{{ $cart->product->name }}</h4>

                                            <p class="text-gray-600 product-price"
                                                data-price="{{ $cart->product->price * $cart->quantity }}">
                                                Rp {{ $cart->product->price }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <button class="px-3 py-1 font-bold text-gray-800 bg-gray-300 rounded-l">-</button>
                                        <input type="text" value="1" class="w-12 text-center border border-gray-300"
                                            readonly>
                                        <button class="px-3 py-1 font-bold text-gray-800 bg-gray-300 rounded-r">+</button>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-gray-800">Total : Rp
                                            {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @empty
                                <p>Belum ada produk di keranjang</p>
                            @endforelse
                        </div>

                        <!-- Subtotal Section -->
                        <div class="p-4 mt-4 bg-white rounded-lg shadow-md">
                            <div class="flex flex-row items-center justify-between">
                                <h4 class="text-lg font-semibold text-gray-800">Subtotal</h4>
                                <p class="text-xl font-bold text-gray-800" id="checkout-sub-total"></p>
                            </div>
                            <div class="flex flex-row items-center justify-between mt-2">
                                <h6 class="text-lg font-semibold text-gray-800">Biaya Kirim</h6>
                                <p class="text-xl font-bold text-gray-800" id="checkout-delivery-fee"></p>
                            </div>
                            <hr class="my-2 border-gray-300">
                            <div class="flex flex-row items-center justify-between">
                                <h4 class="text-lg font-semibold text-gray-800">Total Keseluruhan</h4>
                                <p class="text-xl font-bold text-gray-800" id="checkout-grand-total"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    @include('front.footer')

    <script>
        function calculatePrice() {
            let subTotal = 0;
            let deliveryFee = 10000;

            document.querySelectorAll('.product-price').forEach(item => {
                subTotal += parseFloat(item.getAttribute('data-price'));
            });

            document.getElementById('checkout-delivery-fee').textContent = 'Rp' + deliveryFee.toLocaleString('id', {
                minimumFractionDigits: 0, maximumFractionDigits: 0
            });

            document.getElementById('checkout-sub-total').textContent = 'Rp' + subTotal.toLocaleString('id', {
                minimumFractionDigits: 0, maximumFractionDigits: 0
            });

            const grandTotalPrice = subTotal + deliveryFee;
            document.getElementById('checkout-grand-total').textContent = 'Rp ' + grandTotalPrice.toLocaleString('id', {
                minimumFractionDigits: 0, maximumFractionDigits: 0
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            calculatePrice();
        });
    </script>
</body>

</html>