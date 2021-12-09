<?php

namespace App\Http\Controllers;

use App\Http\Requests\TutorSubStoreRequest;
use App\Http\Requests\TutorSubUpdateRequest;
use App\Http\Resources\TutorSubCollection;
use App\Http\Resources\TutorSubResource;
use App\Models\TutorSub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        TutorSub::where('tutor_id', $request->tutor_id)->where('subject_id', $request->subject_id)->restore();
        $resultTutSubs = TutorSub::where('tutor_id', $request->tutor_id)->where('subject_id', $request->subject_id)->first();
        if (count($resultTutSubs)==0) {
            $tutorSub = TutorSub::create($request->validated());

            return new TutorSubResource($tutorSub);
        }
        return response(["message" => "error"], 400);
    }
    public function storeArray(Request $request)
    {
        // $values = $request->tutorSubList;
        $collectValues = collect($request->tutorSubList);
        $tuts = $collectValues->pluck('tutor_id');
        $subs = $collectValues->pluck('subject_id');
        TutorSub::where('tutor_id',$tuts[0])->whereNotIn('subject_id',$subs)->delete();
        for ($i = 0; $i < count($subs); $i++) {
            TutorSub::withTrashed()->where('tutor_id', $tuts[$i])->where('subject_id', $subs[$i])->restore();
            $resultTutSubs = TutorSub::where('tutor_id', $tuts[$i])->where('subject_id', $subs[$i])->first();
            if ($resultTutSubs) {

                $collectValues = $collectValues->reject(function ($data) use ($tuts, $subs, $i) {
                    return $data['tutor_id'] == $tuts[$i] &&  $data['subject_id'] == $subs[$i];
                });
            }
        }
        
        if (count($collectValues) > 0 && DB::table('tutor_subs')->insert($collectValues->toArray())) {
            return response(["message" => "saved"], 201);
        }


        return response(["message" => "error"], 400);
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
