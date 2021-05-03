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
            <h2 style="margin-top:0px">Bahan_masuk <?php echo $button ?></h2>
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="int">Id Bahan <?php echo form_error('id_bahan') ?></label>
                    <!-- <input type="text" class="form-control" name="id_bahan" id="id_bahan" placeholder="Id Bahan" value="<?php echo $id_bahan; ?>" /> -->
                    <select name="id_bahan" id="id_bahan" class="form-control">
                        <?php
                        foreach ($lihatbahan as $row => $data) {
                        ?>
                            <option value=" <?php echo $data['id'] ?>" <?php if (isset($data['id']) && $data['id'] == $id_bahan) {
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
                    <label for="date">Tgl Masuk <?php echo form_error('tgl_masuk') ?></label>
                    <input type="text" class="form-control" name="tgl_masuk" id="tgl_masuk" placeholder="Tgl Masuk" value="<?php echo $tgl_masuk; ?>" />
                </div>
                <div class="form-group">
                    <label for="int">Kg <?php echo form_error('kg') ?></label>
                    <input type="text" class="form-control" name="kg" id="kg" placeholder="Kg" value="<?php echo $kg; ?>" />
                </div>
                <div class="form-group">
                    <label for="int">Ball <?php echo form_error('ball') ?></label>
                    <input type="text" class="form-control" name="ball" id="ball" placeholder="Ball" value="<?php echo $ball; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Asal Bahan <?php echo form_error('asal_bahan') ?></label>
                    <input type="text" class="form-control" name="asal_bahan" id="asal_bahan" placeholder="Asal Bahan" value="<?php echo $asal_bahan; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Ket <?php echo form_error('ket') ?></label>
                    <input type="text" class="form-control" name="ket" id="ket" placeholder="Ket" value="<?php echo $ket; ?>" />
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('bahan_masuk') ?>" class="btn btn-default">Cancel</a>
            </form>
        </section>
        <!-- /.content -->
    </div>

    <?php $this->load->view('template/backend/footer') ?>