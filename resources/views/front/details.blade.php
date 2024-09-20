<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/output.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="icon" href="{{asset('assets/aplikasilogo.png')}}" type="image/x-icon">
    <title>Detail Produk | CookieCrumbs</title>
</head>

<body class="bg-[#f6f1e9] font-Poppins">
    @include('front.navbar')
    <section class="container p-4 pt-6 mx-auto md:p-3">
        <a href="{{route('front.allproduct')}}" class="bg-amber-500">
        <i class="ti ti-arrow-left text-[#CC9B6D] text-2xl gap-y-4 rounded-lg"></i>
        </a>
        <div class="grid grid-cols-1 gap-6 xl:gap-12 xl:grid-cols-12">
            <!-- Left Column: Product Image -->
            <div class="h-full col-span-6 bg-black rounded shadow-md xl:col-span-5">
                <img src="{{Storage::url($product->photo)}}" class="object-cover w-full h-full">
            </div>
            <!-- Middle Column: Product Details -->
            <div class="flex flex-col col-span-6 gap-4 h-fit justify-items xl:col-span-4">
                <div class="flex flex-col gap-4 wrap justify-items ">
                    <h3 class="font-bold">
                        {{$product->name}}
                    </h3>
                    <h5 class="font-bold">Stok :
                        {{$product->stock}}
                    </h5>
                    <p class="text-xl font-semibold text-gray-600">Rp
                        {{$product->price}}
                    </p>
                    <p class="text-justify text-gray-600">
                        {{$product->about}}
                    </p>
                </div>
                <div class="flex gap-3 tab-event">
                    <button
                        class="px-6 py-2 transition-all duration-300 ease-in-out rounded-md outline outline-1 outline-amber-500 hover:text-white text-[#CC9B6D] hover:outline-0 hover:bg-[#CC9B6D] toggle-tab ">
                        <h6>Info Produk</h6>
                    </button>
                    <button
                        class="px-6 py-2 toggle-tab transition duration-300 ease-in-out rounded-md outline outline-1 outline-amber-500 hover:text-white text-[#CC9B6D] hover:outline-0 hover:bg-[#CC9B6D] ">
                        <h6>Info Pengiriman</h6>
                    </button>
                    
                </div>
                <hr class="border-[0.5px] border-gray-300">
                <div class="hidden tab-box">
                    <p class="text-justify text-gray-600">
                        Berat : 500gr
                    </p>
                    <p class="text-justify text-gray-600">
                        Ketahanan Produk : 2 Bulan
                    </p>
                </div>
                <div class="hidden tab-box">
                    <p class="text-justify text-gray-600">Pengiriman akan dilakukan saat admin sudah approve pesananmu
                    </p>
                </div>
                
                </div>
            </div>
            <!-- Right Column: Quantity Controls -->
            <div
                class="sticky xl:flex hidden flex-col gap-2.5 p-4 bg-white rounded-lg shadow-md top-[110px] h-fit w-fit md:col-span-3">
                <form action="{{ route('carts.store', $product->id) }}" method="POST" class="items-center">
                    @csrf
                    <button type="submit"
                        class="px-6 py-2 text-white rounded-md bg-[#CC9B6D] hover:bg-[#c08e5f] transition duration-300">Tambah ke Keranjang</button>
                </form>
                <a class="px-6 py-2 font-semibold outline outline-1 outline-[#CC9B6D] text-[#CC9B6D] rounded-md text-center hover:bg-[#CC9B6D] hover:text-white transition duration-300 " href="{{route('front.carts')}}">Lihat Keranjang</a>
                
            </div>
        </div>

    </section>

    @include('front.other', ['otherProducts' => $otherProducts])

    @include('front.footer')

</body>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const toggleTabs = document.querySelectorAll(".toggle-tab");
        const toggleBoxes = document.querySelectorAll(".tab-box");

        // Set the first tab and box as active by default
        toggleTabs[0].classList.add("toggle-active");
        toggleBoxes[0].classList.remove("hidden");

        toggleTabs.forEach((toggle, index) => {
            toggle.addEventListener("click", () => {
                // Remove 'toggle-active' class from all tabs
                toggleTabs.forEach(tab => tab.classList.remove("toggle-active"));

                // Add 'toggle-active' class to the clicked tab
                toggle.classList.add("toggle-active");

                // Show/Hide boxes based on the clicked tab
                toggleBoxes.forEach((box, boxIndex) => {
                    if (index === boxIndex) {
                        box.classList.remove("hidden");
                    } else {
                        box.classList.add("hidden");
                    }
                });
            });
        });
    });


</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{asset('js/swiper.js')}}"></script>
<script>
    @if(session('success'))
        alert('{{ session('success') }}');
    @endif
</script>

</html>