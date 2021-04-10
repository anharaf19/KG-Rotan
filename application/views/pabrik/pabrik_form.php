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
        <h2 style="margin-top:0px">Pabrik <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pabrik') ?>" class="btn btn-default">Cancel</a>
	</form>
    </section>
    <!-- /.content -->
  </div>

    <?php $this->load->view('template/backend/footer') ?>