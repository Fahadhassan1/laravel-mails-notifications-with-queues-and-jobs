<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounts;
use Illuminate\Support\Facades\Auth;

class AccountsLoginController extends Controller
{
    

    // show the login form 
    public function login()
    {
        return view('accounts.login');
    } 
    // Login Function
    public function authlogin(Request $request)
    {


        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //convert the password to hash
        $password = hash('sha256', $request->password);
    
        $account = Accounts::where('email', $request->email)
        ->where('password', $password)
        ->first();

        echo '<pre>'; print_r($account); echo '</pre>';
        die();



        // This function let me login inside the system
        // Auth::login($account);



        // Check if the account exists
        if ($account) {
            // If login is successful, redirect to the dashboard or home page
            return redirect()->route('dashboard')->with('success', 'Login successful.');
        }

      

        // If login fails, redirect back with an error message
        return redirect()->back()->with('error', 'Invalid credentials.');
    }


}
