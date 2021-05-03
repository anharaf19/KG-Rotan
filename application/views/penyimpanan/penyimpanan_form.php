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
        <h2 style="margin-top:0px">Penyimpanan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Po Pabrik <?php echo form_error('id_po_pabrik') ?></label>
            <input type="text" class="form-control" name="id_po_pabrik" id="id_po_pabrik" placeholder="Id Po Pabrik" value="<?php echo $id_po_pabrik; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Po <?php echo form_error('no_po') ?></label>
            <input type="text" class="form-control" name="no_po" id="no_po" placeholder="No Po" value="<?php echo $no_po; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Item <?php echo form_error('no_item') ?></label>
            <input type="text" class="form-control" name="no_item" id="no_item" placeholder="No Item" value="<?php echo $no_item; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Total Qty <?php echo form_error('total_qty') ?></label>
            <input type="text" class="form-control" name="total_qty" id="total_qty" placeholder="Total Qty" value="<?php echo $total_qty; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('penyimpanan') ?>" class="btn btn-default">Cancel</a>
	</form>
    </section>
    <!-- /.content -->
  </div>

    <?php $this->load->view('template/backend/footer') ?>