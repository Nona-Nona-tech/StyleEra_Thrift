<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')
            ->select('id', 'name', 'email', 'created_at')
            ->where('role', 'customer')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }
}