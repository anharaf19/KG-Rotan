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
            <h2 style="margin-top:0px"> QC</h2>
            <form action="<?php echo site_url('pabrikqc/add') ?>" method="post">
                <div class="form-group">
                    <label for="varchar">Id Detail Spk</label>
                    <input type="hidden" class="form-control" name="id_detail_spk" id="id_detail_spk" placeholder="id_detail_spk" value="<?php if (isset($id)) echo $id; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">No SPK</label>
                    <input type="text" class="form-control" name="no_spk" id="no_spk" placeholder="no_spk" value="<?php if (isset($id)) echo $no_spk; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">No Item</label>
                    <input type="text" class="form-control" name="no_item" id="no_item" placeholder="no_item" value="<?php if (isset($id)) echo $no_item; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Tanggal</label>
                    <input type="text" class="form-control" name="tgl_masuk" id="tgl_masuk" placeholder="tgl_masuk" value="" />
                </div>
                <div class="form-group">
                    <label for="varchar">qty</label>
                    <input type="text" class="form-control" name="qty" id="qty" placeholder="qty" value="" />
                </div>
                <input type="hidden" name="id" value="" />
                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="<?php echo site_url('pabrikqc') ?>" class="btn btn-default">Cancel</a>
            </form>
        </section>
        <!-- /.content -->
    </div>

    <?php $this->load->view('template/backend/footer') ?>