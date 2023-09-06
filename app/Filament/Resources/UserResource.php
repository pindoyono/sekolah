<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Settings';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')
                ->label('Nama')
                ->required()

                ->maxLength(100),

                TextInput::make('username')
                ->label('NIK/NIK/NISN')
                ->required()

                ->maxLength(100),

                TextInput::make('email')
                ->email()
                ->label('Alamat Email')
                ->required()
                ->maxLength(100),

                TextInput::make('password')
                ->password()
                ->minLength(8)
                ->same('passwordConfirmation')
                ->dehydrateStateUsing(fn (string $state):string => Hash::make($state))
                ->dehydrated(fn($state):bool => filled($state))
                ->required(fn(Page $livewire):bool => $livewire instanceof CreateRecord),

                Select::make('roles')->multiple()->relationship('roles','name'),

                TextInput::make('passwordConfirmation')
                ->password()
                ->label('Komfirmasi Password')
                ->required(fn(Page $livewire):bool => $livewire instanceof CreateRecord)
                ->minLength(8)
                ->dehydrated(false),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('No')->rowIndex(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('username')->searchable(),
                TextColumn::make('roles.name')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    // public static function getGloballySearchableAttributes(): array
    // {
    //     return ['name', 'email', 'roles.name'];
    // }

}
