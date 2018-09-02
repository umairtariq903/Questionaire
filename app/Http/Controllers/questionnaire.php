<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\questionnairemodel;
use App\question;
use App\answer;
use Illuminate\Support\Facades\DB;

class questionnaire extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $questionnaires=DB::table('questionnaire')
        // 				->leftJoin('questions', 'questionnaire.id', '=', 'questions.questionnaire_id')
        // 				->select('questionnaire.*', DB::raw('COUNT(questions.id) as total'))
        // 				->groupBy('questionnaire.questionnairename')
        // 				->get();
        $questionnaires=questionnairemodel::leftJoin(
					    DB::raw('(SELECT questionnaire_id, COUNT(id) AS total FROM questions  GROUP BY questionnaire_id) AS n'),
					    'n.questionnaire_id', '=', 'id'
					)->get();

        return view('questionnaire',compact('questionnaires'));
    }
    public function getcreateview()
    {
        return view('createQuestionnaire');
    }
    public function postquestionnaire(Request $request)
    {
    	 $questionnaire= new \App\questionnairemodel;
    	 $questionnaire->questionnairename=$request->get('questionnaire');
    	 $questionnaire->user_id=auth::user()->id;
    	 $questionnaire->duration=$request->get('duration');
    	 $questionnaire->resumable=$request->get('resumable');
    	 // var_dump(auth::user());
    	 // exit();
    	 $questionnaire->save();

    	 return redirect('/Questionnaire');
    }
    public function getquestion($id)
    {
        return view('question',["id"=>$id]);
    }
    public function postquestion(Request $request)
    {
        // var_dump($request->get('id'));
        //var_dump($request->get('questiontype'));
        $questiontype=$request->get('questiontype');
        $question=$request->get('question');
        $answer=$request->get('answer');
        $choice1=$request->get('choice1');
        $choice2=$request->get('choice2');
        $choice3=$request->get('choice3');
        $correct=$request->get('correct');


        for ($i=0; $i<count($questiontype) ; $i++) { 
        	$questionmodel= new \App\question;
        	$questionmodel->questionnaire_id=$request->get('id');
        	$questionmodel->questiontype=$questiontype[$i];
        	$questionmodel->question=$question[$i];
        	$questionmodel->save();
        	// var_dump($questionmodel->id);
        	$answermodel= new \App\answer;
        	$answermodel->question_id=$questionmodel->id;
        	if ($questiontype[$i]=='mcq') {
        		if($correct[$i]=="1")
        		{
        			$answermodel->answer=$choice1[$i];
        		}
        		if($correct[$i]=="2")
        		{
        			$answermodel->answer=$choice2[$i];
        		}
        		if($correct[$i]=="3")
        		{
        			$answermodel->answer=$choice3[$i];
        		}

        		$answermodel->choices=$choice1[$i].",".$choice2[$i].",".$choice3[$i];
        		
        	}
        	elseif ($questiontype[$i]=='text') {

        		$answermodel->answer=$correct[$i];
        		$answermodel->choices='';
        	}

        	$answermodel->save();


        }
        return redirect('/Questionnaire');
    }
    public function edit($id)
    {
    	$questionnairemodel=new questionnairemodel();
    	$questionnaires=$questionnairemodel::find($id);
    	return view('edit',compact('questionnaires','id'));

    }
    public function destroy(Request $request)
    {
    	
    }
    public function update(Request $request)
    {
    	
    }
}
