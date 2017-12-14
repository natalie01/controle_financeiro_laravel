<?php

namespace projeto_laravel\Http\Controllers;

use Illuminate\Support\Facades\DB;
use projeto_laravel\Cliente;
use Request;
use projeto_laravel\Http\Requests\ClientesRequest;

class ClienteController extends Controller
{
		public function __construct()
		{
				$this->middleware('auth');
		}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
			$user_id = $this->getUserId();

			$clientes = Cliente::where('user_id',$user_id)->get();
			return view('cliente.clientes_index')->with('clientes',$clientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
			return view('cliente.novo_cliente');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientesRequest $request){
			
			$params = request::all();
			 //$user = Auth::user();
			$user_id = $this->getUserId();
			$usuario = array('user_id'=>$user_id);

			$params2 = array_merge($params,$usuario);

			Cliente::create($params2);

			return redirect()
					->route('cliente.index')
					->withInput(Request::only('nome'));
					
	}	
    /**
     * Display the specified resource.
     *
     * @param  \projeto_laravel\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */

  public function lista(){
	if(DB::connection()->getDatabaseName())
	   {
	     echo "connected sucessfully to database ",DB::connection()->getDatabaseName();
	   }
		
		$clientes = Cliente::all();

		

		//return view('clientes_index')->with('clientes',$clientes);

		return view('cliente.clientes_listagem');
	}
	



    public function show($id)
    {
    
    //
		//$user = Auth::user();
		$cliente = Cliente::find($id);

		$user_id = $this->getUserId();
		if($cliente->user_id != $user_id){
			return  view('erro_de_acesso');
		}else{
			return view('cliente.cliente_mostra')->with('cliente',$cliente);
    }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \projeto_laravel\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

			$cliente = Cliente::find($id);
			$user_id = $this->getUserId();

			if($cliente->user_id != $user_id){
				return  view('erro_de_acesso');
			}else{
				return view('cliente.cliente_editar')->with('c', $cliente);
			}

		}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \projeto_laravel\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(ClientesRequest $request, $id)
    {

		$user_id = $this->getUserId();
		$cliente = Cliente::find($id);
	
		if($cliente->user_id != $user_id){
			return  view('erro_de_acesso');
		}else{
			Cliente::find($id)->update($request->all());
				return redirect()
					->route('cliente.index')
					->withInput(Request::only('nome'));
		}

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \projeto_laravel\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
	
			$user_id = $this->getUserId();

			$cliente = Cliente::find($id);
			$c_nome = $cliente->nome;
		
		if($cliente->user_id != $user_id){
			return  view('erro_de_acesso');
		}else{
			$cliente->delete();
			return redirect()
					->route('cliente.index')->with('cliente_nome', $c_nome);
					
    }
	}


}
