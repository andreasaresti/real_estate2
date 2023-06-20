<?php

namespace App\Nova;

use Ctessier\NovaAdvancedImageField\AdvancedImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Http\Requests\NovaRequest;

class Banner extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Banner>
     */
    public static $model = \App\Models\Banner::class;

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
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->rules('required', 'max:255', 'string')
                ->placeholder('Name'),

            AdvancedImage::make('Image')
                ->croppable()
                ->resize(1920)
                ->driver('imagick')
                ->croppable(),

            Text::make('Title')
                ->translatable(DB::table('languages')->select('encoding','name')->orderBy('sequence')->pluck('name', 'encoding')->toArray())
                ->rules('nullable')
                ->placeholder('Title'),

            Trix::make('Description')
                ->translatable(DB::table('languages')->select('encoding','name')->orderBy('sequence')->pluck('name', 'encoding')->toArray())
                ->rules('nullable')
                ->placeholder('Description'),

            Boolean::make('Active')->default(true),

            HasMany::make('BannerImage', 'bannerImages'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
