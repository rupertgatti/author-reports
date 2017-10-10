<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Render an interface to manage users
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Render an interface to edit user details
     *
     * @param int $user_id
     * @return Response
     */
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the details of a user
     *
     * @param type $user_id
     * @param Request $request
     * @return type
     */
    public function update($user_id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'email' => ['email', 'required',
                Rule::unique('user')->ignore($user_id, 'user_id') ],
            'admin' => 'required',
            'display_sales' => 'required',
            'orcid' => 'nullable|min:20|max:40',
            'twitter' => 'nullable',
            'repositories' => 'nullable:'
        ]);

        $user = User::findOrFail($user_id);
        $input = $request->all();
        $input['admin'] = $input['admin'] === "true" ? 1 : 0;
        $input['display_sales'] = $input['display_sales'] === "true" ? 1 : 0;
        $user->fill($input);

        if ($user->save()) {
            $request->session()
                    ->flash('success','Thank you. The record has been saved.');
        } else {
            $request->session()->flash('error', 'Sorry. There was a problem.');
        }
        
        return $this->index();
    }
}
