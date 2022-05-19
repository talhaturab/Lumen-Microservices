<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

        /**
     * Return the list of users
     *
     * @return void
     */
    public function index()
    {
        $users = User::all();

        return $this->validResponse($users);
    }

    /**
     * create one new user
     *
     * @return void
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);

        $user = User::create($fields);

        return $this->validResponse($user, Response::HTTP_CREATED);
    }

    /**
     * obtains and show one user
     *
     * @return void
     */
    public function show($user)
    {
        $user = User::findOrFail($user);

        return $this->validResponse($user);
    }

    /**
     * update on existing user
     *
     * @return void
     */
    public function update(Request $request, $user)
    {
        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:users,email,' . $user,
            'password' => 'min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $user = User::findorFail($user);

        $user->fill($request->all());

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if($user->isClean()) {
            return $this->errorResponse('Atleast one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();

        return $this->validResponse($user);
    }

    /**
     * remove an existing user
     *
     * @return void
     */
    public function destroy($user)
    {
        $user = User::findorFail($user);

        $user->delete();

        return $this->validResponse($user);
    }

    /**
     * identify an existing User
     * @return illuminate/http/response
     */

     public function me(Request $request)
     {
        return $this->validResponse($request->user());
     }
}