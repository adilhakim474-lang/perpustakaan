<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : '' ?>Perpustakaan Mini</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: rgba(255,255,255,0.2);
            color: #fff;
        }
        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .content-wrapper {
            padding: 30px;
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .stats-card .card-body {
            padding: 25px;
        }
        .stats-card h3 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
        .page-header {
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #667eea;
        }
        .page-header h2 {
            color: #667eea;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse" id="sidebarMenu">
                <div class="position-sticky pt-4">
                    <div class="text-center mb-4">
                        <i class="bi bi-book text-white" style="font-size: 3rem;"></i>
                        <h4 class="text-white mt-2">Perpustakaan</h4>
                        <p class="text-white-50 small">Sistem Manajemen</p>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'active' : '' ?>" href="<?= base_url('dashboard') ?>">
                                <i class="bi bi-speedometer2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $this->uri->segment(1) == 'buku' ? 'active' : '' ?>" href="<?= base_url('buku') ?>">
                                <i class="bi bi-book"></i>
                                Data Buku
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $this->uri->segment(1) == 'anggota' ? 'active' : '' ?>" href="<?= base_url('anggota') ?>">
                                <i class="bi bi-people"></i>
                                Data Anggota
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $this->uri->segment(1) == 'peminjaman' ? 'active' : '' ?>" href="<?= base_url('peminjaman') ?>">
                                <i class="bi bi-arrow-left-right"></i>
                                Peminjaman
                            </a>
                        </li>
                    </ul>
                    
                    <hr class="bg-white opacity-25 my-4">
                    
                    <div class="px-3">
                        <small class="text-white-50 d-block">© 2025 Perpustakaan Mini</small>
                        <small class="text-white-50">CodeIgniter 3</small>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-0">
                <!-- Top Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        
                        <span class="navbar-brand mb-0 h1">
                            <i class="bi bi-list me-2"></i>
                            <?= isset($title) ? $title : 'Dashboard' ?>
                        </span>
                        
                        <div class="ms-auto">
                            <span class="badge bg-primary">
                                <i class="bi bi-calendar-event me-1"></i>
                                <?= date('d F Y') ?>
                            </span>
                        </div>
                    </div>
                </nav>

                <!-- Content Area -->
                <div class="content-wrapper">