
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
        <h2 style="margin-top:0px">Iptgl Read</h2>
        <table class="table">
	    <tr><td>Id Detail Spk</td><td><?php echo $id_detail_spk; ?></td></tr>
	    <tr><td>No Item</td><td><?php echo $no_item; ?></td></tr>
	    <tr><td>Tgl Masuk</td><td><?php echo $tgl_masuk; ?></td></tr>
	    <tr><td>Qty</td><td><?php echo $qty; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('iptgl') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</section>
</div>

    <?php $this->load->view('template/backend/footer') ?>