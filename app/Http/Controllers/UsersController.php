<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('list', User::class);
        $accounts = User::all();
        return view('users.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $roles = Role::pluck('name', 'id');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->authorize('create', User::class);
        } catch (AuthorizationException $e) {
            Log::error($e->getMessage());
            return back()->withAlerts([
                ['message' => 'Operazione non consentita.', 'type' => 'error']
            ]);
        }

        $validator = Validator::make($request->all(), [
            'password' => 'same:password_check',
            'roles' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withAlerts([['message' => 'Le password non corrispondono', 'type' => 'error']])
                ->withInput();
        }
        DB::beginTransaction();
        try {
            $account = new User();
            $extra = ['password' => bcrypt(request('password'))];
            $account->fill(array_merge($request->all(), $extra));
            $account->save();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->withAlerts([
                ['message' => 'Errore durante la creazione dell\'account.', 'type' => 'error']
            ]);
        }
        foreach ($request->get('roles') as $role)
            try {
                $account->roles()->save(Role::findOrFail($role));
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                return redirect()->back()->withAlerts([
                    ['message' => 'Errore durante la creazione dell\'account.', 'type' => 'error']
                ]);
            }
        DB::commit();
        return redirect()->route('users::index')->withAlerts([
            ['message' => 'Account creato con successo.', 'type' => 'success']
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = User::with('roles')->findOrFail($id);
        $roles = Role::pluck('name', 'id');
        return view('users.edit', compact('account', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'same:password_check',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withAlerts([['message' => 'Le password non corrispondono', 'type' => 'error']]);
        }

        $account = User::findOrFail($id);
        try {
            $this->authorize('update', $account);
        } catch (AuthorizationException $e) {
            Log::error($e->getMessage());
            return back()->withAlerts([
                ['message' => 'Operazione non consentita.', 'type' => 'error']
            ]);
        }


        DB::beginTransaction();
        try {
            $extra = [];
            if (!empty($password = request('password'))) {
                $extra = ['password' => bcrypt($password)];
            }

            $account->fill(array_merge($request->except('password'), $extra));
            $account->save();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->withAlerts([
                ['message' => 'Si è verificato un errore durante la modifica dell\'account.', 'type' => 'error']
            ]);
        }
        if(Gate::allows('manage_users_roles') && !empty($request->get('roles'))){
            $account->roles()->detach();
            foreach ($request->get('roles') as $role)
                try {
                    $account->roles()->save(Role::findOrFail($role));
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error($e->getMessage());
                    return redirect()->back()->withAlerts([
                        ['message' => 'Errore durante la modifica dell\'account.', 'type' => 'error']
                    ]);
                }
        }

        DB::commit();
        if(Gate::allows('list_users')){
            return redirect()->route('users::index',$account->id)->withAlerts([
                ['message' => 'Account modificato correttamente.', 'type' => 'success']
            ]);
        }
        return redirect()->route('users::edit',$account->id)->withAlerts([
            ['message' => 'Account modificato correttamente.', 'type' => 'success']
        ]);

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws AuthorizationException
     */
    public function delete($id)
    {
        $account = User::findOrFail($id);
        $this->authorize('delete', $account);

        return view('users.delete', compact('account'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $account = User::findOrFail($id);
            $this->authorize('delete', $account);
            $account->delete();
        } catch (AuthorizationException $e) {
            Log::error($e->getMessage());
            return back()->withAlerts([
                ['message' => 'Operazione non consentita.', 'type' => 'error']
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withAlerts([
                ['message' => 'Si è verificato un errore, non è stato possibile cancellare l\'account.', 'type' => 'error']
            ]);
        }

        return redirect()->route('users::index')->withAlerts([
            ['message' => 'Account eliminato correttamente.', 'type' => 'success']
        ]);
    }
}
