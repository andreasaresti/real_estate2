<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChargeRequestCollectMoneyResource;
use App\Http\Resources\ChargeRequestCollectMoneyCollection;

class SalesRequestChargeRequestCollectMoniesController extends Controller
{
    public function index(
        Request $request,
        SalesRequest $salesRequest
    ): ChargeRequestCollectMoneyCollection {
        $this->authorize('view', $salesRequest);

        $search = $request->get('search', '');

        $chargeRequestCollectMonies = $salesRequest
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
        SalesRequest $salesRequest
    ): ChargeRequestCollectMoneyResource {
        $this->authorize('create', ChargeRequestCollectMoney::class);

        $validated = $request->validate([
            'sales_people_id' => ['nullable', 'exists:sales_people,id'],
            'amount' => ['required', 'numeric'],
            'commission_amount' => ['required', 'numeric'],
        ]);

        $chargeRequestCollectMoney = $salesRequest
            ->chargeRequestCollectMonies()
            ->create($validated);

        return new ChargeRequestCollectMoneyResource(
            $chargeRequestCollectMoney
        );
    }
}
