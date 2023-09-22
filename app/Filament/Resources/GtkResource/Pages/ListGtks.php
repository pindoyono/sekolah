<?php

namespace App\Filament\Resources\GtkResource\Pages;

use App\Models\Gtk;
use App\Models\Team;
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

        // dd($tenant->id);

        // dd($gtk);
        if ($gtk) {
            $tenant = Filament::getTenant();
            $user = Auth::user();
            $success = $user->createToken('MyApp')->plainTextToken;
            // $kirim_gtk = Http::withToken('2|SESROaIIjuqSk4L1Re4kw6TwpamrTGahxRYwBGsX232b0621')->post('https://p-tech.site/api/gtk', [

            foreach ($gtk as $key => $value) {
                $kirim_siswa  = Http::withToken('2|SESROaIIjuqSk4L1Re4kw6TwpamrTGahxRYwBGsX232b0621')->post('https://p-tech.site/api/gtk', [
                    // $kirim_siswa = Http::withToken($success)->post(url('/api/siswa'), [
                        'gtk' => $value,
                        // 'tenant' => $tenant,
                    ])->json();
                    dd($kirim_siswa['data']['siswa']);
                Team::find($tenant['id'])->gtks()->syncWithoutDetaching($kirim_siswa['data']['siswa']);
                // return $this->sendResponse($value, 'Sinkronisasi Sekolah Berhasil');
            }

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
