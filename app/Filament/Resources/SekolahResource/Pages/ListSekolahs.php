<?php

namespace App\Filament\Resources\SekolahResource\Pages;

use App\Models\Team;
use Filament\Actions;
use App\Models\Sekolah;
use Filament\Facades\Filament;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SekolahResource;

class ListSekolahs extends ListRecords
{
    protected static string $resource = SekolahResource::class;

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
        $sekolah = Http::withToken($this->token)
            ->get('localhost:5774/WebService/getSekolah?npsn=' . $this->npsn)
            ->json();
        // dd($this->npsn);
        if ($sekolah) {

            $tenant = Filament::getTenant();
            // dd($tenant);
            $user = Auth::user();
            $success = $user->createToken('MyApp')->plainTextToken;
            // $kirim_sekolah = Http::withToken($success)->post(url('/api/sekolah'), [
            $kirim_sekolah = Http::withToken('2|SESROaIIjuqSk4L1Re4kw6TwpamrTGahxRYwBGsX232b0621')->post('https://p-tech.site/api/sekolah', [
                'sekolah' => $sekolah['rows'],
                'tenant' => $tenant,
            ])->json();

            // dd( $kirim_sekolah);

            // Team::query()->find($tenant->id)->sekolahs()->syncWithoutDetaching($kirim_sekolah['data']['id']);
            // $team->users()->attach(auth()->user());

            if ($kirim_sekolah) {
                Notification::make()
                    ->title('Sikronasisasi Data Sekolah Berhasil')
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
