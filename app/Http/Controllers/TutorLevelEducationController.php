<?php

namespace App\Http\Controllers;

use App\Http\Requests\TutorLevelEducationStoreRequest;
use App\Http\Requests\TutorLevelEducationUpdateRequest;
use App\Http\Resources\TutorLevelEducationCollection;
use App\Http\Resources\TutorLevelEducationResource;
use App\Models\TutorLevelEducation;
use Illuminate\Http\Request;

class TutorLevelEducationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\TutorLevelEducationCollection
     */
    public function index(Request $request)
    {
        $tutorLevelEducations = TutorLevelEducation::all();

        return new TutorLevelEducationCollection($tutorLevelEducations);
    }

    /**
     * @param \App\Http\Requests\TutorLevelEducationStoreRequest $request
     * @return \App\Http\Resources\TutorLevelEducationResource
     */
    public function store(TutorLevelEducationStoreRequest $request)
    {
        $tutorLevelEducation = TutorLevelEducation::create($request->validated());

        return new TutorLevelEducationResource($tutorLevelEducation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TutorLevelEducation $tutorLevelEducation
     * @return \App\Http\Resources\TutorLevelEducationResource
     */
    public function show(Request $request, TutorLevelEducation $tutorLevelEducation)
    {
        return new TutorLevelEducationResource($tutorLevelEducation);
    }

    /**
     * @param \App\Http\Requests\TutorLevelEducationUpdateRequest $request
     * @param \App\Models\TutorLevelEducation $tutorLevelEducation
     * @return \App\Http\Resources\TutorLevelEducationResource
     */
    public function update(TutorLevelEducationUpdateRequest $request, TutorLevelEducation $tutorLevelEducation)
    {
        $tutorLevelEducation->update($request->validated());

        return new TutorLevelEducationResource($tutorLevelEducation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TutorLevelEducation $tutorLevelEducation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TutorLevelEducation $tutorLevelEducation)
    {
        $tutorLevelEducation->delete();

        return response()->noContent();
    }
}
