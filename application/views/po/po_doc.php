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
        <h2>Po List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Pembeli</th>
		<th>Tgl Mulai</th>
		<th>Tgl Selesai</th>
		
            </tr><?php
            foreach ($po_data as $po)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $po->id_pembeli ?></td>
		      <td><?php echo $po->tgl_mulai ?></td>
		      <td><?php echo $po->tgl_selesai ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>