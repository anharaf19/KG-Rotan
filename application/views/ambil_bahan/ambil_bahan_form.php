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
            <h2 style="margin-top:0px">Ambil_bahan <?php echo $button ?></h2>
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="int">No Spk <?php echo form_error('id_detail_spk') ?></label>
                    <select name="id_detail_spk" id="id_detail_spk" class="form-control">
                        <?php
                        foreach ($lihatnospk as $row => $data) {
                        ?>
                            <option value=" <?php echo $data['id'] ?>" <?php if (isset($data['id']) && $data['id'] == $id_detail_spk) {
                                                                            echo 'selected';
                                                                        } ?>>
                                <?php {
                                    echo $data['no_spk'];
                                }; ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="int">Kolam <?php echo form_error('lihatkolam') ?></label>
                    <select name="id_bahan_rendam" id="id_bahan_rendam" class="form-control">
                        <?php
                        foreach ($lihatkolam as $row => $data) {
                        ?>
                            <option value=" <?php echo $data['id'] ?>" <?php if (isset($data['id']) && $data['id'] == $lihatkolam) {
                                                                            echo 'selected';
                                                                        } ?>>
                                <?php {
                                    echo "Kolam : ";
                                    echo $data['kolam'];
                                    echo " Nama Bahan : ";
                                    echo $data['nama'];
                                }; ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Tgl Keluar <?php echo form_error('tgl_keluar') ?></label>
                    <input type="text" class="form-control" name="tgl_keluar" id="tgl_keluar" placeholder="Tgl Keluar" value="<?php echo $tgl_keluar; ?>" />
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
                    <label for="varchar">Nama Sopir <?php echo form_error('nama_sopir') ?></label>
                    <input type="text" class="form-control" name="nama_sopir" id="nama_sopir" placeholder="Nama Sopir" value="<?php echo $nama_sopir; ?>" />
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('ambil_bahan') ?>" class="btn btn-default">Cancel</a>
            </form>
        </section>
        <!-- /.content -->
    </div>

    <?php $this->load->view('template/backend/footer') ?>