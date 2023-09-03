<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Resources\SiswaResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ListSiswas extends ListRecords
{
    protected static string $resource = SiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeader(): ?View
    {
        $data = Actions\CreateAction::make();
        return view('filament.custom.sinkron-sekolah', compact('data'));
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
        $siswa = Http::withToken($this->token)
            ->get('localhost:5774/WebService/getPesertaDidik?npsn=' . $this->npsn)
            ->json();

        $siswa = Arr::map($siswa['rows'], function ($item) {
            return Arr::only($item,
                [
                    'registrasi_id',
                    'jenis_pendaftaran_id',
                    'jenis_pendaftaran_id_str',
                    'nipd',
                    'tanggal_masuk_sekolah',
                    'sekolah_asal',
                    'peserta_didik_id',
                    'nama',
                    'nisn',
                    'jenis_kelamin',
                    'nik',
                    'tempat_lahir',
                    'tanggal_lahir',
                    'agama_id',
                    'agama_id_str',
                    'alamat_jalan',
                    'nomor_telepon_rumah',
                    'nomor_telepon_seluler',
                    'nama_ayah',
                    'pekerjaan_ayah_id',
                    'pekerjaan_ayah_id_str',
                    'nama_ibu',
                    'pekerjaan_ibu_id',
                    'pekerjaan_ibu_id_str',
                    'nama_wali',
                    'pekerjaan_wali_id',
                    'pekerjaan_wali_id_str',
                    'anak_keberapa',
                    'tinggi_badan',
                    'berat_badan',
                    'email',
                    'semester_id',
                    'anggota_rombel_id',
                    'rombongan_belajar_id',
                    'tingkat_pendidikan_id',
                    'nama_rombel',
                    'kurikulum_id',
                    'kurikulum_id_str',
                    'kebutuhan_khusus',
                ]
            );
        });

        // dd($rombel['rows']);
        if ($siswa && nps ) {
            $user = Auth::user();
            $success = $user->createToken('MyApp')->plainTextToken;
            $kirim_siswa = Http::withToken($success)->post(url('/api/siswa'), [
                'siswa' => $siswa,
            ])->json();

            // dd($kirim_siswa);
            if ($kirim_siswa) {
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
