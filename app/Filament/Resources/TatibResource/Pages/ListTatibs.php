<?php

namespace App\Filament\Resources\TatibResource\Pages;

use App\Filament\Resources\TatibResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTatibs extends ListRecords
{
    protected static string $resource = TatibResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
