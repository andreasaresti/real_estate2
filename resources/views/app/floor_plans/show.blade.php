<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.floor_plans.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('floor-plans.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.floor_plans.inputs.listing_id')
                        </h5>
                        <span
                            >{{ optional($floorPlan->listing)->name ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.floor_plans.inputs.name')
                        </h5>
                        <pre>{{ json_encode($floorPlan->name) ?? '-' }}</pre>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.floor_plans.inputs.image')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $floorPlan->image ? \Storage::url($floorPlan->image) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.floor_plans.inputs.description')
                        </h5>
                        <pre>
{{ json_encode($floorPlan->description) ?? '-' }}</pre
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('floor-plans.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\FloorPlan::class)
                    <a href="{{ route('floor-plans.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
