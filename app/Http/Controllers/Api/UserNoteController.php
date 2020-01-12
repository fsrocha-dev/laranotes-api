<?php

namespace App\Http\Controllers\Api;

use App\UserNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function store(Request $request)
    {

        $data = $request->all();

        try {

            $userNote = $this->userNote->create($data);

            return response()->json([
                'data' => [
                    'msg' => 'success_create_note'
                ]
            ], 200);

        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 401);
        }

    }

    public function update($id, Request $request)
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
            return response()->json(['error' => $e->getMessage()], 401);
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
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

}
