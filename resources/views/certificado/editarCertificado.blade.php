<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Editar Certificado</title>

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
                        <h2 class="font-weight-bold text-primary">Editar Certificado</h2>
                    </div>

                    <form action="{{ route('atualizarCertificado', $certificado->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="submissao_id" value="{{ $submissao_id }}">
                        <div class="form-group">
                            <label for="titulo">Título do Certificado</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo', $certificado->titulo) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="tipo_atividade_id">Tipo de Atividade do Certificado</label>
                            <select class="form-control" id="tipo_atividade_id" name="tipo_atividade_id" required>
                                @foreach($atividades as $atividade)
                                    <option value="{{ $atividade->id }}" 
                                        {{ old('tipo_atividade_id', $certificado->tipo_atividade_id) == $atividade->id ? 'selected' : '' }}>
                                        {{ $atividade->atividade }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <p>Imagem atual:<a href="{{ asset('storage/' . $certificado->img) }}" target="_blank"> Ver imagem</a></p>
                        <div class="form-group">
                            <input type="file" class="form-control-file" id="imagem" name="img" value="{{ old('img', $certificado->img) }}">
                        </div>
                        <div class="form-group">
                            <label for="total_horas">Total de horas do Certificado</label>
                            <input type="number" class="form-control" id="total_horas" name="total_horas" value="{{ old('total_horas', $certificado->total_horas) }}" required>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">
                            <i class="fas fa-save mr-2"></i> Salvar
                        </button>
                        <a href="{{ route('editarSubmissao', $submissao_id) }}" class="btn btn-secondary mt-3 ml-2">
                            <i class="fas fa-arrow-left mr-1"></i> Voltar
                        </a>
                    </form>
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