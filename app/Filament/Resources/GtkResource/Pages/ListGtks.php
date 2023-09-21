<?php

namespace App\Filament\Resources\GtkResource\Pages;

use Filament\Actions;
use Illuminate\Support\Arr;
use Filament\Facades\Filament;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Filament\Resources\GtkResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListGtks extends ListRecords
{
    protected static string $resource = GtkResource::class;

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
        $gtk = Http::withToken($this->token)
            ->get('localhost:5774/WebService/getGtk?npsn=' . $this->npsn)
            ->json();
        $gtk = Arr::map($gtk['rows'], function ($item) {
            return Arr::only($item,
                [
                    'tahun_ajaran_id',
                    'ptk_terdaftar_id',
                    'ptk_id',
                    'ptk_induk',
                    'tanggal_surat_tugas',
                    'nama',
                    'jenis_kelamin',
                    'tempat_lahir',
                    'tanggal_lahir',
                    'agama_id',
                    'agama_id_str',
                    'nuptk',
                    'nik',
                    'jenis_ptk_id',
                    'jenis_ptk_id_str',
                    'status_kepegawaian_id',
                    'status_kepegawaian_id_str',
                    'nip',
                    'pendidikan_terakhir',
                    'bidang_studi_terakhir',
                    'pangkat_golongan_terakhir',
                ]
            );
        });

        $tenant = Filament::getTenant();
        // dd($gtk);

        // dd($gtk);
        if ($gtk) {
            $user = Auth::user();
            $success = $user->createToken('MyApp')->plainTextToken;
            // $kirim_gtk = Http::withToken($success)->post(url('/api/gtk'), [
            $kirim_gtk  = Http::withToken('2|SESROaIIjuqSk4L1Re4kw6TwpamrTGahxRYwBGsX232b0621')->post('https://p-tech.site/api/gtk', [
                'gtk' => $gtk,
                // 'tenant' => $tenant,
            ])->json();

            dd($kirim_gtk);
            if ($kirim_gtk) {
                Notification::make()
                    ->title('Sikronasisasi Data Siswa Berhasil')
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
