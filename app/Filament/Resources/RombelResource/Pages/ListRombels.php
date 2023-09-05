<?php

namespace App\Filament\Resources\RombelResource\Pages;

use App\Filament\Resources\RombelResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ListRombels extends ListRecords
{
    protected static string $resource = RombelResource::class;

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
        $rombel = Arr::map($rombel['rows'], function ($item) {
            return Arr::only($item,
                [
                    'rombongan_belajar_id',
                    'nama',
                    'tingkat_pendidikan_id',
                    'tingkat_pendidikan_id_str',
                    'semester_id',
                    'jenis_rombel',
                    'jenis_rombel_str',
                    'kurikulum_id',
                    'kurikulum_id_str',
                    'id_ruang',
                    'id_ruang_str',
                    'moving_class',
                    'ptk_id',
                    'ptk_id_str',
                    'jurusan_id',
                    'jurusan_id_str',
                ]
            );
        });

        // dd($rombel['rows']);
        if ($rombel) {
            $user = Auth::user();
            $success = $user->createToken('MyApp')->plainTextToken;
            $kirim_rombel = Http::withToken($success)->post(url('/api/rombel'), [
                'rombel' => $rombel,
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
