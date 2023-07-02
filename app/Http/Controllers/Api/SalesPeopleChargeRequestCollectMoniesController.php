<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesPeople;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChargeRequestCollectMoneyResource;
use App\Http\Resources\ChargeRequestCollectMoneyCollection;

class SalesPeopleChargeRequestCollectMoniesController extends Controller
{
    public function index(
        Request $request,
        SalesPeople $salesPeople
    ): ChargeRequestCollectMoneyCollection {
        $this->authorize('view', $salesPeople);

        $search = $request->get('search', '');

        $chargeRequestCollectMonies = $salesPeople
            ->chargeRequestCollectMonies()
            ->search($search)
            ->latest()
            ->paginate();

        return new ChargeRequestCollectMoneyCollection(
            $chargeRequestCollectMonies
        );
    }

    public function store(
        Request $request,
        SalesPeople $salesPeople
    ): ChargeRequestCollectMoneyResource {
        $this->authorize('create', ChargeRequestCollectMoney::class);

        $validated = $request->validate([
            'sales_request_id' => ['required', 'exists:sales_requests,id'],
            'amount' => ['required', 'numeric'],
            'commission_amount' => ['required', 'numeric'],
        ]);

        $chargeRequestCollectMoney = $salesPeople
            ->chargeRequestCollectMonies()
            ->create($validated);

        return new ChargeRequestCollectMoneyResource(
            $chargeRequestCollectMoney
        );
    }
}
