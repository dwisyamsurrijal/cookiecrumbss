<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
</head>

@include('front.navbar')
<body class="my-28 bg-amber-50">
    <section class="max-w-4xl p-6 mx-auto mt-6 bg-white rounded-md shadow-md">
        <h2 class="mb-4 text-2xl font-bold text-center">Hubungi Kami</h2>
        <p class="mb-6 text-center">Jika Anda memiliki pertanyaan atau saran, silakan isi formulir di bawah ini. Kami akan segera menghubungi Anda.</p>
        <form action="https://api.web3forms.com/submit" method="POST" id="form">
            <input type="hidden" name="access_key" value="a97bd5d9-0b02-4705-ba9f-59e7d07a3578" />
            <div class="grid grid-cols-1 gap-6 mb-6 sm:grid-cols-2">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="nama" name="nama"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-[#CC9B6D] focus:ring-[#CC9B6D] sm:text-sm">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-[#CC9B6D] focus:ring-[#CC9B6D] sm:text-sm">
                </div>
            </div>
            <div class="mb-6">
                <label for="pesan" class="block text-sm font-medium text-gray-700">Pesan</label>
                <textarea id="pesan" name="pesan" rows="4"
                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-[#CC9B6D] focus:ring-[#CC9B6D] sm:text-sm"></textarea>
            </div>
            <div>
                <button type="submit"
                    class="w-full px-4 py-2 font-medium text-white bg-[#CC9B6D] rounded-md shadow-sm hover:bg-[#b88658] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#CC9B6D] sm:w-auto">Kirim</button>
            </div>
        </form>
    </section>
    @include('front.footer')
</body>

</html>