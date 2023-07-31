<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Yepsua\Filament\Forms\Components\Captcha;

class Welcome extends Component implements HasForms
{
    use InteractsWithForms;
    
    public function mount() : void
    {
        $this->form->fill();
    }

    public function render()
    {
        return view('livewire.welcome');
    }

    protected function getFormSchema(): array
    {
        $array = [
            TextInput::make('name')->required()->label('Nama'),
            Fieldset::make('Alamat')->schema([
                Toggle::make('internal')->label('Saya Berdomisili di Desa Pakel')->reactive(),
                Group::make([
                    TextInput::make('Rt')->required()->length(2)->integer(),
                    TextInput::make('Rw')->required(),
                ])->hidden(fn($get) => !$get('internal'))->columns()
            ])->columns(1),
            TextInput::make('email')->helperText('Kami akan mengirim balasan melalui Email')->required()->email(),
            Textarea::make('message')->required()->placeholder('Dapat berupa kritik, saran, pengaduan dan/atau permintaan informasi')->helperText('Gunakan Bahasa Indonesia yang baik dan benar, juga hindari SARA.')->label('Pesan'),
            FileUpload::make('attachments')->multiple()->acceptedFileTypes([
                'application/pdf',
                'audio/*',
                'image/*'
            ])->maxSize(5120)->label('Lampiran')->directory('lampiran'),
        ];

        config('captcha.disable') ?: array_push($array, Fieldset::make('Verifikasi Captcha')->schema([
            Captcha::make('captcha')->label('Masukkan teks pada kotak')->config('inverse')
        ])->columns(1));

        return $array;
    }

    public function submit()
    {
        $data = $this->form->getState();

        $data['raw'] = [
            'ua' => request()->userAgent(),
            'ip' => request()->ip()
        ];

        Message::create($data);
        $this->redirect(route('success'));
    }

    protected function getFormModel(): string
    {
        return Message::class;
    }
}
