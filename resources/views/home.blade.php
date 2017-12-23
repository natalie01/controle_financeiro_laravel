@extends('layouts.app')
@section('content')
<h3>Página Inicial</h3>
<p>{{$dt}}</p>
<div class="boxes">
  <div class="box">
     <div class="box-item">
  		<p style ="text-align:center;font-weight:bold;">Previsto / Realizado este M<span>&ecirc;</span>s</li></p>
 	 </div>
	 <div class="box-item">
      <ul class = "list-unstyled list-inline list-flex">
        <li class ="list-flex-item">Recebimentos</li>
        <li class ="list-flex-item">
            <ul class = "list-unstyled ">
             <li>Previsto : {{ $recebimentos_previstos_mes }} <span>&nbsp;</span>R<span>&dollar;</span></li>
             <li>Realizado :{{ $recebimentos_feitos_mes }} <span>&nbsp;</span>R<span>&dollar;</span></li>
            <li>Falta :{{ $recebimentos_falta_mes }}<span>&nbsp;</span>R<span>&dollar;</span></li>
            </ul>
        </li>
        <li class ="list-flex-item">{{ $porcent_receb_mes }}  % </li>
      </ul>
 	 </div>
	 <div class="box-item">
        <ul class = "list-unstyled list-inline list-flex">
        <li class ="list-flex-item">Pagamentos</li>
        <li class ="list-flex-item">
            <ul class = "list-unstyled ">
             <li>Previsto : {{ $pagamentos_previstos_mes }} <span>&nbsp;</span>R<span>&dollar;</span></li>
             <li>Realizado : {{ $pagamentos_feitos_mes }}  <span>&nbsp;</span>R<span>&dollar;</span></li>
             <li>Falta :  {{ $pagamentos_falta_mes }}  <span>&nbsp;</span>R<span>&dollar;</span></li>
            </ul>
        </li>
        <li class ="list-flex-item">{{ $porcent_pag_mes }}  % </li>
      </ul>
 	 </div> 
  </div>


 <div class="box">
  	  <div class="box-item">
  		<p style="font-size:24px;text-align:center"">Saldo Conta Principal</p>
 	 </div>
	 <div class="box-item">
        <p  style="font-size:40px;text-align:center">
						{{$saldo_atual}}<span>&nbsp;</span>R<span>&dollar;</span> 
				</p>
 	 </div>
	 <div class="box-item">
        <ul class = "list-unstyled list-inline list-flex">
        <li class ="list-flex-item">Este M<span>&ecirc;</span>s</li>
        <li class ="list-flex-item" style="font-size:22px;">
            <ul class = "list-unstyled ">
             <li style="color:#337ab7">Receitas :  {{$soma_receitas_mes}} <span>&nbsp;</span>R<span>&dollar;</span></li>
             <li style="color:#d9534f;">Despesas :  {{$soma_despesas_mes}} <span>&nbsp;</span>R<span>&dollar;</span></li>
						<li>-------------------</li>
						<li style="font-weight:bold;">Total : 
								<span  id = "saldo-mes">{{$saldo_mes}}</span> 
								<span>&nbsp;</span>R<span>&dollar;</span></li>
            </ul>
        </li>

      </ul>
 	 </div>   
</div>

  <div class="box">
  	  <div class="box-1-item">
  		<p style ="text-align:center;font-weight:bold;">Contas em Atraso </p>
 	 </div>
	 <div class="box-item">
    
          <ul class = "list-unstyled" style="padding:15px;">
          <li style="font-size:22px;">Vencidas este M<span>&ecirc;</span>s</li>
             <li style="font-size:16px;">Recebimentos :  {{ $recebimentos_atraso_mes }} <span>&nbsp;</span>R<span>&dollar;</span></li>
             <li style="font-size:16px;">Pagamentos : {{ $pagamentos_atraso_mes }} <span>&nbsp;</span>R<span>&dollar;</span></li>
            </ul>
  	 </div>
     
 <div class="box-item">        
          <ul class = "list-unstyled" style="padding:15px;">
          <li style="font-size:22px;">Todas</li>
             <li style="font-size:16px;">Recebimentos : {{ $recebimentos_atraso_todos }} <span>&nbsp;</span>R<span>&dollar;</span></li>
             <li style="font-size:16px;">Pagamentos :  {{ $pagamentos_atraso_todos }}  <span>&nbsp;</span>R<span>&dollar;</span></li>
            </ul>
 	 </div>  
</div>

  <div class="box">
    <canvas  id="myChart" width="200" height="150"></canvas>
</div>

  <div class="box">
 	  <div class="box-item">
  		Hoje
 	 </div>
	 <div class="box-item">
    
          <ul class = "list-unstyled" style="padding:15px;">
          <li style="font-size:22px;">Vencimentos</li>
             <li style="font-size:16px;">Recebimentos : {{ $recebimentos_previstos_hoje }} <span>&nbsp;</span>R<span>&dollar;</span></li>
             <li style="font-size:16px;">Pagamentos : {{ $pagamentos_previstos_hoje }} <span>&nbsp;</span>R<span>&dollar;</span></li>
            </ul>
  	 </div>
 <div class="box-item">        
 	 </div> 
</div>

  <div class="box">6</div>
</div>

@if(isset($soma_receitas_3m))
<p id ="r3m"  style="display:none;" >{{$soma_receitas_3m}}</p>
@endif

@if(isset($soma_despesas_3m))
<p id= "r3d" style="display:none;" >{{$soma_despesas_3m}}</p>
@endif

@endsection
