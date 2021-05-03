<!doctype html>
<html>

<head>
    <title>Form</title>
    <?php $this->load->view('template/backend/header') ?>
    <?php $this->load->view('template/backend/navbar') ?>
    <?php $this->load->view('template/backend/sidebar') ?>

<body>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <h2 style="margin-top:0px">Pengiriman <?php echo $button ?></h2>
            <form action="<?php echo $action; ?>" method="post">

                <div class="form-group">
                    <label for="date">No Pengiriman <?php echo form_error('tgl') ?></label>
                    <input type="text" class="form-control" name="no_pengiriman" id="no_pengiriman" placeholder="no pengiriman" value="<?php echo $tgl; ?>" />
                </div>
                <div class="form-group">
                    <label for="date">Tgl <?php echo form_error('tgl') ?></label>
                    <input type="text" class="form-control" name="tgl" id="tgl" placeholder="Tgl" value="<?php echo $tgl; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Ket <?php echo form_error('ket') ?></label>
                    <input type="text" class="form-control" name="ket" id="ket" placeholder="Ket" value="<?php echo $ket; ?>" />
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('pengiriman') ?>" class="btn btn-default">Cancel</a>
            </form>
        </section>
        <!-- /.content -->
    </div>

    <?php $this->load->view('template/backend/footer') ?>