<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Jobs\StoreUserJob;
use App\Jobs\UpdateUserJob;
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
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        StoreUserJob::dispatchSync($request->validated());

        return redirect()
            ->route('users.index')
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
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        UpdateUserJob::dispatchSync($request->validated(), $user);

        return redirect()
            ->route('users.index')
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

        return redirect()
            ->route('users.index')
            ->with('ok', 'User successfully deleted.');
    }

    /**
     *
     * @OA\Post(
     *      path="/login",
     *      operationId="login",
     *      tags={"Authorization"},
     *      summary="Login to use API",
     *      description="Authentication",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass user credentials",
     *          @OA\JsonContent(
     *          type="object",
     *          required={"phone","password"},
     *          @OA\Property(property="phone", type="string" , example="380123456789"),
     *          @OA\Property(property="password", type="string", format="password", example="password")
     *    ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *     @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    function login(Request $request)
    {
        $user = User::where('phone', $request->input('phone'))->first();

        if (empty($request) || !$user || !Hash::check($request->input('password'), $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken('login-api-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        Cart::where('user_id', $user->id)->firstOrCreate([
            'user_id' => $user->id,
        ]);

        return response($response, 201);
    }

    /**
     *
     * @OA\Post(
     *      path="/logout",
     *      operationId="logout",
     *      tags={"Authorization"},
     *      summary="Logout",
     *      description="User logout",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *     @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     *
     * @return Application|ResponseFactory|Response
     */
    function logout()
    {
        $user = request()->user();

        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response([
            'message' => ['Logout was successful.']
        ], 200);
    }

}
