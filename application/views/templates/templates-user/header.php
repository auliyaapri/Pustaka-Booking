<!DOCTYPE html>
<html lang="ens">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pustaka-Booking | <?= $judul; ?></title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/logo/'); ?>logo-pb.png">
    
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>user/css/bootstrap.css">
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>datatable/datatables.css" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url(); ?>">Pustaka</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <!-- <a class="nav-item navlink active" href="<?= base_url(); ?>">Beranda</a> -->
                    <?php
                    if (!empty($this->session->userdata('email'))) { ?>
                        <a class="nav-item nav-link" href="<?=base_url('booking');?>">Buku <b><?=$this->ModelBooking->getDataWhere('temp',['email_user' => $this->session->userdata('email')])->num_rows();?></b></a>
                        <a class="nav-item nav-link" href="<?= base_url('member/myprofil'); ?>">Profil Saya</a>
                        <a class="nav-item nav-link" href="<?= base_url('member/logout'); ?>"><i class="fas fw falogin"></i> Log out</a>
                    <?php } else { ?>
                        <!-- <a class="nav-item nav-link active" data-toggle="modal" datatarget="#daftarModal" href="#"><i class="fas fw fa-login"></i> Beranda</a> -->
                        <a class="nav-item nav-link" data-toggle="modal" data-target="#daftarModal"href="#"><i class="fas fw fa-login"></i> Daftar</a>
                        <a class="nav-item nav-link" data-toggle="modal" data-target="#loginModal" href="#"><i class="fas fw fa-login"></i> Log in</a>
                    <?php } ?>
                    <span class="nav-item nav-link navright" style="display:block; marginleft:20px;">Selamat Datang <b><?= $user; ?></b></span>
                </div>
            </div>
        </div>
    </nav>  
    <div class="container mt-5">
        

    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->