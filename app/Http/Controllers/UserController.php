<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Isset_;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $data = $request->name ? $request->name : '';
        $users = User::query()->when($data, function ($query, $data) {
            $query->where('name', 'like', "%$data%");
        })
            ->paginate(20)->withQueryString();


        return view('index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request, User $user)
    {
        $data = $request->validated();
        $data['email'] = lcfirst($data['email']);
        $user = User::query()->create($data);
        if ($user) {
            session()->flash('success', "Пользователь $user->name успешно создан");
        }
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('create', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {

        $data = $request->validated();

        $user->update($data);
        if ($user) {
            session()->flash('success', "Пользователь $user->name успешно отредактирован");
        }
        return redirect()->route('users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with(session()->flash('success', "Пользователь $user->name удален"));
    }
}
