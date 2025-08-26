<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;

class Dashboard extends BaseDashboard
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static ?string $title = 'Dasbor';

    protected static ?string $navigationLabel = 'Dasbor';

    protected static ?string $slug = 'dashboard';

    public function getTitle(): string
    {
        return 'Dasbor';
    }
}
