<?php

namespace App\Nova\Actions;

use App\Models\SalesPeople;
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
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Select;

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
        SalesRequest::where('id','=',$models->first()->id)->update(['sales_people_id'=>$fields->sales_people_id,'assigned'=>1,'accepted_status'=>'no', 'assigned_date' => date('Y-m-d')]);
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
            // BelongsTo::make('SalesPeople', 'salesPeople2')->required(),

            Date::Make('Date')->default(now()->subDays(7)),
            
            Select::make('SalesPeople', 'sales_people_id')
                ->required()
                ->dependsOn(
                        ['date'],
                        function (Select $field, NovaRequest $request, FormData $formData) {
                            $sales_people = SalesPeople::where('active' , '=', 1)->get();
                            $sales_people_arr = [];
                            for($i = 0; $i < count($sales_people); $i++){
                                $total_active_requests = SalesRequest::where('sales_people_id', '=', $sales_people[$i]->id)
                                                        ->where('status', '=', 'open')
                                                        ->where('active', '=', '1')
                                                        ->count('id');
                                $total_period_assigned_requests = SalesRequest::where('sales_people_id', '=', $sales_people[$i]->id)
                                                        ->where('assigned_date', '>=', $formData->date)
                                                        ->count('id');
                                $sales_people_arr[$sales_people[$i]->id] = $sales_people[$i]->name . ' (Open:'.$total_active_requests.', Assigned:'.$total_period_assigned_requests.')';
                            }
                            $field->options($sales_people_arr);
                        }
                    ),
        ];
    }
}
