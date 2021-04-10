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
        <h2 style="margin-top:0px">Spk <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Po <?php echo form_error('id_po') ?></label>
            <input type="text" class="form-control" name="id_po" id="id_po" placeholder="Id Po" value="<?php echo $id_po; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Sub <?php echo form_error('id_sub') ?></label>
            <input type="text" class="form-control" name="id_sub" id="id_sub" placeholder="Id Sub" value="<?php echo $id_sub; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Pabrik <?php echo form_error('id_pabrik') ?></label>
            <input type="text" class="form-control" name="id_pabrik" id="id_pabrik" placeholder="Id Pabrik" value="<?php echo $id_pabrik; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl <?php echo form_error('tgl') ?></label>
            <input type="text" class="form-control" name="tgl" id="tgl" placeholder="Tgl" value="<?php echo $tgl; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('spk') ?>" class="btn btn-default">Cancel</a>
	</form>
    </section>
    <!-- /.content -->
  </div>

    <?php $this->load->view('template/backend/footer') ?>