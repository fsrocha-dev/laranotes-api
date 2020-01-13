<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Api\ApiMessages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->user->paginate(10);

        return response()->json($user, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        try {

            $user = $this->user->create($data);

            return response()->json([
                'data' => [
                    'msg' => 'success_create_user'
                ]
            ], 200);

        }catch(\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = $this->user->findOrFail($id);

            return response()->json([
                'data' => $user
            ], 200);

        }catch(\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        try {

            $user = $this->user->findOrFail($id);
            $user->update($data);

            return response()->json([
                'data' => [
                    'msg' => 'success_update_user'
                ]
            ], 200);

        }catch(\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $user = $this->user->findOrFail($id);
            $user->delete();

            return response()->json([
                'data' => [
                    'msg' => 'success_delete_user'
                ]
            ], 200);

        }catch(\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
