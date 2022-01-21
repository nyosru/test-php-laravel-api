<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;

class NotesController extends Controller
{

    /**
      @OA\Get(
          path="/notes",
          summary="получаем список записей", 
          tags={"Notes"},
          @OA\Response(
                response="200", 
                description="норм ответ"
            ),
          @OA\Response(
              response="401",
              description="Ошибочка",
          ),
      )
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Notes::get());
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }







    /**
      @OA\Post(
          path="/notes/store",
          summary="создание записки", 
          tags={"Notes"},
        @OA\Parameter(
           name="title",
           description="название",
           in="query",
           required=true,
           @OA\Schema(
                type="string"
           )
       ),
        @OA\Parameter(
           name="description",
           description="описание",
           in="query",
           required=true,
           @OA\Schema(
                type="string"
           )
       ),
              @OA\Response(
                response="200", 
                description="добавили, окей"
            ),
          @OA\Response(
              response="401",
              description="Ошибочка",
          ),
      )
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $return = [
            'validate' => true
        ];

        try {
            //code...

            $validated = $request->validate([
                'title' => 'required|max:255|regex:/^[\w-]*$/',
                'description' => 'required|regex:/^[\w-]*$/',
            ]);

            // $return = [ 'val' => $validated , 'req' => $request->all(), 11 => 22];

            $return['added'] = Notes::insert($validated);
        } catch (\Throwable $th) {
            $return['validate'] = false;
        }

        return response()->json($return);
    }


    /**
     * @SWG\Get(
     *     path="/posts/{post_id}",
     *     summary="Get blog post by id",
     *     tags={"Posts"},
     *     description="Get blog post by id",
     *     @SWG\Parameter(
     *         name="post_id",
     *         in="path",
     *         description="Post id",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(ref="#/definitions/Post"),
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Post is not found",
     *     )
     * )
     */
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function show(Notes $notes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function edit(Notes $notes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notes $notes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notes $notes)
    {
        //
    }
}
