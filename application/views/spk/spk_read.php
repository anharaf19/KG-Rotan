
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
        <h2 style="margin-top:0px">Spk Read</h2>
        <table class="table">
	    <tr><td>Id Po</td><td><?php echo $id_po; ?></td></tr>
	    <tr><td>Id Sub</td><td><?php echo $id_sub; ?></td></tr>
	    <tr><td>Id Pabrik</td><td><?php echo $id_pabrik; ?></td></tr>
	    <tr><td>Tgl</td><td><?php echo $tgl; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('spk') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</section>
</div>

    <?php $this->load->view('template/backend/footer') ?>