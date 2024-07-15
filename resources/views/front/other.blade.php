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
</head>

<section id="produk-lainnya" class="relative">
    <div class="container flex flex-col gap-6 lg:gap-10 md:gap-8">
        <h3 class="font-semibold text-center">Produk Lainnya</h3>
        <div class="container swiper">
            <div class="product-content">
                <div class="swiper-wrapper">
                    @foreach($otherProducts as $product)
                        <div class="p-4 bg-white ourproduct swiper-slide">
                            <div class="grid grid-cols-5 gap-4 wrap">
                                <a class="col-span-2" href="{{ route('front.product.details', $product->slug) }}">
                                    <img class="object-cover w-full h-full" src="{{ Storage::url($product->photo) }}">
                                </a>
                                <div class="flex flex-col self-center col-span-3 gap-2 md:gap-4 wrapper">
                                    <h5 class="font-semibold">{{ $product->name }}</h5>
                                    <h6 class="text-justify line-clamp-3">{{ $product->about }}</h6>
                                    <h5>Rp {{ number_format($product->price, 0, ',', '.') }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- mobile -->
        <div class="z-10 flex w-full gap-3 mx-auto place-content-center 2xl:hidden toggle">
            <i id="prev" class="p-3 bg-[#CC9B6D] text-white text-base rounded-full ti ti-chevron-left"></i>
            <i id="next" class="p-3 bg-[#CC9B6D] text-white text-base rounded-full ti ti-chevron-right"></i>
        </div>
    </div>
    <!--.. If we need navigation buttons -->
    <div class="absolute 2xl:flex hidden z-10 justify-between w-full px-1 bottom-[35%] 3xl:px-12 xl:px-6 toggle">
        <!-- tablet to desktop -->
        <div class="relative flex items-center justify-between w-full gap-4 wrap">
            <i id="prev"
                class="absolute bg-[#CC9B6D] text-white left-0 p-4 text-lg 3xl:text-3xl transform translate-y-1/2 rounded-full lg:text-xl ti ti-chevron-left bottom-1/2"></i>
            <i id="next"
                class="absolute bg-[#CC9B6D] text-white right-0 p-4 text-lg 3xl:text-3xl transform translate-y-1/2 rounded-full lg:text-xl ti ti-chevron-right bottom-1/2"></i>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{asset('js/swiper.js')}}"></script>

</html>