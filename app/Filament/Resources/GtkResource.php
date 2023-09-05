<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GtkResource\Pages;
use App\Models\Gtk;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GtkResource extends Resource
{
    protected static ?string $model = Gtk::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'Dapodik';
    protected static ?int $navigationSort = 3;

    // public static function shouldRegisterNavigation(): bool
    // {
    //     if(auth()->user()->can('view_gtk'))
    //     return true
    //     else
    //     return false
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->rowIndex(),
                TextColumn::make('nama'),
                TextColumn::make('tahun_ajaran_id'),
                TextColumn::make('ptk_induk'),
                TextColumn::make('tanggal_surat_tugas'),
                TextColumn::make('jenis_kelamin'),
                TextColumn::make('tanggal_lahir'),
                TextColumn::make('agama_id_str'),
                TextColumn::make('nuptk'),
                TextColumn::make('nik'),
                TextColumn::make('jenis_ptk_id_str'),
                TextColumn::make('status_kepegawaian_id_str'),
                TextColumn::make('nip'),
                TextColumn::make('pendidikan_terakhir'),
                TextColumn::make('bidang_studi_terakhir'),
                TextColumn::make('pangkat_golongan_terakhir'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                // Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGtks::route('/'),
            // 'create' => Pages\CreateGtk::route('/create'),
            // 'edit' => Pages\EditGtk::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        $locale = app()->getLocale();
        if ($locale=='id') {
            # code...
            return "Guru dan Tenaga Kependidikan";
        }else{
            return "GTK";
        }
    }
}
