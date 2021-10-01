<?php

namespace App\Http\Controllers;

use App\Http\Requests\TutorSubStoreRequest;
use App\Http\Requests\TutorSubUpdateRequest;
use App\Http\Resources\TutorSubCollection;
use App\Http\Resources\TutorSubResource;
use App\Models\TutorSub;
use Illuminate\Http\Request;

class TutorSubController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\TutorSubCollection
     */
    public function index(Request $request)
    {
        $tutorSubs = TutorSub::all();

        return new TutorSubCollection($tutorSubs);
    }

    /**
     * @param \App\Http\Requests\TutorSubStoreRequest $request
     * @return \App\Http\Resources\TutorSubResource
     */
    public function store(TutorSubStoreRequest $request)
    {
        $tutorSub = TutorSub::create($request->validated());

        return new TutorSubResource($tutorSub);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TutorSub $tutorSub
     * @return \App\Http\Resources\TutorSubResource
     */
    public function show(Request $request, TutorSub $tutorSub)
    {
        return new TutorSubResource($tutorSub);
    }

    /**
     * @param \App\Http\Requests\TutorSubUpdateRequest $request
     * @param \App\Models\TutorSub $tutorSub
     * @return \App\Http\Resources\TutorSubResource
     */
    public function update(TutorSubUpdateRequest $request, TutorSub $tutorSub)
    {
        $tutorSub->update($request->validated());

        return new TutorSubResource($tutorSub);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TutorSub $tutorSub
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TutorSub $tutorSub)
    {
        $tutorSub->delete();

        return response()->noContent();
    }
}
