<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
{
    $role = auth()->user()->role;

    if ($role === 'admin') {
        return route('admin.dashboard');
    } elseif ($role === 'staff') {
        return route('staff.dashboard');
    }

    return '/'; // fallback
}
    

    // ... rest of the controller code
}