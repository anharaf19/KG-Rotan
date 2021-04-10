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
        <h2>Bahan_rendam List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Bahan</th>
		<th>Tgl Rendam</th>
		<th>Kolam</th>
		<th>Ball</th>
		<th>Kg</th>
		<th>Tgl Habis</th>
		
            </tr><?php
            foreach ($bahan_rendam_data as $bahan_rendam)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $bahan_rendam->id_bahan ?></td>
		      <td><?php echo $bahan_rendam->tgl_rendam ?></td>
		      <td><?php echo $bahan_rendam->kolam ?></td>
		      <td><?php echo $bahan_rendam->ball ?></td>
		      <td><?php echo $bahan_rendam->kg ?></td>
		      <td><?php echo $bahan_rendam->tgl_habis ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>