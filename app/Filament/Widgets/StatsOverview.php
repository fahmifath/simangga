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
            Stat::make('Total Pengajuan', Pengajuan::Count())
        ];
    }
}
