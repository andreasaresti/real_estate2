<?php
namespace App\Http\Controllers\Api;

use App\Models\District;
use App\Models\SalesPeople;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictCollection;

class SalesPeopleDistrictsController extends Controller
{
    public function index(
        Request $request,
        SalesPeople $salesPeople
    ): DistrictCollection {
        $this->authorize('view', $salesPeople);

        $search = $request->get('search', '');

        $districts = $salesPeople
            ->districts()
            ->search($search)
            ->latest()
            ->paginate();

        return new DistrictCollection($districts);
    }

    public function store(
        Request $request,
        SalesPeople $salesPeople,
        District $district
    ): Response {
        $this->authorize('update', $salesPeople);

        $salesPeople->districts()->syncWithoutDetaching([$district->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        SalesPeople $salesPeople,
        District $district
    ): Response {
        $this->authorize('update', $salesPeople);

        $salesPeople->districts()->detach($district);

        return response()->noContent();
    }
}
