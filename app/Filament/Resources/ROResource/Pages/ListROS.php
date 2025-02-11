<?php

namespace App\Filament\Resources\ROResource\Pages;

use App\Filament\Resources\ROResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListROS extends ListRecords
{
    protected static string $resource = ROResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
