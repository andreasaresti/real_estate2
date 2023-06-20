<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.listings.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('listings.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.name')
                        </h5>
                        <pre>{{ json_encode($listing->name) ?? '-' }}</pre>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.image')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $listing->image ? \Storage::url($listing->image) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.parent_id')
                        </h5>
                        <span
                            >{{ optional($listing->listing)->name ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.description')
                        </h5>
                        <pre>
{{ json_encode($listing->description) ?? '-' }}</pre
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.price')
                        </h5>
                        <span>{{ $listing->price ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.old_price')
                        </h5>
                        <span>{{ $listing->old_price ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.price_prefix')
                        </h5>
                        <span>{{ $listing->price_prefix ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.price_postfix')
                        </h5>
                        <span>{{ $listing->price_postfix ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.area_size')
                        </h5>
                        <span>{{ $listing->area_size ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.area_size_prefix')
                        </h5>
                        <span>{{ $listing->area_size_prefix ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.area_size_postfix')
                        </h5>
                        <span>{{ $listing->area_size_postfix ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.number_of_bedrooms')
                        </h5>
                        <span>{{ $listing->number_of_bedrooms ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.number_of_bathrooms')
                        </h5>
                        <span>{{ $listing->number_of_bathrooms ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.number_of_garages_or_parkingpaces')
                        </h5>
                        <span
                            >{{ $listing->number_of_garages_or_parkingpaces ??
                            '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.year_built')
                        </h5>
                        <span>{{ $listing->year_built ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.featured')
                        </h5>
                        <span>{{ $listing->featured ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.published')
                        </h5>
                        <span>{{ $listing->published ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.address')
                        </h5>
                        <span>{{ $listing->address ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.latitude')
                        </h5>
                        <span>{{ $listing->latitude ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.longitude')
                        </h5>
                        <span>{{ $listing->longitude ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.360_virtual_tour')
                        </h5>
                        <span>{{ $listing->360_virtual_tour ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.energy_class')
                        </h5>
                        <span>{{ $listing->energy_class ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.energy_performance')
                        </h5>
                        <span>{{ $listing->energy_performance ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.epc_current_rating')
                        </h5>
                        <span>{{ $listing->epc_current_rating ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.epc_potential_rating')
                        </h5>
                        <span>{{ $listing->epc_potential_rating ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.taxes')
                        </h5>
                        <span>{{ $listing->taxes ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.dues')
                        </h5>
                        <span>{{ $listing->dues ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.notes')
                        </h5>
                        <span>{{ $listing->notes ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.location_id')
                        </h5>
                        <span
                            >{{ optional($listing->location)->name ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.status_id')
                        </h5>
                        <span
                            >{{ optional($listing->status)->name ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.delivery_time_id')
                        </h5>
                        <span
                            >{{ optional($listing->deliveryTime)->name ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.internal_status_id')
                        </h5>
                        <span
                            >{{ optional($listing->internalStatus)->name ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.listings.inputs.owner_id')
                        </h5>
                        <span
                            >{{ optional($listing->customer)->name ?? '-'
                            }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('listings.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Listing::class)
                    <a href="{{ route('listings.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
