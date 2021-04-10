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
        <h2>Detail_spk List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Spk</th>
		<th>No Item</th>
		<th>Qty</th>
		<th>Harga</th>
		
            </tr><?php
            foreach ($detail_spk_data as $detail_spk)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $detail_spk->id_spk ?></td>
		      <td><?php echo $detail_spk->no_item ?></td>
		      <td><?php echo $detail_spk->qty ?></td>
		      <td><?php echo $detail_spk->harga ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>