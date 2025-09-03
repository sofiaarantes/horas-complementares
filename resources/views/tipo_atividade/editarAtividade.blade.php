<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Editar Atividade</title>

    <link href="{{ asset('bootstrap/img/logo.png') }}" rel="icon" type="image/png">
    <link href="{{ asset('bootstrap/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('bootstrap/css/sb-admin-2.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div class="container mt-5">

                <!-- Título -->
                <div class="text-center mb-4">
                    <h2 class="font-weight-bold text-primary">Editar Atividade</h2>
                </div>

                <!-- Formulário -->
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{ route('atualizarAtividade', $atividade->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="ppc_id" value="{{ $ppc_id }}">
                            <div class="form-group">
                                <label for="atividade">Título da Atividade</label>
                                <input type="text" class="form-control" id="atividade" name="atividade" value="{{ old('atividade', $atividade->atividade) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="limite_horas">Limite de Horas da Atividade</label>
                                <input type="text" class="form-control" id="limite_horas" name="limite_horas" value="{{ old('limite_horas', $atividade->limite_horas) }}" required>
                            </div>
                            <button type="submit" class="btn btn-success mt-3">
                                <i class="fas fa-save mr-2"></i> Salvar
                            </button>
                            <a href="{{ route('editarPpc', $ppc_id) }}" class="btn btn-secondary mt-3 ml-2">
                                <i class="fas fa-arrow-left mr-1"></i> Voltar
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="{{ asset('bootstrap/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bootstrap/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('bootstrap/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/demo/chart-area-demo.js') }}"></script>
</body>

</html>