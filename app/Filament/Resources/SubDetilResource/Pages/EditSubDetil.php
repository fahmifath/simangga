<?php

namespace App\Filament\Resources\SubDetilResource\Pages;

use App\Filament\Resources\SubDetilResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubDetil extends EditRecord
{
    protected static string $resource = SubDetilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
