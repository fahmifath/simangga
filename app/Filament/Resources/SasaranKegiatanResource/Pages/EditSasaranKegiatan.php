<?php

namespace App\Filament\Resources\SasaranKegiatanResource\Pages;

use App\Filament\Resources\SasaranKegiatanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSasaranKegiatan extends EditRecord
{
    protected static string $resource = SasaranKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
