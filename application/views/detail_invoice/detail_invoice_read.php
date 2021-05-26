
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
        <h2 style="margin-top:0px">Detail_invoice Read</h2>
        <table class="table">
	    <tr><td>No Kontainer</td><td><?php echo $no_kontainer; ?></td></tr>
	    <tr><td>No Seal</td><td><?php echo $no_seal; ?></td></tr>
	    <tr><td>No Surat Jalan</td><td><?php echo $no_surat_jalan; ?></td></tr>
	    <tr><td>No Invoice</td><td><?php echo $no_invoice; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('detail_invoice') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</section>
</div>

    <?php $this->load->view('template/backend/footer') ?>