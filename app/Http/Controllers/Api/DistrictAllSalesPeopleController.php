<?php
namespace App\Http\Controllers\Api;

use App\Models\District;
use App\Models\SalesPeople;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesPeopleCollection;

class DistrictAllSalesPeopleController extends Controller
{
    public function index(
        Request $request,
        District $district
    ): SalesPeopleCollection {
        $this->authorize('view', $district);

        $search = $request->get('search', '');

        $allSalesPeople = $district
            ->allSalesPeople()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesPeopleCollection($allSalesPeople);
    }

    public function store(
        Request $request,
        District $district,
        SalesPeople $salesPeople
    ): Response {
        $this->authorize('update', $district);

        $district->allSalesPeople()->syncWithoutDetaching([$salesPeople->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        District $district,
        SalesPeople $salesPeople
    ): Response {
        $this->authorize('update', $district);

        $district->allSalesPeople()->detach($salesPeople);

        return response()->noContent();
    }
}
