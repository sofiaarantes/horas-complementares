<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Editar PPC</title>

    <link href="{{ asset('bootstrap/img/logo.png') }}" rel="icon" type="image/png">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet') }}" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom styles for this template-->
    <link href="{{ asset('bootstrap/css/sb-admin-2.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <div class="container mt-5">

                    <!-- Título -->
                    <div class="text-center mb-4">
                        <h2 class="font-weight-bold text-primary">Editar PPC</h2>
                    </div>

                    <form action="{{ route('atualizarPpc', $ppc->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="ano">Ano do Ppc</label>
                            <input type="number" class="form-control" id="ano" name="ano" value="{{ old('ano', $ppc->ano) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="limite_horas">Limite de Horas do Ppc</label>
                            <input type="number" class="form-control" id="limite_horas" name="limite_horas" value="{{ old('limite_horas', $ppc->limite_horas) }}" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">
                            <i class="fas fa-save mr-2"></i> Salvar
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3 ml-2">
                            <i class="fas fa-arrow-left mr-1"></i> Voltar
                        </a>
                    </form>

                    <br>
                    <a href="{{ route('criarAtividade', $ppc_id) }}" class="btn btn-primary">
                        <i class="fas fa-upload mr-2"></i> Criar nova atividade
                    </a>
                    <br><br>

                    <!-- Lista de atividades existentes -->
                    @foreach($atividades as $atividade)
                        <div class="card shadow mb-3">
                            <div class="card-body">
                                <h5><strong>Atividade:</strong> {{ $atividade->atividade }}</h5>
                                <p><strong>Limite de Horas:</strong> {{ $atividade->limite_horas }} Horas</p>
                                <p><strong>Criada em:</strong> {{ $atividade->created_at->format('d/m/Y') }}</p>
                                <div class="d-flex justify-content-between">
                                    <div><span></span></div>
                                    <div>
                                        <a href="{{ route('editarAtividade', $atividade->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye mr-1"></i> Editar
                                        </a>
                                        <form action="{{ route('excluirAtividade', $atividade->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir esta atividade?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mr-2">
                                                <i class="fas fa-times-circle mr-1"></i> Excluir
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deseja realmente sair?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Escolha "Sair" se realmente deseja encerrar sessão.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Sair</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('bootstrap/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('bootstrap/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('bootstrap/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('bootstrap/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('bootstrap/js/demo/chart-area-demo.js') }}"></script>

</body>

</html>