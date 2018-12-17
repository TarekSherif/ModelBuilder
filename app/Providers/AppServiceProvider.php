<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('*', function($view) {
            $view_name=$view->getName();
            $jtable=true;
            $RoleMenu=RoleMenu();
            $data = array('view_name' => $view_name,
                          'Permission'=>PagePermission($view_name),
                          'jtable'=>  $jtable,
                          'RoleMenu'=>$RoleMenu);

            view()->share( $data);
        });

      
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
