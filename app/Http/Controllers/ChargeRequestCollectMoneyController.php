<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\SalesPeople;
use Illuminate\Http\Request;
use App\Models\SalesRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\ChargeRequestCollectMoney;
use App\Http\Requests\ChargeRequestCollectMoneyStoreRequest;
use App\Http\Requests\ChargeRequestCollectMoneyUpdateRequest;

class ChargeRequestCollectMoneyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ChargeRequestCollectMoney::class);

        $search = $request->get('search', '');

        $chargeRequestCollectMonies = ChargeRequestCollectMoney::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.charge_request_collect_monies.index',
            compact('chargeRequestCollectMonies', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ChargeRequestCollectMoney::class);

        $salesRequests = SalesRequest::pluck('name', 'id');
        $allSalesPeople = SalesPeople::pluck('name', 'id');

        return view(
            'app.charge_request_collect_monies.create',
            compact('salesRequests', 'allSalesPeople')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ChargeRequestCollectMoneyStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', ChargeRequestCollectMoney::class);

        $validated = $request->validated();

        $chargeRequestCollectMoney = ChargeRequestCollectMoney::create(
            $validated
        );

        return redirect()
            ->route(
                'charge-request-collect-monies.edit',
                $chargeRequestCollectMoney
            )
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        ChargeRequestCollectMoney $chargeRequestCollectMoney
    ): View {
        $this->authorize('view', $chargeRequestCollectMoney);

        return view(
            'app.charge_request_collect_monies.show',
            compact('chargeRequestCollectMoney')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        ChargeRequestCollectMoney $chargeRequestCollectMoney
    ): View {
        $this->authorize('update', $chargeRequestCollectMoney);

        $salesRequests = SalesRequest::pluck('name', 'id');
        $allSalesPeople = SalesPeople::pluck('name', 'id');

        return view(
            'app.charge_request_collect_monies.edit',
            compact(
                'chargeRequestCollectMoney',
                'salesRequests',
                'allSalesPeople'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ChargeRequestCollectMoneyUpdateRequest $request,
        ChargeRequestCollectMoney $chargeRequestCollectMoney
    ): RedirectResponse {
        $this->authorize('update', $chargeRequestCollectMoney);

        $validated = $request->validated();

        $chargeRequestCollectMoney->update($validated);

        return redirect()
            ->route(
                'charge-request-collect-monies.edit',
                $chargeRequestCollectMoney
            )
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ChargeRequestCollectMoney $chargeRequestCollectMoney
    ): RedirectResponse {
        $this->authorize('delete', $chargeRequestCollectMoney);

        $chargeRequestCollectMoney->delete();

        return redirect()
            ->route('charge-request-collect-monies.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
