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
            <h2 style="margin-top:0px">Detail_po <?php echo $button ?></h2>
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="varchar">No Po <?php echo form_error('no_po') ?></label>
                    <input type="text" class="form-control" name="no_po" id="no_po" placeholder="No Po" value="<?php echo $no_po; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">No Item <?php echo form_error('no_item') ?></label>
                    <input type="text" class="form-control" name="no_item" id="no_item" placeholder="No Item" value="<?php echo $no_item; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Nama Item <?php echo form_error('nama_item') ?></label>
                    <input type="text" class="form-control" name="nama_item" id="nama_item" placeholder="Nama Item" value="<?php echo $nama_item; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Jenis Pack <?php echo form_error('jenis_pack') ?></label>
                    <input type="text" class="form-control" name="jenis_pack" id="jenis_pack" placeholder="Jenis Pack" value="<?php echo $jenis_pack; ?>" />
                </div>
                <div class="form-group">
                    <label for="int">Total Order <?php echo form_error('total_order') ?></label>
                    <input type="text" class="form-control" name="total_order" id="total_order" placeholder="Total Order" value="<?php echo $total_order; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Order Reff <?php echo form_error('order_reff') ?></label>
                    <input type="text" class="form-control" name="order_reff" id="order_reff" placeholder="Order Reff" value="<?php echo $order_reff; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Pack <?php echo form_error('pack') ?></label>
                    <input type="text" class="form-control" name="pack" id="pack" placeholder="Pack" value="<?php echo $pack; ?>" />
                </div>
                <div class="form-group">
                    <label for="float">Total Ctn <?php echo form_error('total_ctn') ?></label>
                    <input type="text" class="form-control" name="total_ctn" id="total_ctn" placeholder="Total Ctn" value="<?php echo $total_ctn; ?>" />
                </div>
                <div class="form-group">
                    <label for="float">Cbm Ctn <?php echo form_error('cbm_ctn') ?></label>
                    <input type="text" class="form-control" name="cbm_ctn" id="cbm_ctn" placeholder="Cbm Ctn" value="<?php echo $cbm_ctn; ?>" />
                </div>
                <div class="form-group">
                    <label for="float">Total Cbm <?php echo form_error('total_cbm') ?></label>
                    <input type="text" class="form-control" name="total_cbm" id="total_cbm" placeholder="Total Cbm" value="<?php echo $total_cbm; ?>" />
                </div>
                <div class="form-group">
                    <label for="int">Harga Sub <?php echo form_error('harga_sub') ?></label>
                    <input type="text" class="form-control" name="harga_sub" id="harga_sub" placeholder="Harga Sub" value="<?php echo $harga_sub; ?>" />
                </div>
                <div class="form-group">
                    <label for="int">Harga Anyam <?php echo form_error('harga_anyam') ?></label>
                    <input type="text" class="form-control" name="harga_anyam" id="harga_anyam" placeholder="Harga Anyam" value="<?php echo $harga_anyam; ?>" />
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('detail_po') ?>" class="btn btn-default">Cancel</a>
            </form>
        </section>
        <!-- /.content -->
    </div>

    <?php $this->load->view('template/backend/footer') ?>