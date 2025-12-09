<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $menuItems = [
                [
                    'label' => 'Dashboard',
                    'icon' => 'bi bi-house',
                    'route' => 'dashboard',
                ],
                [
                    'label' => 'Aset',
                    'icon' => 'bi bi-box',
                    'route' => 'aset.index',
                ],
                [
                    'label' => 'Peminjaman',
                    'icon' => 'bi bi-archive',
                    'route' => 'peminjaman.index',
                ],
                [
                    'label' => 'Peminjam',
                    'icon' => 'bi bi-people',
                    'route' => 'peminjam.index',
                ],
                [
                    'label' => 'Reports',
                    'icon' => 'bi bi-graph-up',
                    'route' => 'reports.index',
                ],
            ];

            $view->with('menuItems', $menuItems);
        });
    }
}