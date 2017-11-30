<?php

namespace projeto_laravel\Http\Controllers;

use Illuminate\Support\Facades\DB;
use projeto_laravel\Cliente;
use Request;
use projeto_laravel\Http\Requests\ClientesRequest;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$clientes = Cliente::all();
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
			Cliente::create($params);
		
				/*	return redirect()
					->action('ClienteController@lista')
					->withInput(Request::only('nome'));
	*/
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
	



    public function show(Cliente $cliente)
    {
        //
			return view('cliente.cliente_mostra')->with('cliente',$cliente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \projeto_laravel\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$cliente = Cliente::find($id);
		echo "editar produto".$id;
		return view('cliente.cliente_editar')->with('c', $cliente);
	
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
        //

	  Cliente::find($id)->update($request->all());
		return redirect()
					->route('cliente.index')
					->withInput(Request::only('nome'));

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
			$cliente = Cliente::find($id);
			$c_nome = $cliente->nome;
			$cliente->delete();
			return redirect()
					->route('cliente.index')->with('cliente_nome', $c_nome);
					
    }
}
