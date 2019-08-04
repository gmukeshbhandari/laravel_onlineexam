<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Subject;
use App\Question;
use App\Result;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;


class QuestionController extends Controller
{
    public function manageQuestion($id)
    {
        $subject = Subject::findorFail($id);
        $questions = $subject->questions;
       // dd($questions);
       return view('admin.question')->with('subject',$subject)->with('questions',$questions);
    }

    public function addQuestion(Request $request, $id)
    {
      $this->validate($request,[
            'question' => ['required',
                Rule::unique('questions','Question')->where(function ($query) use ($id) {
                    $query->where('Subject_ID',$id);
                }),
            ],
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'correctanswer' => 'required',
            'marks' => 'required'
        ]);

        $totalmarksquestiontable = Question::where('Subject_ID',$id)->sum('Marks');
        $totalmarks = $totalmarksquestiontable + $request['marks'];
        $totalmarkssubjecttable = Subject::where('id',$id)->first()->Full_Marks;
        $subject = Subject::find($id);
        if ($totalmarks <= $totalmarkssubjecttable)
            {
                 $quest = new Question();
                 $quest->College_ID = Auth::guard('admin')->user()->College_ID;
                 $quest->Question = $request['question'];
                 $quest->Option1 = $request['option1'];
                 $quest->Option2 = $request['option2'];
                 $quest->Option3 = $request['option3'];
                 $quest->Option4 = $request['option4'];
                 $quest->Correct_Answer = $request['correctanswer'];
                 $quest->Marks = $request['marks'];
                 $subject->questions()->save($quest);
    return redirect()->route('question_managing',['id' => $subject->id])->with('errormsg','Question Added Successfully.');
            }
        if ($totalmarks > $totalmarkssubjecttable)
        {
            return redirect()->route('question_managing',['id' => $subject->id])->with('errormsg','Further Question cannot be added. Total Marks cannot exceed the Full Marks.');
        }

    }

    public function deleteSubject($id)
    {
        $subject = Subject::findorFail($id);
        $subject->destroy($id);
        return redirect()->route('admindashboard')->with('errormsg','Subject Delete Successfully');
    }

    public function changeActiveStatus($id)
    {
            $subject = Subject::findorFail($id);

        if ($subject->Status == 0)
        {
            $totalmarksquestiontable = Question::where('Subject_ID',$id)->sum('Marks');
            if($subject->Full_Marks == $totalmarksquestiontable)
            {
                $subject->Status = true;
                $subject->update();
                return redirect()->route('admindashboard')->with('errormsg','Status Updated Successfully');
            }
            else
            {
                return redirect()->route('admindashboard')->with('errormsg','Status Cannot be updated. Either Question has not been added to this subject or Total Marks is not equal to full marks.');
            }

        }
        if ($subject->Status == 1)
        {
            $subject->Status = false;
            $subject->update();
            return redirect()->route('admindashboard')->with('errormsg','Status Updated Successfully');
        }
    }

    public function editAddedQuestion(Request $request, $id)
    {
        $subid = Question::where('id',$id)->first()->Subject_ID;
         $this->validate($request,[
             'question' => ['required',
                 Rule::unique('questions','Question')->ignore($id)->where(function ($query) use ($subid) {
                     $query->where('Subject_ID',$subid);
                 }),
             ],
             'option1' => 'required',
             'option2' => 'required',
             'option3' => 'required',
             'option4' => 'required',
             'correctanswer' => 'required',
             'marks' => 'required'
         ]);

        $subidd = Question::where('id',$id)->first();
        $totalmarksquestiontable = Question::where('Subject_ID',$subidd->Subject_ID)->sum('Marks');
        $totalmarks = ($totalmarksquestiontable - ($subidd->Marks)) + $request['marks'];
        $totalmarkssubjecttable = Subject::where('id',$subidd->Subject_ID)->first()->Full_Marks;
        $question = Question::findorFail($id);
        if ($totalmarks <= $totalmarkssubjecttable)
        {
            $question->Question = $request['question'];
            $question->Option1 = $request['option1'];
            $question->Option2 = $request['option2'];
            $question->Option3 = $request['option3'];
            $question->Option4 = $request['option4'];
            $question->Correct_Answer = $request['correctanswer'];
            $question->Marks = $request['marks'];
            $question->update();
            return redirect()->route('question_managing',['id' => $question->Subject_ID])->with('errormsg','Question Updated Successfully');
        }
        if ($totalmarks > $totalmarkssubjecttable)
        {
            return redirect()->route('question_managing',['id' => $question->Subject_ID])->with('errormsg','Question cannot be updated. Total Marks cannot exceed the Full Marks.');
        }

    }


