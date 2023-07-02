<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\ChargeRequestCollectMoney;
use App\Http\Resources\ChargeRequestCollectMoneyResource;
use App\Http\Resources\ChargeRequestCollectMoneyCollection;
use App\Http\Requests\ChargeRequestCollectMoneyStoreRequest;
use App\Http\Requests\ChargeRequestCollectMoneyUpdateRequest;

class ChargeRequestCollectMoneyController extends Controller
{
    public function index(Request $request): ChargeRequestCollectMoneyCollection
    {
        $this->authorize('view-any', ChargeRequestCollectMoney::class);

        $search = $request->get('search', '');

        $chargeRequestCollectMonies = ChargeRequestCollectMoney::search($search)
            ->latest()
            ->paginate();

        return new ChargeRequestCollectMoneyCollection(
            $chargeRequestCollectMonies
        );
    }

    public function store(
        ChargeRequestCollectMoneyStoreRequest $request
    ): ChargeRequestCollectMoneyResource {
        $this->authorize('create', ChargeRequestCollectMoney::class);

        $validated = $request->validated();

        $chargeRequestCollectMoney = ChargeRequestCollectMoney::create(
            $validated
        );

        return new ChargeRequestCollectMoneyResource(
            $chargeRequestCollectMoney
        );
    }

    public function show(
        Request $request,
        ChargeRequestCollectMoney $chargeRequestCollectMoney
    ): ChargeRequestCollectMoneyResource {
        $this->authorize('view', $chargeRequestCollectMoney);

        return new ChargeRequestCollectMoneyResource(
            $chargeRequestCollectMoney
        );
    }

    public function update(
        ChargeRequestCollectMoneyUpdateRequest $request,
        ChargeRequestCollectMoney $chargeRequestCollectMoney
    ): ChargeRequestCollectMoneyResource {
        $this->authorize('update', $chargeRequestCollectMoney);

        $validated = $request->validated();

        $chargeRequestCollectMoney->update($validated);

        return new ChargeRequestCollectMoneyResource(
            $chargeRequestCollectMoney
        );
    }

    public function destroy(
        Request $request,
        ChargeRequestCollectMoney $chargeRequestCollectMoney
    ): Response {
        $this->authorize('delete', $chargeRequestCollectMoney);

        $chargeRequestCollectMoney->delete();

        return response()->noContent();
    }
}
