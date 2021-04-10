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
        <h2>Bahan_masuk List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Bahan</th>
		<th>Tgl Masuk</th>
		<th>Ball</th>
		<th>Kg</th>
		<th>Asal Bahan</th>
		
            </tr><?php
            foreach ($bahan_masuk_data as $bahan_masuk)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $bahan_masuk->id_bahan ?></td>
		      <td><?php echo $bahan_masuk->tgl_masuk ?></td>
		      <td><?php echo $bahan_masuk->ball ?></td>
		      <td><?php echo $bahan_masuk->kg ?></td>
		      <td><?php echo $bahan_masuk->asal_bahan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>