    public function giveExam(Request $request)
    {
        $this->validate($request,[
            'selectgiveexamsubjectcategory' => 'required'
        ]);
        $subjecidtogiveexam = $request['selectgiveexamsubjectcategory'];
        $subjectinfos = Subject::where('id',$subjecidtogiveexam)->first();
        $questions = $subjectinfos->questions()->get();
        $first_question_id = $subjectinfos->questions()->min('id');
        $last_question_id = $subjectinfos->questions()->max('id');
        $duration = $subjectinfos->Duration;

        if(session('next_question_id')){
            $current_question_id = session('next_question_id');
        }
        else{
            $current_question_id = $first_question_id;
            session(['next_question_id'=>$current_question_id]);
        }
       return view('user.exam')->with(compact('subjectinfos','duration','questions','current_question_id','first_question_id','last_question_id'));
    }






    public function saveQuestionResult(Request $request, $id)
    {
        $subject = Subject::find($id);
        $a = 1;
        $obtainedmarks = 0;
        $count_nosofincorrectanswer = 0;
        $count_nosofcorrectanswer = 0;
        $count_nosofleavedanswer = 0;
        $noofquestion = Question::where('Subject_ID',$id)->count();

          for($x = 0;$x <=($noofquestion-1);$x++)
            {
                $info = $request->input('question_id'.$a);
                $question = Question::find($info);

          if($request->input('option'.$a) != null){

                if ($question->Correct_Answer == $request->input('option'.$a))
                {
                    $obtainedmarks = $obtainedmarks + $question->Marks;
                    $count_nosofcorrectanswer =  $count_nosofcorrectanswer + 1;
                }
                if ( $question->Correct_Answer != $request->input('option'.$a))
                {
                    $obtainedmarks =  $obtainedmarks - 0.20;
                    $count_nosofincorrectanswer = $count_nosofincorrectanswer + 1;
                }
               Answer::create([
                    'user_id'=>Auth::user()->id,
                    'question_id'=> $request->input('question_id'.$a),
                    'subject_id' => $id,
                    'user_answer'=> $request->input('option'.$a),
                    'question' => $question->Question,
                    'option1' => $question->Option1,
                    'option2' => $question->Option2,
                    'option3' => $question->Option3,
                    'option4' => $question->Option4,
                    'right_answer'=>$question->Correct_Answer
                ]);
            }



            if($request->input('option'.$a) == null) {
                $count_nosofleavedanswer =  $count_nosofleavedanswer + 1;
            }
            $a = $a + 1;
        }
        if ($obtainedmarks >= $subject->Pass_Marks)
        {
            $result = '1';
        }
        if ($obtainedmarks < $subject->Pass_Marks)
        {
            $result = '0';
        }
         Result::create([
             'email'=> Auth::user()->email,
             'Subject_ID'=> $id,
             'Subject_Name' => $subject->Subject_Name,
             'Category_Name'=> $subject->category->Category_Name,
             'Exam_Date' => $subject->Date_of_Exam,
             'Result' => $result,
             'Full_Marks' => $subject->Full_Marks,
             'Pass_Marks' => $subject->Pass_Marks,
             'Obtained_Marks' => $obtainedmarks,
             'No_of_Correct_Answer' =>$count_nosofcorrectanswer,
             'No_of_Incorrect_Answer' => $count_nosofincorrectanswer,
             'No_of_Leaved_Answer' => $count_nosofleavedanswer
         ]);

        return redirect()->route('userdashboard');
    }


    public function deleteQuestion($id)
    {
        $quesn = Question::findorFail($id);
        $subjid = $quesn->Subject_ID;
       $quesn->destroy($id);
        return redirect()->route('question_managing',['id' => $subjid])->with('errormsg','Question Deleted Successfully');
    }
}
