<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('src/output.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="icon" href="{{asset('assets/aplikasilogo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>Landing Page | CookieCrumbs</title>
</head>

<body class="bg-[#f6f1e9] font-Poppins">
    @include('front.navbar')

    <main class="mt-0">
        <section id="banner" class="relative my-0">
            <img src="assets/banner.jpg" class="object-cover w-full md:h-[900px] h-[550px]" alt="Banner Image" />
            <div
                class="absolute flex flex-col items-center justify-center w-full h-full gap-3 px-4 font-semibold text-white transform translate-x-1/2 translate-y-1/2 bg-black bg-opacity-50 lg:gap-6 right-1/2 bottom-1/2">

                <h1 class="text-center ">Cari Cemilan Kue Kering Yang Lezat</h1>
                <h3 class="">CookieCrumbs Solusinya</h3>
                <a href="{{route('front.allproduct')}}"
                    class="px-10 lg:py-3.5 py-1.5 md:mt-0 text-black uppercase transition-all duration-300 ease-in-out bg-white rounded-lg hover:bg-[#CC9B6D] hover:text-white">
                    <h6>lihat produk</h6>
                </a>
            </div>
        </section>
        <section id="ourproduct" class="relative ">
            <div class="container flex flex-col gap-6 lg:gap-10 md:gap-8">
                <h2 class="font-semibold text-center">Produk Terbaru Kami</h2>
                <div class="max-w-[100%] swiper ">
                    <div class=" product-content">
                        <div class="swiper-wrapper">
                            <!-- Placeholder content -->
                            @forelse($products as $product)
                                <div class="p-4 bg-white ourproduct swiper-slide">
                                    <div class="grid grid-cols-5 gap-4 wrap">
                                        <a class="col-span-2" href="{{route('front.product.details', $product->slug)}}">
                                            <img class="object-cover w-full h-full" src="{{Storage::url($product->photo)}}">
                                        </a>
                                        <div class="flex flex-col self-center col-span-3 gap-2 md:gap-4 wrapper">
                                            <h5 class="font-semibold">{{ $product->name }}</h5>
                                            <h6 class="font-light text-justify line-clamp-3">{{ $product->about }}</h6>
                                            <h5>Rp {{ number_format($product->price, 0, ',', '.') }}</h5>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>
                                    Belum ada produk baru tersedia
                                </p>
                            @endforelse
                            <!-- End placeholder content -->
                        </div>
                    </div>
                </div>
                <!-- mobile -->
                <div class="z-10 flex w-full gap-3 mx-auto place-content-center 2xl:hidden toggle">
                    <i id="prev" class="p-3 bg-[#CC9B6D] text-white text-base rounded-full ti ti-chevron-left"></i>
                    <i id="next" class="p-3 bg-[#CC9B6D] text-white text-base rounded-full ti ti-chevron-right"></i>
                </div>
                <a href="{{route('front.allproduct')}}"
                    class="px-6 py-2.5 rounded-lg w-fit mx-auto text-white uppercase bg-[#CC9B6D]">
                    <h6 class="text-xs md:text-base">lihat selengkapnya</h6>
                </a>
            </div>
            <!--.. If we need navigation buttons -->
            <div
                class="absolute 2xl:flex hidden z-10 justify-between w-full px-1 bottom-[50%] 3xl:px-12 xl:px-6 toggle">
                <!-- tablet to desktop -->
                <div class="relative flex items-center justify-between w-full gap-4 wrap">
                    <i id="prev"
                        class="absolute bg-[#CC9B6D] text-white -left-5 p-4 text-lg 3xl:text-3xl transform translate-y-1/2 rounded-full lg:text-xl ti ti-chevron-left bottom-1/2"></i>
                    <i id="next"
                        class="absolute bg-[#CC9B6D] text-white -right-5 p-4 text-lg 3xl:text-3xl transform translate-y-1/2 rounded-full lg:text-xl ti ti-chevron-right bottom-1/2"></i>
                </div>
            </div>
        </section>

        <section class="aboutus bg-[#CC9B6D] py-32" id="aboutus">
            <div class="container">
                <div class="grid grid-cols-1 gap-4 md:gap-0 md:grid-cols-5">
                    <div class="md:col-span-3">
                        <!-- Placeholder content -->
                        <img class="md:w-[85%] w-full border-[6px] border-white "
                            src="{{asset('assets/banner.jpg')}}" />
                        <div class="wrap"></div>
                    </div>
                    <div class="flex flex-col justify-center gap-6 md:col-span-2 wrap">
                        <h2 class="font-semibold text-center text-white md:text-start">Tentang Kami</h2>
                        <hr />
                        <h6 class="text-justify text-white">
                            Selamat datang di CookieCrumbs!

                            Kami adalah usaha rumahan yang berdedikasi untuk menyajikan kue kering terbaik dan paling
                            lezat untuk Anda dan keluarga.
                            Berdiri sejak tahun 2023, CookieCrumbs lahir dari cinta kami terhadap kue kering yang renyah
                            dan menggugah selera.
                        </h6>
                    </div>
                </div>
            </div>
        </section>
        <section id="whyus" class="my-2 py-9 md:my-5">
            <div class="container flex flex-col gap-8">
                <div class="flex flex-col gap-2 px-3 text-center wrap">
                    <h2 class="font-semibold ">Pelayanan Kami</h2>
                    <h5 class="font-medium">Mengapa Harus pilih CookieCrumbs?</h5>
                </div>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div class="p-6 bg-white rounded-lg shadow-md">
                        <img src="{{asset('assets/pengiriman.png')}}" class="mb-1 h-14 w-14" alt="">
                        <h3 class="mb-4 text-2xl font-semibold ">Pengiriman Kue</h3>
                        <p>Nikmati layanan pengiriman untuk wilayah Tangerang dan sekitarnya. Pesan sekarang dan terima
                            kue kering anda.
                        </p>
                    </div>
                    <div class="p-6 bg-white rounded-lg shadow-md">
                        <img src="assets/dollar.png" class="w-12 h-12 mb-3" alt="">
                        <h3 class="mb-4 text-2xl font-semibold">Harga Terjangkau</h3>
                        <p>Kami menawarkan kue kering dengan harga yang terjangkau tanpa mengorbankan kualitas kue
                            kering kami.</p>
                    </div>

                    <div class="p-6 bg-white rounded-lg shadow-md">
                        <img src="assets/cooking (1).png" class="w-12 h-12 mb-3" alt="">
                        <h3 class="mb-4 text-2xl font-semibold">Tanpa Bahan Pengawet</h3>
                        <p>Nikmati lezatnya kue kering yang dibuat dari bahan alami dan bebas dari bahan pengawet.

        </section>

        <section id="orders" class="relative">
    <div class="container flex flex-col gap-6 lg:gap-10 md:gap-8">
        <h2 class="font-semibold text-center">Cara Pesan</h2>
        <h3 class="font-semibold text-center">Cara Pesan di CookieCrumbs</h3>
        <div class="max-w-full swiper">
            <div class="order-content">
                <div class="swiper-wrapper">
                    <!-- Placeholder content -->

                    <div class="p-6 bg-white w-full ourproduct swiper-slide">
                        <div class="flex flex-col items-center gap-4 md:flex-row">

                            <img class="object-cover w-1/6" src="{{asset('assets/login.png')}}">

                            <div class="flex flex-col self-center gap-2 md:gap-4 wrapper">
                                <h5 class="font-semibold">Langkah 1: Masuk atau Daftar</h5>
                                <h6 class="font-light text-justify">Daftarkan diri anda atau masuk ke akun anda di CookieCrumbs untuk melakukan pemesanan.</h6>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white w-full ourproduct swiper-slide">
                        <div class="flex flex-col items-center gap-4 md:flex-row">

                            <img class="object-cover w-1/6" src="{{asset('assets/cookie.png')}}">

                            <div class="flex flex-col self-center gap-2 md:gap-4 wrapper">
                                <h5 class="font-semibold">Langkah 2: Pilih Produk</h5>
                                <h6 class="font-light text-justify">Telusuri produk kami dan pilih kue kering yang anda inginkan.</h6>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white w-full ourproduct swiper-slide">
                        <div class="flex flex-col items-center gap-4 md:flex-row">

                            <img class="object-cover w-1/6" src="{{asset('assets/carts.png')}}">

                            <div class="flex flex-col self-center gap-2 md:gap-4 wrapper">
                                <h5 class="font-semibold">Langkah 3: Tambahkan pada Keranjang</h5>
                                <h6 class="font-light text-justify">Tambahkan produk yang ingin Anda pilih ke dalam keranjang belanja.</h6>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white w-full ourproduct swiper-slide">
                        <div class="flex flex-col items-center gap-4 md:flex-row">

                            <img class="object-cover w-1/6" src="{{asset('assets/contact-form.png')}}">

                            <div class="flex flex-col self-center gap-2 md:gap-4 wrapper">
                                <h5 class="font-semibold">Langkah 4: Isi Formulir</h5>
                                <h6 class="font-light text-justify">Isi formulir pada halaman cart yang telah disediakan</h6>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white w-full ourproduct swiper-slide">
                        <div class="flex flex-col items-center gap-4 md:flex-row">

                            <img class="object-cover w-1/6" src="{{asset('assets/credit-card.png')}}">

                            <div class="flex flex-col self-center gap-2 md:gap-4 wrapper">
                                <h5 class="font-semibold">Langkah 5: Lakukan Pembayaran</h5>
                                <h6 class="font-light text-justify">Lakukan pembayaran sesuai dengan metode yang disediakan dan unggah bukti pembayaran</h6>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white w-full ourproduct swiper-slide">
                        <div class="flex flex-col items-center gap-4 md:flex-row">

                            <img class="object-cover w-1/6" src="{{asset('assets/box.png')}}">

                            <div class="flex flex-col self-center gap-2 md:gap-4 wrapper">
                                <h5 class="font-semibold">Langkah 6: Terima Pesanan</h5>
                                <h6 class="font-light text-justify">Tunggu pesanan Anda tiba di alamat yang sudah Anda tentukan</h6>
                            </div>
                        </div>
                    </div>

                    <!-- End placeholder content -->
                </div>
            </div>
        </div>
        <!-- mobile -->
        <div class="z-10 flex w-full gap-3 mx-auto place-content-center 2xl:hidden toggle">
            <i id="prev2" class="p-3 bg-[#CC9B6D] text-white text-base rounded-full ti ti-chevron-left"></i>
            <i id="next2" class="p-3 bg-[#CC9B6D] text-white text-base rounded-full ti ti-chevron-right"></i>
        </div>

    </div>
    <!--.. If we need navigation buttons -->
    <div class="absolute 2xl:flex hidden z-10 justify-between w-full px-1 bottom-1/3 3xl:px-12 xl:px-6 toggle">
        <!-- tablet to desktop -->
        <div class="relative flex items-center justify-between w-full gap-4 wrap">
            <i id="prev2" class="absolute bg-[#CC9B6D] text-white -left-5 p-4 text-lg 3xl:text-3xl transform translate-y-1/2 rounded-full lg:text-xl ti ti-chevron-left bottom-1/2"></i>
            <i id="next2" class="absolute bg-[#CC9B6D] text-white -right-5 p-4 text-lg 3xl:text-3xl transform translate-y-1/2 rounded-full lg:text-xl ti ti-chevron-right bottom-1/2"></i>
        </div>
    </div>
</section>

    </main>
    @include('front.footer')
</body>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{asset('js/swiper.js')}}"></script>

</html>