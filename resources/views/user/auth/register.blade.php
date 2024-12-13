<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Register Page</title>
    <link rel="icon" href="{{ asset('assets/logo-udinus.png') }}" type="image/x-icon">
</head>

<body>
    @include('sweetalert::alert')
    <form method="POST" action="{{ route('user.handleregister') }}">
        @csrf
        <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
            <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center flex-1">
                <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
                    <div class="mt-12 flex flex-col items-center">
                        <h1 class="text-2xl xl:text-3xl font-extrabold">
                            Register
                        </h1>
                        <div class="w-full flex-1 mt-3">
                            <div class="my-6 border-b text-center">
                                @if (session('error'))
                                    <div class="text-red-500 text-sm my-2 text-start">
                                        {{ session('error') }}
                                    </div>
                                @else
                                    <div class="text-green-500 text-sm my-2">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if ($errors->has('nama'))
                                    <div class="text-red-500 text-sm mb-2">
                                        {{ $errors->first('nama') }}
                                    </div>
                                @endif
                                <input
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                    type="text" placeholder="Name" name="nama" value="{{ old('nama') }}" />
                                @if ($errors->has('no_ktp'))
                                    <div class="text-red-500 text-sm mt-2">
                                        {{ $errors->first('no_ktp') }}
                                    </div>
                                @endif
                                <input
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    type="number" placeholder="3316xxxxxxxxxx" name="no_ktp"
                                    value="{{ old('no_ktp') }}" />
                                @if ($errors->has('no_hp'))
                                    <div class="text-red-500 text-sm mt-2">
                                        {{ $errors->first('no_hp') }}
                                    </div>
                                @endif
                                <input
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    type="number" placeholder="081xxxxxxxxxx" name="no_hp"
                                    value="{{ old('no_hp') }}" />
                                @if ($errors->has('alamat'))
                                    <div class="text-red-500 text-sm mt-2">
                                        {{ $errors->first('alamat') }}
                                    </div>
                                @endif
                                <input
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    type="text" placeholder="semarang" name="alamat" value="{{ old('alamat') }}" />
                                <button type="submit"
                                    class="mt-5 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                    <svg class="w-6 h-6 -ml-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                                        <path fill-rule="evenodd"
                                            d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                    </svg>
                                    <span class="ml-3">
                                        Sign Up
                                    </span>
                                </button>
                                <p class="mt-6 text-xs text-gray-600 text-center">
                                    Saya setuju dengan
                                    <a href="#"
                                        class="border-b border-gray-500 border-dotted hover:text-indigo-400">
                                        Terms of Service
                                    </a>
                                    dan
                                    <a href="#"
                                        class="border-b border-gray-500 border-dotted hover:text-indigo-400">
                                        Privacy Policy
                                    </a>
                                    Poliklinik.
                                </p>
                                <div
                                    class="leading-none px-2 inline-block text-sm text-gray-600 tracking-wide font-medium bg-white transform translate-y-1/2">
                                    Have an account?
                                </div>
                            </div>
                            <div class="mx-auto max-w-xs">
                                <div class="flex flex-col items-center">
                                    <a href="{{ route('user.login') }}"
                                        class="w-full max-w-xs font-bold shadow-sm rounded-lg py-3 bg-indigo-100 text-gray-800 flex items-center justify-center transition-all duration-300 ease-in-out focus:outline-none hover:shadow focus:shadow-sm focus:shadow-outline mt-5 hover:bg-indigo-300">
                                        <div class="bg-white p-2 rounded-full">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                                <circle cx="8.5" cy="7" r="4" />
                                                <path d="M20 8v6M23 11h-6" />
                                            </svg>
                                        </div>
                                        <span class="ml-4">
                                            Login
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 bg-indigo-100 text-center hidden lg:flex">
                    <div class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat">
                        <img src="{{ asset('assets/img-login.png') }}">
                        <p class="text-indigo-700 text-2xl font-bold">SELAMAT DATANG DI POLIKLINIK</p>
                        <p class="text-indigo-700 text-sm font-normal">Berobat dan berkonsultasi dengan nyaman dan aman
                        </p>
                        <p class="absolute bottom-0 my-3 text-indigo-700 text-xs font-thin">© 2024, Cihuykan Dulu Le</p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
