<?php

namespace App\Filament\Resources\JurnalKelasResource\Pages;

use App\Filament\Resources\JurnalKelasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJurnalKelas extends EditRecord
{
    protected static string $resource = JurnalKelasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
