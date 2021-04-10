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
        <h2>Spk List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Po</th>
		<th>Id Sub</th>
		<th>Id Pabrik</th>
		<th>Id Bahan Rendam</th>
		<th>Tgl</th>
		<th>Jenis</th>
		<th>Total Bahan</th>
		
            </tr><?php
            foreach ($spk_data as $spk)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $spk->id_po ?></td>
		      <td><?php echo $spk->id_sub ?></td>
		      <td><?php echo $spk->id_pabrik ?></td>
		      <td><?php echo $spk->id_bahan_rendam ?></td>
		      <td><?php echo $spk->tgl ?></td>
		      <td><?php echo $spk->jenis ?></td>
		      <td><?php echo $spk->total_bahan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>