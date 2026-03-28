<?php

namespace App\Providers\Filament;

use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
// use Filament\Widgets\AccountWidget;
// use Filament\Widgets\FilamentInfoWidget;
use Filament\FontProviders\LocalFontProvider;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Support\Icons\Heroicon;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // --- CUSTOM ------------

            ->sidebarCollapsibleOnDesktop()
            // ->sidebarFullyCollapsibleOnDesktop()

            ->path("admin")
            // ->path("dashboard")
            // ->path("/")

            // ->font("JetBrains Mono")
            ->font(
                "JetBrains Mono",
                url: asset("fonts/JetBrains_Mono/index.css"),
                provider: LocalFontProvider::class,
            )

            // ->brandName('Curso Filament')
            ->brandLogo(asset('images/icon.png'))
            // ->brandLogo(url('https://avatars.githubusercontent.com/u/138526727'))
            ->brandLogoHeight('2rem')

            // ->favicon(asset('images/icon.png'))
            ->favicon(url: url('https://avatars.githubusercontent.com/u/138526727'))

            ->defaultThemeMode(ThemeMode::Light)

            ->profile()

            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])

            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Postagens')
                    // ->icon(Heroicon::ClipboardDocumentList)
                    ->collapsible(true)
            ])

            ->navigationItems([
                NavigationItem::make('Portfolio')
                    ->url('http://gustavogordoni.github.io/', shouldOpenInNewTab: true)
                    ->icon(Heroicon::UserCircle)
                    // ->group('Postagens')
                    ->sort(4),

                NavigationItem::make('Repositório')
                    ->url('https://github.com/gustavogordoni/filament-course')
                    ->icon(Heroicon::CodeBracket)
                    // ->group('Postagens')
                    ->sort(5),
            ])

            // ->topNavigation()
            // ->topbar(false)
            // ->breadcrumbs(false)

            // --- DEFAULT ------------

            ->default()
            ->id("admin")
            ->login()
            ->colors([
                "primary" => Color::Indigo,
            ])
            ->discoverResources(
                in: app_path("Filament/Resources"),
                for: "App\Filament\Resources",
            )
            ->discoverPages(
                in: app_path("Filament/Pages"),
                for: "App\Filament\Pages",
            )
            ->pages([Dashboard::class])
            ->discoverWidgets(
                in: app_path("Filament/Widgets"),
                for: "App\Filament\Widgets",
            )
            ->widgets([
                // AccountWidget::class,
                // FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([Authenticate::class]);
    }
}
