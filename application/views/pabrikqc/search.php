<!-- Header -->
<?php $this->load->view('template/backend/header') ?>
<!-- /Header -->
<!-- Navbar -->
<?php $this->load->view('template/backend/navbar') ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php $this->load->view('template/backend/sidebar') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard Pabrik</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <?php echo form_open('pabrikqc/search') ?>
        <input type="text" name="keyword" placeholder="search">
        <input type="submit" name="search_submit" value="Cari">
        <?php echo form_close() ?>
        <div class="row">

            <?php foreach ($detail_spk as $row) { ?>
                <div class="col-md-3">
                    <div class="card" style="width: 24rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row->no_spk; ?></h5>
                            <p class="card-text">No Item :<?php echo $row->no_item; ?> </p>
                            <p class="card-text"><?php echo $row->total_qty; ?> Item </p>
                            <a href="<?php echo site_url('pabrikqc/addqty/' . $row->id) ?>" class="btn btn-primary">Hasil Qc</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('template/backend/footer') ?>