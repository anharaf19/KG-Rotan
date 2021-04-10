<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Detail_po List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Po</th>
		<th>No Item</th>
		<th>Jenis Pack</th>
		<th>Total Order</th>
		<th>Sisa Order</th>
		<th>Order Reff</th>
		<th>Pack</th>
		<th>Total Ctn</th>
		<th>Cbm Ctn</th>
		<th>Total Cbm</th>
		
            </tr><?php
            foreach ($detail_po_data as $detail_po)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $detail_po->id_po ?></td>
		      <td><?php echo $detail_po->no_item ?></td>
		      <td><?php echo $detail_po->jenis_pack ?></td>
		      <td><?php echo $detail_po->total_order ?></td>
		      <td><?php echo $detail_po->sisa_order ?></td>
		      <td><?php echo $detail_po->order_reff ?></td>
		      <td><?php echo $detail_po->pack ?></td>
		      <td><?php echo $detail_po->total_ctn ?></td>
		      <td><?php echo $detail_po->cbm_ctn ?></td>
		      <td><?php echo $detail_po->total_cbm ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>