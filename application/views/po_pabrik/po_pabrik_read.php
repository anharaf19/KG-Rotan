
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
        <h2 style="margin-top:0px">Po_pabrik Read</h2>
        <table class="table">
	    <tr><td>Id Pabrik</td><td><?php echo $id_pabrik; ?></td></tr>
	    <tr><td>Id Po</td><td><?php echo $id_po; ?></td></tr>
	    <tr><td>Id Penyimpanan</td><td><?php echo $id_penyimpanan; ?></td></tr>
	    <tr><td>No Po</td><td><?php echo $no_po; ?></td></tr>
	    <tr><td>No Item</td><td><?php echo $no_item; ?></td></tr>
	    <tr><td>Qty</td><td><?php echo $qty; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('po_pabrik') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</section>
</div>

    <?php $this->load->view('template/backend/footer') ?>