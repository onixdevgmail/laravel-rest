<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Helpers\ValidationHelper;
use App\Podcast;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @param Podcast $podcast
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add_comment(Request $request)
    {

        $validator = ValidationHelper::getCommentValidator($request->all());

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } else {
            try {
                $comment = Comments::create($request->all());
                return response()->json($comment, 201);
            } catch (QueryException $e) {
                $errorCode = $e->errorInfo[1];

                if ($errorCode == 1062) {
                    return response()->json("This comment already exist for this podcast", 400);
                }
                if ($errorCode == 1452) {
                    return response()->json("Podcast with this id doesn't exist", 404);
                }

                return response()->json("Error occurs while making request", 500);

            }
        }
    }

    /**
     * @param Comments $comment
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete_comment(Comments $comment)
    {
        $comment->delete();
        return response()->json(null, 204);
    }
}
