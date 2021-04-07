<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rubric;
use App\Models\User;
use Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
    /**
     * All users by id rubric (subscription)
     * @param offset numeric
     * @param limit numeric
     * @param rubric numeric id of rubric
     * @return \Illuminate\Http\Response
     */
    public function usersBySubscriptions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'numeric',
            'offset' => 'numeric',
            'rubric' => 'numeric|required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'wrong params',
            ]);
        }

        $rubric = Rubric::find($request->rubric);
        Log::debug($rubric);
        $users = $rubric->users()
                        ->offset($request->offset)
                        ->limit($request->limit)
                        ->get();

        return response()->json([
            'status' => 'success',
            'users' => $users
        ]);
    }

    /**
     * All subscriptions by user
     * @param offset numeric
     * @param limit numeric
     * @return \Illuminate\Http\Response
     */
    public function subscriptionsByUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'numeric',
            'offset' => 'numeric',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'wrong params',
            ]);
        }

        $user = Auth::user();
        $rubrics = $user->rubrics()
                        ->offset($request->offset)
                        ->limit($request->limit)
                        ->get();

        return response()->json([
            'status' => 'success',
            'rubrics' => $rubrics
        ]);
    }

    /**
     * Subscribe user to array of rubrics
     * @param rubric json array or number
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        $user = Auth::user();

        //get array json or one id rubrics
        $rubrics_input = (array) json_decode($request->rubric);
        if($rubrics_input == []) {
            $rubrics_input = $request->rubric;
        }

        $rubrics = Rubric::whereIn('id', $rubrics_input)->get();

        if($rubrics){
            $user->rubrics()->attach($rubrics);
            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
            ]);
        }
    }

    /**
     * Unsubscribe user from rubric
     * @param rubric json array or number
     * @return \Illuminate\Http\Response
     */
    public function unsubscribeOne(Request $request)
    {
        $user = Auth::user();

        //get array json or one id rubrics
        $rubrics_input = (array) json_decode($request->rubric);
        if($rubrics_input == []) {
            $rubrics_input = $request->rubric;
        }
        $rubrics = Rubric::whereIn('id', $rubrics_input)->get();

        if($rubrics){
            $user->rubrics()->detach($rubrics);
            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
            ]);
        }
    }

    /**
     * Unsubscribe user from all rubrics
     *
     * @return \Illuminate\Http\Response
     */
    public function unsubscribeAll(Request $request)
    {
        $user = Auth::user();
        $rubrics = Rubric::all();

        if($rubrics){
            $user->rubrics()->detach($rubrics);
            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
            ]);
        }
    }
}
