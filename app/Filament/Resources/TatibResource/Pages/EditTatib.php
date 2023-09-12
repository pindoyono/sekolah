<?php

namespace App\Filament\Resources\TatibResource\Pages;

use App\Filament\Resources\TatibResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTatib extends EditRecord
{
    protected static string $resource = TatibResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
