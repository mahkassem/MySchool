<?php

namespace App\Http\Controllers;

use App\Http\Requests\Building\CreateBuildingRequest;
use App\Http\Requests\Building\UpdateBuildingRequest;
use App\Http\Resources\BuildingResource;
use App\Models\Building;

class BuildingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'admin'])->except(['index']);
    }

    public function index()
    {
        $buildings = Building::all();

        return BuildingResource::collection($buildings);
    }

    public function create(CreateBuildingRequest $request)
    {
        $building = $request->createBuilding();

        return new BuildingResource($building);
    }

    public function update(UpdateBuildingRequest $request)
    {
        $building = $request->updateBuilding();

        return new BuildingResource($building);
    }

    public function delete($id)
    {
        $building = Building::findOrFail($id);
        $building->delete();

        return response()->json([
            'message' => 'Building deleted successfully',
        ]);
    }
}
