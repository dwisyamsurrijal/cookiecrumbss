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

@include('front.navbar')
<section>
<body class="bg-amber-50">
    <div class="min-h-screen py-12 ">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="flex flex-wrap">
                    <!-- Left Column: Form for Product Transaction -->
                    <div class="w-full md:w-1/2 p-6 bg-[#e5ba91] shadow-lg">
                        <h2 class="mb-4 text-xl font-bold leading-tight text-gray-800">Produk di Keranjang</h2>
                        <div class="space-y-4">
                            <!-- Dummy Cart Item 1 -->
                            @forelse($my_carts as $cart)
                                <div class="relative flex flex-col items-start justify-between p-4 mb-4 bg-white rounded-lg shadow-md md:justify-between md:flex-row md:items-center">
                                                                    <form action="{{route('carts.destroy', $cart)}}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="absolute top-0 right-0 px-2 py-1 text-red-500 bg-red-200 rounded-full hover:bg-red-300">x</button>
                                                                    </form>
                                                                    <div class="flex items-center mb-4 md:w-1/3 md:mb-0">
                                                                        <img src="{{ Storage::url($cart->product->photo) }}" alt="Produk 1"
                                                                            class="object-cover w-16 h-16 rounded-md">
                                                                        <div class="ml-4">
                                                                            <h4 class="text-lg font-semibold text-gray-800">{{ $cart->product->name }}</h4>

                                                                            <p class="text-gray-600 product-price" data-price="{{ $cart->product->price * $cart->quantity }}">
                                                                                Rp {{ $cart->product->price }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex items-center mb-4 md:mb-0 md:ml-4">

                                                                    <form action="{{ route('carts.update', $cart) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="number" name="quantity" value="{{ $cart->quantity }}" class="items-center w-16 border border-gray-300"
                                                                            min="1">
                                                                        <button type="submit" class="px-2 py-1 ml-2 text-white bg-blue-500 rounded hover:bg-blue-700">Update</button>
                                                                    </form>



                                                                    </div>
                                                                    <div class="text-right">
                                                                        <p class="text-gray-800">Total : Rp
                                                                            {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</p>
                                                                    </div>
                                                                </div>
                            @empty
                                <p>Belum ada produk di keranjang</p>
                            @endforelse
                        
                    
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
                            
                            <!-- accordion -->
                            <div class="p-4 bg-white rounded-lg">
                            <div id="accordion-flush" data-accordion="collapse"
                                data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
                                data-inactive-classes="text-gray-500 dark:text-gray-400">
                                <h6 id="accordion-flush-heading-1">
                                    <button type="button"
                                        class="flex items-center justify-between w-full gap-3 py-5 font-medium text-gray-500 border-b border-gray-200 max-h[50px] rtl:text-right dark:border-gray-700 dark:text-gray-400"
                                        data-accordion-target="#accordion-flush-body-1" aria-expanded="true" aria-controls="accordion-flush-body-1">
                                        <span>Metode Pembayaran <img class="w-[50px] h-[50px]" src="{{asset('assets/pngwing.com.png')}}" alt=""></span>                                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5 5 1 1 5" />
                                        </svg>
                                    </button>
                                </h6>
                                <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                                    <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                                        <p class="mb-2 text-gray-500 dark:text-gray-400">Cara transfer ke rekening BCA lewat fitur m-Transfer Berikut langkah-langkah atau cara transfer uang ke rekening BCA
                                        lainnya melalui fitur m-Transfer di aplikasi BCA mobile:
                                        <p>• Login ke aplikasi BCA mobile</p>
                                        <p>• Pilih fitur "m-Transfer"</p>
                                        <p>• Di bagian Daftar Transfer, pilih Antar Rekening"</p>
                                        <p>• Masukkan Rekening <strong>8820840969</strong>, dan send, setelah itu pilih dengan nama <strong>MUHAMMAD DWI SYAMSURRIJAL</strong></p>
                                        <p>• Masukkan Pin</p>
                                        <p>• Setelah Sukses, Pilih Transfer Antar Rekening</p>
                                        <p>• Pilih Rekening tujuan yang tadi sudah didaftarkan</p>
                                        <p>• Masukkan nominal yang akan ditransfer</p>
                                        <p>• Pastikan kembali informasi transfer sudah benar</p>
                                        <p>• Konfirmasi dengan memasukkan PIN</p>
                                        <p>• BCA mobile Transfer ke sesama rekening BCA berhasil</p>
</p>
                                        
                                    </div>
                                </div>
                        </div>
                        
                    </div>
                    

                    <!-- Right Column: Forms Items -->
                    <div class="w-full md:w-1/2 p-6 bg-[#e2b285]">
                        <h2 class="mb-4 text-xl font-semibold leading-tight text-gray-800">Form Transaksi</h2>
                        <form method="POST" action="{{route('product_transactions.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-1 lg:grid-cols-2">
                            <div class="col-span-1">
                                <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                                <input id="address" name="address" type="text" required autofocus
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" placeholder="Jl Pegangsaan timur nomor 20 kecamatan ...">
                            </div>
                    
                            <div class="col-span-1 mt-4">
                                <label for="city" class="block text-sm font-medium text-gray-700">Kota</label>
                                <input id="city" name="city" type="text" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" placeholder="Tangerang">
                            </div>
                    </div>
                            <div class="mt-4">
                                <label for="post_code" class="block text-sm font-medium text-gray-700">Kode Pos</label>
                                <input id="post_code" name="post_code" type="number" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" placeholder="23132">
                            </div>
                    
                            <div class="mt-4">
                                <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor
                                    Telepon</label>
                                <input id="phone_number" name="phone_number" type="number" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" placeholder="62">
                            </div>
                    
                            <div class="mt-4">
                                <label for="proof" class="block text-sm font-medium text-gray-700">Bukti
                                    Transfer</label>
                                <input id="proof" name="proof" type="file" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            </div>
                    
                            <div class="mt-4">
                                <label for="notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                                <textarea id="notes" name="notes" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" placeholder="Tambahkan catatan untuk alamatmu"></textarea>
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
                    
                </div>
            </div>
            
        </div>
        
    </div>
    </section>
    @include('front.footer')
    
    <script>
        function calculatePrice(){
            let subTotal = 0;
            let deliveryFee = 10000;
            
            document.querySelectorAll('.product-price').forEach(item => {
                subTotal += parseFloat(item.getAttribute('data-price'));
            });

            document.getElementById('checkout-delivery-fee').textContent = 'Rp' +deliveryFee.toLocaleString('id',{
                minimumFractionDigits: 0, maximumFractionDigits: 0
            });

            document.getElementById('checkout-sub-total').textContent = 'Rp' + subTotal.toLocaleString('id', {
                minimumFractionDigits: 0, maximumFractionDigits: 0
            });

            const grandTotalPrice = subTotal +deliveryFee;
            document.getElementById('checkout-grand-total').textContent = 'Rp '+grandTotalPrice.toLocaleString('id', {
                minimumFractionDigits: 0, maximumFractionDigits: 0
            });
        }

        document.addEventListener('DOMContentLoaded', function(){
            calculatePrice();
        });
    </script>
</body>


</html>