<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('src/output.css')}}" />
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet" />
    <title>Pembayaran | CookieCrumbs</title>
    <link rel="icon" href="{{asset('assets/aplikasilogo.png')}}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

@include('front.navbar')

<body class="bg-amber-100 py-16">
    <div class="container mx-auto py-8 px-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-6">Upload Bukti Pembayaran</h1>

            <!-- accordion -->

            <div class="p-4 bg-white rounded-lg">
                <div id="accordion-flush" data-accordion="collapse"
                    data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
                    data-inactive-classes="text-gray-500 dark:text-gray-400">
                    <h6 id="accordion-flush-heading-1">
                        <button type="button"
                            class="flex items-center justify-between w-full gap-3 py-5 font-medium text-gray-500 border-b border-gray-200 max-h[50px] rtl:text-right dark:border-gray-700 dark:text-gray-400"
                            data-accordion-target="#accordion-flush-body-1" aria-expanded="true"
                            aria-controls="accordion-flush-body-1">
                            <span>Metode Pembayaran <img class="w-[50px] h-[50px]"
                                    src="{{asset('assets/pngwing.com.png')}}" alt=""></span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h6>
                    <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                        <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                            <p class="mb-2 text-gray-500 dark:text-gray-400">Cara transfer ke rekening BCA lewat fitur
                                m-Transfer Berikut langkah-langkah atau cara transfer uang ke rekening BCA
                                lainnya melalui fitur m-Transfer di aplikasi BCA mobile:</p>
                            <p>• Login ke aplikasi BCA mobile</p>
                            <p>• Pilih fitur "m-Transfer"</p>
                            <p>• Di bagian Daftar Transfer, pilih Antar Rekening"</p>
                            <p>• Masukkan Rekening <strong>8820840969</strong>, dan send, setelah itu pilih dengan nama
                                <strong>MUHAMMAD DWI SYAMSURRIJAL</strong></p>
                            <p>• Masukkan Pin</p>
                            <p>• Setelah Sukses, Pilih Transfer Antar Rekening</p>
                            <p>• Pilih Rekening tujuan yang tadi sudah didaftarkan</p>
                            <p>• Masukkan nominal yang akan ditransfer</p>
                            <p>• Pastikan kembali informasi transfer sudah benar</p>
                            <p>• Konfirmasi dengan memasukkan PIN</p>
                            <p>• BCA mobile Transfer ke sesama rekening BCA berhasil</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end accordion -->


            <div class="mt-4 mb-6">
                <h2 class="text-xl font-semibold">Detail Transaksi</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 mt-4 table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Nama Produk</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Quantity</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Harga</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php $total = 0; @endphp
                            @foreach ($productTransaction->transactionDetails as $detail)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $detail->product->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $detail->quantity }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Rp
                                        {{ number_format($detail->price * $detail->quantity, 2) }}</td>
                                </tr>
                                @php    $total += $detail->price * $detail->quantity; @endphp
                            @endforeach
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-bold" colspan="2">Biaya Pengiriman</td>
                                <td class="px-6 py-4 whitespace-nowrap">Rp 10,000.00</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-bold" colspan="2">Total Harga</td>
                                <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($total + 10000, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>



            <form method="POST" action="{{ route('product_transactions.upload_proof.post', $productTransaction->id) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="wrapper-file flex justify-between items-center">
                    <div class="mb-4 flex justify-between">
                        <label for="proof" class="block text-sm font-medium text-gray-700">Bukti Pembayaran</label>
                        <input id="proof" name="proof" type="file" required
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>

                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Upload
                    </button>
                </div>


            </form>
            <form method="POST" action="{{ route('product_transactions.cancel', $productTransaction->id) }}"
                onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');" class="mt-4">
                @csrf
                @method('PUT')

                <button type="submit"
                    class="inline-flex  items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Batalkan Pesanan
                </button>

            </form>

            <!-- cancel form -->


        </div>
    </div>
    @include('front.footer')
</body>

</html>