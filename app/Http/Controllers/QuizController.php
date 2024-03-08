<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizCreateRequest;
use App\Http\Requests\QuizUpdateRequest;
use App\Http\Resources\QuizResource;
use App\Models\Quiz;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quiz = Quiz::get()->all();
        return QuizResource::collection($quiz);
    }

    public function store(QuizCreateRequest $request): QuizResource
    {
        $data = $request->validated();
        
        if(Quiz::where('question', $data['question'])->count() == 1){
            throw new HttpResponseException(response([
                "errors" => "Question already exists"
            ], 400));
        };

        $upload = $request->file('question')->storeOnCloudinary('resonance-riddle');

        $quiz = new Quiz();
        $quiz->question = $upload->getSecurePath();
        $quiz->answer_true = $data['answer_true'];
        $quiz->answer_false = $data['answer_false'];
        $quiz->save();
        return new QuizResource($quiz);
    }

    public function update(QuizUpdateRequest $request, $id): QuizResource
    {
        $data = $request->validated();
        
        $quiz = Quiz::where('_id', $id)->first();
        if(!$quiz){
            throw new HttpResponseException(response([
                "errors" => "Question not found"
            ], 400));
        };
        
        $upload = $request->file('question')->storeOnCloudinary('resonance-riddle');
        
        $quiz->question = $upload->getSecurePath();
        $quiz->answer_true = $data['answer_true'];
        $quiz->answer_false = $data['answer_false'];
        $quiz->update();
        return new QuizResource($quiz);
    }

    public function destroy($id)
    {
        $quiz = Quiz::where('_id', $id)->first();

        $quiz->delete();
        return response()->json([
            'message' => 'delete quiz success'
        ])->setStatusCode(200);
    }
}
