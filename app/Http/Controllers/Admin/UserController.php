<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): Factory|View|Application
    {
        $users = User::paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function orders(User $user): Factory|View|Application
    {
        $orders = $user->orders;
        return view('admin.user.orders', compact('orders'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        session()->flash('warning', "Пользователь $user->email удалён");
        return redirect()->route('admin.users.index');
    }
}
