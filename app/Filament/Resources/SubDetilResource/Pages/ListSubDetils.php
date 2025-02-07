<?php

namespace App\Filament\Resources\SubDetilResource\Pages;

use App\Filament\Resources\SubDetilResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubDetils extends ListRecords
{
    protected static string $resource = SubDetilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
