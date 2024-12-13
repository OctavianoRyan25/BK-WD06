<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Temu Janji</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <!-- Header Section -->
    <header class="bg-blue-800 text-white py-10">
        <div class="container mx-auto text-center">
            <h1 class="text-2xl font-bold">Poliklinik</h1>
            <h2 class="text-4xl font-extrabold mt-2">Sistem Temu Janji Pasien - Dokter</h2>
            <p class="mt-2 text-lg">Bimbingan Karir 2024 Bidang Web</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto py-16 px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Card 1 -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <div class="flex justify-center">
                    <div class="bg-blue-500 text-white p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A4 4 0 0112 17.804a4 4 0 016.879.001M15 11a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl font-semibold mt-4">Registrasi Sebagai Pasien</h3>
                <p class="mt-2 text-gray-600">Apabila Anda adalah seorang Pasien, silahkan Registrasi terlebih dahulu
                    untuk melakukan pendaftaran sebagai Pasien!</p>
                <a href="{{ route('user.login') }}" class="mt-4 inline-block text-blue-500 font-semibold">Klik Link
                    Berikut →</a>
            </div>

            <!-- Card 2 -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <div class="flex justify-center">
                    <div class="bg-blue-500 text-white p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A4 4 0 0112 17.804a4 4 0 016.879.001M15 11a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl font-semibold mt-4">Login Sebagai Dokter</h3>
                <p class="mt-2 text-gray-600">Apabila Anda adalah seorang Dokter, silahkan Login terlebih dahulu untuk
                    memulai melayani Pasien!</p>
                <a href="{{ route('dokter.login') }}" class="mt-4 inline-block text-blue-500 font-semibold">Klik Link
                    Berikut →</a>
            </div>
        </div>
        <!-- Footer -->
        <footer class="container mx-auto flex justify-center p-7">
            <p class="text-sm text-gray-500">© 2024 Made with ❤️ by <span class="font-bold">Octaviano Ryan</span></p>
        </footer>
        <!-- End-Footer -->

    </main>

</body>

</html>
