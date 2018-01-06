<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserSecurityRequest;
use App\User;

class UsersController extends Controller {

    public function __construct()
    {
        $this->middleware('adm')->except(['showChangePassword','updatePassword']);
    }
    public function showChangePassword()
    {
        return view('users.change_password');
    }

    public function updatePassword(UserSecurityRequest $request)
    {

        $user = \Auth::user();
        $new_password = $request->input('password');
        $user->password = \Hash::make($new_password);
        $user->save();
        \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('Senha Alterada com Sucesso!')]);
        return back();
    }

    public function index()
    {
        
        $users = User::allUsers()->get();
        return view("users.index", compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        $dados=  $this->tratarDados($request->all());
        User::create($dados);
        \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionCreate')]);
        return redirect('users');
    }

    public function show($id)
    {
        return "show";
    }

    public function edit(User $user)
    {
          unset($user->password);
          return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {

        $dados=  $this->tratarDados($request->all());
        $user->update($dados);
        \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionUpdate')]);
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {

        $retorno = $user->delete();
        if ($retorno):
            \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionDelete')]);
        endif;

        return redirect()->route('users.index');
    }

    private function tratarDados($dados)
    {
        if($dados['password']):
            $dados['password']=  bcrypt($dados['password']);
        else:
            unset($dados['password']);
        endif;
        return $dados;
    }

}
