<?php

namespace App\Filament\Resources\RombelResource\Pages;

use App\Models\Team;
use Filament\Actions;
use Illuminate\Support\Arr;
use Filament\Facades\Filament;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\RombelResource;

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
            $tenant = Filament::getTenant();
            $success = $user->createToken('MyApp')->plainTextToken;
            // $kirim_rombel = Http::withToken($success)->post(url('/api/rombel'), [
            $kirim_rombel = Http::withToken('2|SESROaIIjuqSk4L1Re4kw6TwpamrTGahxRYwBGsX232b0621')->post('https://p-tech.site/api/rombel', [
                'rombel' => $rombel,
                'tenant' => $tenant,
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
