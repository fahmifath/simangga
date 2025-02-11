<?php

namespace App\Filament\Resources\IKUResource\Pages;

use App\Filament\Resources\IKUResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIKU extends EditRecord
{
    protected static string $resource = IKUResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
