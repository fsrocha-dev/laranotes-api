<?php

namespace App\Http\Controllers\Api;

use App\UserNote;
use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserNoteRequest;

class UserNoteController extends Controller
{

    private $userNote;

    public function __construct(UserNote $userNote)
    {
        $this->userNote = $userNote;
    }

    public function index()
    {
        $userNote = auth('api')->user()->user_note();

        return response()->json($userNote->paginate(10), 200);
    }

    public function show($id)
    {
        try {
            $userNote = auth('api')->user()->user_note()->findOrFail($id);

            return response()->json([
                'data' => $userNote
            ], 200);

        }catch(\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    public function store(UserNoteRequest $request)
    {

        $data = $request->all();

        try {

            $data['user_id'] = auth('api')->user()->id;

            $userNote = $this->userNdote->create($data);

            return response()->json([
                'data' => [
                    'msg' => 'success_create_note'
                ]
            ], 200);

        }catch(\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }

    }

    public function update($id, UserNoteRequest $request)
    {
        $data = $request->all();

        try {

            $userNote = auth('api')->user()->user_note()->findOrFail($id);
            $userNote->update($data);

            return response()->json([
                'data' => [
                    'msg' => 'success_update_note'
                ]
            ], 200);

        }catch(\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    public function destroy($id)
    {
        try {

            $userNote = auth('api')->user()->user_note()->findOrFail($id);
            $userNote->delete();

            return response()->json([
                'data' => [
                    'msg' => 'success_delete_note'
                ]
            ], 200);

        }catch(\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

}
