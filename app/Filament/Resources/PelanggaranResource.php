<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelanggaranResource\Pages;
use App\Filament\Resources\PelanggaranResource\RelationManagers;
use App\Models\Pelanggaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PelanggaranResource extends Resource
{
    protected static ?string $model = Pelanggaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kelompok_pelanggaran')
                ->label('Kelompok Pelanggaran')
                ->options([
                    'Kelakuan' => 'Kelakuan',
                    'Kedisiplinan' => 'Kedisiplinan',
                    'Kerapian' => 'Kerapian',
                    'Kebersihan' => 'Kebersihan',
                ])
                ->required(),

                Forms\Components\MarkdownEditor::make('jenis_pelanggaran')
                    ->label('Jenis Pelanggaran')
                    ->required()
                    ->columnSpan('full'),

                Forms\Components\TextInput::make('bobot')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')->rowIndex(),

                Tables\Columns\TextColumn::make('kelompok_pelanggaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_pelanggaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bobot')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
