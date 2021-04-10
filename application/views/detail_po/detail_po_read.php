
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
        <h2 style="margin-top:0px">Detail_po Read</h2>
        <table class="table">
	    <tr><td>No Po</td><td><?php echo $no_po; ?></td></tr>
	    <tr><td>No Item</td><td><?php echo $no_item; ?></td></tr>
	    <tr><td>Nama Item</td><td><?php echo $nama_item; ?></td></tr>
	    <tr><td>Jenis Pack</td><td><?php echo $jenis_pack; ?></td></tr>
	    <tr><td>Total Order</td><td><?php echo $total_order; ?></td></tr>
	    <tr><td>Order Reff</td><td><?php echo $order_reff; ?></td></tr>
	    <tr><td>Pack</td><td><?php echo $pack; ?></td></tr>
	    <tr><td>Total Ctn</td><td><?php echo $total_ctn; ?></td></tr>
	    <tr><td>Cbm Ctn</td><td><?php echo $cbm_ctn; ?></td></tr>
	    <tr><td>Total Cbm</td><td><?php echo $total_cbm; ?></td></tr>
	    <tr><td>Harga Sub</td><td><?php echo $harga_sub; ?></td></tr>
	    <tr><td>Harga Anyam</td><td><?php echo $harga_anyam; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('detail_po') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</section>
</div>

    <?php $this->load->view('template/backend/footer') ?>