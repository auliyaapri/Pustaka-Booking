<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');
date_default_timezone_set('Asia/Jakarta');
class Booking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model(['ModelBooking', 'ModelUser']);
    }
    public function index()
    {
        $id = ['bo.id_user' => $this->uri->segment(3)];
        $id_user = $this->session->userdata('id_user');
        $data['booking'] = $this->ModelBooking->joinOrder($id)->result();
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        foreach ($user as $a) {
            $data = [
                'image' => $user['image'],
                'user' => $user['nama'],
                'email' => $user['email'],
                'tanggal_input' => $user['tanggal_input']
            ];
        }
        $dtb = $this->ModelBooking->showtemp(['id_user' => $id_user])->num_rows();
        if ($dtb < 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alertmassege alert-danger" role="alert">Tidak Ada Buku dikeranjang</div>');
            redirect(base_url());
        } else {
            $data['temp'] = $this->db->query("select image, judul_buku, penulis, penerbit, tahun_terbit,id_buku from temp WHERE id_user='$id_user'")->result_array();
        }
        $data['judul'] = "Data Booking";
        $this->load->view('templates/templates-user/header', $data);
        $this->load->view('booking/data-booking', $data);
        $this->load->view('templates/templates-user/modal');
        $this->load->view('templates/templates-user/footer');
    }
    public function tambahBooking()
    {
        $id_buku = $this->uri->segment(3);
        //memilih data buku yang untuk dimasukkan ke tabel temp/keranjang melalui variabel $isi
        $d = $this->db->query("SELECT * FROM buku WHERE id='$id_buku'")->row();
        //berupa data2 yang akan disimpan ke dalam tabel temp/keranjang
        $isi = [
            'id_buku' => $id_buku,
            'judul_buku' => $d->judul_buku,
            'id_user' => $this->session->userdata('id_user'),
            'email_user' => $this->session->userdata('email'),
            'tgl_booking' => date('Y-m-d H:i:s'),
            'image' => $d->image,
            'penulis' => $d->pengarang,
            'penerbit' => $d->penerbit,
            'tahun_terbit' => $d->tahun_terbit
        ];
        //cek apakah buku yang di klik booking sudah ada di keranjang
        $temp = $this->ModelBooking->getDataWHERE('temp', ['id_buku' => $id_buku, 'id_user' => $this->session->userdata('id_user')])->num_rows();

        $userid = $this->session->userdata('id_user');
        //cek jika sudah memasukan 3 buku untuk dibooking dalam keranjang
        $tempuser = $this->db->query("SELECT * FROM temp WHERE id_user ='$userid'")->num_rows();
        //cek jika masih ada booking buku yang belum diambil
        $databooking = $this->db->query("SELECT * FROM booking WHERE id_user='$userid'")->num_rows();
        if ($databooking > 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Masih Ada booking buku sebelumnya yang belum diambil.<br> Abmil Buku yang dibooking atau tunggu 1x24 Jam untuk bisa booking kembali </div>');
            redirect(base_url());
        }
        //jika buku yang diklik booking sudah ada di keranjang
        if ($temp > 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Buku ini Sudah anda booking </div>');
            redirect(base_url() . 'home');
        }
        //jika buku yang akan dibooking sudah mencapai 3 item
        if ($tempuser == 3) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Booking Buku Tidak Boleh Lebih dari 3</div>');
            redirect(base_url() . 'home');
        }
        //membuat tabel temp jika belum ada
        $this->ModelBooking->createTemp();
        $this->ModelBooking->insertData('temp', $isi);
        //pesan ketika berhasil memasukkan buku ke keranjang
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Buku berhasil ditambahkan ke keranjang </div>');
        redirect(base_url() . 'home');
    }

    //================= HAPUS =====================
    // public function hapusbooking()
    // {
    //     $id_buku = $this->uri->segment(3);
    //     $id_user = $this->session->userdata('id_user');
    //     $this->ModelBooking->deleteData(['id_buku' => $id_buku], 'temp');
    //     $kosong = $this->db->query("SELECT * FROM temp WHERE id_user='$id_user'")->num_rows();
    //     if ($kosong < 1) {
    //         $this->session->set_flashdata('pesan', '<div class="alert alert-massege alert-danger" role="alert">Tidak Ada Buku dikeranjang</div>');
    //         redirect(base_url());
    //     } else {
    //         redirect(base_url() . 'booking');
    //     }
    //     $this->ModelBooking->deleteData(['id_buku' => $id_buku], 'temp');
    //     $kosong = $this->db->query("SELECT * FROM temp WHERE id_user='$id_user'")->num_rows();
    //     if ($kosong < 1) {
    //         $this->session->set_flashdata('pesan', '<div class="alert alert-massege alert-danger" role="alert">Tidak Ada Buku dikeranjang</div>');
    //         redirect(base_url());
    //     } else {
    //         redirect(base_url() . 'booking');
    //     }
    // }
    //================= HAPUS =====================

    public function hapusbooking($id_buku)
    {
        // Dapatkan ID booking yang akan dihapus
        $id_booking = $this->uri->segment(3);

        // Periksa apakah pengguna yang ingin menghapus booking adalah pemilik booking tersebut
        $booking = $this->ModelBooking->getDataWHERE('temp', ['id_buku' => $id_buku, 'id_user' => $this->session->userdata('id_user')])->row();

        if (!$booking) {
            // Jika ID pengguna tidak cocok, berikan pesan kesalahan dan arahkan pengguna ke halaman yang sesuai
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Anda tidak memiliki izin untuk menghapus booking ini.</div>');
            redirect(base_url() . 'booking');
        }

        // Jika validasi berhasil, hapus booking dari database
        $this->ModelBooking->db->where(['id_buku' => $id_buku, 'id_user' => $this->session->userdata('id_user')]);
        $this->ModelBooking->db->delete('temp');

        // Setelah menghapus booking, arahkan pengguna ke halaman yang sesuai
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Booking berhasil dihapus.</div>');
        redirect(base_url() . 'home');
    }



    public function bookingSelesai($WHERE)
    {
        //mengupdate stok dan dibooking di tabel buku saat proses booking diselesaikan
        $this->db->query("UPDATE buku, temp SET buku.dibooking = buku.dibooking+1, buku.stok=buku.stok-1 WHERE buku.id=temp.id_buku");
        $tglsekarang = date('Y-m-d');
        $isibooking = [
            'id_booking' => $this->ModelBooking->kodeOtomatis('booking', 'id_booking'),
            'tgl_booking' => date('Y-m-d H:m:s'),
            'batas_ambil' => date('Y-md', strtotime('+2 days', strtotime($tglsekarang))),
            'id_user' => $WHERE
        ];
        //menyimpan ke tabel booking dan detail booking, dan mengosongkan tabel temporari
        $this->ModelBooking->insertData('booking', $isibooking);
        $this->ModelBooking->simpanDetail($WHERE);
        $this->ModelBooking->kosongkanData('temp');
        redirect(base_url() . 'booking/info');       
    }



    public function info()
    {
        $WHERE = $this->session->userdata('id_user');
        $data['user'] = $this->session->userdata('nama');
        $data['judul'] = "Selesai Booking";
        $data['useraktif'] = $this->ModelUser->cekData(['id' => $this->session->userdata('id_user')])->result();
        $data['items'] = $this->db->query("SELECT * FROM booking bo, booking_detail d, buku bu WHERE d.id_booking=bo.id_booking AND d.id_buku=bu.id AND bo.id_user='$WHERE'")->result_array();
        $this->load->view('templates/templates-user/header', $data);
        $this->load->view('booking/info-booking', $data);
        $this->load->view('templates/templates-user/modal');
        $this->load->view('templates/templates-user/footer');
    }
    public function exportToPdf()
    {
        $id_user = $this->session->userdata('id_user');
        $data['user'] = $this->session->userdata('nama');
        $data['judul'] = "Cetak Bukti Booking";
        $data['useraktif'] = $this->ModelUser->cekData(['id' => $this->session->userdata('id_user')])->result();
        $data['items'] = $this->db->query("SELECT * FROM booking bo, booking_detail d, buku bu WHERE d.id_booking = bo.id_booking AND d.id_buku=bu.id AND bo.id_user='$id_user'")->result_array();
        // $data['items'] = $this->db->query("select*from booking bo, booking_detail d, buku bu where d.id_booking=bo.id_booking and d.id_buku=bu.id and bo.id_user='$id_user'")->result_array();

        // $this->load->library('dompdf_gen');
        $sroot = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/pustaka-booking/application/third_party/dompdf/autoload.inc.php";
        $dompdf = new Dompdf\Dompdf();
        $this->load->view('booking/bukti-pdf', $data);
        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();
        $dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("bukti-booking-$id_user.pdf", array('Attachment' => 0));
        // nama file pdf yang di hasilkan
    }
}
