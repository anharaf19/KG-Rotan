
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
        <h2 style="margin-top:0px">Detail_spk Read</h2>
        <table class="table">
	    <tr><td>Id Spk</td><td><?php echo $id_spk; ?></td></tr>
	    <tr><td>No Item</td><td><?php echo $no_item; ?></td></tr>
	    <tr><td>Qty</td><td><?php echo $qty; ?></td></tr>
	    <tr><td>Id Bahan Rendam</td><td><?php echo $id_bahan_rendam; ?></td></tr>
	    <tr><td>Ball</td><td><?php echo $ball; ?></td></tr>
	    <tr><td>Kg</td><td><?php echo $kg; ?></td></tr>
	    <tr><td>Detail Iptgl</td><td><?php echo $detail_iptgl; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('detail_spk') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</section>
</div>

    <?php $this->load->view('template/backend/footer') ?>