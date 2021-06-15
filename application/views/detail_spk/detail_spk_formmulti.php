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
            <form action="<?php echo base_url("detail_spk/save"); ?>" method="post">
                <button type="button" id="btn-tambah-form">Tambah Data Form</button>
                <button type="button" id="btn-reset-form">Reset Form</button><br><br>
                <b>Item ke 1 :</b>
                <div class="form-group">
                    <input type="text" class="form-control" name="id_po_pabrik[]" placeholder="Id Spk" value="<?php echo $id_po_pabrik ?>" />
                    <label for="int">No SPK</label>
                    <input type="text" class="form-control" name="no_spk[]" id="no_spk" placeholder="Id Spk" value="<?php echo $no_spk ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">No Item</label>
                    <select id="no_item" name="no_item[]" class="form-control"></select>
                    <!-- <input type="text" class="form-control" name="no_item[]" id="no_item" placeholder="No Item" /> -->
                </div>
                <div class="form-group">
                    <label for="varchar">QTY</label>
                    <input type="text" class="form-control" name="qty[]" id="qty" placeholder="Qty" />
                </div>
                <div class="form-group">
                    <label for="varchar">Bahan</label>
                    <input type="text" class="form-control" name="id_bahan_rendam[]" id="id_bahan_rendam" placeholder="Bahan" />
                </div>
                <div class="form-group">
                    <label for="int">Ball</label>
                    <input type="text" class="form-control" name="ball[]" id="ball" placeholder="Total Order" />
                </div>
                <div class="form-group">
                    <label for="int">KG</label>
                    <input type="text" class="form-control" name="kg[]" id="kg" placeholder="Order Reff" />
                </div>
                <div id="insert-form"></div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="<?php echo site_url('spk') ?>" class="btn btn-default">Cancel</a>
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
                            '<input type="text" class="form-control" name="no_spk[]" id="no_spk" placeholder="Id s" value="<?php echo $no_spk ?>" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="varchar">No Item</label>' +
                            // '<select id="no_item" name="no_item[]" class="form-control"></select>' +
                            '<input type="text" class="form-control" name="no_item[]"  placeholder="No Item" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="varchar">QTY</label>' +
                            '<input type="text" class="form-control" name="qty[]" id="qty" placeholder="Qty" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="varchar">Bahan</label>' +
                            '<input type="text" class="form-control" name="id_bahan_rendam[]" id="id_bahan_rendam" placeholder="Bahan" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="int">Ball</label>' +
                            '<input type="text" class="form-control" name="ball[]" id="ball" placeholder="Total Order" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="int">KG</label>' +
                            '<input type="text" class="form-control" name="kg[]" id="kg" placeholder="Order Reff" />' +
                            '</div>');

                        $("#jumlah-form").val(nextform); // Ubah value textbox jumlah-form dengan variabel nextform
                    });


                    // Buat fungsi untuk mereset form ke semula
                    $("#btn-reset-form").click(function() {
                        $("#insert-form").html(""); // Kita kosongkan isi dari div insert-form
                        $("#jumlah-form").val("1"); // Ubah kembali value jumlah form menjadi 1
                    });


                    var $select = $('#no_item');

                    $.getJSON('<?php echo base_url("detail_spk/get_no_item"); ?>', function(data) {
                        $select.html('');
                        for (var i = 0; i < data.length; i++) {
                            $select.append('<option id="' + data[i]['no_item'] + '">' + data[i]['no_item'] + '</option>');
                        }
                    });


                });
            </script>
        </section>
        <!-- /.content -->

    </div>

    <?php $this->load->view('template/backend/footer') ?>