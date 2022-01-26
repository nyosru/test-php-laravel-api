<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;

class NotesController extends Controller
{

    /**
      @OA\Get(
          path="/api/notes",
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



    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create(Request $request)
    // {

    // }







    /**
      @OA\Post(
          path="/api/notes",
          summary="создание записки", 
          tags={"Notes"},
        @OA\Parameter(
           name="title",
           description="название (латиница, цифры)",
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
                'title' => 'required|max:255|alpha_dash',
                'description' => 'required',
            ]);

            // $return = [ 'val' => $validated , 'req' => $request->all(), 11 => 22];

            // $return['added'] = Notes::insert($validated);
            $note = new Notes;
            $note->title = $validated['title'];
            $note->description = $validated['description'];
            $return['added'] = $note->save();

        } catch (\Throwable $th) {
            $return['validate'] = false;
        }

        return response()->json($return);
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Notes  $notes
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Notes $notes)
    // {
    //     //
    // }



    
    /**
      @OA\Get(
          path="/api/notes/{id}/edit",
          summary="создание записки", 
          tags={"Notes"},

        @OA\Parameter(
           name="id",
           description="номер записи (id)",
           in="path",
           required=true,
           @OA\Schema( type="number" )
       ),

        @OA\Parameter(
           name="title",
           description="название (латиница, цифры)",
           in="query",
           required=true,
           @OA\Schema( type="string" )
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
     * Show the form for editing the specified resource.
     * редактируем записку, присылаем номер заголовок и описание
     *
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function edit(Notes $notes, Request $request)
    {
        $return = [
            'validate' => false,
            'request' => $request->all()
        ];

        try {

            // правила валидации
            $validated = $request->validate([
                'id' => 'required|numeric',
                'title' => 'required|max:255|alpha_dash',
                'description' => 'required',
            ]);
            // если сработает строчка значит проверка прошла норм
            $return['validate'] = true;

            // изменяем строчку
            $note = Notes::find($validated['id']);
            $post->title = $validated['title'];
            $post->description = $validated['description'];
            $return['edited'] = $note->save();            

        } catch (\Throwable $th) {
        }

        // возвращаем json
        return response()->json($return);
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Notes  $notes
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Notes $notes)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Notes  $notes
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Notes $notes)
    // {
    //     //
    // }
}
