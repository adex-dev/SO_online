<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Audit</title>
  <link rel="shortcut icon" href="<?= base_url() ?>content/src/images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/sweetalert2/sweetalert2.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/build/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/bootstrap-datetimepicker/css/jquery.datetimepicker.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/Datatables/datatables.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/Datatables/rowGroup.dataTables.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/Datatables/Buttons-2.2.3/css/buttons.bootstrap5.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/Datatables/FixedHeader-3.2.3/css/fixedHeader.bootstrap.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/Datatables/Scroller-2.0.6/css/scroller.bootstrap.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/bootstrap-datetimepicker/css/jquery.datetimepicker.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url('') ?>content/vendor/Datatables/FixedColumns-4.1.0/css/fixedColumns.dataTables.min.css" />


  <script src="<?= base_url() ?>content/vendor/jquery/jquery.min.js"></script>
  <script>
    var hostname = "<?= base_url() ?>"
  </script>
</head>

<body class="bgroundhome">
  <?= $contents ?>
  <div class="viewModal" style="display: none;"></div>
  <?php if ($this->uri->segment(1) != 'home') : ?>
    <div class="position-absolute d-md-block d-none top-0 mt-3 end-0 px-2 position-fixed" style="width: 50px;">
      <ul class="w-100 list-unstyled">
        <li><button class="btn btn-primary btn-sm  rounded-circle w-100" onclick="window.location.href='<?= site_url('home') ?>'" data-bs-toggle="tooltip" data-bs-placement="left" title="Kembali ke halaman Awal"><i class="fa fa-home"></i></button></li>
        <li><button class="btn btn-danger btn-sm  rounded-circle w-100 btnlogout mt-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Logout"><i class="fa fa-power-off"></i></button></li>
        <li><button class="btn btn-info btn-sm  rounded-circle w-100 mt-1" data-bs-toggle="tooltip" data-bs-placement="left" title="rebuild by @akmadnudin.inc 2022- <?= date('Y') ?>"><i class="fa fa-info"></i></button></li>
      </ul>
    </div>
  <?php endif ?>
  <script src="<?= base_url() ?>content/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>content/vendor/bootstrap-datetimepicker/js/jquery.datetimepicker.full.js"></script>
  <script src="<?= base_url() ?>content/vendor/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?= base_url() ?>content/vendor/popper/umd/popper.min.js"></script>
  <script src="<?= base_url() ?>content/vendor/select2/js/select2.min.js"></script>
  <script src="<?= base_url() ?>content/vendor/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?= base_url() ?>content/build/js/style.js"></script>
  <?php if ($this->uri->segment(1) != 'home') : ?>
    <script src="<?= base_url() ?>content/vendor/Datatables/datatables.min.js"></script>
    <script src="<?= base_url() ?>content/vendor/Datatables/Buttons-2.2.3/js/buttons.html5.js"></script>
    <script src="<?= base_url() ?>content/vendor/Datatables/FixedHeader-3.2.3/js/fixedHeader.bootstrap.js"></script>
    <script src="<?= base_url() ?>content/vendor/Datatables/dataTables.rowGroup.min.js"></script>
    <script src="<?= base_url() ?>content/vendor/Datatables/Scroller-2.0.6/js/scroller.bootstrap.js"></script>
    <script src="<?= base_url() ?>content/vendor/Datatables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="<?= base_url() ?>content/build/js/custometable.js"></script>
    <script src="<?= base_url() ?>content/build/js/prosesing.js"></script>
    <?php endif ?>
    <script src="<?= base_url() ?>content/build/js/modal.js"></script>
</body>

</html>