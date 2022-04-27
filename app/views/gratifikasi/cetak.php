<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pemberian Gratifikasi - Baristand Banjarbaru</title>
    <style>
      *{
        font-family: sans-serif;
        margin: 0 auto;
      }
      h1,h2,h3,h4,h5,h6{
        padding: 0;
        margin: 0;
        color: #292929;
      }
      p{
        margin: 0;
        padding: 0;
      }
      ul{
        padding:0;
        margin:0;
      }
      li{
        list-style-type: none;
      }

      hr{
        border-bottom: 1px solid black;
      }
      
      .row{
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
      }
      .gambar img{
        object-fit: cover;
        height: 30px;
        margin-bottom: 10px;
      }
      .header{
        width: 100%;
        margin: 0 auto;
      }
      .title{
        padding:10px 20px;
      }
      
      .content{
        width: 95%;
        margin-top: 20px;
        padding: 10px 0;
        padding-bottom: 50px;
        border: 1px solid black;
      }
      .content table tr{
        height: 25px;
        vertical-align: top;
      }

      table td{
        border:0;
        font-size: 0.9rem;
        padding:0px 10px;
      }
      table tr{
        border-bottom: 1px solid black;
      }

      .footer{
        margin-top: 50px;
        display: flex;
        justify-content: space-between;
        text-align: center;
      }
      .footer .kosong{
        font-size: 0.9rem;
        margin-top: 120px;
      }
    </style>
</head>
<body>
  <div class="header">
    <table border="1">
      <tr>
        <td rowspan="5" style="border-right:1px solid black;">
          <div class="title">
            <div class="gambar">
              <img src="<?= URLROOT; ?>/img/logo/baristand.png" alt="logo baristand">
            </div>
            <h2>FORMULIR PEMBERIAN GRATIFIKASI</h2>
          </div>
        </td>
        <td>No.Dok</td>
        <td>:</td>
        <td>FM 8.3.20 - FWB</td>
      </tr>
      <tr>
        <td>Edisi</td>
        <td>:</td>
        <td>B</td>
      </tr>
      <tr>
        <td>Revisi</td>
        <td>:</td>
        <td>0</td>
      </tr>
      <tr>
        <td>Tanggal</td>
        <td>:</td>
        <td><?= $data['gratifikasi']->tanggal ?></td>
      </tr> 
      <tr>
        <td>Halaman</td>
        <td>:</td>
        <td>1 dari 1</td>
      </tr>
    </table>
  </div>

  <div class="content">
  <table class="table">
  <tbody>
    <tr>
      <td colspan="4">Data Pemberian Gratifikasi</td>
    </tr>
    <tr>
      <td>1</td>
      <td>Jenis Penerimaan</td>
      <td>:</td>
      <td><?= $data['gratifikasi']->jenis_penerimaan ?></td>
    </tr>
    <tr>
      <td>2</td>
      <td>Uraian</td>
      <td>:</td>
      <td><?= $data['gratifikasi']->uraian ?></td>
    </tr>
    <tr>
      <td>3</td>
      <td>Harga/Nilai/Nominal/Taksiran</td>
      <td>:</td>
      <td><?= rupiah($data['gratifikasi']->taksiran) ?></td>
    </tr>
    <tr>
      <td>4</td>
      <td class="col-3">Jenis Peristiwa</td>
      <td>:</th>
      <td><?= $data['gratifikasi']->jenis_peristiwa ?></td>
    </tr>
    <tr>
      <td>5</td>
      <td class="col-3">Tempat Penerimaan</td>
      <td>:</td>
      <td><?= $data['gratifikasi']->tempat_penerimaan ?></td>
    </tr>
    <tr>
      <td>6</td>
      <td >Tanggal</th>
      <td>:</td>
      <td><?= $data['gratifikasi']->tanggal; ?></td>
    </tr>
    <tr>
      <td colspan="4">Data Penerima dan Pemberi Gratifikasi</td>
    </tr>
    <tr>
      <td>1</td>
      <td>Nama Penerima</th>
      <td>:</th>
      <td><?= $data['gratifikasi']->penerima ?></td>
    </tr>
    <tr>
      <td>2</td>
      <td>Pemberi</th>
      <td>:</th>
      <td><?= $data['gratifikasi']->pemberi ?></td>
    </tr>
    <tr>
      <td>3</td>
      <td>Pekerjaan dan Jabatan</th>
      <td>:</th>
      <td><?= $data['gratifikasi']->pekerjaan ?> / <?= $data['gratifikasi']->jabatan ?></td>
    </tr>
    <tr>
      <td>4</td>
      <td>Alamat/Telepon/Faks/Email</th>
      <td>:</th>
      <td>
      <?= $data['gratifikasi']->alamat ?> / <?= $data['gratifikasi']->telepon ?>
      / <?= $data['gratifikasi']->email ?>
      </td>
    </tr>
    <tr>
      <td>5</td>
      <td>Hubungan dengan Pemberi</th>
      <td>:</th>
      <td>
      <?= $data['gratifikasi']->hubungan ?>
      </td>
    </tr>
    <tr>
      <td colspan="4">Alasan dan Kronologi</td>
    </tr>
    <tr>
      <td>1</td>
      <td>Alasan Pemberian</th>
      <td>:</th>
      <td><?= $data['gratifikasi']->alasan_pemberian ?></td>
    </tr>
    <tr>
      <td>2</td>
      <td>Kronologi Penerimaan</th>
      <td>:</th>
      <td><?= $data['gratifikasi']->kronologi_penerimaan ?></td>
    </tr>
    <tr>
      <td colspan="2">Tindakan oleh Tim FKAP</th>
      <td>:</th>
      <td><?= $data['gratifikasi']->tindakan ?></td>
    </tr>
  </tbody>
  </table>

  <div class="footer">
    <div class="left">
      <p>Mengetahui</p>
      <p>An. Tim Fungsi Kepatuhan Anti Penyuapan</p>
      <div class="kosong">
        (........................)
      </div>
    </div>
    <div class="right">
      <p>Banjarbaru, <?= $data['gratifikasi']->tanggal ?></p>
      <p>Yang Melaporkan</p>
      <div class="sign">
        <img src="<?php echo qrcode('120',$data['gratifikasi']->sign) ?>" alt="">
      </div>
      <div class="nama">
        <b><u><?= $data['gratifikasi']->nama ?></u></b>
        </br>
        NIP: <?= $data['gratifikasi']->pelapor ?>
      </div>
    </div>
  </div>

  </div>
    
    <script>
        window.print();
    </script>
</body>
</html>