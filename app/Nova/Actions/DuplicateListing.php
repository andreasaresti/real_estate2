<?php

namespace App\Nova\Actions;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use \App\Models\Listing;

class DuplicateListing extends Action
{
    public $name = 'Duplicate Listing';

    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    //'sales_people_id' => $fields->sales_people,
    //'accepted_status' => $fields->accepted_status
    public function handle(ActionFields $fields, Collection $models)
    {
        $Listing = new Listing;
        $Listing->name = $models->first()->name;
        $Listing->image = $models->first()->image;
        $Listing->parent_id = $models->first()->parent_id;
        $Listing->description = $models->first()->description;
        $Listing->price = $models->first()->price;
        $Listing->old_price = $models->first()->old_price;
        $Listing->map = $models->first()->map;
        $Listing->price_prefix = $models->first()->price_prefix;
        $Listing->price_postfix = $models->first()->price_postfix;
        $Listing->area_size = $models->first()->area_size;
        $Listing->area_size_prefix = $models->first()->area_size_prefix;
        $Listing->area_size_postfix = $models->first()->area_size_postfix;
        $Listing->number_of_bedrooms = $models->first()->number_of_bedrooms;
        $Listing->number_of_bathrooms = $models->first()->number_of_bathrooms;
        $Listing->number_of_garages_or_parkingpaces = $models->first()->number_of_garages_or_parkingpaces;
        $Listing->year_built = $models->first()->year_built;
        $Listing->featured = $models->first()->featured;
        $Listing->published = $models->first()->published;
        $Listing->address = $models->first()->address;
        $Listing->latitude = $models->first()->latitude;
        $Listing->longitude = $models->first()->longitude;
        $Listing->energy_class = $models->first()->energy_class;
        $Listing->energy_performance = $models->first()->energy_performance;
        $Listing->epc_current_rating = $models->first()->epc_current_rating;
        $Listing->epc_potential_rating = $models->first()->epc_potential_rating;
        $Listing->taxes = $models->first()->taxes;
        $Listing->dues = $models->first()->dues;
        $Listing->notes = $models->first()->notes;  
        $Listing->location_id = $models->first()->location_id;
        $Listing->property_type_id = $models->first()->property_type_id;
        $Listing->status_id = $models->first()->status_id;
        $Listing->delivery_time_id = $models->first()->delivery_time_id;
        $Listing->internal_status_id = $models->first()->internal_status_id;
        $Listing->owner_id = $models->first()->owner_id;Other Features!
        $Listing->save();
        return Action::message("Duplicate successfully");
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [];
    }
}
