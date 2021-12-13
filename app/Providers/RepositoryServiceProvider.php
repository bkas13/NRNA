<?php

namespace App\Providers;

use App\Repository\Eloquent\AdminSiteSettingRepository;
use App\Repository\Eloquent\CandidateRepository;
use App\Repository\Eloquent\ContactRepository;
use App\Repository\Eloquent\NewsRepository;
use App\Repository\Eloquent\ProfileRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\IUserRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\IRegionalRepository;
use App\Repository\Eloquent\RegionalRepository;
use App\Repository\Eloquent\RegionalSettingRepository;
use App\Repository\IAdminSiteSettingRepository;
use App\Repository\ICandidateRepository;
use App\Repository\IContactRepository;
use App\Repository\INewsRepository;
use App\Repository\IProfileRepository;
use App\Repository\IRegionalSettingRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IRegionalRepository::class, RegionalRepository::class);
        $this->app->bind(ICandidateRepository::class, CandidateRepository::class);
        $this->app->bind(INewsRepository::class, NewsRepository::class);
        $this->app->bind(IRegionalSettingRepository::class, RegionalSettingRepository::class);
        $this->app->bind(IContactRepository::class, ContactRepository::class);
        $this->app->bind(IAdminSiteSettingRepository::class, AdminSiteSettingRepository::class);
        $this->app->bind(IProfileRepository::class, ProfileRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
