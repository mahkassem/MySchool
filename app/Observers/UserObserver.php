<?php

namespace App\Observers;

use App\Jobs\SendWelcomeEmailJob;
use App\Models\User;
use App\Notifications\SendWelcomeNotification;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        Log::info('User created: ' . $user->name);
        SendWelcomeEmailJob::dispatch($user)->delay(now()->addSeconds(5));

        // Send welcome email using notification
        $user->notify(new SendWelcomeNotification());
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
