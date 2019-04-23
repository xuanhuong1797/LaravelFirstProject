<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use View;
use Form;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Form::component('bsText', 'components.form.text', ['name', 'value', 'attributes' => []]);
        Form::component('bsTextArea', 'components.form.textarea', ['name', 'value', 'attributes' => []]);
        Form::component('bsNumber', 'components.form.number', ['name', 'value', 'attributes' => []]);
        Form::component('bsSelect', 'components.form.select', ['name', 'value', 'selected', 'attributes' => []]);
        Form::component('bsSubmit', 'components.form.submit', ['value', 'attributes' => []]);
        Form::component('bsFile', 'components.form.file', ['name', 'attributes' => []]);
        if (!app()->runningInConsole()) {
            View::share('allCategories', Category::get());
        }
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
