<?php

namespace JeffersonGoncalves\Filament\GdprAuditLog\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use JeffersonGoncalves\Filament\GdprAuditLog\GdprAuditLogPlugin;

class TestPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->plugins([
                GdprAuditLogPlugin::make(),
            ]);
    }
}
