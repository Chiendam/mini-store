<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function getLoginForm(): Factory|View|Application
    {
        return view('admin.pages.auth.login');
    }

    public function login(AuthLoginRequest $request): RedirectResponse
    {
        $request->merge([$this->username() => request()->input('username')]);
        $credentials = request([$this->username(), 'password']);
        if (!auth()->attempt($credentials)) {
            return redirect()->back()
                ->withErrors(['username' => ['Vui lòng kiểm tra lại tài khoản hoặc mật khẩu!']])
                ->withInput();
        }

        if (auth()->user()->status === 0) {
            auth()->logout();

            return redirect()->back()
                ->withErrors(['username' => ['Tài khoản của bạn đã bị khoá, Vui lòng liên hệ quản trị viên!']])
                ->withInput();
        }

        return redirect()->route('admin.dashboard');
    }

    private function username(): string
    {
        return filter_var(request()->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.pages.auth.profile')->with(compact('user'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        $roles = RoleEnum::displayAll();
        return view('admin.pages.auth.profile-edit')->with(compact('user', 'roles'));
    }

    public function updateProfile(UserUpdateRequest $request, string $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $data = $request->all();
            $user = User::where('_id', $id)->first();

            $user?->fill(array_merge($data, [
                'update_by' => auth()->id(),
            ]));
            $user?->save();
            $request->session()->flash('success', 'Cập nhật tài khoản thành công');

            return redirect()->route('admin.profile');

        } catch (\Exception $exception) {
            Log::error('Error update user', [
                'method' => __METHOD__,
                'message' => $exception->getMessage()
            ]);

            return redirect()->back()
                ->withErrors(['error' => ['Không thể cập nhật tài khoản']])
                ->withInput();
        }
    }
}
