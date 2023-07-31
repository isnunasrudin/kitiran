<html>
    <head>
        <title>KITIRAN - Desa Pakel</title>
        @vite('resources/css/mail.css')
        <style>
        .bg{
            background-color: rgba(0,0,0,0);
            opacity: 0.2;
            background: repeating-linear-gradient( 45deg, #ddddddae, #ddddddae 5px, rgba(0,0,0,0) 5px, rgba(0,0,0,0) 25px );
        }
        </style>
    </head>
 
    <body class="antialiased bg-gradient-to-t from-slate-200 to-white min-h-screen min-w-[300px] relative pb-12">
        <div class="bg w-full h-full absolute -z-10 bg-cover top-0"></div>
        <div class="text-white px-8 pt-16 pb-40 max-md:pb-36 bg-center relative overflow-hidden shadow-lg bg-cover" style="background-image: url({{ asset('assets/img/pemandangan.jpg') }})">
            <div class="w-full h-full opacity-70 bg-black left-0 top-0 absolute"></div>
            <div class="z-20 relative">
                <div class="mx-auto flex justify-center gap-7 mb-12">
                    <img src="{{ asset('assets/img/trenggalek.webp') }}" class=" object-contain h-24" alt="Logo Trenggalek">
                    <img src="{{ asset('assets/img/pakel_semarak.webp') }}" class=" object-contain h-24" alt="Logo Pakel Semarak">
                </div>
                <h1 class="text-center max-md:text-4xl text-5xl font-black mb-4">Pesan Balasan</h1>
                <p class="text-center text-2xl font-light">Layanan Kritik, Saran dan Pengaduan Pemerintah Desa Pakel</p>
            </div>
        </div>
        <div class="container mx-auto relative p-3">
            <div class="bg-white rounded-lg px-8 py-10 mx-auto min-w-[300px] max-w-[650px] shadow-xl -mt-24 border-4 border-indigo-200 ring-2 ring-slate-50">
                <div>
                    <div class="text-center mb-8">
                        <p class="text-4xl inline align-middle ml-2 font-light text-success-600">Yth, {{ $obj->name }}!</p>
                    </div>
                
                    <div class="mb-2">
                        Berkaitan dengan pesan anda:
                        <div class="bg-gray-200 p-2 rounded text-gray-600 mt-1 mb-3">{{ $obj->message }}</div>

                        Berikut respon dari kami:
                        <div class="bg-gray-200 p-2 rounded text-gray-600 my-1">{{ $obj->answer }}</div>
                    </div>

                
                </div>
            </div>
            <footer class="text-center mt-6 font-bold text-slate-600">&copy; 2023 - Pemerintah Desa Pakel</footer>
        </div>
 
    </body>
</html>