<?php 

$string = "<!doctype html>
<html>
    <head>
    <title>Form</title>
    <?php \$this->load->view('template/backend/header') ?>
    <?php \$this->load->view('template/backend/navbar') ?>
    <?php \$this->load->view('template/backend/sidebar') ?>
<body>
  <!-- Content Wrapper. Contains page content -->
    <div class=\"content-wrapper\">
<!-- Content Header (Page header) -->
    <div class=\"content-header\">
    <div class=\"container-fluid\">
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class=\"content\">
        <h2 style=\"margin-top:0px\">".ucfirst($table_name)." <?php echo \$button ?></h2>
        <form action=\"<?php echo \$action; ?>\" method=\"post\">";
foreach ($non_pk as $row) {
    if ($row["data_type"] == 'text')
    {
    $string .= "\n\t    <div class=\"form-group\">
            <label for=\"".$row["column_name"]."\">".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
            <textarea class=\"form-control\" rows=\"3\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\"><?php echo $".$row["column_name"]."; ?></textarea>
        </div>";
    } else
    {
    $string .= "\n\t    <div class=\"form-group\">
            <label for=\"".$row["data_type"]."\">".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
            <input type=\"text\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" />
        </div>";
    }
}
$string .= "\n\t    <input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo $".$pk."; ?>\" /> ";
$string .= "\n\t    <button type=\"submit\" class=\"btn btn-primary\"><?php echo \$button ?></button> ";
$string .= "\n\t    <a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-default\">Cancel</a>";
$string .= "\n\t</form>
    </section>
    <!-- /.content -->
  </div>

    <?php \$this->load->view('template/backend/footer') ?>";

$hasil_view_form = createFile($string, $target."views/" . $c_url . "/" . $v_form_file);

?>