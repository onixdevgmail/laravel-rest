<?php

namespace App\Http\Controllers;

use App\Helpers\ValidationHelper;
use App\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class PodcastController extends Controller
{
    /**
     * @param null $status
     * @return mixed
     */
    public function index($status = null)
    {
        $status_id = Podcast::getStatusIdByName($status);
        if ($status_id) {
            return Podcast::where("status", "=", $status_id)->paginate(Podcast::PAGINATION_PER_PAGE);
        } else {
            return Podcast::paginate(Podcast::PAGINATION_PER_PAGE);
        }
    }

    /**
     * @param Podcast $podcast
     * @return Podcast
     */
    public function show(Podcast $podcast)
    {
        if (Input::get('comments') == 1) $podcast->comments;
        return $podcast;
    }

    /**
     * @param Podcast $podcast
     * @return Podcast
     */
    public function approval(Podcast $podcast)
    {
        $podcast->update(['status' => Podcast::STATUS_PUBLISHED]);
        return $podcast;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = ValidationHelper::getPodcastValidator($request->all());

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } else {
            $podcast = Podcast::create($request->all());
            return response()->json($podcast, 201);
        }
    }

    /**
     * @param Request $request
     * @param Podcast $podcast
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Podcast $podcast)
    {
        $validator = ValidationHelper::getPodcastValidator($request->all(), true);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } else {
            $podcast->update($request->all());
            return response()->json($podcast, 200);
        }
    }

    /**
     * @param Podcast $podcast
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Podcast $podcast)
    {
        $podcast->delete();
        return response()->json(null, 204);
    }


}
