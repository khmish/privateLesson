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

        if (!is_null($request->student_id) && !empty($request->student_id)) {

            $studentId = $request->student_id;
            $lesssons = Lessson::whereHas('student', function ($query) use ($studentId) {

                $query->where('id', '=', $studentId);
            });
        }
        if (!is_null($request->teacher_id) && !empty($request->teacher_id)) {

            $teacherId = $request->teacher_id;
            $lesssons = Lessson::whereHas('teacher', function ($query) use ($teacherId) {

                $query->where('id', '=', $teacherId);
            });
        }
        if ((is_null($request->student_id) && empty($request->student_id)) && (is_null($request->teacher_id) && empty($request->teacher_id))) {

            $lesssons = Lessson::all();
        } else {

            $lesssons = $lesssons->get();
        }
        return new LesssonCollection($lesssons);
    }

    /**
     * @param \App\Http\Requests\LesssonStoreRequest $request
     * @return \App\Http\Resources\LesssonResource
     */
    public function store(LesssonStoreRequest $request)
    {
        $hasLesson = Lessson::where('student_id', $request->student_id)->where('teacher_id', $request->teacher_id)->where('subject_id', $request->subject_id)->get();

        if (count($hasLesson) > 0) {
            return response("you already register", 400);
        }
        $lessson = Lessson::create([
            'student_id' => $request->student_id,
            'teacher_id' => $request->teacher_id,
            'subject_id' => $request->subject_id,
            'date_execution' => $request->date_execution,
            'state' => $request->state,
        ]);

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
