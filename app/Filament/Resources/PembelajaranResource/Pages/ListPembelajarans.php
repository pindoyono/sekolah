<?php

namespace App\Filament\Resources\PembelajaranResource\Pages;

use App\Filament\Resources\PembelajaranResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ListPembelajarans extends ListRecords
{
    protected static string $resource = PembelajaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeader(): ?View
    {
        // $data = Actions\CreateAction::make();
        return view('filament.custom.sinkron-sekolah');
    }

    public $npsn = "";
    public $token = "";

    protected $rules = [
        'npsn' => 'required',
        'token' => 'required',
    ];

    public function save()
    {
        $this->validate();
        $rombel = Http::withToken($this->token)
            ->get('localhost:5774/WebService/getRombonganBelajar?npsn=' . $this->npsn)
            ->json();
        // dd($rombel['rows']);

        $pembelajaran = Arr::map($rombel['rows'], function ($item) {
            return Arr::only($item,
                [
                    'pembelajaran',
                    'rombongan_belajar_id',
                ]
            );
        });

        // dd($pembelajaran);
        if ($rombel) {
            $user = Auth::user();
            $success = $user->createToken('MyApp')->plainTextToken;
            $kirim_rombel = Http::withToken($success)->post(url('/api/pembelajaran'), [
                'pembelajaran' => $pembelajaran,
            ])->json();

            // dd($kirim_rombel);
            if ($kirim_rombel) {
                Notification::make()
                    ->title('Sikronasisasi Data Rombongan Belajar Berhasil')
                    ->success()
                    ->send();
            } else {
                Notification::make()
                    ->title('Gagal Melakukan Sinkronisasi')
                    ->danger()
                    ->send();
            }
        } else {
            Notification::make()
                ->title('NPSN atau Token Salah')
                ->danger()
                ->send();
        }
    }

}
