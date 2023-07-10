<?= $this->session->flashdata('pesan'); ?>

<div style="padding: 25px;">
    <div class="x_panel">
        <div class="x_content">
            <!-- Tampilkan semua produk -->
            <div class="row">
                <!-- Looping products -->
                <?php foreach ($buku as $buku1) { ?>
                    <div class="col-md-2 col-md-3">
                        <div class="thumbnail" style="height: 370px;">
                            <img src="<?php echo base_url(); ?>assets/img/upload/<?= $buku1->image; ?>" style="max-width:100%; maxheight: 100%; height: 200px; width: 180px">
                            <div class="caption">
                                <h5 style="min-height:30px;"><?= $buku1->pengarang ?></h5>
                                <h5><?= $buku1->penerbit ?></h5>
                                <h5><?= substr($buku1->tahun_terbit, 0, 4) ?></h5>
                                <p>
                                    <?php
                                    if ($buku1->stok < 1) {
                                        echo "<button type='button' class='btn btn-outline-accelerator-primary fa fa-shopping-cart bg-danger' data-toggle='modal' data-target='#bookingAlert'>Booking&nbsp;&nbsp;0</button>";
                                    } else {
                                        echo "<a class='btn btn-outline-primary fa fa-shopping-cart' href='" . base_url('booking/tambahBooking/' . $buku1->id) . "'>Booking</a>";
                                    }
                                    ?>
                                    <a class="btn btn-outline-warning fas fw fa-search" href="<?= base_url('Home/detailBuku/'.$buku1->id); ?>">Detail</a>
                                </p>
                            </div>
                        </div>
                    </div> 
                <?php } ?>
                <!-- End looping -->
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap modal for booking alert -->
<div class="modal fade" id="bookingAlert" tabindex="-1" role="dialog" aria-labelledby="bookingAlertLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingAlertLabel">Pemberitahuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Mohon maaf stok buku kosong.</p>
            </div>
        </div>
    </div>
</div>