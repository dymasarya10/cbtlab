<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    public function cekauth($func)
    {
        if(auth()->user()->role === 'student'){
            abort(403, 'HEHEHE GABOLEH YA ANAK ANAK');
        }

        return $func;
    }
    public string $title = 'CBT-LAB | Admin';
    public function cek($role,$heading){
        ($role === 'admin') ? $cek = 'Admin' : $cek = $heading;
        return $cek;
    }

    public function index()
    {
        return $this->cekauth(view('admin.pages.question', [
            'heading' => $this->cek(auth()->user()->role,'Daftar Soal'),
            'title' => $this->title,
            'collection' => Question::all()
        ]));
    }

    public function createqst()
    {
        return $this->cekauth(view('admin.pages.authorops.createquestion', [
            'heading' => $this->cek(auth()->user()->role,'Buat Soal'),
            'title' => $this->title,
            'grades' => Grade::all(),
            'subjects' => Subject::all()
        ]));
    }

    public function storeqst(Request $request)
    {
        $rules = [
            'level' => 'required',
            'question_name' => 'required',
            'subject' => 'required',
            'grade' => 'required',
            'duration' => 'required',
            'answer_key' => 'required',
            'creator' => 'required',
            'question_path' => 'required'
        ];
        $validatedData = $request->validate($rules);
        $data = explode('-',$request->subject);
        $answer_key = implode(',',$request->answer_key);
        $validatedData['answer_key'] = $answer_key;
        $validatedData['question_path'] = $request->file('question_path')->store('QuestionBank');
        $validatedData['level'] = $data[1];
        $validatedData['subject'] = $data[0];

        Question::create($validatedData);

        return redirect(route('questionlist'))->with('success','Soal Berhasil Dibuat : '.$validatedData['question_name']);
    }

    public function activateqst(Request $request)
    {
        $question = Question::find($request->target);
        $question->status = $request->status;
        $question->save();
        return redirect(route('questionlist'));
    }

    public function deleteqst(Request $request)
    {
        $qst = Question::find($request->target_id);
        Storage::delete($qst->question_path);
        $question_name = $qst->question_name;
        $qst->delete();

        return redirect(route('questionlist'))->with('success',$question_name.' berhasil dihapus');

    }

    public function result()
    {
        return $this->cekauth(view('admin.pages.result', [
            'heading' => $this->cek(auth()->user()->role,'Hasil Ujian'),
            'title' => $this->title
        ]));
    }
}
