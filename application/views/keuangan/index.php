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
                        <li class="breadcrumb-item active">Dashboard Keuangan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        Belum Dibayar
        <div class="row">
            <?php foreach ($lihatiptgl as $row) : ?>
                <div class="col-md-3">
                    <div class="card mb-3" style="width: 24 rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row->id_detail_spk; ?></h5>
                            <p class="card-text"><?php echo $row->no_item; ?> </p>
                            <p class="card-text"><?php echo $row->tgl_masuk; ?> </p>
                            <p class="card-text"><?php echo $row->qty; ?> </p>
                            <form action="<?php echo base_url('keuangan/bayar') ?>" method="post">
                                <input type="hidden" name='id' value="<?php echo $row->id; ?>" />
                                <button type="submit" class="btn btn-primary">Bayar</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        Sudah Dibayar
        <div class="row">
            <?php foreach ($lihatqcbayar as $row) : ?>
                <div class="col-md-3">
                    <div class="card mb-3" style="width: 24 rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row->id_detail_spk; ?></h5>
                            <p class="card-text"><?php echo $row->no_item; ?> </p>
                            <p class="card-text"><?php echo $row->tgl_masuk; ?> </p>
                            <p class="card-text"><?php echo $row->qty; ?> </p>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('template/backend/footer') ?>