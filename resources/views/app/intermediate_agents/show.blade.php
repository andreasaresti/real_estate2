<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.intermediate_agents.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a
                        href="{{ route('intermediate-agents.index') }}"
                        class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.intermediate_agents.inputs.name')
                        </h5>
                        <span>{{ $intermediateAgent->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.intermediate_agents.inputs.address')
                        </h5>
                        <span>{{ $intermediateAgent->address ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.intermediate_agents.inputs.city')
                        </h5>
                        <span>{{ $intermediateAgent->city ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.intermediate_agents.inputs.country')
                        </h5>
                        <span>{{ $intermediateAgent->country ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.intermediate_agents.inputs.telephone')
                        </h5>
                        <span>{{ $intermediateAgent->telephone ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.intermediate_agents.inputs.email')
                        </h5>
                        <span>{{ $intermediateAgent->email ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.intermediate_agents.inputs.website')
                        </h5>
                        <span>{{ $intermediateAgent->website ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a
                        href="{{ route('intermediate-agents.index') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\IntermediateAgent::class)
                    <a
                        href="{{ route('intermediate-agents.create') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
