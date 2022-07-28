<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    public function create(User $user)
    {
        return view('create', compact('user'));
    }

    public function show(User $user)
    {
        return view('view', compact('user'));
    }

    public function update(User $user, UserRequest $request)
    {
        $user->appendUserComments($request->get('comment'));

        return redirect()->route('users.show', compact('user'));
    }

    public function storeJson(User $user, UserRequest $request)
    {
        try {
            $user->appendUserComments($request->get('comment'));

            return response()->json([
                'message' => 'OK'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong '. $e->getMessage()
            ], 200);
        }
    }
}
