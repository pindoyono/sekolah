<?php

namespace App\Filament\Resources\JurnalKelasResource\Pages;

use App\Filament\Resources\JurnalKelasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJurnalKelas extends ListRecords
{
    protected static string $resource = JurnalKelasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
