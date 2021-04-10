<!doctype html>
<html>

<head>
    <title>Form</title>
    <?php $this->load->view('template/backend/header') ?>
    <?php $this->load->view('template/backend/navbar') ?>
    <?php $this->load->view('template/backend/sidebar') ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#tgl_mulai").datepicker({
                dateFormat: 'yy-mm-dd'
            });
            $("#tgl_selesai").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>

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
            <h2 style="margin-top:0px">Po <?php echo $button ?></h2>
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="date">NO Po <?php echo form_error('no_po') ?></label>
                    <input type="text" class="form-control" name="no_po" id="no_po" placeholder="No Po" value="<?php echo $no_po; ?>" />
                </div>
                <div class="form-group">
                    <label for="int">Id Pembeli <?php echo form_error('id_pembeli') ?></label>
                    <select name="id_pembeli" id="id_pembeli" class="form-control">
                        <?php
                        foreach ($lihatpembeli as $row => $data) {
                        ?>
                            <option value=" <?php echo $data['id'] ?>" <?php if (isset($data['id']) && $data['id'] == $id_pembeli) {
                                                                            echo 'selected';
                                                                        } ?>>
                                <?php {
                                    echo $data['nama'];
                                }; ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Tgl Mulai <?php echo form_error('tgl_mulai') ?></label>
                    <!-- <input type="text" class="form-control" name="tgl_mulai" id="tgl_mulai" placeholder="Tgl Mulai" value="<?php echo $tgl_mulai; ?>" /> -->
                    <input type="text" id="tgl_mulai" data-date-format='yyyy-mm-dd' name="tgl_mulai" id="tgl_mulai" placeholder="Tgl Mulai" class="form-control" value="<?php echo $tgl_mulai; ?>">
                </div>
                <div class="form-group">
                    <label for="date">Tgl Selesai <?php echo form_error('tgl_selesai') ?></label>
                    <!-- <input type="text" class="form-control" name="tgl_selesai" id="tgl_selesai" placeholder="Tgl Selesai" value="<?php echo $tgl_selesai; ?>" /> -->
                    <input type="text" id="tgl_selesai" data-date-format='yyyy-mm-dd' name="tgl_selesai" id="tgl_selesai" placeholder="Tgl Rendam" class="form-control" value="<?php echo $tgl_selesai; ?>">
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('po') ?>" class="btn btn-default">Cancel</a>
            </form>
        </section>
        <!-- /.content -->
    </div>

    <?php $this->load->view('template/backend/footer') ?>