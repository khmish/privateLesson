<?php

namespace App\Http\Controllers;

use App\Http\Requests\LesssonStoreRequest;
use App\Http\Requests\LesssonUpdateRequest;
use App\Http\Resources\LesssonCollection;
use App\Http\Resources\LesssonResource;
use App\Models\Lessson;
use Illuminate\Http\Request;

class LesssonController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\LesssonCollection
     */
    public function index(Request $request)
    {
        $lesssons = Lessson::all();

        return new LesssonCollection($lesssons);
    }

    /**
     * @param \App\Http\Requests\LesssonStoreRequest $request
     * @return \App\Http\Resources\LesssonResource
     */
    public function store(LesssonStoreRequest $request)
    {
        $lessson = Lessson::create($request->validated());

        return new LesssonResource($lessson);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lessson $lessson
     * @return \App\Http\Resources\LesssonResource
     */
    public function show(Request $request, Lessson $lessson)
    {
        return new LesssonResource($lessson);
    }

    /**
     * @param \App\Http\Requests\LesssonUpdateRequest $request
     * @param \App\Models\Lessson $lessson
     * @return \App\Http\Resources\LesssonResource
     */
    public function update(LesssonUpdateRequest $request, Lessson $lessson)
    {
        $lessson->update($request->validated());

        return new LesssonResource($lessson);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lessson $lessson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Lessson $lessson)
    {
        $lessson->delete();

        return response()->noContent();
    }
}
