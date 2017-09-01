 
<nav class="navbar-inverse navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand title-app" href="{{ url('/home') }}">
                Arte Studio
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class="{{Request::segment(1)=='alunos'?'active':null}}">
                    <a href="{{ route('alunos.index') }}">Alunos</a>
                </li>
               <li class="dropdown {{Request::segment(1)=='teachers'?'active':null}}">
                    <a href="#" class="dropdown-toggle" 
                       data-toggle="dropdown" role="button"  aria-expanded="false">
                        Professores <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('teachers.index') }}">Gerenciar</a></li>
                        <li><a href="{{ route('payments.index') }}">Pagamentos</a></li>
                        
                    </ul>
                </li>
                <li class="{{Request::segment(1)=='turmas'?'active':null}}">
                    <a href="{{ route('turmas.index') }}">Turmas</a>
                </li>
                <li class="{{Request::segment(1)=='contratos'?'active':null}}">
                    <a href="{{ route('contratos.index') }}">Contratos</a>
                </li>
                 <li class="{{Request::segment(1)=='despesas'?'active':null}}">
                    <a href="{{ route('despesas.index') }}">Despesas</a>
                </li>
                 <li class="{{Request::segment(1)=='produtos'?'active':null}}">
                    <a href="{{ route('produtos.index') }}">Produtos</a>
                </li>
                 <li class="{{Request::segment(1)=='vendas'?'active':null}}">
                    <a href="{{ route('vendas.index') }}">Vendas</a>
                </li>
                
                 <li class="dropdown {{Request::segment(1)=='relatorio'?'active':null}}">
                    <a href="#" class="dropdown-toggle" 
                       data-toggle="dropdown" role="button"  aria-expanded="false">
                        Relatório <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('relatorio.venda') }}">de Venda</a></li>
                        <li><a href="{{ route('relatorio.contrato') }}">de Contrato</a></li>
                        <li><a href="{{ route('relatorio.mensalidade')}}">de Mensalidade</a></li>
                        <li><a href="{{ route('relatorio.geral')}}">Geral</a></li>
                    </ul>
                </li>
                
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>

                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
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
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
