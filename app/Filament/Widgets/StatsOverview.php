<?php

namespace App\Filament\Widgets;

use App\Models\Pengajuan;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pengajuan Anggaran', Pengajuan::Count())
                ->description('Pengajuan')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([0, Pengajuan::Count()]),
        ];
    }
}
