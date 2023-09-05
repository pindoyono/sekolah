<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnggotaRombelResource\RelationManagers;
use App\Filament\Resources\RombelResource\Pages;
use App\Models\Rombel;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RombelResource extends Resource
{
    protected static ?string $model = Rombel::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationGroup = 'Dapodik';
    protected static ?int $navigationSort = 1;

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
                //
                TextColumn::make('No')->rowIndex(),
                TextColumn::make('nama'),
                TextColumn::make('tingkat_pendidikan_id_str'),
                TextColumn::make('semester_id'),
                TextColumn::make('jenis_rombel_str'),
                TextColumn::make('kurikulum_id_str'),
                TextColumn::make('id_ruang_str'),
                TextColumn::make('ptk_id_str'),
                TextColumn::make('jurusan_id_str'),

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
            RelationManagers\SiswasRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRombels::route('/'),
            'create' => Pages\CreateRombel::route('/create'),
            'edit' => Pages\EditRombel::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        $locale = app()->getLocale();
        if ($locale=='id') {
            # code...
            return "Rombongan Belajar";
        }else{
            return "Rombel";
        }
    }
}
