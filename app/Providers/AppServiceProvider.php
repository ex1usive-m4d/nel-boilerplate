<?php

namespace App\Providers;

use App\Models\ChallengeApplication;
use App\Models\Comment;
use App\Models\IdeaKey;
use App\Models\Meet;
use App\Models\Package;
use App\Models\Position;
use App\Models\Post;
use App\Policies\ChallengeApplicationPolicy;
use App\Policies\CommentPolicy;
use App\Policies\IdeaKeyPolicy;
use App\Policies\MeetPolicy;
use App\Policies\PackagePolicy;
use App\Policies\PositionPolicy;
use App\Policies\PostPolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\NelReports\Application\Interfaces\NelReportRepositoryInterface;
use App\NelReports\Infrastructure\Repositories\NelReportRepository;
use App\NelReports\Infrastructure\Services\SentryService;
use Sentry\State\HubInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        // Регистрация репозитория
        $this->app->bind(NelReportRepositoryInterface::class, NelReportRepository::class);

        // Регистрация SentryService
        $this->app->singleton(SentryService::class, function ($app) {
            return new SentryService($app->make(HubInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });


        Paginator::useBootstrapFive();

        $this->registerPolicies();
    }

    /**
     * Register the application's policies.
     *
     * @return void
     */
    protected function registerPolicies()
    {
        foreach ($this->policies() as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }

    /**
     * The model to policy mappings for the application.
     *
     * @return string[]
     */
    protected function policies()
    {
        return [

        ];
    }
}
