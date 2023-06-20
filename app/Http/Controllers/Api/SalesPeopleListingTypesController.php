<?php
namespace App\Http\Controllers\Api;

use App\Models\SalesPeople;
use App\Models\ListingType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingTypeCollection;

class SalesPeopleListingTypesController extends Controller
{
    public function index(
        Request $request,
        SalesPeople $salesPeople
    ): ListingTypeCollection {
        $this->authorize('view', $salesPeople);

        $search = $request->get('search', '');

        $listingTypes = $salesPeople
            ->listingTypes()
            ->search($search)
            ->latest()
            ->paginate();

        return new ListingTypeCollection($listingTypes);
    }

    public function store(
        Request $request,
        SalesPeople $salesPeople,
        ListingType $listingType
    ): Response {
        $this->authorize('update', $salesPeople);

        $salesPeople->listingTypes()->syncWithoutDetaching([$listingType->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        SalesPeople $salesPeople,
        ListingType $listingType
    ): Response {
        $this->authorize('update', $salesPeople);

        $salesPeople->listingTypes()->detach($listingType);

        return response()->noContent();
    }
}
