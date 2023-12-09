<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Exports\UsersExport;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Imports\UsersImport;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $data = $request->only(['q', 'limit']);

        $users = $this->userRepository->getUsersPaginate($data);

        return view('admin.pages.users.index')->with([
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = RoleEnum::displayAll();
        return view('admin.pages.users.create')->with(compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $data = $request->all();
            $authId = auth()->id();
            $user = $this->userRepository->create(array_merge($data, [
                'created_by' => $authId,
                'updated_by' => $authId,
            ]));
            $request->session()->flash('success', 'Tạo mới tài khoản thành công');
            return redirect()->route('admin.users.index');

        } catch (\Exception $exception) {
            Log::error('Error store users', [
                'method' => __METHOD__,
                'message' => $exception->getMessage()
            ]);

            return redirect()->back()
                ->withErrors(['error' => ['Không thể tạo mới tài khoản']])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->userRepository->find($id);
        $roles = RoleEnum::displayAll();
        return view('admin.pages.users.update')->with(compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $data = $request->all();
            $user = $this->userRepository->find($id);

            $user?->fill(array_merge($data, [
                'updated_by' => auth()->id(),
            ]));
            $user?->save();
            $request->session()->flash('success', 'Cập nhật tài khoản thành công');

            return redirect()->route('admin.users.index');

        } catch (\Exception $exception) {
            Log::error('Error update users', [
                'method' => __METHOD__,
                'message' => $exception->getMessage()
            ]);

            return redirect()->back()
                ->withErrors(['error' => ['Không thể cập nhật tài khoản']])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->userRepository->delete($id);

            session()->flash('success', 'Xóa tài khoản thành công');

            return redirect()->route('admin.users.index');

        } catch (\Exception $exception) {
            Log::error('Error delete users', [
                'method' => __METHOD__,
                'message' => $exception->getMessage()
            ]);
            return redirect()->back()
                ->withErrors(['error' => ['Không thể xóa tài khoản']])
                ->withInput();
        }
    }

    public function importFile(Request $request)
    {
        try {
            $authId = auth()->id();
            $userArrays = Excel::toCollection(new UsersImport, $request->file('file'))->first()?->toArray();
            $this->userRepository->createMany($userArrays);
            session()->flash('success', 'Import tài khoản thành công');

            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => [$e->getMessage()]])
                ->withInput();
        }
    }

    public function downloadFile()
    {
        $file = public_path() . '/template/file-template.xlsx';
        return response()->download($file, 'file-template.xlsx');
    }

    public function exportFile()
    {
        return Excel::download(new UsersExport, 'danh-sach-nguoi-dung.xlsx');
    }
}
