<!doctype html>
<html>

<head>
    <title>Form</title>
    <?php $this->load->view('template/backend/header') ?>
    <?php $this->load->view('template/backend/navbar') ?>
    <?php $this->load->view('template/backend/sidebar') ?>
    <script src="<?php echo base_url('assets/AdminLTE/plugins/jquery/jquery.min.js') ?>"></script>

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
            <h2 style="margin-top:0px">Detail_pengiriman</h2>
            <form action="<?php echo base_url("detail_pengiriman/save"); ?>" method="post">
                <button type="button" id="btn-tambah-form">Tambah Data Form</button>
                <button type="button" id="btn-reset-form">Reset Form</button><br><br>
                <div class="form-group">
                    <label for="int">No Pengiriman </label>
                    <input type="text" class="form-control" name="no_pengiriman[]" id="no_pengiriman" placeholder="No Pengiriman" value="<?php echo $no_pengiriman; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">No Item</label>
                    <input type="text" class="form-control" name="no_item" id="no_item" placeholder="No Item" value="" />

                    <!-- <select name="no_item[]" id="no_item" class="form-control">
                        <?php foreach ($lihatwarehouse as $row => $data1) { ?>
                            <option value=" <?php echo $data1['no_item'] ?>" <?php if (isset($data1['no_item']) && $data1['no_item'] == $no_item) {
                                                                                    echo 'selected';
                                                                                } ?>>
                                <?php {
                                    echo $data1['no_item'];
                                }; ?> </option>
                        <?php } ?>
                    </select> -->
                </div>
                <div class="form-group">
                    <label for="varchar">No Po</label>
                    <input type="text" class="form-control" name="no_po" id="no_po" placeholder="No Po" value="" />

                    <!-- <select name="no_po[]" id="no_po" class="form-control">
                        <?php
                        foreach ($lihatwarehouse as $row => $data) {
                        ?>
                            <option value=" <?php echo $data['no_po'] ?>" <?php if (isset($data['no_po']) && $data['no_item'] == $no_po) {
                                                                                echo 'selected';
                                                                            } ?>>
                                <?php {
                                    echo $data['no_po'];
                                }; ?> </option>
                        <?php
                        }
                        ?>
                    </select> -->
                </div>
                <div class="form-group">
                    <label for="int">Qty</label>
                    <input type="text" class="form-control" name="qty[]" id="qty" placeholder="Qty" value="" />
                </div>
                <div id="insert-form"></div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="<?php echo site_url('detail_pengiriman') ?>" class="btn btn-default">Cancel</a>
            </form>
            <input type="hidden" id="jumlah-form" value="1">
            <script>
                $(document).ready(function() { // Ketika halaman sudah diload dan siap
                    $("#btn-tambah-form").click(function() { // Ketika tombol Tambah Data Form di klik
                        console.log('bas')
                        var jumlah = parseInt($("#jumlah-form").val()); // Ambil jumlah data form pada textbox jumlah-form
                        var nextform = jumlah + 1; // Tambah 1 untuk jumlah form nya

                        // Kita akan menambahkan form dengan menggunakan append
                        // pada sebuah tag div yg kita beri id insert-form
                        $("#insert-form").append('<hr><b>Item ke ' + nextform + ' :</b>' +
                            '<div class="form-group">' +
                            '<label for="int">No Pengiriman</label>' +
                            '<input type="text" class="form-control" name="no_pengiriman[]" id="no_pengiriman" placeholder="No Pengiriman" value="<?php echo $no_pengiriman; ?>" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="varchar">No Item</label>' +
                            '<select name="no_item[]" id="no_item" class="form-control">' +
                            '<?php foreach ($lihatwarehouse as $row => $data) { ?>' +
                            '<option value=" <?php echo $data[`no_item`] ?>" <?php if (isset($data[`no_item`]) && $data[`no_item`] == $no_item) {
                                                                                    echo `selected`;
                                                                                } ?>>' +
                            '<?php {
                                        echo $data[`no_item`];
                                    }; ?> </option>' +
                            '<?php } ?>' +
                            '</select>' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="int">Qty</label>' +
                            '<input type="text" class="form-control" name="qty[]" id="qty" placeholder="Qty" value="" />' +
                            '</div>');

                        $("#jumlah-form").val(nextform); // Ubah value textbox jumlah-form dengan variabel nextform
                    });

                    // Buat fungsi untuk mereset form ke semula
                    $("#btn-reset-form").click(function() {
                        $("#insert-form").html(""); // Kita kosongkan isi dari div insert-form
                        $("#jumlah-form").val("1"); // Ubah kembali value jumlah form menjadi 1
                    });
                });
            </script>
        </section>
        <!-- /.content -->
    </div>

    <?php $this->load->view('template/backend/footer') ?>