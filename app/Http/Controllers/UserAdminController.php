<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function dashboard()
    {
        return view('UserAdmin.dashboard');
    }  
    public function profile()
    {
        return view('UserAdmin.profile');
    }  
    public function sub_user()
    {
        return view('UserAdmin.sub_user');
    }  
    public function payment_bill()
    {
        return view('UserAdmin.payment_bill');
    }  
    public function application()
    {
        return view('UserAdmin.application');
    }
    public function application_list()
    {
        return view('UserAdmin.application_list');
    }
    public function application_history()
    {
        return view('UserAdmin.application_history');
    } 
    public function support()
    {
        return view('UserAdmin.support');
    }  
    public function open_support()
    {
       return view('UserAdmin.open_ticket'); 
    }
    public function promotion()
    {
        return view('UserAdmin.promotion');
    } 
    public function create_sub_user()
    {
        return view('UserAdmin.new_sub_user');
    }                                                          
}
