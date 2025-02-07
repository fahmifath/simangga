<?php

namespace App\Filament\Resources\DetilResource\Pages;

use App\Filament\Resources\DetilResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDetil extends EditRecord
{
    protected static string $resource = DetilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
