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
            <h2 style="margin-top:0px">Detail_po</h2>
            <form action="<?php echo base_url("detail_po/save"); ?>" method="post">
                <button type="button" id="btn-tambah-form">Tambah Data Form</button>
                <button type="button" id="btn-reset-form">Reset Form</button><br><br>
                <b>Item ke 1 :</b>
                <div class="form-group">
                    <label for="int">Id Po</label>
                    <input type="text" class="form-control" name="no_po[]" id="no_po" placeholder="Id PO" value="<?php echo $no_po ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">No Item</label>
                    <input type="text" class="form-control" name="no_item[]" id="no_item" placeholder="No Item" />
                </div>
                <div class="form-group">
                    <label for="varchar">Nama Item</label>
                    <input type="text" class="form-control" name="nama_item[]" id="nama_item" placeholder="Nama Item" />
                </div>
                <div class="form-group">
                    <label for="varchar">Jenis Pack</label>
                    <input type="text" class="form-control" name="jenis_pack[]" id="jenis_pack" placeholder="Jenis Pack" />
                </div>
                <div class="form-group">
                    <label for="int">Total Order</label>
                    <input type="text" class="form-control" name="total_order[]" id="total_order" placeholder="Total Order" />
                </div>
                <div class="form-group">
                    <label for="int">Order Reff</label>
                    <input type="text" class="form-control" name="order_reff[]" id="order_reff" placeholder="Order Reff" />
                </div>
                <div class="form-group">
                    <label for="int">Pack</label>
                    <input type="text" class="form-control" name="pack[]" id="pack" placeholder="Pack" />
                </div>
                <div class="form-group">
                    <label for="int">Total Ctn</label>
                    <input type="text" class="form-control" name="total_ctn[]" id="total_ctn" placeholder="Total Ctn" />
                </div>
                <div class="form-group">
                    <label for="int">Cbm Ctn</label>
                    <input type="text" class="form-control" name="cbm_ctn[]" id="cbm_ctn" placeholder="Cbm Ctn" />
                </div>
                <div class="form-group">
                    <label for="int">Total Cbm</label>
                    <input type="text" class="form-control" name="total_cbm[]" id="total_cbm" placeholder="Total Cbm" />
                </div>
                <div class="form-group">
                    <label for="int">Harga Sub</label>
                    <input type="text" class="form-control" name="harga_sub[]" id="harga_sub" placeholder="Harga Sub" />
                </div>
                <div class="form-group">
                    <label for="int">Harga Anyam</label>
                    <input type="text" class="form-control" name="harga_anyam[]" id="harga_anyam" placeholder="Harga Anyam" />
                </div>
                <div id="insert-form"></div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="<?php echo site_url('detail_po') ?>" class="btn btn-default">Cancel</a>
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
                            '<label for="int">Id Po</label>' +
                            '<input type="text" class="form-control" name="no_po[]" id="no_po" placeholder="Id PO" value="<?php echo $no_po ?>"/>' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="varchar">No Item</label>' +
                            '<input type="text" class="form-control" name="no_item[]" id="no_item" placeholder="No Item" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="varchar">Nama Item</label>' +
                            '<input type="text" class="form-control" name="nama_item[]" id="nama_item" placeholder="Nama Item" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="varchar">Jenis Pack</label>' +
                            '<input type="text" class="form-control" name="jenis_pack[]" id="jenis_pack" placeholder="Jenis Pack" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="int">Total Order</label>' +
                            '<input type="text" class="form-control" name="total_order[]" id="total_order" placeholder="Total Order" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="int">Order Reff</label>' +
                            '<input type="text" class="form-control" name="order_reff[]" id="order_reff" placeholder="Order Reff" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="int">Pack</label>' +
                            '<input type="text" class="form-control" name="pack[]" id="pack" placeholder="Pack" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="int">Total Ctn</label>' +
                            '<input type="text" class="form-control" name="total_ctn[]" id="total_ctn" placeholder="Total Ctn" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="int">Cbm Ctn</label>' +
                            '<input type="text" class="form-control" name="cbm_ctn[]" id="cbm_ctn" placeholder="Cbm Ctn" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="int">Total Cbm</label>' +
                            '<input type="text" class="form-control" name="total_cbm[]" id="total_cbm" placeholder="Total Cbm" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="int">Harga Sub</label>' +
                            '<input type="text" class="form-control" name="harga_sub[]" id="harga_sub" placeholder="Harga Sub" />' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="int">Harga Anyam/label>' +
                            '<input type="text" class="form-control" name="harga_anyam[]" id="harga_anyam" placeholder="Harga Anyam" />' +
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