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
            <h2 style="margin-top:0px">Detail_spk</h2>
            <form action="<?php echo base_url("detail_po_pabrik/save"); ?>" method="post">
                <button type="button" id="btn-tambah-form">Tambah Data Form</button>
                <button type="button" id="btn-reset-form">Reset Form</button><br><br>
                <b>Item ke 1 :</b>
                <div class="form-group">
                    <label for="int">No SPK</label>
                    <input type="text" class="form-control" name="id_po_pabrik[]" id="id_po_pabrik" placeholder="Id Spk" value="<?php echo $id ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">No Item</label>
                    <input type="text" class="form-control" name="no_item[]" id="no_item" placeholder="No Item" />
                </div>
                <div class="form-group">
                    <label for="varchar">QTY</label>
                    <input type="text" class="form-control" name="qty[]" id="qty" placeholder="Qty" />
                </div>
                <div id="insert-form"></div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="<?php echo site_url('po_pabrik') ?>" class="btn btn-default">Cancel</a>
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
                            '<label for="int">No SPK</label>' +
                            '<input type="text" class="form-control" name="id_po_pabrik[]" id="id_po_pabrik" placeholder="Id s" value="<?php echo $id ?>" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="varchar">No Item</label>' +
                            '<input type="text" class="form-control" name="no_item[]" id="no_item" placeholder="No Item" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="varchar">QTY</label>' +
                            '<input type="text" class="form-control" name="qty[]" id="qty" placeholder="Qty" />' +
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