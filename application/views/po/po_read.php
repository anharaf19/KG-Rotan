
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
        <h2 style="margin-top:0px">Po Read</h2>
        <table class="table">
	    <tr><td>Id Pembeli</td><td><?php echo $id_pembeli; ?></td></tr>
	    <tr><td>Tgl Mulai</td><td><?php echo $tgl_mulai; ?></td></tr>
	    <tr><td>Tgl Selesai</td><td><?php echo $tgl_selesai; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('po') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</section>
</div>

    <?php $this->load->view('template/backend/footer') ?>