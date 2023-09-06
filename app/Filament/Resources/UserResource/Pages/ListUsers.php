<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Models\Gtk;
use App\Models\User;
use App\Models\Siswa;
use Filament\Actions;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use App\Filament\Resources\UserResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeader(): ?View
    {
        $data = Actions\CreateAction::make();
        return view('filament.custom.generate-user', compact('data'));
    }

    public function generate_siswa()
    {
        try {
            $siswa = Siswa::all();
            foreach ($siswa as $key => $value) {

                if($value['email']==null || $value['email']==''){
                    $email =  $value['nisn'].'@gmail.com';
                }else{
                    $email =  $value['email'];
                }

                $data = [
                    'name' => $value['nama'],
                    'email' => $email,
                    'username' => $value['nisn'],
                    'email_verified_at' => now(),
                    'password' => bcrypt($value['nisn']),
                    'remember_token' => Str::random(10),
                ];
                $save = User::updateOrCreate([
                    'username' => $value['nisn'],
                ],$data)->assignRole('siswa');
            }
            Notification::make()
                    ->title('Berhasil generate akun siswa')
                    ->success()
                    ->send();
        } catch (\Throwable $th) {

            Notification::make()
                    ->title('Gagal Melakukan Generate'.$th)
                    ->danger()
                    ->send();
        }

    }

    public function generate_gtk()
    {
        // dd('generate');
        // $siswa = Siswa::all();
        // $gtk = Gtk::all();
        try {
            $guru = Gtk::all();
            foreach ($guru as $key => $value) {

                if($value['email']==null || $value['email']==''){
                    $email =  $value['nik'].'@gmail.com';
                }else{
                    $email =  $value['email'];
                }

                $data = [
                    'name' => $value['nama'],
                    'email' => $email,
                    'username' => $value['nip'],
                    'email_verified_at' => now(),
                    'password' => bcrypt($value['nip']),
                    'remember_token' => Str::random(10),
                ];
                $save = User::updateOrCreate([
                    'username' => $value['nip'],
                ],$data)->assignRole('guru');
            }
            Notification::make()
                    ->title('Berhasil generate akun guru')
                    ->success()
                    ->send();
        } catch (\Throwable $th) {
            // dd($th);
            Notification::make()
                    ->title('Gagal Melakukan Generate')
                    ->danger()
                    ->send();
        }

    }

}
