
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
    <link rel="icon" href="{{asset('assets/aplikasilogo.png')}}" type="image/x-icon">
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

                <form action="{{route('front.search')}}" method="GET" class="w-full mx-auto md:w-2/3 lg:w-1/2">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="default-search" name="keyword" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Produk..." />
                </div>
            </form>

            @if (isset($keyword))
            <form action="{{ route('front.allproduct') }}" method="GET" class="w-full mx-auto md:w-2/3 lg:w-1/2 mt-4">
                <button type="submit" class="block w-full p-4 text-sm text-white bg-[#CC9B6D] rounded-lg">Lihat Semua Produk</button>
            </form>
            @endif
                
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

    <script>
        document.getElementById('search-form').addEventListener('submit', function(e) {
            var keyword = document.getElementById('default-search').value;
            if (!keyword) {
                e.preventDefault();
            }
        });
    </script>
    
</body>

</html>