<?php

namespace App\Filament\Resources\SubKomponenResource\Pages;

use App\Filament\Resources\SubKomponenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubKomponens extends ListRecords
{
    protected static string $resource = SubKomponenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
