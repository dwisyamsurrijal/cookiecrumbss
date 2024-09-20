<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('src/output.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

        <link rel="icon" href="{{asset('assets/aplikasilogo.png')}}" type="image/x-icon">

    <title>Register | CookieCrumbs</title>
</head>


<div id="parent-regis" style="background-image: url('{{asset('assets/bglogin.jpg')}}')"
    class="fixed inset-0 top-0 transition-all duration-[400ms] ease-in-out opacity-100 invisible-z-20">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div
            class="relative w-full overflow-hidden bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div id="parent-Register" class="relative flex flex-col gap-4 p-6 md:gap-3 sm:p-8">
                <a href="{{route('front.index')}}"
                    class="flex items-center justify-center gap-2 mb-6 text-2xl font-semibold text-gray-900">
                    Cookiecrumbs
                    <img class="w-8 h-8 mr-2 " src="{{asset('assets/aplikasilogo.png')}}" alt="logo">
                </a>
                <div id="btn-close-login"
                    class="absolute top-0 right-0 cursor-pointer z-30 px-2 py-1.5 rounded-bl-lg bg-amber-600 hover:bg-amber-700">
                    <a href="{{route('front.index')}}">
                    <i class="text-lg text-white ti ti-x md:text-2xl"></i>
                    </a>
                </div>
                <form class="space-y-4 md:space-y-6" action="{{ route('register') }}" method="POST">
                    @csrf
                    <h5 class="font-semibold leading-tight tracking-tight text-center text-gray-900">
                        Daftarkan Akunmu
                    </h5>
                    <div>
                        <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                        <input type="text" name="name" id="fullname__"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            placeholder="fullname" required="">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            placeholder="name@company.com" required="">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                        <input type="text" name="address" id="address__"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            placeholder="address" required="">
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>
                    <div class="relative mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                         <input type="password" name="password" id="password" placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 pr-10" />
                    <i id="togglePassword" class="absolute inset-y-3.5 right-0 flex items-end pr-3 cursor-pointer text-gray-500">
                    <i id="eyeIcon" class="ti ti-eye"></i>
                    </i>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="relative mb-4">
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 pr-10" />
                    <i id="togglePasswordConfirmation" class="absolute inset-y-3.5 top-1/2 right-0 flex items-end pr-3 cursor-pointer text-gray-500">
                     <i id="eyeIconConfirmation" class="ti ti-eye"></i>
                    </i>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    
                    <button type="submit"
                        class="w-full text-white bg-amber-600 hover:bg-amber-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 transition duration-300">Daftar Akun</button>

                </form>
                <button class="text-[13px] font-light mx-auto text-gray-500 dark:text-gray-400">
                    Sudah punya akun? <a href="{{(route('login'))}}" id="loginBtn"
                        class="font-medium cursor-pointer text-primary-600 hover:underline dark:text-primary-500">Masuk</a>
                </button>
            </div>
            <!-- Regis -->

            <!-- Regis End -->
        </div>
    </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', function() {
        const passwordField = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('ti-eye');
                eyeIcon.classList.add('ti-eye-off');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('ti-eye-off');
                eyeIcon.classList.add('ti-eye');
            }
        });

        const passwordConfirmationField = document.getElementById('password_confirmation');
        const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
        const eyeIconConfirmation = document.getElementById('eyeIconConfirmation');

        togglePasswordConfirmation.addEventListener('click', function() {
            if (passwordConfirmationField.type === 'password') {
                passwordConfirmationField.type = 'text';
                eyeIconConfirmation.classList.remove('ti-eye');
                eyeIconConfirmation.classList.add('ti-eye-off');
            } else {
                passwordConfirmationField.type = 'password';
                eyeIconConfirmation.classList.remove('ti-eye-off');
                eyeIconConfirmation.classList.add('ti-eye');
            }
        });
    });

</script>