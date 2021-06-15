<!doctype html>
<html>

<head>
    <title> Read</title>
    <?php $this->load->view('template/backend/header') ?>
    <?php $this->load->view('template/backend/navbar') ?>
    <?php $this->load->view('template/backend/sidebar') ?>
</head>

<body>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
            </div>
        </div>
        <section class="content">
            <h2 style="margin-top:0px">Po Read</h2>
            <table class="table">
                <tr>
                    <td>No Po</td>
                    <td><?php echo $no_po; ?></td>
                </tr>
                <tr>
                    <td>Id Pembeli</td>
                    <td><?php echo $id_pembeli; ?></td>
                </tr>
                <tr>
                    <td>Tgl Mulai</td>
                    <td><?php echo $tgl_mulai; ?></td>
                </tr>
                <tr>
                    <td>Tgl Selesai</td>
                    <td><?php echo $tgl_selesai; ?></td>
                </tr>
                <tr>
                    <td>Ket</td>
                    <td><?php echo $ket; ?></td>
                </tr>
                <tr>
                    <td>
                        <form action="<?php echo base_url('po/selesai') ?>" method="post">
                            <input type="hidden" name='id' value="<?php echo $id; ?>" />
                            <button type="submit" class="btn btn-primary">Selesai</button>
                        </form>
                    </td>
                    <td><a href="<?php echo site_url('po') ?>" class="btn btn-default">Cancel</a></td>
                </tr>
            </table>
            <table class="table table-bordered table-striped" id="mytable">
                <thead>
                    <tr>
                        <th>No Po</th>
                        <th>No Item</th>
                        <th>Nama Item</th>
                        <th>Jenis Pack</th>
                        <th>Total Order</th>
                        <th>Order Reff</th>
                        <th>Pack</th>
                        <th>Total Ctn</th>
                        <th>Cbm Ctn</th>
                        <th>Total Cbm</th>
                        <th>Harga Sub</th>
                        <th>Harga Anyam</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($lihatdetailpo as $rows) {
                    ?>
                        <tr>
                            <td><?php echo $rows->no_po; ?></td>
                            <td><?php echo $rows->no_item; ?></td>
                            <td><?php echo $rows->nama_item; ?></td>
                            <td><?php echo $rows->jenis_pack; ?></td>
                            <td><?php echo $rows->total_order; ?></td>
                            <td><?php echo $rows->order_reff; ?></td>
                            <td><?php echo $rows->pack; ?></td>
                            <td><?php echo $rows->total_ctn; ?></td>
                            <td><?php echo $rows->cbm_ctn; ?></td>
                            <td><?php echo $rows->total_cbm; ?></td>
                            <td><?php echo $rows->harga_sub; ?></td>
                            <td><?php echo $rows->harga_anyam; ?></td>
                        </tr>
                    <?php

                    } ?>
                </tbody>
            </table>
        </section>
    </div>

    <?php $this->load->view('template/backend/footer') ?>