<?php

namespace App\Observers;

use App\Models\FavoriteProperty;
use App\Http\Controllers\SendEmailController;
use Illuminate\Support\Facades\DB;

class FavoritePropertyObserver
{
    /**
     * Handle the FavoriteProperty "created" event.
     *
     * @param  \App\Models\FavoriteProperty  $favoriteProperty
     * @return void
     */
    public function created(FavoriteProperty $favoriteProperty)
    {
 

        $emails = \DB::select("SELECT email FROM listings l JOIN customers cs ON l.owner_id = cs.id WHERE l.id=". $favoriteProperty->listing_id);
        if(count($emails)>0){
            $data["email"] = $emails[0]->email;
            $data["title"] = "Appointments";
            $data["body"] = "Your listing have been favorites";
            $files = [ ];
            SendEmailController::sendEmail($data,$files);
        }
    }


    /**
     * Handle the FavoriteProperty "updated" event.
     *
     * @param  \App\Models\FavoriteProperty  $favoriteProperty
     * @return void
     */
    public function updated(FavoriteProperty $favoriteProperty)
    {
        //
    }

    /**
     * Handle the FavoriteProperty "deleted" event.
     *
     * @param  \App\Models\FavoriteProperty  $favoriteProperty
     * @return void
     */
    public function deleted(FavoriteProperty $favoriteProperty)
    {
        //
    }

    /**
     * Handle the FavoriteProperty "restored" event.
     *
     * @param  \App\Models\FavoriteProperty  $favoriteProperty
     * @return void
     */
    public function restored(FavoriteProperty $favoriteProperty)
    {
        //
    }

    /**
     * Handle the FavoriteProperty "force deleted" event.
     *
     * @param  \App\Models\FavoriteProperty  $favoriteProperty
     * @return void
     */
    public function forceDeleted(FavoriteProperty $favoriteProperty)
    {
        //
    }
}
