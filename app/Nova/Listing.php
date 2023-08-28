<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Support\Facades\DB;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Traits\HasTabs;
use Eminiarts\Tabs\Traits\HasActionsInTabs; // Add this Trait
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use ZiffMedia\NovaSelectPlus\SelectPlus;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Select;
use Trinityrank\GoogleMapWithAutocomplete\TRLocation;
use NormanHuth\IframePopup\IframePopup;

class Listing extends Resource
{
	use HasTabs;
    use HasActionsInTabs;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Listing::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
	 *
     */
    public static $search = ['name', 'id','ext_code'];
	public static $searchRelations = [
		'Location' => ['name'],
		'Customer' => ['name'],
	];
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [

			IframePopup::make(__('Position'), 'position', function () {
					return '/positionModal?flag=listings&index='.$this->resource->id;
				})->hideWhenCreating()->hideWhenUpdating(),

			 Tabs::make('Listing', [
                 Tab::make('Basic Information',[

					ID::make('id')->sortable(),

					BelongsTo::make('Customer', 'customer')
						->required()
						->searchable()
						->sortable()
						->showCreateRelationButton(),					

					Text::make('Ext Code')
						->creationRules(
							'nullable',
							'unique:property_types,ext_code',
							'max:255',
							'string'
						)
						->updateRules(
							'nullable',
							'unique:property_types,ext_code,{{resourceId}}',
							'max:255',
							'string'
						)
						->placeholder('Ext Code')
						->hideFromIndex(),

					Text::make('Name')
						->translatable(DB::table('languages')->select('encoding','name')->orderBy('sequence')->pluck('name', 'encoding')->toArray())
						->rules('nullable')
						->placeholder('Name'),


					Image::make('Image')
						->rules('nullable', 'image', 'max:1024')
						->placeholder('Image')
						->sortable(),

					Trix::make('Description')
						->translatable(DB::table('languages')->select('encoding','name')->orderBy('sequence')->pluck('name', 'encoding')->toArray())
						->rules('nullable')
						->placeholder('Description')
						->hideFromIndex(),

					Number::make('Price')
						->rules('required', 'numeric')
						->placeholder('Price')
						->hideFromIndex(),

					Number::make('Old Price')
						->rules('nullable', 'numeric')
						->placeholder('Old Price')
						->hideFromIndex(),

					Text::make('Price Prefix')
						->rules('nullable', 'max:255', 'string')
						->placeholder('Price Prefix')
						->hideFromIndex(),

					Text::make('Price Postfix')
						->rules('nullable', 'max:255', 'string')
						->placeholder('Price Postfix')
						->hideFromIndex(),

					Number::make('Area Size')
						->rules('nullable', 'numeric')
						->placeholder('Area Size')
						->hideFromIndex(),

					Text::make('Area Size Prefix')
						->rules('nullable', 'max:255', 'string')
						->placeholder('Area Size Prefix')
						->hideFromIndex(),

					Text::make('Area Size Postfix')
						->rules('nullable', 'max:255', 'string')
						->placeholder('Area Size Postfix')
						->hideFromIndex(),

					Number::make('Number Of Bedrooms')
						->rules('nullable', 'numeric')
						->placeholder('Number Of Bedrooms')
						->hideFromIndex(),

					Number::make('Number Of Bathrooms')
						->rules('nullable', 'numeric')
						->placeholder('Number Of Bathrooms')
						->hideFromIndex(),

					Number::make('Number Of Garages Or Parkingpaces')
						->rules('nullable', 'numeric')
						->placeholder('Number Of Garages Or Parkingpaces')
						->hideFromIndex(),

					Number::make('Year Built')
						->rules('nullable', 'numeric')
						->placeholder('Year Built')
						->hideFromIndex(),

					BelongsTo::make('Listing', 'listing')
						->nullable()
						->hideFromIndex()
						->searchable(),

					BelongsTo::make('Location', 'location')
						->nullable()
						->showCreateRelationButton()
						->sortable()
						->searchable(),

					BelongsTo::make('PropertyType', 'propertyType')
						->nullable()
						->showCreateRelationButton()
						->sortable(),

					// SelectPlus::make('ListingTypeRelation', 'listingTypeRelation', ListingTypeRelation::class),

					BelongsTo::make('Status', 'status')
						->nullable()
						->showCreateRelationButton()
						->hideFromIndex(),

					BelongsTo::make('DeliveryTime', 'deliveryTime')
						->nullable()
						->showCreateRelationButton()
						->hideFromIndex(),
					// BelongsTo::make('ListingType', 'listingType')->showCreateRelationButton(),

					BelongsTo::make('InternalStatus', 'internalStatus')
						->nullable()
						->showCreateRelationButton()
						->hideFromIndex(),

					
						
					SelectPlus::make('Features', 'Featured', Feature::class)->hideFromIndex(),
					SelectPlus::make('ListingType', 'ListingType', ListingType::class)->hideFromIndex(),

					
					
					Boolean::make('Include all Feeds')
						->rules('nullable', 'boolean')
						->placeholder('Include all Feeds')
						->default(true)
						->hideFromIndex(),

					SelectPlus::make('Feed', 'Feed', Feed::class)
						->nullable()
						// ->dependsOn(
						// 		['include_all_feeds'],
						// 		function (SelectPlus $field, NovaRequest $request, FormData $formData) {
						// 			$field->readonly(true)->rules(['nullable'])->hide();
						// 			if ($formData->include_all_feeds === false) {
						// 				$field->readonly(false)->rules(['required'])->show();
						// 			}
						// 		}
						// 	)
						// ->hide()
						->hideFromIndex(),

					Boolean::make('Popular')
						->rules('nullable', 'boolean')
						->placeholder('Popular')
						->sortable(),	

					Boolean::make('Featured')
						->rules('nullable', 'boolean')
						->placeholder('Featured')
						->sortable(),	

					Boolean::make('Published')
						->rules('nullable', 'boolean')
						->placeholder('Published')
						->sortable(),	
				 ]),
				 
				 Tab::make('Location',[

			// 		GoogleMaps::make('Address')
            // ->zoom(8) // Optionally set the zoom level
            // ->defaultCoordinates('35.1681365','32.7658189'),

			// TRLocation::make('Location')->rules('nullable'),

					Text::make('Address')
						->rules('nullable', 'max:255', 'string')
						->placeholder('Address')
						->hideFromIndex(),

					Text::make('Latitude')
						->rules('nullable', 'max:255', 'string')
						->placeholder('Latitude')
						->hideFromIndex(),

					Text::make('Longitude')
						->rules('nullable', 'max:255', 'string')
						->placeholder('Longitude')
						->hideFromIndex(),
				]),
				Tab::make('Images',[
					Images::make('Images', 'images') // second parameter is the media collection name
					->conversionOnPreview('medium-size') // conversion used to display the "original" image
					->conversionOnDetailView('thumb') // conversion used on the model's view
					->conversionOnIndexView('thumb') // conversion used to display the image on the model's index page
					->conversionOnForm('thumb') // conversion used to display the image on the model's form
					->fullSize() // full size column
					// ->rules('required', 'size:3') // validation rules for the collection of images
					// validation rules for the collection of images
					->singleImageRules('dimensions:min_width=100')
					->hideFromIndex(),
			  
				]),
				Tab::make('Property Video',[
					Textarea::make('360 Virtual Tour')
						->rules('nullable', 'max:255', 'string')
						->placeholder('360 Virtual Tour')
						->hideFromIndex(),
				]),
				Tab::make('Energy Performance',[
					Text::make('Energy Class')
						->rules('nullable', 'max:255', 'string')
						->placeholder('Energy Class')
						->hideFromIndex(),

					Text::make('Energy Performance')
						->rules('nullable', 'max:255', 'string')
						->placeholder('Energy Performance')
						->hideFromIndex(),

					Text::make('Epc Current Rating')
						->rules('nullable', 'max:255', 'string')
						->placeholder('Epc Current Rating')
						->hideFromIndex(),

					Text::make('Epc Potential Rating')
						->rules('nullable', 'max:255', 'string')
						->placeholder('Epc Potential Rating')
						->hideFromIndex(),					
				]),
				Tab::make('Additional Fields',[
                    Text::make('Taxes')
						->rules('nullable', 'max:255', 'string')
						->placeholder('Taxes')
						->hideFromIndex(),

					Text::make('Dues')
						->rules('nullable', 'max:255', 'string')
						->placeholder('Dues')
						->hideFromIndex(),

					Trix::make('Notes')
						->rules('nullable', 'max:255', 'string')
						->placeholder('Notes')
						->hideFromIndex(),
				]),
			]),
			HasMany::make('Listing Attachment', 'listingAttachment'),
			HasMany::make('Included Listing Feed', 'IncludedListingFeed'),
			HasMany::make('Floor Plan', 'floorPlan'),

			HasMany::make(
				'ListingAdditionalDetail',
				'listingAdditionalDetail'
			),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
			new Filters\Type(),
			new Filters\Listing_types(),
			new Filters\Price(),
			new Filters\Number_of_Bedrooms(),
			new Filters\Number_of_Bathrooms(),
			new Filters\Owner(),
			new Filters\Status(),
		];

    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [ Actions\DuplicateListing::make()->showInline() ];
    }
}