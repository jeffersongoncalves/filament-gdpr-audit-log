<?php

namespace JeffersonGoncalves\Filament\GdprAuditLog\Resources\AuditLogs\Pages;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\Filament\GdprAuditLog\GdprAuditLogPlugin;
use JeffersonGoncalves\Filament\GdprAuditLog\Resources\AuditLogs\AuditLogResource;
use JeffersonGoncalves\GdprAuditLog\AuditLogger;

class ListAuditLogs extends ListRecords
{
    protected static string $resource = AuditLogResource::class;

    public function mount(): void
    {
        parent::mount();

        // The list shows who touched whose data: opening it is an access to the log too.
        if (GdprAuditLogPlugin::get()->shouldLogViews()) {
            app(AuditLogger::class)->record('viewed', purpose: 'Audit log review');
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('verify')
                ->label(AuditLogResource::label('verify.label'))
                ->icon('heroicon-o-shield-check')
                ->color('gray')
                ->action(function (): void {
                    $logger = app(AuditLogger::class);
                    $broken = $logger->verify();

                    if (GdprAuditLogPlugin::get()->shouldLogViews()) {
                        $logger->record('verified', purpose: 'Audit log review', metadata: ['intact' => $broken === null, 'broken_at' => $broken]);
                    }

                    if ($broken === null) {
                        Notification::make()->success()->title(AuditLogResource::label('verify.intact'))->send();

                        return;
                    }

                    Notification::make()
                        ->danger()
                        ->title(__('filament-gdpr-audit-log::filament-gdpr-audit-log.verify.broken', ['id' => $broken]))
                        ->persistent()
                        ->send();
                }),
        ];
    }
}
