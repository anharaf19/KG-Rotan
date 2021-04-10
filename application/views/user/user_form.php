<!doctype html>
<html>

<head>
    <title>Form</title>
    <?php $this->load->view('template/backend/header') ?>
    <?php $this->load->view('template/backend/navbar') ?>
    <?php $this->load->view('template/backend/sidebar') ?>

<body>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <h2 style="margin-top:0px">User <?php echo $button ?></h2>
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Username <?php echo form_error('username') ?></label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Password <?php echo form_error('password') ?></label>
                    <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Jabatan <?php echo form_error('jabatan') ?></label>
                    <select name="jabatan" id="jabatan" class="form-control" <?php echo $jabatan; ?>>
                        <option value="SuperAdmin" <?php if ((isset($jabatan)) && ($jabatan == 'SuperAdmin')) {
                                                        echo "selected";
                                                    } ?>> SuperAdmin </option>
                        <option value="Admin" <?php if ((isset($jabatan)) && ($jabatan == 'Admin')) {
                                                    echo "selected";
                                                } ?>> Admin </option>
                        <option value="Pabrik" <?php if ((isset($jabatan)) && ($jabatan == 'Pabrik')) {
                                                    echo "selected";
                                                } ?>> Pabrik </option>
                        <option value="Keuangan" <?php if ((isset($jabatan)) && ($jabatan == 'Keuangan')) {
                                                        echo "selected";
                                                    } ?>> Keuangan </option>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('user') ?>" class="btn btn-default">Cancel</a>
            </form>
        </section>
        <!-- /.content -->
    </div>

    <?php $this->load->view('template/backend/footer') ?>