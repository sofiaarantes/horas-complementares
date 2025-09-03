<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Editar Submissão</title>

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
                            <h2 class="font-weight-bold text-primary">Editar Submissão</h2>
                        </div>
                    </div>

                    <!-- botão enviar arquivo -->
                    <br>
                    <a href="{{ route('anexarCertificado', $submissao_id) }}" class="btn btn-primary">
                        <i class="fas fa-upload mr-2"></i> Anexar novo certificado
                    </a> <br><br>

                    <!-- Lista de certificados encontrados -->
                    @foreach($certificados as $certificado)
                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <h5><strong>Título: </strong> {{ $certificado->titulo }}</h5> 
                            <strong>Imagem: </strong> <a href="{{ asset('storage/' . $certificado->img) }}" target="_blank">Ver imagem</a>
                            <br><strong>Total de horas: </strong> {{ $certificado->total_horas }}
                            <br><strong>Anexado em:</strong> {{ $certificado->created_at->format('d/m/Y H:i:s') }}
                            <br><strong>Última atualização em:</strong> {{ $certificado->updated_at->format('d/m/Y H:i:s') }}

                            <div class="d-flex justify-content-between">
                                <div><span></span></div>
                                <div>
                                    <a href="{{ route('editarCertificado', $certificado->id) }}" class=" btn btn-info btn-sm">
                                        <i class="fas fa-pencil mr-1"></i> Editar
                                    </a>
                                    <form action="{{ route('excluirCertificado', $certificado->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este certificado?');">
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

                    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3 ml-2">
                        <i class="fas fa-arrow-left mr-1"></i> Voltar
                    </a>

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

    <!-- Script do gráfico -->
    <script>
        const canvas = document.getElementById("progressPieChart");
        if (canvas) {
            const ctx = canvas.getContext("2d");
            const progressPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["Horas Concluídas", "Horas Restantes"],
                    datasets: [{
                        data: [75, 25],
                        backgroundColor: ['#1cc88a', '#e74a3b'],
                        hoverBackgroundColor: ['#17a673', '#c0392b'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)"
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                usePointStyle: true, // <- Usa círculo no lugar do quadrado
                                pointStyle: 'circle',
                                font: {
                                    size: 14 // <- aumenta o tamanho da fonte
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1
                        }
                    }
                }
            });
        }
    </script>


</body>

</html>