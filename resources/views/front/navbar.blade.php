<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('src/output.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
        
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
<header id="mainHeader"
    class="fixed inset-x-0 lg:py-8 md:py-7 py-5 top-0 z-30 font-semibold text-[#CC9B6D] transition-all duration-300 ease-in-out">
    <nav class="container flex items-center justify-between gap-12 text-sm md:text-sm lg:text-lg">
        <ul>
            <li>
                <a href="{{route('front.index')}}" class="flex items-center gap-1.5">
                    CookieCrumbs
                    <img src="{{asset('assets/aplikasilogo.png')}}" class="w-[15%]" alt="">
                </a>
            </li>
        </ul>
        <ul class="flex items-center gap-3 capitalize md:gap-9">
            <li class="hidden md:block"><a href="{{route('front.index')}}">beranda</a></li>
            <li class="hidden md:block"><a href="{{route('front.allproduct')}}">produk</a></li>
            <li class="hidden md:block"><a href="{{route('front.contact')}}">Kontak</a></li>

            @if (Route::has('login'))
                @auth

                <li class="hidden md:block"><a href="{{route('product_transactions.index')}}">Pesanan</a></li>
                <li class="hidden md:block">
                    <a class="" href="{{route('front.carts')}}">
                        <i class="p-2 text-base text-white rounded-full md:p-2.5 md:text-xl ti ti-shopping-cart bg-[#CC9B6D] "></i>
                    </a>
                </li>
                <li class="hidden md:block">
                    <a class="" href="{{route('profile.edit')}}">
                        <i class="p-2 text-base text-white rounded-full md:p-2.5 md:text-xl ti ti-user-circle bg-[#CC9B6D] "></i>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{route('logout')}}">
                        @csrf
                        <button class="md:px-12 px-7 py-1.5 font-semibold text-white rounded-lg bg-[#CC9B6D] hover:bg-[#c99564]" type="submit">
                            <h6>Keluar</h6>
                        </button>
                    </form>
                </li>
                @else
                <li>
                    <a href="{{ route('login') }}">
                        <button id="btn-login" class="md:px-12 px-7 py-1.5 font-semibold text-white rounded-lg bg-[#CC9B6D]">
                            <h6 class="">Masuk</h6>
                        </button>
                    </a>
                </li>
                @endauth
            @endif
            <button id="humbergerToggler" class="flex flex-col gap-1 md:hidden">
                <span
                    class="bar w-[23px] h-[3px] rounded-full bg-white transition-all origin-top-right ease-in-out duration-300"></span>
                <span class="bar w-[23px] h-[3px] rounded-full bg-white transition-all ease-in-out duration-300"></span>
                <span
                    class="bar w-[23px] h-[3px] rounded-full bg-white transition-all origin-bottom-right ease-in-out duration-300"></span>
            </button>
        </ul>
    </nav>
    <div id="mobileMenu" class="overflow-hidden transition-all ease-in-out duration-400 max-h-0">
        <ul class="md:hidden flex flex-col text-[#CC9B6D] gap-3.5 uppercase text-sm mt-6 px-4">
            <li><a href="{{route('front.index')}}">beranda</a></li>
            <li><a href="{{route('front.allproduct')}}">produk</a></li>
            <li><a href="{{route('front.contact')}}">kontak</a></li>

            @auth
            <li><a href="{{route('product_transactions.index')}}">Pesanan</a></li>
            <li>
                <a class="" href="{{route('front.carts')}}">
                    <i class="p-2 text-base text-white rounded-full md:p-2.5 md:text-xl ti ti-shopping-cart bg-[#CC9B6D] "></i>
                </a>
            </li>
            <li class="py-3">
                <a class="" href="{{route('profile.edit')}}">
                    <i class="p-2 text-base text-white rounded-full md:p-2.5 md:text-xl ti ti-user-circle bg-[#CC9B6D] "></i>
                </a>
            </li>
            
            @else
            <li>
                <a href="{{ route('login') }}">
                    <button id="btn-login" class="md:px-12 px-7 py-1.5 font-semibold text-white rounded-lg bg-[#CC9B6D]">
                        <h6 class="">Masuk</h6>
                    </button>
                </a>
            </li>
            @endauth
        </ul>
    </div>
</header>

<script src="{{asset('js/nav.js')}}"></script>
</body>
</html>
