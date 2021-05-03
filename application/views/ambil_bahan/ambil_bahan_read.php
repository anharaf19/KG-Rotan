
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
        <h2 style="margin-top:0px">Ambil_bahan Read</h2>
        <table class="table">
	    <tr><td>Id Detail Spk</td><td><?php echo $id_detail_spk; ?></td></tr>
	    <tr><td>Id Bahan Rendam</td><td><?php echo $id_bahan_rendam; ?></td></tr>
	    <tr><td>Tgl Keluar</td><td><?php echo $tgl_keluar; ?></td></tr>
	    <tr><td>Kg</td><td><?php echo $kg; ?></td></tr>
	    <tr><td>Ball</td><td><?php echo $ball; ?></td></tr>
	    <tr><td>Nama Sopir</td><td><?php echo $nama_sopir; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('ambil_bahan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</section>
</div>

    <?php $this->load->view('template/backend/footer') ?>