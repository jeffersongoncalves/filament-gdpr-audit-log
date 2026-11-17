<?php

namespace JeffersonGoncalves\Filament\GdprAuditLog;

use JeffersonGoncalves\FilamentPluginCore\BasePackageServiceProvider;
use Spatie\LaravelPackageTools\Package;

class GdprAuditLogServiceProvider extends BasePackageServiceProvider
{
    public static string $name = 'filament-gdpr-audit-log';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasTranslations();
    }
}
