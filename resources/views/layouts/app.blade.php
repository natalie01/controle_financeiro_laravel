<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
<link href = "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"rel="stylesheet">
   <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <div id="app" class=" wrapper">
            <!-- Sidebar Holder -->
					@if(!Auth::guest())

            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>$$$$</h3>
                    <strong>$$</strong>
                </div>

                <ul class="list-unstyled components">
                    <li class="active">
                        <a href="/home">
                            <i class="fa fa-dashboard" aria-hidden="true"></i>
                            <span>Home</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('despesas_fixas.index')}}">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                            <span>Despesas Fixas</span>
                        </a>
                    </li>

                    <li>
                        <a href="#clientesSubmenu" data-toggle="collapse" aria-expanded="false" ">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            Clientes
                        </a>
												 <ul class="collapse list-unstyled" id="clientesSubmenu">
                            <li><a href="{{route('cliente.create')}}" >Novo</a></li>
                            <li><a href="{{route('cliente.index')}}" >Lista</a></li>
                        </ul>
	  
                    </li>
                    <li>
                        <a href="#fornecedoresSubmenu" data-toggle="collapse" aria-expanded="false"  >
                          <i class="fa fa-truck" aria-hidden="true"></i>
                            <span>Fornece-</span><br/><span>dores</span>
                        </a>
												 <ul class="collapse list-unstyled" id="fornecedoresSubmenu">
                            <li><a href="{{route('fornecedor.create')}}" >Novo</a></li>
                            <li><a href="{{route('fornecedor.index')}}" >Lista</a></li>
                        </ul>
	  
                    </li>

									
										<li>
                        <a href="#movimentacoesSubmenu" data-toggle="collapse" aria-expanded="false">
                             <i class="fa fa-usd" aria-hidden="true"></i>
                            <span>Movimen-</span><span>ta</span><span>&ccedil;</span><span>&otilde;</span>es
                        </a>
												 <ul class="collapse list-unstyled" id="movimentacoesSubmenu">
                            <li><a href="{{route('contapagar.create')}}" >Novo Lancamentos a Pagar</a></li>
                            <li><a href="{{route('contareceber.create')}}" >Novo Lancamentos Receber</a></li>
           									<li><a href="/novareceita" >Nova Receita</a></li>
                            <li><a href="/novadespesa" >Nova Despesa</a></li>
                        </ul>
	  
                    </li>

											<li>
                        <a href="#relatoriosSubmenu" data-toggle="collapse" aria-expanded="false"  >
                             <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            Relatórios
                        </a>
												 <ul class="collapse list-unstyled" id="relatoriosSubmenu">
                            <li><a href="/relatorio_caixa" >Fluxo de Caixa</a></li>
                            <li><a href="{{route('contareceber.index')}}" >Contas Receber</a></li>
                            <li><a href="{{route('contapagar.index')}}" >Contas Pagar</a></li>
                        </ul>
	  
                    </li>
             
                </ul>

            </nav>

					@endif
<!-- Page Content Holder -->
        <div id="content">
  	        <nav class="navbar navbar-default" style="background-color:rgb(34, 34, 34);">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                               <i class="fa fa-bars" aria-hidden="true"></i>
                             
                            </button>
                        </div>

                        <div>
                            <ul class="nav navbar-nav navbar-right">
 			 									@guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                           <li>
		                        <a id = "username">
		                            Hello ,{{ Auth::user()->name }}
		                        </a>
													</li>

                         <li>
                              <a href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                  Logout
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                          </li>
                        @endguest
                            </ul>
                        </div>
                    </div>
                </nav>

     @yield('content')
	</div>

   
    </div>

    <!-- Scripts -->


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	 
<script src="{{ asset('js/index.js') }}"></script>


</body>
</html>
