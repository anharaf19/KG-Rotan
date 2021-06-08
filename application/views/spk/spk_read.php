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
            <h2 style="margin-top:0px">Spk Read</h2>
            <table class="table">
                <tr>
                    <td>No Spk</td>
                    <td><?php echo $no_spk; ?></td>
                </tr>
                <tr>
                    <td>Id Po Pabrik</td>
                    <td><?php echo $id_detail_po_pabrik; ?></td>
                </tr>
                <tr>
                    <td>Id Sub</td>
                    <td><?php echo $id_sub; ?></td>
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
                    <td>Status</td>
                    <td><?php echo $status; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><a href="<?php echo site_url('spk') ?>" class="btn btn-default">Cancel</a></td>
                </tr>
            </table>
            <table class="table table-bordered table-striped" id="mytable">
                <thead>
                    <tr>
                        <th>No Spk</th>
                        <th>No Item</th>
                        <th>Total Qty</th>
                        <th>Kg</th>
                        <th>Ball</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($lihatdetailspk as $rows) {
                    ?>
                        <tr>
                            <td><?php echo $rows->no_spk; ?></td>
                            <td><?php echo $rows->no_item; ?></td>
                            <td><?php echo $rows->total_qty; ?></td>
                            <td><?php echo $rows->kg; ?></td>
                            <td><?php echo $rows->ball; ?></td>
                        </tr>
                    <?php

                    } ?>
                </tbody>
            </table>
        </section>
    </div>

    <?php $this->load->view('template/backend/footer') ?>