
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
        <h2 style="margin-top:0px">Bahan Read</h2>
        <table class="table">
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Jenis</td><td><?php echo $jenis; ?></td></tr>
	    <tr><td>Total Kg</td><td><?php echo $total_kg; ?></td></tr>
	    <tr><td>Total Ball</td><td><?php echo $total_ball; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('bahan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</section>
</div>

    <?php $this->load->view('template/backend/footer') ?>