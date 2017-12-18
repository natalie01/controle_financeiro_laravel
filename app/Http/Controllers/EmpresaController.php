<?php

namespace projeto_laravel\Http\Controllers;

use Carbon\Carbon;
use projeto_laravel\Empresa;
//use projeto_laravel\Caixa;
//use projeto_laravel\ContaReceber;
//use projeto_laravel\ContaPagar;
use Illuminate\Support\Facades\Request;

class EmpresaController extends Controller
{
    
    public function empresa()
    {
			//se o usuário ja tiver preenchido,redirecionar para a página de atualizar
			$user_id = $this->getUserId();				
				$hoje= $this->dataHoje();
				
				$emp =  Empresa::where('user_id','=',$user_id)->count();

			if($emp == 0){
					return view('empresa.empresa')->with('hoje',$hoje);
				}else{
					$e =  Empresa::where('user_id','=',$user_id)->get();
					$id = $e[0]->id;
					//return redirect()->action('EmpresaController@empresa_editar');
				return redirect()->action('EmpresaController@empresa_editar',['id' => $id]);
/*
					$e =  Empresa::where('user_id','=',$user_id)->get();
dd($e['id']);
					return view('empresa.empresa_editar',compact('hoje','e'));
*/
				}
		      
		  }



    public function empresa_salvar(Request $request)
  {
			
			$params = Request::all();
			$user_id = $this->getUserId();

			$nome_empresa = $params['nome_empresa'];
			$cidade = $params['cidade'];
			$estado = $params['estado'];
		
			$dt = $this->dataHoje();
	
			$saldo_inicial = $this->strToFloat($params['saldo_inicial']);
			$nao_informado = '';

			if(isset($params['nao_informado'])){
				$saldo_inicial = 0;
				//$nao_informado =$params['nao_informado'];
			}
				
			//dd($params);
	
				Empresa::create(['nome_empresa'=>$nome_empresa,
														'cidade'=>$cidade,
														'estado' => $estado,
														'saldo_inicial'=>$saldo_inicial,
														'saldo_atual'=>$saldo_inicial,
														'data_inicial'=>$dt,
														'user_id'=>$user_id
														]);

        return redirect()->action('HomeController@index');
	
    }

    public function empresa_editar($id)
    {

			$e = Empresa::find($id);
			$user_id = $this->getUserId();
				$hoje= $this->dataHoje();

			if($e->user_id != $user_id){
				return  view('erro_de_acesso');
			}else{
				return view('empresa.empresa_editar',compact('hoje','e'));
			}

		}

    public function empresa_update(Request $request, $id)
    {

			$params =$request::except(['_method','_token','msg']);
			$e = Empresa::find($id);
			$user_id = $this->getUserId();

			if($e->user_id != $user_id){
				return  view('erro_de_acesso');
			}else{
			$e->update($params);
				return redirect()->action('HomeController@index');
		}

    }
}
