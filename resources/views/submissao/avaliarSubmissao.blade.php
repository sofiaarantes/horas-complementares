<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Avaliar Submissão</title>

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
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="container mt-5">
                        <div class="text-center mb-4">
                            <h2 class="font-weight-bold text-primary">Avaliar Submissão</h2>
                        </div>
                    </div>
                    <!-- Lista de certificados encontrados -->
                    @foreach($certificados as $certificado)
                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <h5><strong>Título: </strong> {{ $certificado->titulo }}</h5> 
                            <strong>Imagem: </strong> <a href="{{ asset('storage/' . $certificado->img) }}" target="_blank">Ver imagem</a>
                            <br><strong>Total de horas: </strong> {{ $certificado->total_horas }}
                            <br><strong>Anexado em:</strong> {{ $certificado->created_at->format('d/m/Y H:i:s') }}
                            <br><strong>Última atualização em:</strong> {{ $certificado->updated_at->format('d/m/Y H:i:s') }}
                        </div>
                    </div>
                    @endforeach
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3 ml-2">
                                <i class="fas fa-arrow-left mr-1"></i> Voltar
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('aprovarSubmissaoForm', $submissao_id) }}" class="btn btn-success btn-sm mr-2">
                                <i class="fas fa-check-circle mr-1"></i> Aprovar
                            </a>
                            <form action="{{ route('rejeitarSubmissao', $submissao_id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm mr-2">
                                    <i class="fas fa-times-circle mr-1"></i> Rejeitar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Content Wrapper -->

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