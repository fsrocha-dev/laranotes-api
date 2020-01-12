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
        $userNote = $this->userNote->paginate('10');

        return response()->json($userNote, 200);
    }

    public function show($id)
    {
        try {
            $userNote = $this->userNote->findOrFail($id);

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

            $userNote = $this->userNote->findOrFail($id);
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

            $userNote = $this->userNote->findOrFail($id);
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
