<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.sales_requests.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\SalesRequest::class)
                            <a
                                href="{{ route('sales-requests.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sales_requests.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sales_requests.inputs.date')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sales_requests.inputs.customer_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sales_requests.inputs.source_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sales_requests.inputs.sales_people_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sales_requests.inputs.property_type_id')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.sales_requests.inputs.minimum_budget')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.sales_requests.inputs.maximum_budget')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sales_requests.inputs.description')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sales_requests.inputs.active')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($salesRequests as $salesRequest)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $salesRequest->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $salesRequest->date ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($salesRequest->customer)->name
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($salesRequest->source)->name ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{
                                    optional($salesRequest->salesPeople)->name
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{
                                    optional($salesRequest->propertyType)->name
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $salesRequest->minimum_budget ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $salesRequest->maximum_budget ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $salesRequest->description ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $salesRequest->active ?? '-' }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $salesRequest)
                                        <a
                                            href="{{ route('sales-requests.edit', $salesRequest) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $salesRequest)
                                        <a
                                            href="{{ route('sales-requests.show', $salesRequest) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $salesRequest)
                                        <form
                                            action="{{ route('sales-requests.destroy', $salesRequest) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="11">
                                    <div class="mt-10 px-4">
                                        {!! $salesRequests->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
