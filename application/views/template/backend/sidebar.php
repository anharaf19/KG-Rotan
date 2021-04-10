<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="<?php echo base_url('assets/AdminLTE/dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Rotan</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo base_url('assets/AdminLTE/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $this->session->userdata('nama'); ?></a>
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $this->session->userdata('jabatan'); ?></a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <?php if ($this->session->userdata('jabatan') == "SuperAdmin") { ?>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">Transaksi</li>
          <li class="nav-item">
            <a href="<?php echo base_url('po') ?>" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                PO
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('bahan_masuk') ?>" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Bahan Masuk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('bahan_rendam') ?>" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Bahan Rendam
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('spk') ?>" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                SPK
              </p>
            </a>
          </li>
          <li class="nav-header">Dummy</li>
          <li class="nav-item">
            <a href="<?php echo base_url('detail_po') ?>" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Detail PO
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('detail_spk') ?>" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Detail SPK
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('detail_harga') ?>" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Detail Harga
              </p>
            </a>
          </li>
          <li class="nav-header">----</li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('pembeli') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembeli</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('bahan') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bahan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('pabrik') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pabrik</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('sub') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('pabrik') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pabrik</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('user') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    <?php } ?>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>