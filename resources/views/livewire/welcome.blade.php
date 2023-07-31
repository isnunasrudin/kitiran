<form wire:submit.prevent="submit">
    <div class=" bg-teal-600 -mt-2 rounded mb-6 px-4 py-2 text-white">
        <b>&#128712;</b>&nbsp;Silahkan mengisi entitas dibawah ini dengan sebenar-benarnya agar laporan bisa segera diproses (maksimal 2x24 jam kerja).<br />
        <b>Informasi yang anda berikan, dijamin kerahasiaannya.</b>
    </div>
    <div class="mb-3">
        <span class="text-danger-700 whitespace-nowrap font-medium">*</span>
        Kolom Wajib diisi
    </div>
    {{ $this->form }}
    <x-filament::button type="submit" form="submit" class="w-full mt-10">Kirim Laporan</x-filament::button>
</form>