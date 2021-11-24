<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\TutorUserCollection;
use App\Http\Resources\UserResource;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function me(Request $request)
    {
        return $request->user();
    }
    public function login(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->firstOrFail();

        if (!$user || !Hash::check($request->password, $user->password)) {

            return response(['data' => "invlid password or username"], 400);
        } else {
            $token = $user->createToken("token")->plainTextToken;
            return response(['data' => $token, 'user'=>$user], 200);
        }
    }
    public function search(Request $request)
    {
        $users = User::has("tutor");
        if (!is_null($request->gender) && !empty($request->gender)) {
            // log("gender: $request->gender");
            $users->where("gender", $request->gender);
        }
        if (!is_null($request->city_id) && !empty($request->city_id)) {
            // log("city_id: $request->city_id");
            $users->where("city_id", $request->city_id);
        }
        if (!is_null($request->leveleducation_id) && !empty($request->leveleducation_id)) {
            // log("leveleducation_id: $request->leveleducation_id");

            $edu_id = $request->leveleducation_id;
            $users->whereHas('tutor', function ($query) use ($edu_id) {
                $query->whereHas(
                    'tutorLevelEducations',
                    function ($query) use ($edu_id) {
                        $query->where('leveleducation_id', $edu_id);
                    }
                );
            });
        }
        if (!is_null($request->subject_id) && !empty($request->subject_id)) {
            $sub_id = $request->subject_id;
            $users->whereHas('tutor', function ($query) use ($sub_id) {
                $query->whereHas(
                    'tutorSubs',
                    function ($query) use ($sub_id) {
                        $query->where('subject_id', $sub_id);
                    }
                );
            });
        }
        $users = $users->get();

        return TutorUserCollection::collection($users);
    }
    public function avarageUser(Request $request)
    {
        $reviews =  User::where("id",'=', 2)
            ->first();
            
            $reviews->rating=$reviews->reviews->avg('stars');
            
        // ddd($reviews);
        return $reviews;
    }
    public function index(Request $request)
    {
        $users = User::all();
        return new UserCollection($users);
    }

    /**
     * @param \App\Http\Requests\UserStoreRequest $request
     * @return \App\Http\Resources\UserResource
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->city_id = $request->city_id;
        $user->role = $request->role;
        if ($user->save()) {
            return $user;
        }
        return response(400, "error");
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \App\Http\Resources\UserResource
     */
    public function show(Request $request, User $user)
    {
        return new UserResource($user);
    }

    /**
     * @param \App\Http\Requests\UserUpdateRequest $request
     * @param \App\Models\User $user
     * @return \App\Http\Resources\UserResource
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();

        return response()->noContent();
    }
}
