<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Category;
use App\LoginDetail;
use App\Mail\RecoverPassword;
use App\Mail\VerifyMail;
use App\Subject;
use App\SuperAdmin;
use App\User;
use App\ChangePassword;
use App\VerificationCode;
use App\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
  /*  public function __construct() //this function makes sure that AdminController.php controller or its all function can be accessed only when admin is already authenticated.
    {
        $this->middleware('auth:admin');
   $this->middleware('auth:admin', ['except' => ['','','','']]);


    }*/
    public function index(Request $request)
    {
        if (Auth::guard('admin')->check())
            {
                $coun = Admin::where('email',Auth::guard('admin')->user()->email)->first()->Verified;
                if ($coun == 0)
                {
                   $errormsg =  "You need to confirm your account. We have sent you an activation code, please check your email.";
                    Auth::guard('admin')->logout();
                    return redirect()->route('adminhomepage')->with('errormsg',$errormsg);
                }
                else
                {
                    return redirect()->route('admindashboard');
                }
            }
            return view('admin.adminhome');
    }


    public function register()
    {
        if (Auth::guard('admin')->check())
        {
            $coun = Admin::where('email',Auth::guard('admin')->user()->email)->first()->Verified;
            if ($coun == 0)
            {
                $errormsg =  "You need to confirm your account. We have sent you an activation code, please check your email.";
                Auth::guard('admin')->logout();
                return redirect()->route('adminhomepage')->with('errormsg',$errormsg);
            }
            else
            {
                return redirect()->route('admindashboard');
            }
        }
        return view('admin.adminregister');
    }

    public function checkEmailAvailablity(Request $request)
    {
        $dataadmin = Admin::where('email',$request['email'])->count();
        $datauser = User::where('email',$request['email'])->count();
        $datasuperadmin = SuperAdmin::where('email',$request['email'])->count();

        if ($dataadmin > 0 || $datauser > 0 || $datasuperadmin >0)
        {
            echo 'not_unique';
        }
        if ($dataadmin == 0 && $datauser == 0 && $datasuperadmin ==0)
        {
            echo 'unique';
        }
    }

    public function checkregistration(Request $request)
    {
        if (Auth::guard('admin')->check())
        {
            return redirect()->route('admindashboard');
        }
        $verifycode = $request['verificationcode'];
        $this->validate($request,[
            'college_name' => 'required|string|max:60',
            'email' => 'required|max:50|string|unique:users,email|unique:admins,email|unique:super_admins,email',
            'password' => 'required_with:confirmpassword|min:8|max:60|same:confirmpassword',
            'confirmpassword' => 'max:50',
            'college_id' => 'required|numeric|min:1|max:99999999|unique:admins',
            'country'   => 'required',
            'zone'  => 'nullable',
            'district'  => 'nullable',
            'village'  => 'nullable',
            'provinceno'  => 'nullable',
            'wardno'  => 'nullable',
            'verificationcode' => ['required',
            Rule::exists('verification_codes','Verification_Code')->where(function ($query){
                $query->where('Status',1);
            }),
            ],
            'streetaddress'  => 'nullable|string|max:60'

        ]);

        $date = date('Y-m-d h:m:s');
        $admin = new Admin();
        $admin->email = $request['email'];
        $admin->password = bcrypt($request['password']);
        $admin->College_Name = $request['college_name'];
        $admin->College_ID = $request['college_id'];
        $admin->Country = $request['country'];
        $admin->Zone = $request['zone'];
        $admin->District = $request['district'];
        $admin->Village = $request['village'];
        $admin->Province_No = $request['provinceno'];
        $admin->Ward_No = $request['wardno'];
        $admin->Street_Address = $request['streetaddress'];
        $admin->Last_College_Name_Update = $date;
        $admin->Last_Password_Update = $date;

        /*
       $data = array('email'=>$request['email'],'password'=> bcrypt($request['password']),'College_Name'=>$request['college_name'],'College_ID'=>$request['college_id'],
           'Country'=>$request['country','Zone'=>$request['zone'],'District'=>$request['district'],'Village'=>$request['village'],'Province_No'=>$request['provinceno'],'Ward_No'=>$request['wardno'],'Street_Address'=>$request['streetaddress'],'Last_College_Name_Update'=>$date,'Last_Password_Update'=>$date);
       DB::table('admins')->insert($data);*/

        $admin->save();

        $updateverificationdetail = VerificationCode::where('Verification_Code',$request['verificationcode'])->first();
        $updateverificationdetail->email = $request['email'];
        $updateverificationdetail->Status = 0;
        $updateverificationdetail->update();



       Auth::guard('admin')->login($admin);

        $adminaccountdetail = new LoginDetail();
        $adminaccountdetail->email =$request['email'];
        $adminaccountdetail->IP_Address = \Request::ip();
        $adminaccountdetail->Login_DateandTime = $date;
        $adminaccountdetail->Login_Type = 'Account Creation';
        $adminaccountdetail->User_Type = 'admin';
        $adminaccountdetail->save();


        $verifyUser = VerifyUser::create([
            'id' => $admin->id,
            'Name' => $admin->College_Name,
            'email' => $admin->email,
            'token' => str_random(40)
        ]);

            Mail::to($admin->email)->send(new VerifyMail($verifyUser));
       // return redirect()->back();
        //return $admin;

       return redirect()->route('adminhomepage')->with('errormsg','Email has been sent to your email. Open the link and verify');
    }

    public function verifyAdmin($token)
    {

        $verifyAdmin = VerifyUser::where('token', $token)->first();
        if(isset($verifyAdmin) )
        {
            if(Admin::where('email',$verifyAdmin->email)->exists())
            {
                $admin = $verifyAdmin->admin;
                if(!$admin->Verified)
                {
                    $verifyAdmin->admin->Verified = 1;
                    $verifyAdmin->admin->save();
                    $errormsg = "Your Email is verified. You may now login";
                }
                else
                {
                    $errormsg = "Your e-mail is already verified. You can login";
                }
                return redirect()->route('adminhomepage')->with('errormsg', $errormsg);
            }


            if(User::where('email',$verifyAdmin->email)->exists())
            {
                $user = $verifyAdmin->user;
                if(!$user->Verified)
                {
                    $verifyAdmin->user->Verified = 1;
                    $verifyAdmin->user->save();
                    $errormsg = "Your Email is verified. You may now login";
                }
                else
                {
                    $errormsg = "Your e-mail is already verified. You can login";
                }
                return redirect()->route('userhomepage')->with('errormsg', $errormsg);
            }

        }
        else
        {
            return redirect()->route('adminhomepage')->with('errormsg', "Sorry your email cannot be identified.");
        }

    }

    public function verifyForgotPasswordLink($email,$token)
    {
        $data = ChangePassword::where('email',$email)->where('token', $token)->first();
        if((isset($data)) && ($data->Status == 1))
        {
            if($data->User_Type == 'user')
            {
                $useremail = 'useremail';
                $mail = $email;
                return view('admin.recoverpassword')->with(compact('useremail','mail'));
            }

            if($data->User_Type == 'admin')
            {
                $useremail = 'adminemail';
                $mail = $email;
                return view('admin.recoverpassword')->with(compact('useremail','mail'));
            }
        }
        else
        {
            return view('admin.recoverpassword')->with('msg', 'Sorry your email cannot be identified.');
        }

    }


    public function checkLogIn(Request $request)
    {
        //$this->middleware('auth:admin'); //checkLogIn function can be accessed only when admin is authenticated
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);




        if (Auth::guard('admin')->attempt(['email' => $request['email'], 'password' => $request['password']]))
        {
            $admin = new LoginDetail();
            $admin->email = $request['email'];
            $admin->IP_Address = \Request::ip();
            $date = date('Y-m-d h:m:s');
            $admin->Login_DateandTime = $date;
            $admin->Login_Type = 'Log In';
            $admin->User_Type = 'admin';
            $admin->save();

            if (!Admin::where('email',$request['email'])->first()->Verified)
            {
                Auth::guard('admin')->logout();
                return redirect()->route('adminhomepage')->with('warning','You need to confirm your account. We have sent you an activation link, please check your email.');
            }



            if (Admin::where('email',$request['email'])->count() !=0 )
            {
                if (Admin::where('email', $request['email'])->first()->flag_one_device == 0 || Admin::where('email', $request['email'])->first()->flag_en_dis == 0)
                {
                    if (Admin::where('email', $request['email'])->first()->flag_en_dis == 0)
                    {
                        Auth::guard('admin')->logout();
                        return redirect()->route('adminhomepage')->with('errormsg', 'Account Disabled. Contact Your College.');
                    }
                    if (Admin::where('email', $request['email'])->first()->flag_one_device == 0)
                    {
                        Auth::guard('admin')->logout();
                        return redirect()->route('adminhomepage')->with('errormsg', 'Already Logged in another device.');
                    }
                }
            }

//                $details = Auth::guard('admin')->user();
//                $user = $details['College_Name'];
//                return $user;

            return redirect()->route('admindashboard');
        }
        else
        {
            $admin = new LoginDetail();
            $admin->email = $request['email'];
            $admin->IP_Address = \Request::ip();
            $date = date('Y-m-d h:m:s');
            $admin->Login_DateandTime = $date;
            $admin->Login_Type = 'Wrong Password';
            $admin->User_Type = 'admin';
            $admin->save();
            if((Admin::where('email',$request['email'])->count())>0)
            {
            if(Hash::check($request['password'], Admin::where('email',$request['email'])->first()->Previous_Password))
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
    }


    public function successfullyLoggedIn()
    {
        $data = Category::where('College_ID',Auth::guard('admin')->user()->College_ID)->get();
        $subjects = Subject::where('College_ID',Auth::guard('admin')->user()->College_ID)->paginate(5);
        return view('admin.admindashboard')->with('data',$data)->with('subjects',$subjects);
    }

    public function accountDetails()
    {
        $data = LoginDetail::where('email',Auth::guard('admin')->user()->email)->orderBy('created_at','desc')->get();
       // dd($data);
        $colstart = 1;
        return view('admin.accountdetails')->with('data', $data)->with('colstart',$colstart);
        // return view('admin.accountdetails')->withData($data);
        //return view('admin.accountdetails')->with(compact('data'));
    }

    public function getuserlist()
    {
        $data = User::where('College_ID',Auth::guard('admin')->user()->College_ID)->orderBy('created_at','asc')->get();
        $colstart = 1;
        return view('admin.userlist')->with('data',$data)->with('colstart',$colstart);
    }

    public function changeFlagendis($id,Request $request)
    {
        $user = User::findorFail($id);
        $currentflagstatus = $user->flag_en_dis;

        if($currentflagstatus == 1)
        {
            if (Auth::check())
            {
                $userdetail = new LoginDetail();
                $userdetail->email = Auth::user()->email;
                $userdetail->IP_Address = \Request::ip();
                $date = date('Y-m-d h:m:s');
                $userdetail->Login_DateandTime = $date;
                $userdetail->Login_Type = 'Log Out - Disable by Admin';
                $userdetail->User_Type = 'user';
                $userdetail->save();
                Auth::logout();
            }
            $user->flag_en_dis = 0;
            $user->update();
        }

        if($currentflagstatus == 0)
        {
            $user->flag_en_dis = 1;
            $user->update();
        }
        return redirect()->route('user_list');

    }


    public function viewAdminProfile()
    {
        $data = Admin::where('email',Auth::guard('admin')->user()->email)->first();
       return view('admin.viewprofile')->with('data',$data);
    }

    public function manageCategoryandSubject(Request $request)
    {
        if ($request['butnname'] == 'adcategory')
        {
            if (!Category::where('College_ID',Auth::guard('admin')->user()->College_ID)->where('Category_Name', $request['categoryname'])->exists()) {
                /* $data = new Category();
                 $data->Category_Name = $request['categoryname'];
                 $data->save();
                 echo "Successfully Added";*/

                Category::create([
                    'College_ID' => Auth::guard('admin')->user()->College_ID,
                    'Category_Name' => $request['categoryname']
                ]);


                //echo "Successfully Added";
                return response()->json(['message' => 'Successfully Added','catname' => $request['categoryname']]);
            }
            else
            {
                echo "Category Name Already Exists";
            }
        }

        if ($request['butnname'] == 'deletcategory')
        {
            if (Category::where('College_ID',Auth::guard('admin')->user()->College_ID)->where('Category_Name', $request['categoryname'])->exists())
            {
                $data = Category::where('College_ID',Auth::guard('admin')->user()->College_ID)->where('Category_Name', $request['categoryname'])->delete();
                if ($data)
                {
                  //  echo "Successfully Deleted";
                    return response()->json(['message' => 'Successfully Deleted','catname' => $request['categoryname']]);

                }
                else
                {
                    echo "Failed";
                }

            }
            else
            {
                echo "Category Name Doesnot Exists";
            }
        }

        if ($request['butnname'] == 'addsubject')
        {
            if (Category::where('College_ID',Auth::guard('admin')->user()->College_ID)->where('Category_Name', $request['categories'])->exists())
            {
                $categoryid = Category::where('College_ID',Auth::guard('admin')->user()->College_ID)->where('Category_Name', $request['categories'])->first()->id;
                if (Subject::where('College_ID',Auth::guard('admin')->user()->College_ID)->where('Category_ID', $categoryid)->where('Subject_Name',$request['subjectname'])->exists())
                {
                        echo "Already";
                }
                else
                {
                    if ($request['passmarks'] < $request['fullmarks'])
                    {
                        $subject = new Subject();
                        $subject->College_ID = Auth::guard('admin')->user()->College_ID;
                        $subject->Subject_Name = $request['subjectname'];
                        $subject->Duration = $request['duration'];
                        $subject->Full_Marks = $request['fullmarks'];
                        $subject->Pass_Marks = $request['passmarks'];
                        $subject->Date_of_Exam = $request['dateofexam'];
                        $category = Category::where('College_ID',Auth::guard('admin')->user()->College_ID)->where('Category_Name',$request['categories'])->first();
                        $data = $category->subjects()->save($subject);

                        if ($data) {
                           // echo "Successfully Added";
                            return response()->json(['message' => 'Successfully Added','subjtname' => $request['subjectname'],'catname' => $request['categoryname'],'duratn' => $request['duration'],'fulmark' =>$request['fullmarks'],'pasmark' => $request['passmarks'],'examdat' => $request['dateofexam'],'status' => 'Inactive']);
                        }
                        else {
                            echo "Failed";
                        }
                    }
                    else
                    {
                        echo "Pass Marks Greater or Equal";
                    }

                }
            }
            else{
                echo "Category Name Doesnot Exist";
            }
        }

        if ($request['butnname'] == 'deletesubject')
        {
            $categoryid = Category::where('College_ID',Auth::guard('admin')->user()->College_ID)->where('Category_Name', $request['categories'])->first()->id;

                if (Subject::where('College_ID',Auth::guard('admin')->user()->College_ID)->where('Category_ID',$categoryid)->where('Subject_Name', $request['subjectname'])->exists()) {
                    $data = Subject::where('College_ID',Auth::guard('admin')->user()->College_ID)->where('Category_ID',$categoryid)->where('Subject_Name', $request['subjectname'])->delete();
                    if ($data) {
                        echo "Successfully Deleted";
                    } else {
                        echo "Failed";
                    }
                } else {
                    echo "No Exists";
                }
        }




    }



    public function viewResult(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',


        ]);

    }

    public function deleteAccount()
    {
        $admin = Admin::find(Auth::guard('admin')->user()->id);

        Auth::guard('admin')->logout();

        if ($admin->delete())
        {
            return redirect()->route('adminhomepage')->with('errormsg', 'Your account has been deleted.');
        }
    }

    public function changePassword()
    {
        $data = 'admin';
        return view('admin.changepassword')->with('data',$data);
    }

    public function checkChangePassword(Request $request)
    {
        $this->validate($request,[
            'currentpassword' => 'required',
            'newpassword' => 'required_with:confirmnewpassword|min:8|max:60|same:confirmnewpassword',
            'confirmnewpassword' => 'max:60'
        ]);

        $data = Admin::where('email',Auth::guard('admin')->user()->email)->first();
        $currentpassword = $data->password;

        if(Hash::check($request['currentpassword'], $data->password))
        {
            $data->password = bcrypt($request['newpassword']);
            $data->Previous_Password = $currentpassword;
            $data->update();

            return redirect()->route('changeapassword')->with('errormsg','Password Successfully Changed. You may now logout to test your new password.');
        }
        else
        {
            return redirect()->route('changeapassword')->with('errormsg','Your current password is wrong.');
        }
    }

    public function forgotPassword(Request $request)
    {
        return view('admin.forgotpassword');
    }


    public function checkForgotDetail(Request $request)
    {
        if ((Auth::check()) || (Auth::guard('admin')->check()) || (Auth::guard('superadmin')->check())) {
            return redirect()->route('forgotpassword')->with('errormsg', 'Please, Logout from current account before proceesing further.');
        }
        $this->validate($request, [
            'email' => 'required'
        ]);
        $existinuser = User::where('email', $request['email'])->count();
        $existinadmin = Admin::where('email', $request['email'])->count();
        $existinsuperadmin = SuperAdmin::where('email', $request['email'])->count();

        if ($existinuser > 0 || $existinadmin > 0 || $existinsuperadmin > 0) {
            if ($existinuser > 0) {
                $usertype = 'user';
                $id = User::where('email', $request['email'])->first()->id;
                $name = User::where('email', $request['email'])->first()->First_Name;
            }
            if ($existinadmin > 0) {
                $usertype = 'admin';
                $id = Admin::where('email', $request['email'])->first()->id;
                $name = Admin::where('email', $request['email'])->first()->College_Name;
            }
            if ($existinsuperadmin > 0) {
                $usertype = 'superadmin';
                $id = SuperAdmin::where('email', $request['email'])->first()->id;
                $name = SuperAdmin::where('email', $request['email'])->first()->First_Name;
            }
            $verifyChangePassword = ChangePassword::create([
                'id' => $id,
                'Name' => $name,
                'email' => $request['email'],
                'User_Type' => $usertype,
                'token' => str_random(40)
            ]);

             Mail::to($request['email'])->send(new RecoverPassword($verifyChangePassword));
            return redirect()->route('forgotpassword')->with('errormsg','Password recovering link has been sent to the email entered by you, if it exists in our record.');
         }
         if ($existinuser == 0 && $existinadmin == 0 && $existinsuperadmin ==0)
         {
                 return redirect()->route('forgotpassword')->with('errormsg','Password recovering link has been sent to the email entered by you, if it exists in our record.');
         }
    }

    public function checkRecoverChangePassword(Request $request,$email,$name)
    {
        $this->validate($request, [
            'newpassword' => 'required_with:confirmnewpassword|min:8|max:60|same:confirmnewpassword',
            'confirmnewpassword' => 'max:60'
        ]);

            if ($name == 'useremail')
            {
                $data = User::where('email',$email)->first();
                $currentpassword = $data->password;
                $data->password = bcrypt($request['newpassword']);
                $data->Previous_Password = $currentpassword;
                $data->update();

                $forchangepasswordstatuss =  ChangePassword::where('email',$email)->get();
                foreach($forchangepasswordstatuss as $forchangepasswordstatus)
                {
                    $forchangepasswordstatus->delete();
                }

                return redirect()->route('userhomepage')->with('errormsg','Password Changed Successfully. You may now login.');
            }

        if ($name == 'adminemail')
        {
            $data = Admin::where('email',$email)->first();
            $currentpassword = $data->password;
            $data->password = bcrypt($request['newpassword']);
            $data->Previous_Password = $currentpassword;
            $data->update();

            $forchangepasswordstatuss =  ChangePassword::where('email',$email)->get();
            foreach($forchangepasswordstatuss as $forchangepasswordstatus)
            {
                $forchangepasswordstatus->delete();
            }
            return redirect()->route('adminhomepage')->with('errormsg','Password Changed Successfully. You may now login.');
        }

    }

    public function logout()
    {
        $admin = new LoginDetail();
        $admin->email = Auth::guard('admin')->user()->email;
        $admin->IP_Address = \Request::ip();
        $date = date('Y-m-d h:m:s');
        $admin->Login_DateandTime = $date;
        $admin->Login_Type = 'Log Out';
        $admin->User_Type = 'admin';
        $admin->save();

        Auth::guard('admin')->logout();

        return redirect()->route('adminhomepage');
    }

}
