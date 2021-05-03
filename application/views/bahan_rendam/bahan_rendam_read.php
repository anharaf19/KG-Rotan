
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
        <h2 style="margin-top:0px">Bahan_rendam Read</h2>
        <table class="table">
	    <tr><td>Id Bahan</td><td><?php echo $id_bahan; ?></td></tr>
	    <tr><td>Tgl Rendam</td><td><?php echo $tgl_rendam; ?></td></tr>
	    <tr><td>Kolam</td><td><?php echo $kolam; ?></td></tr>
	    <tr><td>Kg</td><td><?php echo $kg; ?></td></tr>
	    <tr><td>Ball</td><td><?php echo $ball; ?></td></tr>
	    <tr><td>Tgl Habis</td><td><?php echo $tgl_habis; ?></td></tr>
	    <tr><td>Ket</td><td><?php echo $ket; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('bahan_rendam') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</section>
</div>

    <?php $this->load->view('template/backend/footer') ?>