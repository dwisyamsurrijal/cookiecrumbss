
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('src/output.css')}}" />
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <title>Cookie Crumbs | Semua Produk</title>
</head>

<body class="bg-[#f6f1e9] font-Poppins">
   @include('front.navbar')
    <section id="beginning">
        <div class="container flex flex-col gap-6 p-4 pt-6 mx-auto md:p-6 ">
            <h1 class="text-3xl font-bold text-center">Produk Kami</h1>
            <h6 class="font-medium text-center ">Kue kering homemade kami dibuat dengan
                bahan-bahan berkualitas dan resep keluarga yang teruji. Setiap kue dipersiapkan dengan cermat untuk
                menghasilkan rasa yang lezat dan tekstur yang sempurna. Nikmati kue kering kami yang dibuat dengan
                sentuhan rumah untuk menemani momen spesial Anda.</h6>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 3xl:grid-cols-4 lg:grid-cols-3">
               @forelse($allproducts as $product)
                <div class="bg-white rounded shadow-md ">

                    <img src="{{Storage::url($product->photo)}}"
                        class="h-[250px] object-cover w-full">
                    <div class="flex flex-col gap-2.5 p-6">
                        <h5 class="font-bold ">
                            {{ $product->name }}
                        </h5>
                        <p class="text-gray-600 line-clamp-3">
                            {{ $product->about }}
                        </p>
                        <div class="flex items-center justify-between ">
                            <p class="font-semibold text-gray-600">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            <div class="flex gap-2">

                                <a href="{{route('front.product.details', $product->slug)}}"
                                    class="flex items-center justify-center px-6 py-1 text-sm text-white bg-gray-500 rounded">Lihat
                                    Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center col-span-full">Belum ada produk tersedia</p>
            @endforelse
            </div>
        </div>
    </section>
    
</body>

</html>