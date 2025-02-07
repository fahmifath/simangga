<?php

namespace App\Filament\Resources\RKAKLResource\Pages;

use App\Filament\Resources\RKAKLResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRKAKL extends EditRecord
{
    protected static string $resource = RKAKLResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
