<!-- Top Dashboard Navbar -->
<nav class="navbar navbar-dashboard navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="fa fa-id-card"></i> ReachMe - Admin Center</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDashboard" aria-controls="navbarDashboard" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarDashboard">
            <ul class="navbar-nav ms-3 mb-2 mb-lg-0">
                <!-- <li class="nav-item"><a class="nav-link<?= (uri_string() == '' ? ' active' : '') ?>" href="<?= site_url('/') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> -->
                <li class="nav-item"><a class="nav-link<?= (uri_string() == 'islanders' ? ' active' : '') ?>" href="<?= site_url('/islanders') ?>"><i class="fa fa-users"></i> Islanders</a></li>
                <!-- <li class="nav-item"><a class="nav-link<?= (uri_string() == 'admin/users' ? ' active' : '') ?>" href="<?= site_url('/admin/users') ?>"><i class="fa fa-user"></i> Users</a></li> -->
            </ul>
        </div>
    </div>
</nav>
