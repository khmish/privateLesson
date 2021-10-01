<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeveleducationStoreRequest;
use App\Http\Requests\LeveleducationUpdateRequest;
use App\Http\Resources\LeveleducationCollection;
use App\Http\Resources\LeveleducationResource;
use App\Models\Leveleducation;
use Illuminate\Http\Request;

class LeveleducationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\LeveleducationCollection
     */
    public function index(Request $request)
    {
        $leveleducations = Leveleducation::all();

        return new LeveleducationCollection($leveleducations);
    }

    /**
     * @param \App\Http\Requests\LeveleducationStoreRequest $request
     * @return \App\Http\Resources\LeveleducationResource
     */
    public function store(LeveleducationStoreRequest $request)
    {
        $leveleducation = Leveleducation::create($request->validated());

        return new LeveleducationResource($leveleducation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Leveleducation $leveleducation
     * @return \App\Http\Resources\LeveleducationResource
     */
    public function show(Request $request, Leveleducation $leveleducation)
    {
        return new LeveleducationResource($leveleducation);
    }

    /**
     * @param \App\Http\Requests\LeveleducationUpdateRequest $request
     * @param \App\Models\Leveleducation $leveleducation
     * @return \App\Http\Resources\LeveleducationResource
     */
    public function update(LeveleducationUpdateRequest $request, Leveleducation $leveleducation)
    {
        $leveleducation->update($request->validated());

        return new LeveleducationResource($leveleducation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Leveleducation $leveleducation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Leveleducation $leveleducation)
    {
        $leveleducation->delete();

        return response()->noContent();
    }
}
