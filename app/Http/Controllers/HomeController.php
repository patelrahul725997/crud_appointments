<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    protected function logout(Request $req)
    {
         //dd($req->session()->all());
        try {
            Session::flush();
            Auth::logout();      
            return redirect('login');
        } catch (JWTException $e) {           
            Session::flash('error', $e->getMessage());           
            return redirect('dashboard');  
        }
    } 

    public function sendEmail()
    {
                
        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
        ];
        Mail::to('rahulpatel@siliconithub.com')->send(new TestMail($details));

        //\Mail::to('rahulpatel@siliconithub.com')->send(new \App\Mail\TestMail($details));
        dd("Email is Sent.");

    } 
}
