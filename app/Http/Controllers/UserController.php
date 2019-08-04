<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\LoginDetail;
use App\Admin;
use App\Result;
use App\Subject;
use App\SuperAdmin;
use App\User;
use App\Mail\VerifyMail;
use App\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{

    public function index()
    {
        if (Auth::check())
        {
            $coun = User::where('email',Auth::user()->email)->first()->Verified;
            if ($coun == 0)
            {
                $errormsg =  "You need to confirm your account. We have sent you an activation code, please check your email.";
                Auth::logout();
                return redirect()->route('userhomepage')->with('errormsg',$errormsg);
            }
            else
            {
                return redirect()->route('userdashboard');
            }
        }

        return view('user.userhome');
    }

        public function giveFeedback()
        {
            return view('user.feedback');
        }

    public function viewUserProfile()
    {
        $data = User::where('email',Auth::user()->email)->first();
        return view('user.viewprofile')->with('data',$data);
    }


        public function checkFeedback(Request $request)
        {
                $this->validate($request,[
                    'email' => 'required|exists:users,email',
                    'feedbacktopic' => 'required|max:50',
                    'feedbackdescription' =>'required|min:20|max:191'
                ]);


            $addtodatabase = Feedback::create([
               'email' => $request['email'],
                'Feedback_Topic' => $request['feedbacktopic'],
                'Feedback_Description' => $request['feedbackdescription'],
                'IP_Address' => \Request::ip()
            ]);

            if ($addtodatabase)
            {
                return redirect()->route('userfeedback')->with('errormsg','Feedback has been sent to developer.');
            }
            else
            {
                return redirect()->route('userfeedback')->with('errormsg','Something went wrong. Try Again.');
            }

        }

    public function checkLogIn(Request $request)
    {
            $this->validate($request,[
                'email' =>  'required',
                'password'  => 'required'
            ]);



       if (Auth::attempt(['email' => $request['email'],'password' => $request['password']]))
       {
           $user = new LoginDetail();
           $user->email = $request['email'];
           $user->IP_Address = \Request::ip();
           $date = date('Y-m-d h:m:s');
           $user->Login_DateandTime = $date;
           $user->Login_Type = 'Log In';
           $user->User_Type = 'user';
           $user->save();

           if (!User::where('email',$request['email'])->first()->Verified)
           {
               Auth::logout();
               return redirect()->route('userhomepage')->with('warning','You need to confirm your account. We have sent you an activation link, please check your email.');
           }


           if (User::where('email',$request['email'])->count() !=0 )
           {
               if (User::where('email', $request['email'])->first()->flag_one_device == 0 || User::where('email', $request['email'])->first()->flag_en_dis == 0)
               {
                   if (User::where('email', $request['email'])->first()->flag_en_dis == 0)
                   {
                       Auth::logout();
                       return redirect()->route('userhomepage')->with('errormsg', 'Account Disabled. Contact Your College.');
                   }
                   if (User::where('email', $request['email'])->first()->flag_one_device == 0)
                   {
                       Auth::logout();
                       return redirect()->route('userhomepage')->with('errormsg', 'Already Logged in another device.');
                   }
               }
           }


           return redirect()->route('userdashboard');
       }

       else
       {
           $user = new LoginDetail();
           $user->email = $request['email'];
           $user->IP_Address = \Request::ip();
           $date = date('Y-m-d h:m:s');
           $user->Login_DateandTime = $date;
           $user->Login_Type = 'Wrong Password';
           $user->User_Type = 'user';
           $user->save();
           if((User::where('email',$request['email'])->count())>0)
           {
           if(Hash::check($request['password'], User::where('email',$request['email'])->first()->Previous_Password))
           {
                return redirect()->back()->with('errormsg','You entered previous password.');
           }
           else
           {
               session()->flash('errormsg', 'Incorrect Username and Password');
               return redirect()->back()->withInput();
           }
           }
           else
           {
                session()->flash('errormsg', 'Incorrect Username and Password');
                return redirect()->back()->withInput();
           }


       }
        return redirect()->back();
    }

    public function successfullyLoggedIn()
    {
        $listofactivesubjects = Subject::where('College_ID',Auth::user()->College_ID)->where('Status',1)->where(function($query){
            $query->whereNull('Date_of_Exam')->orWhere('Date_of_Exam',Carbon::now()->format('Y-m-d'));
        })->get();

       $results = Result::where('email',Auth::user()->email)->get();

        $checkifemailexistinresult = Result::where('email',Auth::user()->email)->count();


       if($checkifemailexistinresult > 0)
       {

           foreach($listofactivesubjects as $listofactivesubject)
           {
               $checkifexistinresult = Result::where('email',Auth::user()->email)->where('Subject_ID',$listofactivesubject->id)->count();
               if ($checkifexistinresult > 0)
               {
                   $checkifexistinresults = 1;
               }
           }

         if($checkifexistinresults == 1)
        {
            return view('user.userdashboard')->with(compact('results'));

        }
         else
           {
               return view('user.userdashboard')->with(compact('listofactivesubjects','results'));
           }


       }

        if($checkifemailexistinresult == 0)
        {
            return view('user.userdashboard')->with(compact('listofactivesubjects','results'));
        }

    }



    public function register()
    {

        if (Auth::check())
        {
            $coun = User::where('email',Auth::user()->email)->first()->Verified;
            if ($coun == 0)
            {
                $errormsg =  "You need to confirm your account. We have sent you an activation code, please check your email.";
                Auth::logout();
                return redirect()->route('userhomepage')->with('errormsg',$errormsg);
            }
            else
            {
                return redirect()->route('userdashboard');
            }
        }
        return view('user.userregister');
    }

    public function checkregistration(Request $request)
    {
        if (Auth::check())
        {
            return redirect()->route('userdashboard');
        }
        $this->validate($request,[
            'first_name' => 'required|string|max:25',
            'middle_name' => 'nullable|string|max:25',
            'last_name' => 'required|string|max:25',
            'email' => 'required|max:50|string|unique:users,email|unique:admins,email|unique:super_admins,email',
            'gender'    => 'required',
            'password' => 'required_with:confirmpassword|min:8|max:60|same:confirmpassword',
            'confirmpassword' => 'max:50',
            'college_id' => 'required|numeric|min:1|max:99999999|exists:admins,College_ID',
            'symbol_no' => 'required|numeric|min:11111111|max:99999999|unique:users',
            'country'   => 'required',
            'zone'  => 'nullable',
            'district'  => 'nullable',
            'village'  => 'nullable',
            'wardno'  => 'nullable',
            'streetaddress'  => 'nullable|string|max:60'
        ]);

        $first_name = $request['first_name'];
        $middle_name = $request['middle_name'];
        $last_name = $request['last_name'];
        $email = $request['email'];
        $gender = $request['gender'];
        $password = bcrypt($request['password']);
        $country = $request['country'];
        $college_id = $request['college_id'];
        $symbol_no = $request['symbol_no'];
        $zone = $request['zone'];
        $district = $request['district'];
        $village = $request['village'];
//        $provinceno = $request['provinceno'];
        $wardno = $request['wardno'];
        $streetaddress = $request['streetaddress'];
        $date = date('Y-m-d h:m:s');

        $user = new User();


        $user->First_Name = $first_name;
        $user->Middle_Name = $middle_name;
        $user->Last_Name = $last_name;
        $user->email = $email;
        $user->Gender = $gender;
        $user->password = $password;
        $user->Country = $country;
        $user->College_ID = $college_id;
        $user->Symbol_No = $symbol_no;
        $user->Last_First_Name_Update = $date ;
        $user->Last_Middle_Name_Update = $date ;
        $user->Last_Last_Name_Update = $date ;
        $user->Last_Password_Update = $date ;
        $user->Zone = $zone;
        $user->District = $district;
        $user->Village = $village;
//        $user->Province_No = $provinceno;
        $user->Street_Address = $streetaddress;
        $user->Ward_No = $wardno;

        $user->save();
        Auth::login($user);

        $useraccountdetail = new LoginDetail();
        $useraccountdetail->email =$email;
        $useraccountdetail->IP_Address = \Request::ip();
        $useraccountdetail->Login_DateandTime = $date;
        $useraccountdetail->Login_Type = 'Account Creation';
        $useraccountdetail->User_Type = 'user';
        $useraccountdetail->save();

        $verifyUser = VerifyUser::create([
            'id' => $user->id,
            'Name' => $user->First_Name,
            'email' => $user->email,
            'token' => str_random(40)
        ]);

        Mail::to($user->email)->send(new VerifyMail($verifyUser));
        // return redirect()->back();
        //return $admin;

        return redirect()->route('userhomepage')->with('errormsg','Email has been sent to your email. Open the link and verify');
    }



    public function logout()
    {
        $user = new LoginDetail();
        $user->email = Auth::user()->email;
        $user->IP_Address = \Request::ip();
        $date = date('Y-m-d h:m:s');
        $user->Login_DateandTime = $date;
        $user->Login_Type = 'Log Out';
        $user->User_Type = 'user';
        $user->save();
        Auth::logout();
        return redirect()->route('userhomepage');
    }


    public function accountDetails()
    {
        $data = LoginDetail::where('email',Auth::user()->email)->orderBy('created_at','desc')->get();
        // dd($data);
        $colstart = 1;
        return view('user.accountdetails')->with('data', $data)->with('colstart',$colstart);
    }


    public function deleteAccount()
    {
        $user = User::find(Auth::user()->id);

        Auth::logout();

        if ($user->delete())
        {
            return redirect()->route('userhomepage')->with('errormsg', 'Your account has been deleted.');
        }
    }

    public function changePassword()
    {
        $data = 'user';
        return view('admin.changepassword')->with('data',$data);
    }

    public function checkChangePassword(Request $request)
    {
        $this->validate($request,[
            'currentpassword' => 'required',
            'newpassword' => 'required_with:confirmnewpassword|min:8|max:60|same:confirmnewpassword',
            'confirmnewpassword' => 'max:60'
        ]);

        $data = User::where('email',Auth::user()->email)->first();
    $currentpassword = $data->password;

            if(Hash::check($request['currentpassword'], $data->password))
            {
                $data->password = bcrypt($request['newpassword']);
                $data->Previous_Password = $currentpassword;
                $data->update();



                return redirect()->route('changeupassword')->with('errormsg','Password Successfully Changed. You may now logout to test your new password.');
            }
        else
        {
            return redirect()->route('changeupassword')->with('errormsg','Your current password is wrong.');
        }
    }


    public function wrong_page()
    {
        return view('user.wrong-page');
    }

}
