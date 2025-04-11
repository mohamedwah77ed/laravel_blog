<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    
    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    
    
    public function login(Request $request)
{
    
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    
    if (Auth::guard('admin')->attempt($credentials)) {
        $user = Auth::guard('admin')->user();

        if ($user->is_admin) {
            $request->session()->regenerate(); // تجديد السيشن لتأمين الاتصال

            return redirect()->intended(route('admin.index'))->with('success', 'تم تسجيل الدخول بنجاح!');
        }

        Auth::guard('admin')->logout();
        return back()->withErrors(['email' => 'غير مسموح لك بالدخول كأدمن.']);
    }

    return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة.']);
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}