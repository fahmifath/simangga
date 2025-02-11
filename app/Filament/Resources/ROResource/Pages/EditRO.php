<?php

namespace App\Filament\Resources\ROResource\Pages;

use App\Filament\Resources\ROResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRO extends EditRecord
{
    protected static string $resource = ROResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
