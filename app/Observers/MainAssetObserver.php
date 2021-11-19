<?php

namespace App\Observers;

use App\Models\MainAsset;

class MainAssetObserver
{
    /**
     * Handle the MainAsset "created" event.
     *
     * @param  \App\Models\MainAsset  $mainAsset
     * @return void
     */
    public function created(MainAsset $mainAsset)
    {
        //
    }

    /**
     * Handle the MainAsset "updated" event.
     *
     * @param  \App\Models\MainAsset  $mainAsset
     * @return void
     */
    public function updated(MainAsset $mainAsset)
    {
        //
    }

    /**
     * Handle the MainAsset "deleted" event.
     *
     * @param  \App\Models\MainAsset  $mainAsset
     * @return void
     */
    public function deleted(MainAsset $mainAsset)
    {
        //
    }

    /**
     * Handle the MainAsset "restored" event.
     *
     * @param  \App\Models\MainAsset  $mainAsset
     * @return void
     */
    public function restored(MainAsset $mainAsset)
    {
        //
    }

    /**
     * Handle the MainAsset "force deleted" event.
     *
     * @param  \App\Models\MainAsset  $mainAsset
     * @return void
     */
    public function forceDeleted(MainAsset $mainAsset)
    {
        //
    }
}
