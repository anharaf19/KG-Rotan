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
        <h2 style="margin-top:0px">Detail_invoice <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">No Kontainer <?php echo form_error('no_kontainer') ?></label>
            <input type="text" class="form-control" name="no_kontainer" id="no_kontainer" placeholder="No Kontainer" value="<?php echo $no_kontainer; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Seal <?php echo form_error('no_seal') ?></label>
            <input type="text" class="form-control" name="no_seal" id="no_seal" placeholder="No Seal" value="<?php echo $no_seal; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Surat Jalan <?php echo form_error('no_surat_jalan') ?></label>
            <input type="text" class="form-control" name="no_surat_jalan" id="no_surat_jalan" placeholder="No Surat Jalan" value="<?php echo $no_surat_jalan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Invoice <?php echo form_error('no_invoice') ?></label>
            <input type="text" class="form-control" name="no_invoice" id="no_invoice" placeholder="No Invoice" value="<?php echo $no_invoice; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('detail_invoice') ?>" class="btn btn-default">Cancel</a>
	</form>
    </section>
    <!-- /.content -->
  </div>

    <?php $this->load->view('template/backend/footer') ?>