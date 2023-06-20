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
use \App\Models\SalesRequest;

class AssignRequest extends Action
{
    public $name = 'Assign Request';

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
        SalesRequest::where('id','=',$models->first()->id)->update(['sales_people_id'=>$fields->salesPeople->id,'assigned'=>1,'accepted_status'=>'no']);
        return Action::message("Status has been successfully updated");
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            BelongsTo::make('SalesPeople', 'salesPeople')->required(),
            // Text::make('Assigned')->default(function ($request) {
            //     return '1';
            // }),
            // Text::make('AcceptedStatus')->default(function ($request) {
            //     return 'pending';
            // }),
        ];
    }
}
