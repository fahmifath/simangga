<?php

namespace App\Filament\Resources\DetilResource\Pages;

use App\Filament\Resources\DetilResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetils extends ListRecords
{
    protected static string $resource = DetilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
