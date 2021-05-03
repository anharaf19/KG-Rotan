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
            <h2 style="margin-top:0px">Simpan <?php echo $button ?></h2>
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="varchar">No Item <?php echo form_error('no_item') ?></label>
                    <select name="no_item" id="no_item" class="form-control">
                        <?php
                        foreach ($lihatpenyimpanan as $row => $data) {
                        ?>
                            <option value=" <?php echo $data['no_item'] ?>" <?php if (isset($data['no_item']) && $data['no_item'] == $no_item) {
                                                                                echo 'selected';
                                                                            } ?>>
                                <?php {
                                    echo $data['no_item'];
                                }; ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="int">Qty <?php echo form_error('qty') ?></label>
                    <input type="text" class="form-control" name="qty" id="qty" placeholder="Qty" value="<?php echo $qty; ?>" />
                </div>
                <div class="form-group">
                    <label for="date">Tgl <?php echo form_error('tgl') ?></label>
                    <input type="text" class="form-control" name="tgl" id="tgl" placeholder="Tgl" value="<?php echo $tgl; ?>" />
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('simpan') ?>" class="btn btn-default">Cancel</a>
            </form>
        </section>
        <!-- /.content -->
    </div>

    <?php $this->load->view('template/backend/footer') ?>