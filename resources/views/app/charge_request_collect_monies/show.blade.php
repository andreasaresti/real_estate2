<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.charge_request_collect_monies.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a
                        href="{{ route('charge-request-collect-monies.index') }}"
                        class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.charge_request_collect_monies.inputs.sales_request_id')
                        </h5>
                        <span
                            >{{
                            optional($chargeRequestCollectMoney->salesRequest)->name
                            ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.charge_request_collect_monies.inputs.sales_people_id')
                        </h5>
                        <span
                            >{{
                            optional($chargeRequestCollectMoney->salesPeople)->name
                            ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.charge_request_collect_monies.inputs.amount')
                        </h5>
                        <span
                            >{{ $chargeRequestCollectMoney->amount ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.charge_request_collect_monies.inputs.commission_amount')
                        </h5>
                        <span
                            >{{ $chargeRequestCollectMoney->commission_amount ??
                            '-' }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a
                        href="{{ route('charge-request-collect-monies.index') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\ChargeRequestCollectMoney::class)
                    <a
                        href="{{ route('charge-request-collect-monies.create') }}"
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
