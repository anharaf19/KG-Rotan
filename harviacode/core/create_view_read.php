<?php 

$string = "
<!doctype html>
<html>
    <head>
        <title> Read</title>
        <?php \$this->load->view('template/backend/header') ?>
        <?php \$this->load->view('template/backend/navbar') ?>
        <?php \$this->load->view('template/backend/sidebar') ?>
    </head>
    <body>
    <div class=\"content-wrapper\">
    <div class=\"content-header\">
    <div class=\"container-fluid\">
</div>
</div>
    <section class=\"content\">
        <h2 style=\"margin-top:0px\">".ucfirst($table_name)." Read</h2>
        <table class=\"table\">";
foreach ($non_pk as $row) {
    $string .= "\n\t    <tr><td>".label($row["column_name"])."</td><td><?php echo $".$row["column_name"]."; ?></td></tr>";
}
$string .= "\n\t    <tr><td></td><td><a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-default\">Cancel</a></td></tr>";
$string .= "\n\t</table>
</section>
</div>

    <?php \$this->load->view('template/backend/footer') ?>";



$hasil_view_read = createFile($string, $target."views/" . $c_url . "/" . $v_read_file);

?>