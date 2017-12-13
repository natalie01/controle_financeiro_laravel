@extends('layouts.app')
@section('content')
<p>{{$hoje}}</p>
<h1>Empresa</h1>

<div class="container" id ="panel">
     <form action="/empresa_salvar" id="form1" class="form-horizontal"  method="post">
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		
			<div class="row">
				<div class="col-md-6">
				   <div class="form-group">
				     <label>Nome da Empresa:</label><br />
				    <input type="text" name="nome_empresa" class="form-control"/>  
				  </div>
       </div>
      </div> 

		<div class = "row">
			<div class="col-md-6">
          <div class="form-group">
					  <label>Cidade:</label><br />
					  <input type="text" name="cidade" id="cidade" size="50" class="form-control"/>
		 			</div>
      </div>
            
			<div class="col-md-3">
        <div class="form-group">
					<label>Estado:</label><br />
					<select id="estado" name="estado" class="col-md-12"> 
						  <option value="ac">Acre</option> 
						  <option value="al">Alagoas</option> 
						  <option value="am">Amazonas</option> 
						  <option value="ap">Amapá</option> 
						  <option value="ba">Bahia</option> 
						  <option value="ce">Ceará</option> 
						  <option value="df">Distrito Federal</option> 
						  <option value="es">Espírito Santo</option> 
						  <option value="go">Goiás</option> 
						  <option value="ma">Maranhão</option> 
						  <option value="mt">Mato Grosso</option> 
						  <option value="ms">Mato Grosso do Sul</option> 
						  <option value="mg">Minas Gerais</option> 
						  <option value="pa">Pará</option> 
						  <option value="pb">Paraíba</option> 
						  <option value="pr">Paraná</option> 
						  <option value="pe">Pernambuco</option> 
						  <option value="pi">Piauí</option> 
						  <option value="rj">Rio de Janeiro</option> 
						  <option value="rn">Rio Grande do Norte</option> 
						  <option value="ro">Rondônia</option> 
						  <option value="rs">Rio Grande do Sul</option> 
						  <option value="rr">Roraima</option> 
						  <option value="sc">Santa Catarina</option> 
						  <option value="se">Sergipe</option> 
						  <option value="sp">São Paulo</option> 
						  <option value="to">Tocantins</option> 
						 </select>
	 	    </div><!--form-group-->
       </div><!--col-md-3-->
	 	</div><!--row-->
 
   <div class="row">      
       <div class="col-md-4">
				<div class="form-group">
         	<label>Saldo Inicial:</label><br />
		     	<div class="input-group ">
						<span class="input-group-addon">R$</span>
						<input type="text" placeholder="0,00" name = "saldo_inicial" class="form-control" style="width:50%;" aria-label="valor em reais">
				 </div>
			</div>
			<input type="checkbox" name="nao_informado" value = "off"/>
			  <span>&nbsp;</span>
		  <label>N<span>&atilde;</span>o desejo informar</label>
		 </div><!--col-md-4-->
 	</div><!--row-->

		<br>

   	 <input type="submit" class= "btn btn-primary" value="Salvar" />
 </form>
</div>

@endsection