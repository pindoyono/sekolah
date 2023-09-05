<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Pages\Dashboard;
use Filament\Pages\Auth\Login;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use App\Filament\Pages\Auth\Login1;
use Filament\Widgets\AccountWidget;
use App\Filament\Resources\GtkResource;
use Filament\Navigation\NavigationItem;
use App\Filament\Resources\UserResource;
use Filament\Navigation\NavigationGroup;
use Filament\Widgets\FilamentInfoWidget;
use App\Filament\Resources\SiswaResource;
use App\Filament\Resources\RombelResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Navigation\NavigationBuilder;
use App\Filament\Resources\SekolahResource;
use Illuminate\Session\Middleware\StartSession;
use App\Filament\Resources\PembelajaranResource;
use Illuminate\Cookie\Middleware\EncryptCookies;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(Login1::class)
            ->sidebarCollapsibleOnDesktop(true)
            // ->colors([
            //     'primary' => Color::Amber,
            // ])
            ->colors([
                'danger' => Color::Rose,
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'primary' => Color::Indigo,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
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
            ->authMiddleware([
                Authenticate::class,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            // ->plugin(FilamentSpatieRolesPermissionsPlugin::make())
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                FilamentSpatieRolesPermissionsPlugin::make()
            ]);
            // ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
            //     return $builder->groups([
            //         NavigationGroup::make()
            //             ->items([
            //                 NavigationItem::make('Dashboard')
            //                 ->icon('heroicon-o-home')
            //                 ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.pages.dashboard'))
            //                 ->url(fn (): string => Dashboard::getUrl()),
            //             ]),
            //         NavigationGroup::make('Dapodik')
            //             ->items([
            //                 ...GtkResource::getNavigationItems(),
            //                 ...PembelajaranResource::getNavigationItems(),
            //                 ...RombelResource::getNavigationItems(),
            //                 ...SekolahResource::getNavigationItems(),
            //                 ...SiswaResource::getNavigationItems(),
            //             ]),
            //         NavigationGroup::make('Setting')
            //             ->items([
            //                 ...UserResource::getNavigationItems(),
            //                 NavigationItem::make('Roles')
            //                 ->visible(fn(): bool => auth()->user()->can('roles'))
            //                 ->icon('heroicon-o-puzzle-piece')
            //                 ->isActiveWhen(fn (): bool => request()->routeIs([
            //                         'filament.admin.resources.roles.index',
            //                         'filament.admin.resources.roles.create',
            //                         'filament.admin.resources.roles.view',
            //                         'filament.admin.resources.roles.edit',
            //                     ]))
            //                 ->url(fn (): string => '/admin/roles'),
            //                 NavigationItem::make('Permissions')
            //                 ->visible(fn(): bool => auth()->user()->can('permissions'))
            //                 ->icon('heroicon-o-key')
            //                 ->isActiveWhen(fn (): bool => request()->routeIs([
            //                         'filament.admin.resources.permissions.index',
            //                         'filament.admin.resources.permissions.create',
            //                         'filament.admin.resources.permissions.view',
            //                         'filament.admin.resources.permissions.edit',
            //                     ]))
            //                 ->url(fn (): string => '/admin/permissions'),
            //             ]),
            //     ]);
            // });
            // ->userMenuItems([
            //     'logout' => MenuItem::make()->label('Log out'),
            //     // ...
            // ]);

    }
}
