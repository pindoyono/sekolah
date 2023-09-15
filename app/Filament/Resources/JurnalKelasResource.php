<?php

namespace App\Filament\Resources;

use App\Models\Gtk;
use Filament\Forms;
use Filament\Tables;
use App\Models\Siswa;
use App\Models\Rombel;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\JurnalKelas;
use App\Models\Pembelajaran;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\JurnalKelasResource\Pages;
use App\Filament\Resources\JurnalKelasResource\RelationManagers;

class JurnalKelasResource extends Resource
{
    protected static ?string $model = JurnalKelas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('minggu_ke')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('tgl')
                    ->label('Tanggal')
                    ->required(),
                Forms\Components\TextInput::make('jam_ke')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('mata_pelajaran')
                    ->label('Mata Pelajaran')
                    ->required()
                    ->options(Pembelajaran::all()->pluck('mata_pelajaran_id_str', 'mata_pelajaran_id_str'))
                    ->searchable(),
                Forms\Components\Select::make('ptk_id')
                    ->label('Guru')
                    ->options(Gtk::all()->pluck('nama', 'ptk_id'))
                    ->searchable(),
                Forms\Components\Select::make('rombel_id')
                    ->label('Rombongan Belajar')
                    ->options(Rombel::all()->pluck('nama', 'rombongan_belajar_id'))
                    ->searchable(),
                Forms\Components\Textarea::make('materi_pelajaran')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('kegiatan_pelajaran')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),

                Repeater::make('absen_jurnals')
                    ->relationship()
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        // ...
                    Forms\Components\Select::make('siswa_id')
                    ->label('Nama Siswa')
                    ->options(Siswa::all()->pluck('nama_kelas', 'id'))
                    ->searchable(),

                    Forms\Components\Select::make('keterangan')
                    ->label('keterangan')
                    ->options([
                        'Alpha' => 'Alpha',
                        'Sakit' => 'Sakit',
                        'Ijin' => 'Ijin',
                    ])
                    ->searchable(),
                    ])
                    // ->orderColumn('sort')
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
                Tables\Columns\TextColumn::make('minggu_ke')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jam_ke')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mata_pelajaran')
                    ->searchable(),

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
            'index' => Pages\ListJurnalKelas::route('/'),
            'create' => Pages\CreateJurnalKelas::route('/create'),
            'edit' => Pages\EditJurnalKelas::route('/{record}/edit'),
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
