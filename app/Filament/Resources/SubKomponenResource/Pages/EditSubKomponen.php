<?php

namespace App\Filament\Resources\SubKomponenResource\Pages;

use App\Filament\Resources\SubKomponenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubKomponen extends EditRecord
{
    protected static string $resource = SubKomponenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
