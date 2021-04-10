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
            $("#tgl_rendam").datepicker({
                dateFormat: 'yy-mm-dd'
            });
            $("#tgl_habis").datepicker({
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
            <h2 style="margin-top:0px">Bahan_rendam <?php echo $button ?></h2>
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="int">Id Bahan <?php echo form_error('id_bahan') ?></label>
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
                    <label for="date">Tgl Rendam <?php echo form_error('tgl_rendam') ?></label>
                    <!-- <input type="text" class="form-control" name="tgl_rendam" id="tgl_rendam" placeholder="Tgl Rendam" value="<?php echo $tgl_rendam; ?>" /> -->
                    <input type="text" id="tgl_rendam" data-date-format='yyyy-mm-dd' name="tgl_rendam" id="tgl_rendam" placeholder="Tgl Rendam" class="form-control" value="<?php echo $tgl_rendam; ?>">
                </div>
                <div class="form-group">
                    <label for="varchar">Kolam <?php echo form_error('kolam') ?></label>
                    <input type="text" class="form-control" name="kolam" id="kolam" placeholder="Kolam" value="<?php echo $kolam; ?>" />
                </div>
                <div class="form-group">
                    <label for="int">Ball <?php echo form_error('ball') ?></label>
                    <input type="text" class="form-control" name="ball" id="ball" placeholder="Ball" value="<?php echo $ball; ?>" />
                </div>
                <div class="form-group">
                    <label for="int">Kg <?php echo form_error('kg') ?></label>
                    <input type="text" class="form-control" name="kg" id="kg" placeholder="Kg" value="<?php echo $kg; ?>" />
                </div>
                <div class="form-group">
                    <label for="date">Tgl Habis <?php echo form_error('tgl_habis') ?></label>
                    <!-- <input type="text" class="form-control" name="tgl_habis" id="tgl_habis" placeholder="Tgl Habis" value="<?php echo $tgl_habis; ?>" /> -->
                    <input type="text" id="tgl_habis" data-date-format='yyyy-mm-dd' name="tgl_habis" id="tgl_habis" placeholder="Tgl Habis" class="form-control" value="<?php echo $tgl_habis; ?>">
                </div>
                <div class="form-group">
                    <label for="int">Keterangan <?php echo form_error('ket') ?></label>
                    <textarea class="form-control" name="ket" id="ket" value="<?php echo $ket; ?>"></textarea>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('bahan_rendam') ?>" class="btn btn-default">Cancel</a>
            </form>
        </section>
        <!-- /.content -->
    </div>

    <?php $this->load->view('template/backend/footer') ?>