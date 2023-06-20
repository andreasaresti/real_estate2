<?php
namespace App\Http\Controllers\Api;

use App\Models\ListingType;
use App\Models\SalesPeople;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesPeopleCollection;

class ListingTypeAllSalesPeopleController extends Controller
{
    public function index(
        Request $request,
        ListingType $listingType
    ): SalesPeopleCollection {
        $this->authorize('view', $listingType);

        $search = $request->get('search', '');

        $allSalesPeople = $listingType
            ->allSalesPeople()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesPeopleCollection($allSalesPeople);
    }

    public function store(
        Request $request,
        ListingType $listingType,
        SalesPeople $salesPeople
    ): Response {
        $this->authorize('update', $listingType);

        $listingType
            ->allSalesPeople()
            ->syncWithoutDetaching([$salesPeople->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        ListingType $listingType,
        SalesPeople $salesPeople
    ): Response {
        $this->authorize('update', $listingType);

        $listingType->allSalesPeople()->detach($salesPeople);

        return response()->noContent();
    }
}
