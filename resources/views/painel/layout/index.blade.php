@includeIf('painel.layout.head')
    @if(Auth::user()->tipo == 1)
        <body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
            <div class="wrapper">
            @includeIf('painel.layout.navbar-topo')

            @includeIf('painel.layout.siderbar-lateral')
    @else
        <body class="hold-transition layout-top-nav">
            <div class="wrapper"> 
            @includeIf('painel.layout.navbar-topo-user')           
    @endif      

        <div class="content-wrapper">

            @yield('content')

        </div>
        <!-- /.content-wrapper -->

        @includeIf('painel.layout.footer')

    </div>
<!-- ./wrapper -->

@includeIf('painel.layout.end-html')

