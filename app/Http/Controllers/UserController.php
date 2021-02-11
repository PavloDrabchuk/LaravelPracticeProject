<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:40',
            'phone' => 'required|unique:users',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|min:8|same:password',
        ]);

        //  User::create($request->all());
        User::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('users.index')
            ->with('ok', 'User successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View|Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View|Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:40',
            'phone' => 'required',
            'password' => 'required|string|confirmed|min:8'
        ]);

        $user->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect()->route('users.index')
            ->with('ok', 'User successfully updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('ok', 'User successfully deleted.');
    }

    function login(Request $request)
    {
        $user = User::where('phone', $request->input('phone'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken('login-api-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            Cart::create([
                'user_id' => $user->id,
            ])->save();
        }

        return response($response, 201);
    }

}
