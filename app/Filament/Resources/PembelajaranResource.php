<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembelajaranResource\Pages;
use App\Models\Pembelajaran;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PembelajaranResource extends Resource
{
    protected static ?string $model = Pembelajaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                TextColumn::make('mata_pelajaran_id_str'),
                TextColumn::make('ptk_id'),
                TextColumn::make('ptk_id'),
                TextColumn::make('jam_mengajar_per_minggu'),
                TextColumn::make('status_di_kurikulum_str'),
                //
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
            'index' => Pages\ListPembelajarans::route('/'),
            // 'create' => Pages\CreatePembelajaran::route('/create'),
            // 'edit' => Pages\EditPembelajaran::route('/{record}/edit'),
        ];
    }
}
