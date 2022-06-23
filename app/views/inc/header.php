<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sistem Informasi Baristand Banjarbaru">
  <meta name="author" content="Baristand Banjarbaru">
  <!-- <link href="img/logo/logo.png" rel="icon"> -->
  <title><?= SITENAME; ?></title>
  <link href="<?= URLROOT; ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?= URLROOT; ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?= URLROOT; ?>/css/ruang-admin.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="<?= URLROOT; ?>/img/logo/logo.png" type="image/x-icon">
  <!-- DataTables  CSS -->
  <link href="<?= URLROOT; ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Sweetalert 2 CSS -->
	<link rel="stylesheet" href="<?= URLROOT; ?>/vendor/sweetalert2/sweetalert2.min.css">
  <!-- Select2 -->
  <link href="<?= URLROOT; ?>/vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
  <!-- Bootstrap DatePicker -->  
  <link href="<?= URLROOT; ?>/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" >
  <!-- Bootstrap Touchspin -->
  <link href="<?= URLROOT; ?>/vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css" rel="stylesheet" >
  <!-- ClockPicker -->
  <link href="<?= URLROOT; ?>/vendor/clock-picker/clockpicker.css" rel="stylesheet">
  <style>
    input::placeholder,textarea::placeholder{
      color: #bfbfbf !important;
    }
    .bg-navbar{
      background-color: #302b63;
    }
    .sidebar-light .sidebar-brand {
      background-color: #24243e;
    }

    .select2-container .select2-selection--single{
      height: 35px !important;
    }
    .select2-container .select2-selection--single .select2-selection__rendered{
      padding-top: 3px !important;
    }

    .avatar-upload {
      position: relative;
      max-width: 205px;
      margin: 20px auto;
    }

    .avatar-upload .avatar-edit{
      position: absolute;
      right: 12px;
      z-index: 1;
      top: 10px;
    }

    .avatar-upload .avatar-edit input{
      display: none;
    }

    .avatar-upload .avatar-edit label{
      display: inline-block;
      width: 34px;
      height: 34px;
      margin-bottom: 0;
      border-radius: 100%;
      background: #FFFFFF;
      border: 1px solid transparent;
      box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
      cursor: pointer;
      font-weight: normal;
      transition: all .2s ease-in-out;
    }

    .avatar-upload .avatar-edit label:hover {
        background: #f1f1f1;
        border-color: #d6d6d6;
    }
    .avatar-upload .avatar-edit label i {
        color: #757575;
        position: absolute;
        top: 10px;
        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
    }

    .avatar-preview {
        width: 192px;
        height: 192px;
        position: relative;
        border-radius: 100%;
        border: 6px solid #F8F8F8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }
    .avatar-preview div{
      width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
    }
  </style>
</head>

<body id="page-top">
  <div id="wrapper">
  <?php require APPROOT . '/views/inc/sidebar.php'; ?>