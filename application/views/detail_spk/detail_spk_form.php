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
        <h2 style="margin-top:0px">Detail_spk <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">No Spk <?php echo form_error('no_spk') ?></label>
            <input type="text" class="form-control" name="no_spk" id="no_spk" placeholder="No Spk" value="<?php echo $no_spk; ?>" />
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
            <label for="int">Id Bahan Rendam <?php echo form_error('id_bahan_rendam') ?></label>
            <input type="text" class="form-control" name="id_bahan_rendam" id="id_bahan_rendam" placeholder="Id Bahan Rendam" value="<?php echo $id_bahan_rendam; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Kg <?php echo form_error('kg') ?></label>
            <input type="text" class="form-control" name="kg" id="kg" placeholder="Kg" value="<?php echo $kg; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Ball <?php echo form_error('ball') ?></label>
            <input type="text" class="form-control" name="ball" id="ball" placeholder="Ball" value="<?php echo $ball; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ket <?php echo form_error('ket') ?></label>
            <input type="text" class="form-control" name="ket" id="ket" placeholder="Ket" value="<?php echo $ket; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('detail_spk') ?>" class="btn btn-default">Cancel</a>
	</form>
    </section>
    <!-- /.content -->
  </div>

    <?php $this->load->view('template/backend/footer') ?>