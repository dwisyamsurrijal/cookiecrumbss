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

<footer class="bg-[#f8f8f8] py-12">
    <div class="container px-4 mx-auto">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
            <div id="alamat" class="space-y-4">
                <p class="font-semibold">Informasi Tentang Kami</p>
                <p>Jalan Pulosari Raya No. 79<br>Tangerang 15138</p>
                <p>cookiecrumbs412@gmail.com</p>
                <p>081-233-334-808</p>
            </div>
            <div class="mb-3 space-y-4" id="bagian-footer">
                <p class="font-semibold">Halaman Kami</p>
                <p><a class="text-reset text-decoration-none" href="#">Beranda</a></p>
                <p><a class="text-reset text-decoration-none" href="#ourproduct">Produk Kami</a></p>
                <p><a class="text-reset text-decoration-none" href="#aboutus">Tentang Kami</a></p>
                <p><a class="text-reset text-decoration-none" href="#whyus">Why Us</a></p>
            </div>
            <div>
                <p class="font-semibold">Hubungi Kami</p>
                <div class="flex items-center gap-4 mt-4 text-2xl">
                    <a href="">
                        <i class="ti ti-mail"></i>
                    </a>
                    <a href="">
                        <i class="ti ti-brand-whatsapp"></i>
                    </a>
                    
                </div>
            </div>
            <div>
                <p class="font-semibold">Metode Pembayaran</p>
                <img src="{{asset('assets/pngwing.com.png')}}" alt="" class="h-12 mt-1 " />
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="js/swiper.js"></script>

</html>