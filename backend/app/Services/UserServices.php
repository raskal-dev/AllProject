<?php

namespace App\Services;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;

class UserServices extends BaseController
{

    /**
    * parm: void
    * return: Illuminate\Http\JsonResponse
    */
    public function index()
    {
        $users = User::all();
        return $this->sendResponse($users);
    }

    public function store($request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return $this->sendResponse([], 'User Created Successfully', 201);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) return $this->sendResponse([], 'User not found', 404);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = $user->createToken('user_token')->accessToken;
            return $this->sendResponse(['token' => $token], 'User Logged In Successfully');
        }

        return $this->sendResponse([], 'Invalid Credentials', 401);
    }

    public function logout()
    {
        $tokens = Auth::user()->tokens;
        $tokenRepository = app(TokenRepository::class);

        foreach ($tokens as $token) {
            $tokenRepository->revokeAccessToken($token->id);
        }

        return $this->sendResponse([], 'User Logged Out Successfully');
    }

    public function updateUser(Request $request, $user)
    {
        User::find($user)->update($request->all());
        return $this->sendResponse([], 'User Updated Successfully');
    }

    public function deleteUser($user)
    {
        User::find($user)->delete();
        return $this->sendResponse([], 'User Deleted Successfully');
    }
}