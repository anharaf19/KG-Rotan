<!doctype html>
<html>

<head>
    <title>Kg-Rotan Bahan_rendam</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
    <?php $this->load->view('template/backend/header') ?>
</head>
<?php $this->load->view('template/backend/navbar') ?>
<?php $this->load->view('template/backend/sidebar') ?>

<body>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Bahan_rendam List</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-4 text-center">
                    <div style="margin-top: 4px" id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
                <div class="col-md-8 text-right">
                    <?php echo anchor(site_url('bahan_rendam/create'), 'Create', 'class="btn btn-primary"'); ?>
                    <?php echo anchor(site_url('bahan_rendam/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                    <?php echo anchor(site_url('bahan_rendam/word'), 'Word', 'class="btn btn-primary"'); ?>
                </div>
            </div>
            <table class="table table-bordered table-striped" id="mytable">
                <thead>
                    <tr>
                        <th width="80px">No</th>
                        <th>Id Bahan</th>
                        <th>Tgl Rendam</th>
                        <th>Kolam</th>
                        <th>Ball</th>
                        <th>Kg</th>
                        <th>Tgl Habis</th>
                        <th>Keterangan</th>
                        <th width="200px">Action</th>
                    </tr>
                </thead>

            </table>
        </section>
        <!-- /.content -->
    </div>
    <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
                return {
                    "iStart": oSettings._iDisplayStart,
                    "iEnd": oSettings.fnDisplayEnd(),
                    "iLength": oSettings._iDisplayLength,
                    "iTotal": oSettings.fnRecordsTotal(),
                    "iFilteredTotal": oSettings.fnRecordsDisplay(),
                    "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                    "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                };
            };

            var t = $("#mytable").dataTable({
                initComplete: function() {
                    var api = this.api();
                    $('#mytable_filter input')
                        .off('.DT')
                        .on('keyup.DT', function(e) {
                            if (e.keyCode == 13) {
                                api.search(this.value).draw();
                            }
                        });
                },
                oLanguage: {
                    sProcessing: "loading..."
                },
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "bahan_rendam/json",
                    "type": "POST"
                },
                columns: [{
                        "data": "id",
                        "orderable": false
                    }, {
                        "data": "nama"
                    }, {
                        "data": "tgl_rendam"
                    }, {
                        "data": "kolam"
                    }, {
                        "data": "ball"
                    }, {
                        "data": "kg"
                    }, {
                        "data": "tgl_habis"
                    },
                    {
                        "data": "ket"
                    },
                    {
                        "data": "action",
                        "orderable": false,
                        "className": "text-center"
                    }
                ],
                order: [
                    [0, 'desc']
                ],
                rowCallback: function(row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                    var page = info.iPage;
                    var length = info.iLength;
                    var index = page * length + (iDisplayIndex + 1);
                    $('td:eq(0)', row).html(index);
                }
            });
        });
    </script>
</body>
<?php $this->load->view('template/backend/footer') ?>