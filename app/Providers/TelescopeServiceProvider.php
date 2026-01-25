<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\TelescopeApplicationServiceProvider;

class TelescopeServiceProvider extends TelescopeApplicationServiceProvider
{
    public function register(): void
    {
        $this->hideSensitiveRequestDetails();
        Telescope::filter(function (IncomingEntry $entry) {
            if ($this->app->environment("local")) {
                return true;
            }
            return $entry->isReportableException() ||
                   $entry->isFailedRequest() ||
                   $entry->isFailedJob() ||
                   $entry->isScheduledTask() ||
       >hasMonitoredTag() ||
                   $entry->type === 'request';
        });
    }

    protected function hideSensitiveRequestDetails(): void
    {
        if ($this->app->environment("local")) {
            return;
        }
        Telescope::hideRequestParameters(["_token"]);
        Telescope::hideRequestHeaders(["cookie", "x-csrf-token", "x-xsrf-token"]);
    }

    protected function gate(): void
    {
        Gate::define("viewTelescope", function ($user = null) {
            if (app()->environment("local", "dev", "development")) {
                return true;
            }
            if (!$user) {
                return false;
            }
            $allowedEmails = ['admin@yourdomain.com'];
            return in_array($user->email, $allowedEmails);
        });
    }
}
