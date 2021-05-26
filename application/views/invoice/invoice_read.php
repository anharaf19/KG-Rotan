
<!doctype html>
<html>
    <head>
        <title> Read</title>
        <?php $this->load->view('template/backend/header') ?>
        <?php $this->load->view('template/backend/navbar') ?>
        <?php $this->load->view('template/backend/sidebar') ?>
    </head>
    <body>
    <div class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
</div>
</div>
    <section class="content">
        <h2 style="margin-top:0px">Invoice Read</h2>
        <table class="table">
	    <tr><td>No Invoice</td><td><?php echo $no_invoice; ?></td></tr>
	    <tr><td>Importir</td><td><?php echo $importir; ?></td></tr>
	    <tr><td>Feeder Vessel</td><td><?php echo $feeder_vessel; ?></td></tr>
	    <tr><td>Mother Vessel</td><td><?php echo $mother_vessel; ?></td></tr>
	    <tr><td>Total</td><td><?php echo $total; ?></td></tr>
	    <tr><td>Etd</td><td><?php echo $etd; ?></td></tr>
	    <tr><td>Eta</td><td><?php echo $eta; ?></td></tr>
	    <tr><td>Tgl</td><td><?php echo $tgl; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('invoice') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</section>
</div>

    <?php $this->load->view('template/backend/footer') ?>