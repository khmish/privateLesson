<?php

namespace App\Http\Controllers;

use App\Http\Requests\TutorStoreRequest;
use App\Http\Requests\TutorUpdateRequest;
use App\Http\Resources\TutorCollection;
use App\Http\Resources\TutorResource;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;

class TutorController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\TutorCollection
     */
    public function index(Request $request)
    {
        $tutors = Tutor::all();

        return new TutorCollection($tutors);
    }

    /**
     * @param \App\Http\Requests\TutorStoreRequest $request
     * @return \App\Http\Resources\TutorResource
     */
    public function store(TutorStoreRequest $request)
    {
        $tutor = Tutor::create($request->validated());

        return new TutorResource($tutor);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tutor $tutor
     * @return \App\Http\Resources\TutorResource
     */
    public function show(Request $request, Tutor $tutor)
    {
        return new TutorResource($tutor);
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tutor $tutor
     * @return \App\Http\Resources\TutorResource
     */
    public function getTutorByUser(Request $request, User $user)
    {
        $tutor=Tutor::where("user_id",$user->id)->first();
        return new TutorResource($tutor);
    }

    /**
     * @param \App\Http\Requests\TutorUpdateRequest $request
     * @param \App\Models\Tutor $tutor
     * @return \App\Http\Resources\TutorResource
     */
    public function update(TutorUpdateRequest $request, Tutor $tutor)
    {
        $tutor->update($request->validated());

        return new TutorResource($tutor);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tutor $tutor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Tutor $tutor)
    {
        $tutor->delete();

        return response()->noContent();
    }
}
