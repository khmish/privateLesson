<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectStoreRequest;
use App\Http\Requests\SubjectUpdateRequest;
use App\Http\Resources\SubjectCollection;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\SubjectCollection
     */
    public function index(Request $request)
    {
        $subjects = Subject::all();

        return new SubjectCollection($subjects);
    }

    /**
     * @param \App\Http\Requests\SubjectStoreRequest $request
     * @return \App\Http\Resources\SubjectResource
     */
    public function store(SubjectStoreRequest $request)
    {
        $subject = Subject::create($request->validated());

        return new SubjectResource($subject);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Subject $subject
     * @return \App\Http\Resources\SubjectResource
     */
    public function show(Request $request, Subject $subject)
    {
        return new SubjectResource($subject);
    }

    /**
     * @param \App\Http\Requests\SubjectUpdateRequest $request
     * @param \App\Models\Subject $subject
     * @return \App\Http\Resources\SubjectResource
     */
    public function update(SubjectUpdateRequest $request, Subject $subject)
    {
        $subject->update($request->validated());

        return new SubjectResource($subject);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Subject $subject)
    {
        $subject->delete();

        return response()->noContent();
    }
}
