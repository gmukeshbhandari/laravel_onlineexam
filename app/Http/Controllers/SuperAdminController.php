<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Feedback;
use App\SuperAdmin;
use App\LoginDetail;
use App\VerificationCode;
use Illuminate\Support\Facades\Auth; //for AUTH::Atempt
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class SuperAdminController extends Controller
{
    public function index(Request $request)
        {
            $verificationcodes = VerificationCode::get();
            $admindetails = Admin::get();
           return view('superadmin.superadmin')->with('verificationcodes',$verificationcodes)->with('admindetails',$admindetails);
        }

    public function password()
        {
            if (Auth::guard('superadmin')->check())
            {
                return redirect()->route('super_admin');
                //return view('verification.superadmin');
            }
            return view('superadmin.password');

        }


    public function checkPasswordLogin(Request $request)
    {
        $this->validate($request,[
            'email' =>  'required',
            'password'  => 'required'
        ]);

        if (Auth::guard('superadmin')->attempt(['email' => $request['email'], 'password' => $request['password']]))
        {
            $superadmin = new LoginDetail();
            $superadmin->email = $request['email'];
            $superadmin->IP_Address = \Request::ip();
            $date = date('Y-m-d h:m:s');
            $superadmin->Login_DateandTime = $date;
            $superadmin->Login_Type = 'Log In';
            $superadmin->User_Type = 'superadmin';
            $superadmin->save();

            return redirect()->route('super_admin');
        }
        else
        {
            $superadmin = new LoginDetail();
            $superadmin->email = $request['email'];
            $superadmin->IP_Address = \Request::ip();
            $date = date('Y-m-d h:m:s');
            $superadmin->Login_DateandTime = $date;
            $superadmin->Login_Type = 'Wrong Password';
            $superadmin->User_Type = 'superadmin';
            $superadmin->save();


                session()->flash('errormsg', 'Incorrect Username and Password');
                return redirect()->back()->withInput();


        }
    }

    public function addVerificationCode(Request $request)
    {
        $this->validate($request,[
            'verificationcode' =>  'required|unique:verification_codes,Verification_Code',
        ]);

        $superadmin = new VerificationCode();
        $superadmin->Verification_Code = $request['verificationcode'];
        $superadmin->save();
        session()->flash('errormsg', 'Code Added Successfully');
        return redirect()->back()->withInput();
    }

    public function accountDetails()
    {
        $data = LoginDetail::where('email',Auth::guard('superadmin')->user()->email)->orderBy('created_at','desc')->get();
        // dd($data);
        $colstart = 1;
        return view('superadmin.accountdetails')->with('data', $data)->with('colstart',$colstart);
    }


    public function deleteVerificationCode($id)
    {
        $data = VerificationCode::findorFail($id);
        $data->destroy($id);
        return redirect()->route('super_admin');
    }

    public function changeAccountStatus($id)
    {
        $admin = Admin::findorFail($id);
        $currentflagstatus = $admin->flag_en_dis;

        if($currentflagstatus == 1)
        {
            if (Auth::check())
            {
                $admindetail = new LoginDetail();
                $admindetail->email = Auth::guard('admin')->user()->email;
                $admindetail->IP_Address = \Request::ip();
                $date = date('Y-m-d h:m:s');
                $admindetail->Login_DateandTime = $date;
                $admindetail->Login_Type = 'Log Out-Disable by SuperAdmin';
                $admindetail->User_Type = 'admin';
                $admindetail->save();
                Auth::guard('admin')->logout();
            }
            $admin->flag_en_dis = 0;
            $admin->update();
        }

        if($currentflagstatus == 0)
        {
            $admin->flag_en_dis = 1;
            $admin->update();
        }
        return redirect()->route('super_admin');

    }

    public function changePassword()
    {
        $data = 'superadmin';
        return view('admin.changepassword')->with('data',$data);
    }

    public function checkChangePassword(Request $request)
    {
        $this->validate($request,[
            'currentpassword' => 'required',
            'newpassword' => 'required_with:confirmnewpassword|min:8|max:60|same:confirmnewpassword',
            'confirmnewpassword' => 'max:60'
        ]);

        $data = SuperAdmin::where('email',Auth::guard('superadmin')->user()->email)->first();

        if(Hash::check($request['currentpassword'], $data->password))
        {
            $data->password = bcrypt($request['newpassword']);
            $data->update();

            return redirect()->route('changespassword')->with('errormsg','Password Successfully Changed. You may now logout to test your new password.');
        }
        else
        {
            return redirect()->route('changespassword')->with('errormsg','Your current password is wrong.');
        }
    }

    public function viewFeedback()
    {
        $feedbacks = Feedback::all();
        return view('superadmin.feedback')->with('feedbacks',$feedbacks);
    }

    public function viewSuperAdminProfile()
    {
        $data = SuperAdmin::where('email',Auth::guard('superadmin')->user()->email)->first();
        return view('superadmin.viewprofile')->with('data',$data);
    }

    public function logout()
        {
            $admin = new LoginDetail();
            $admin->email = Auth::guard('superadmin')->user()->email;
            $admin->IP_Address = \Request::ip();
            $date = date('Y-m-d h:m:s');
            $admin->Login_DateandTime = $date;
            $admin->Login_Type = 'Log Out';
            $admin->User_Type = 'superadmin';
            $admin->save();

            Auth::guard('superadmin')->logout();
            return redirect()->route('pass');
        }
}
