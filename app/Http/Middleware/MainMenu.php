<?php

namespace App\Http\Middleware;

use Auth;
use Menu;
use Closure;

class MainMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        Menu::make('menu', function ($menu) {
            //$menu->add('Home', ['route' => 'index']);
            App()->setLocale(\Session::get('locale'));

            $menu->add(__('Lidmaatschap'), ['route' => ['subscription.index']])->nickname('lidmaatschap');
            $menu->lidmaatschap->prepend('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> ');

            $menu->add(__('Activiteiten'), ['route' => ['activity.index']])->nickname('activiteiten');
            $menu->activiteiten->prepend('<i class="fa fa-bus" aria-hidden="true"></i> ');
            $menu->activiteiten->add(__('Aanmeldingen'), ['route' => ['activity_entry.index']]);
            $menu->activiteiten->add(__('Activiteiten overzicht'), ['route' => ['activity.index']]);

            $menu->add(__('Betalingen'), ['route' => ['payment.index']])->nickname('betalingen');
            $menu->betalingen->prepend('<i class="fa fa-money" aria-hidden="true"></i> ');

            // Check if the user is authenticated
            if (Auth::check()) {
                if (Auth::user()->hasAccountType('admin')) {
                    $menu->add(__('Beheren'), ['route' => 'user.index'])->nickname('beheren');
                    $menu->beheren->prepend('<i class="fa fa-cog" aria-hidden="true"></i> ');
                    $menu->beheren->add(__('Gebruikers beheren'), ['route' => ['user.index']]);
                    $menu->beheren->add(__('Inschrijvingen beheren'), ['route' => ['subscription.manage']]);
                    $menu->beheren->add(__('Activiteiten overzicht'), ['route' => ['activity.manage']]);
                    $menu->beheren->add(__('Activiteiten aanmaken'), ['route' => ['activity.create']]);
                }
            }
        });

        return $next($request);
    }
}
