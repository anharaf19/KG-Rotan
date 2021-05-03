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
            <h2 style="margin-top:0px">Spk <?php echo $button ?></h2>
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="varchar">No Spk <?php echo form_error('no_spk') ?></label>
                    <input type="text" class="form-control" name="no_spk" id="no_spk" placeholder="No Spk" value="<?php echo $no_spk; ?>" />
                </div>
                <div class="form-group">
                    <label for="int">Id Po Pabrik <?php echo form_error('id_po_pabrik') ?></label>
                    <select name="id_po_pabrik" id="id_po_pabrik" class="form-control">
                        <?php
                        foreach ($lihatpabrik as $row => $data) {
                        ?>
                            <option value=" <?php echo $data['id'] ?>" <?php if (isset($data['id']) && $data['id'] == $id_po_pabrik) {
                                                                            echo 'selected';
                                                                        } ?>>
                                <?php {
                                    echo " No PO : ";
                                    echo $data['no_po'];
                                    echo " No Item : ";
                                    echo $data['no_item'];
                                }; ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="int">Id Sub <?php echo form_error('id_sub') ?></label>
                    <select name="id_sub" id="id_sub" class="form-control">
                        <?php
                        foreach ($lihatsub as $row => $data) {
                        ?>
                            <option value=" <?php echo $data['id'] ?>" <?php if (isset($data['id']) && $data['id'] == $id_sub) {
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
                    <input type="text" class="form-control" name="tgl_mulai" id="tgl_mulai" placeholder="Tgl Mulai" value="<?php echo $tgl_mulai; ?>" />
                </div>
                <div class="form-group">
                    <label for="date">Tgl Selesai <?php echo form_error('tgl_selesai') ?></label>
                    <input type="text" class="form-control" name="tgl_selesai" id="tgl_selesai" placeholder="Tgl Selesai" value="<?php echo $tgl_selesai; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Status <?php echo form_error('status') ?></label>
                    <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('spk') ?>" class="btn btn-default">Cancel</a>
            </form>
        </section>
        <!-- /.content -->
    </div>

    <?php $this->load->view('template/backend/footer') ?>