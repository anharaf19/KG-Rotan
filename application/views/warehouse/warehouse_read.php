
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
        <h2 style="margin-top:0px">Warehouse Read</h2>
        <table class="table">
	    <tr><td>No Item</td><td><?php echo $no_item; ?></td></tr>
	    <tr><td>No Po</td><td><?php echo $no_po; ?></td></tr>
	    <tr><td>Total Qty</td><td><?php echo $total_qty; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('warehouse') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</section>
</div>

    <?php $this->load->view('template/backend/footer') ?>