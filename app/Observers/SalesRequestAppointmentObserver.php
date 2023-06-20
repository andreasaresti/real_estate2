<?php

namespace App\Observers;

use App\Models\SalesRequestAppointment;
use App\Http\Controllers\SendEmailController;
use Illuminate\Support\Facades\DB;

class SalesRequestAppointmentObserver
{
    /**
     * Handle the SalesRequestAppointment "created" event.
     *
     * @param  \App\Models\SalesRequestAppointment  $SalesRequestAppointment
     * @return void
     */
    public function created(SalesRequestAppointment $SalesRequestAppointment)
    {
        
    }


    /**
     * Handle the SalesRequestAppointment "updated" event.
     *
     * @param  \App\Models\SalesRequestAppointment  $SalesRequestAppointment
     * @return void
     */
    public function updated(SalesRequestAppointment $SalesRequestAppointment)
    {
        if($SalesRequestAppointment->signed == 1){
            $emails = \DB::select("SELECT email FROM listings l JOIN customers cs ON l.owner_id = cs.id WHERE l.id=". $SalesRequestAppointment->listing_id);
            if(count($emails)>0){
                $sendData["email"] = $emails[0]->email;
                $sendData["title"] = "Appointments";
                $sendData["body"] = "A new user ".$_SESSION["name"]." is interested in the listing ".$SalesRequestAppointment->listing_id;
                $files = [
                    public_path('storage').'/'.$SalesRequestAppointment->signature
                ];
                SendEmailController::sendEmail($data,$files);
            }
        }
    }

    /**
     * Handle the SalesRequestAppointment "deleted" event.
     *
     * @param  \App\Models\SalesRequestAppointment  $SalesRequestAppointment
     * @return void
     */
    public function deleted(SalesRequestAppointment $SalesRequestAppointment)
    {
        //
    }

    /**
     * Handle the SalesRequestAppointment "restored" event.
     *
     * @param  \App\Models\SalesRequestAppointment  $SalesRequestAppointment
     * @return void
     */
    public function restored(SalesRequestAppointment $SalesRequestAppointment)
    {
        //
    }

    /**
     * Handle the SalesRequestAppointment "force deleted" event.
     *
     * @param  \App\Models\SalesRequestAppointment  $SalesRequestAppointment
     * @return void
     */
    public function forceDeleted(SalesRequestAppointment $SalesRequestAppointment)
    {
        //
    }
}
