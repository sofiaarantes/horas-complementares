<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Página Principal</title>

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

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Aluno</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Acessar
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('verSubmissoesAluno', Auth::id()) }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Ver Submissões</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ Auth::user()->nome }}
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('bootstrap/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Sair</button>
                                    </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="container mt-5">

                        <!-- Título -->
                        <div class="text-center mb-4">
                            <h2 class="font-weight-bold text-primary">Progresso de Horas dos Alunos</h2>
                        </div>
                        <!-- Gráfico circular -->
                        <div class="card shadow">
                            <div class="card-body">
                                
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="progressPieChart"></canvas>
                                </div>
                                <div class="mt-4 text-center small">
                                    <span class="mr-2">
                                         Total de horas concluídas: {{ $totalHorasConcluidas }}
                                    </span>
                                    @if($totalHorasConcluidas < $limiteHoras)
                                    <span class="mr-2">
                                         Horas restantes: {{ $limiteHoras - $totalHorasConcluidas}}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- botão enviar arquivo -->
                    <br>
                    <form action="{{ route('criarSubmissao') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload mr-2"></i> Criar nova submissão
                        </button>
                    </form>
                    <br><br>
                    <!-- Lista de submissões existentes -->
                    @foreach($submissoes as $submissao)
                    @if($submissao->status === 'pendente')
                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <h5><strong>Submissao: </strong></h5>
                            <strong>Total de horas enviadas:</strong> {{ $submissao->certificados->sum('total_horas') }}
                            <br><strong>Criado em:</strong> {{ $submissao->created_at->format('d/m/Y H:i:s') }}
                            <br><strong>Última atualização:</strong> {{ $submissao->updated_at->format('d/m/Y H:i:s') }}

                            <div class="d-flex justify-content-between">
                                <div>
                                    <span class="badge badge-warning text-white">
                                        <i class="fas fa-hourglass-half mr-1"></i> Em Análise
                                    </span>
                                </div>
                                <div>
                                    <a href="{{ route('editarSubmissao', $submissao->id) }}" class=" btn btn-info btn-sm">
                                        <i class="fas fa-pencil mr-1"></i> Editar
                                    </a>
                                    <form action="{{ route('excluirSubmissao', $submissao->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir esta submissão?');">
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
                    @endif
                    @endforeach
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
                        data: [{{ $totalHorasConcluidas }}, {{ max(0, $limiteHoras - $totalHorasConcluidas) }}],
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