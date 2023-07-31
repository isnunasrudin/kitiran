<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
 
        <meta name="application-name" content="{{ config('app.name') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
 
        <link rel="shortcut icon" href="{{ asset('assets/img/pakel_semarak.webp') }}" type="image/webp">
        <title>KITIRAN - Desa Pakel</title>
 
        <style>[x-cloak] { display: none !important; }</style>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @livewireScripts
        @stack('scripts')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100;0,9..40,200;0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;0,9..40,900;0,9..40,1000;1,9..40,100;1,9..40,200;1,9..40,300;1,9..40,400;1,9..40,500;1,9..40,600;1,9..40,700;1,9..40,800;1,9..40,900;1,9..40,1000&display=swap" rel="stylesheet">
        <style>
        html{
            font-family: 'DM Sans', sans-serif;
        }
        .bg{
            background-color: rgba(0,0,0,0);
            opacity: 0.2;
            background: repeating-linear-gradient( 45deg, #ddddddae, #ddddddae 5px, rgba(0,0,0,0) 5px, rgba(0,0,0,0) 25px );
        }
        </style>
    </head>
 
    <body class="antialiased bg-gradient-to-t from-slate-200 to-white min-h-screen min-w-[300px] relative pb-12">
        <div class="bg w-full h-full absolute -z-10 bg-cover top-0"></div>
        <div class="text-white px-8 pt-16 pb-48 max-md:pb-36 bg-center relative overflow-hidden shadow-lg bg-cover" style="background-image: url({{ asset('assets/img/pemandangan.jpg') }})">
            <div class="w-full h-full opacity-70 bg-gradient-to-b from-black to-slate-700 left-0 top-0 absolute"></div>
            <div class="z-20 relative">
                <div class="mx-auto flex justify-center gap-7 mb-12">
                    <img src="{{ asset('assets/img/trenggalek.webp') }}" class=" object-contain h-24" alt="Logo Trenggalek">
                    <img src="{{ asset('assets/img/pakel_semarak.webp') }}" class=" object-contain h-24" alt="Logo Pakel Semarak">
                </div>
                <h1 class="text-center max-md:text-4xl text-5xl font-black mb-4">Layanan Kritik, Saran dan Pengaduan</h1>
                <p class="text-center text-2xl font-light">Sampaikan laporan Anda langsung kepada Pemerintah Desa Pakel</p>
            </div>
        </div>
        <div class="container mx-auto relative p-3">
            <div class="bg-white rounded-lg px-8 py-10 mx-auto min-w-[300px] max-w-[650px] shadow-xl -mt-24 border-4 border-indigo-200 ring-2 ring-slate-50">
                {{ $slot }}
            </div>
            <footer class="text-center mt-6 font-bold text-slate-600">&copy; 2023 - Pemerintah Desa Pakel</footer>
        </div>
 
        @livewire('notifications')
    </body>
</html>