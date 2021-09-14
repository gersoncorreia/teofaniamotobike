<?php

namespace App\Http\Controllers\Painel\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Support\facades\DB;
use Illuminate\Http\Request;
use App\User;

class UsuariosController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        $usuarios = User::where('status', 1)->get();
        //$query = DB::table('users')->where('status',1)->;
        //dd($usuarios);
        if(isset($usuarios)){
            return view('painel.usuarios.index', compact('usuarios'));
        }
        
    }

    public function create()
    {
        //
        return view('painel.usuarios.novo');
    }

    public function store(Request $request)
    {
        $u = new User();
        $u->name = $request->input('nome');
        $u->email = $request->input('email');
        $u->password = bcrypt($request->input('senha'));
        $u->tipo = $request->input('tipo');
        $u->status = '1';
        $u->save();

        $resposta = "sucesso";
        //return view('painel.usuarios.novo', compact('resposta'));
        return redirect('/usuarios');
    }

    public function show(Request $request)
    {
        //
    }

    public function edit($id)
    {
        $usuario = User::find($id);
        if(isset($usuario)){
            return view('painel.usuarios.editar', compact('usuario'));
        }
        return redirect('/usuarios');
    }
    public function update(Request $request, $id)
    {
        $u = User::find($id);
        if(isset($u)){
            if($request->input('senha') == ""){
                $u->name = $request->input('nome');
                $u->email = $request->input('email');
                $u->password = $u->password;
                $u->tipo = $request->input('tipo');
                $u->status = $request->input('status');
            }else{
                $u->name = $request->input('nome');
                $u->email = $request->input('email');
                $u->password = bcrypt($request->input('senha'));
                $u->tipo = $request->input('tipo');
                $u->status = $request->input('status');
            }             
            $u->save(); 
        }
        return redirect('/usuarios');
    }

    public function atualizarStatus($id){
        echo $id;
       $u = User::find($id);
        if(isset($u)){
            $u->status = '0';
            $u->update();
        }else{
            echo "Usuário não foi deletado!";
        }
       return redirect('/usuarios');
    }
    public function destroy($id)
    {
       //
    }
}
