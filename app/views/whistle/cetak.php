<!DOCTYPE html>
<html>
<head>
    <title>Whistleblowing System - Baristand Banjarbaru</title>
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
        padding:10px;
      }
      
      .content{
        width: 95%;
        margin-top: 20px;
        padding: 30px 0;
        padding-bottom: 50px;
        border: 1px solid black;
      }
      .content table tr{
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

      .content table td{
        padding-bottom: 10px;
      }

      .footer{
        margin-top: 100px;
        text-align: center;
        float: right;
      }
      .footer .nama{
        font-size: 0.9rem;
        line-height: 120%;
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
            <h3>FORMULIR LAPORAN WHISTLE BLOWING SYSTEM</h3>
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
        <td><?= $data['whistle']->tanggal ?></td>
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
      <td>Nama</td>
      <td>:</td>
      <td><?= $data['whistle']->nama_pelaporan ?></td>
    </tr>
    <tr>
      <td>Instansi</td>
      <td>:</td>
      <td><?= $data['whistle']->instansi ?></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</th>
      <td><?= $data['whistle']->alamat ?></td>
    </tr>
    <tr>
      <td>Email</th>
      <td>:</th>
      <td><?= $data['whistle']->email ?></td>
    </tr>
    <tr>
      <td>Telepon</td>
      <td>:</td>
      <td><?= $data['whistle']->telepon ?></td>
    </tr>
    <tr>
      <td>Judul Laporan</td>
      <td>:</th>
      <td><?= $data['whistle']->judul_laporan ?></td>
    </tr>
    <tr>
      <td>Uraian Laporan</td>
      <td>:</td>
      <td><?= $data['whistle']->uraian_laporan ?></td>
    </tr>
    <tr>
      <td>Data Dukung</th>
      <td>:</th>
      <td>
        <a href="#" style="background-color:white;color:black;border-radius:5px;padding:5px 10px;"><?= $data['whistle']->data_dukung ?></a>
      </td>
    </tr>
    <tr>
      <td>Pelanggaran</td>
      <td>:</td>
      <td>
        <ul>
        <?php 
        $pelanggaran = explode(',',$data['whistle']->pelanggaran);
        foreach ($pelanggaran as $v) {
        ?>
          <li>- <?= $v ?></li>
        <?php
        }
        ?>
        </ul>
      </td>
    </tr>
    <tr>
      <td >Tanggal</th>
      <td>:</td>
      <td><?= $data['whistle']->tanggal ?></td>
    </tr>
  </tbody>
  </table>

  <div class="footer">
    <div class=right>
      <p>Banjarbaru, <?= $data['whistle']->tanggal ?></p>
      <p>Yang Melaporkan</p>
      <div class="sign">
        <img src="<?php echo qrcode('120',$data['whistle']->sign) ?>" alt="">
      </div>
      <div class="nama">
        <b><u><?= $data['whistle']->nama ?></u></b>
        </br>
        NIP : <?= $data['whistle']->nip ?>
      </div>
    </div>
  </div>

  </div>
    
    <script>
        window.print();
    </script>
</body>
</html>