<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TatibResource\Pages;
use App\Filament\Resources\TatibResource\RelationManagers;
use App\Models\Tatib;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TatibResource extends Resource
{
    protected static ?string $model = Tatib::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kelompok_pelanggaran')
                ->options([
                    'Kelakuan' => 'Kelakuan',
                    'Kedisiplinan' => 'Kedisiplinan',
                    'Kerapian' => 'Kelakuan',
                    'Kebersihan' => 'Kebersihan',
                ])
                ->required()
                ->native(false),
                Forms\Components\Textarea::make('jenis_pelanggaran')
                    ->maxLength(65535)
                    ->required()
                    ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('kelompok_pelanggaran')
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
                // Tables\Columns\TextColumn::make('deleted_at')
                //     ->dateTime()
                //     ->sortable(),
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
            'index' => Pages\ListTatibs::route('/'),
            'create' => Pages\CreateTatib::route('/create'),
            'edit' => Pages\EditTatib::route('/{record}/edit'),
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
