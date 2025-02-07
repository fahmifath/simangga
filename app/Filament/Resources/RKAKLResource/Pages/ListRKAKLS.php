<?php

namespace App\Filament\Resources\RKAKLResource\Pages;

use App\Filament\Resources\RKAKLResource;
use App\Models\RKAKL;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRKAKLS extends ListRecords
{
    protected static string $resource = RKAKLResource::class;

    protected function getQuery(){
        return RKAKL::query()->with('komponen.subKomponens.detils');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
