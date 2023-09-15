<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Tatib;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Pelanggaran;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PelanggaranResource\Pages;
use App\Filament\Resources\PelanggaranResource\RelationManagers;
use App\Models\Siswa;

class PelanggaranResource extends Resource
{
    protected static ?string $model = Pelanggaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tgl')
                    ->required(),
                Forms\Components\Select::make('tatib_id')
                ->label('Jenis Pelanggaran')
                ->options(Tatib::all()->pluck('tatib_bobot', 'id'))
                ->searchable(),
                Forms\Components\Select::make('siswa_id')
                ->label('Nama Siswa')
                ->options(Siswa::all()->pluck('nama_nisn', 'id'))
                ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tgl')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tatib.jenis_pelanggaran')
                    ->label('Pelanggaran')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tatib.bobot')
                    ->label('Bobot')
                    ->numeric()
                    ->sortable(),
          Tables\Columns\TextColumn::make('siswa.nama')
                    ->label('Nama Siswa')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListPelanggarans::route('/'),
            'create' => Pages\CreatePelanggaran::route('/create'),
            'edit' => Pages\EditPelanggaran::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
