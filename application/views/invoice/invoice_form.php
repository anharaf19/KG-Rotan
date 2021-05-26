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
        <h2 style="margin-top:0px">Invoice <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">No Invoice <?php echo form_error('no_invoice') ?></label>
            <input type="text" class="form-control" name="no_invoice" id="no_invoice" placeholder="No Invoice" value="<?php echo $no_invoice; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Importir <?php echo form_error('importir') ?></label>
            <input type="text" class="form-control" name="importir" id="importir" placeholder="Importir" value="<?php echo $importir; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Feeder Vessel <?php echo form_error('feeder_vessel') ?></label>
            <input type="text" class="form-control" name="feeder_vessel" id="feeder_vessel" placeholder="Feeder Vessel" value="<?php echo $feeder_vessel; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mother Vessel <?php echo form_error('mother_vessel') ?></label>
            <input type="text" class="form-control" name="mother_vessel" id="mother_vessel" placeholder="Mother Vessel" value="<?php echo $mother_vessel; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Total <?php echo form_error('total') ?></label>
            <input type="text" class="form-control" name="total" id="total" placeholder="Total" value="<?php echo $total; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Etd <?php echo form_error('etd') ?></label>
            <input type="text" class="form-control" name="etd" id="etd" placeholder="Etd" value="<?php echo $etd; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Eta <?php echo form_error('eta') ?></label>
            <input type="text" class="form-control" name="eta" id="eta" placeholder="Eta" value="<?php echo $eta; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl <?php echo form_error('tgl') ?></label>
            <input type="text" class="form-control" name="tgl" id="tgl" placeholder="Tgl" value="<?php echo $tgl; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('invoice') ?>" class="btn btn-default">Cancel</a>
	</form>
    </section>
    <!-- /.content -->
  </div>

    <?php $this->load->view('template/backend/footer') ?>