<?php

namespace JeffersonGoncalves\Filament\GdprAuditLog;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class GdprAuditLogServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-gdpr-audit-log')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations();
    }
}
