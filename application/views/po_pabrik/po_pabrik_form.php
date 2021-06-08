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
            <h2 style="margin-top:0px">Po_pabrik <?php echo $button ?></h2>
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="int">Nama <?php echo form_error('id_pabrik') ?></label>
                    <select name="id_pabrik" id="id_pabrik" class="form-control">
                        <?php
                        foreach ($lihatpabrik as $row => $data) {
                        ?>
                            <option value=" <?php echo $data['id'] ?>" <?php if (isset($data['id']) && $data['id'] == $id_pabrik) {
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
                    <label for="int">No Po <?php echo form_error('id_po') ?></label>
                    <select name="no_po" id="no_po" class="form-control">
                        <?php
                        foreach ($lihatpo as $row => $data) {
                        ?>
                            <option value=" <?php echo $data['no_po'] ?>" <?php if (isset($data['no_po']) && $data['no_po'] == $no_po) {
                                                                                echo 'selected';
                                                                            } ?>>
                                <?php {
                                    echo $data['no_po'];
                                }; ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('po_pabrik') ?>" class="btn btn-default">Cancel</a>
            </form>
        </section>
        <!-- /.content -->
    </div>

    <?php $this->load->view('template/backend/footer') ?>