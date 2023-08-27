<?php

namespace App\Observers;

use App\Models\Building;
use Illuminate\Support\Facades\Log;

class BuildingObserver
{
    /**
     * Handle the Building "created" event.
     */
    public function created(Building $building): void
    {
        Log::debug("Building {$building->name} was created.");
    }

    /**
     * Handle the Building "updated" event.
     */
    public function updated(Building $building): void
    {
        //
    }

    /**
     * Handle the Building "deleted" event.
     */
    public function deleted(Building $building): void
    {
        //
    }

    /**
     * Handle the Building "restored" event.
     */
    public function restored(Building $building): void
    {
        //
    }

    /**
     * Handle the Building "force deleted" event.
     */
    public function forceDeleted(Building $building): void
    {
        //
    }
}
