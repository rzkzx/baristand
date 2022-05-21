<!DOCTYPE html>
<html>
<head>
    <title>Surat Tugas - Baristand Banjarbaru</title>
    <style>
      *{
        font-family: sans-serif;
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
        height: 70px;
      }
      .title p{
        padding: 0;
        margin: 0;
        font-size: 10px;
        color: #2b2b2b;
      }

      .content{
        margin-top: 20px;
      }

      .text{
        margin-top: 30px;
        width: 90%;
      }

      .text p{
        margin-left : 20px;
        text-align: justify;
        line-height: 130%;
      }

      .footer{
        margin-top: 30px;
        width: 90%;
      }

      .footer p{
        margin-left : 40px;
        text-align: justify;
        line-height: 130%;
      }

      .sign{
        float: right;
        margin-top: 30px;
        text-align: center;
        font-size: 0.9rem;
      }

      .text table{
        margin-left : 20px;
        border: hidden;
        text-align: left;
        margin-top: 10px;
      }

    </style>
</head>
<body>
    <center>
      <div class="row">
        <div class="gambar">
          <img src="<?= URLROOT; ?>/img/logo/baristand.png" alt="logo baristand">
        </div>
        <div class="title">
          <h5 style="margin-bottom:2px;font-weight:500;">BADAN STANDARDISASI DAN KEBIJAKAN JASA INDUSTRI</h6>
          <h3>BALAI RISET DAN STANDARDISASI INDUSTRI</h3>
          <h3>BANJARBARU</h3>
          <p>Jl. Panglima Batur Barat No. 2 Banjarbaru 70711, Banjarbaru</p>
          <p>Telp. (0511) 4772461, 4772115, 4774861 Fax. (0511) 4772115</p>
        </div>
      </div>

      <hr/>

      <div class="content" >
        <u>SURAT TUGAS</u>
        <p style="margin-top:10px">Nomor: <?= $data['surattugas']->nomor_surat ?></p>
        <div class="text">
        <b>KEPALA BALAI RISET DAN STANDARDISASI INDUSTRI BANJARBARU</b>
        </div>
        <div class="text">
          <p>
            Memberi Tugas Kepada : 
          </p>
        </div>
        <div class="text">
          <table style="width : 100%">
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td><?= $data['ditugaskan']->nama ?></td>
            </tr>
            <tr>
              <td>NIP</td>
              <td>:</td>
              <td><?= $data['surattugas']->nip_ditugaskan ?></td>
            </tr>
            <tr>
              <td>Pangkat/Golongan</td>
              <td>:</td>
              <td><?= $data['ditugaskan']->golongan ?></td>
            </tr>
            <tr>
              <td>Jabatan</td>
              <td>:</td>
              <td><?= $data['ditugaskan']->jabatan ?></td>
            </tr>
            <tr>
              <td>Tujuan</td>
              <td>:</td>
              <td><?= $data['surattugas']->tujuan_tugas ?></td>
            </tr>
            <tr>
              <td>Lamanya</td>
              <td>:</td>
              <td><?= $data['surattugas']->lama_tugas ?></td>
            </tr>
            <tr>
              <td>Keperluan</td>
              <td>:</td>
              <td><?= $data['surattugas']->keperluan_tugas ?></td>
            </tr>
            <tr>
              <td>Berangkat Tanggal</td>
              <td>:</td>
              <td><?= dateID($data['surattugas']->tanggal_berangkat) ?></td>
            </tr>
            <tr>
              <td>Kembali Tanggal</td>
              <td>:</td>
              <td><?= dateID($data['surattugas']->tanggal_kembali) ?></td>
            </tr>
            <tr>
              <td>Instansi yang dituju</td>
              <td>:</td>
              <td><?= $data['surattugas']->instansi_dituju ?></td>
            </tr>
            <tr>
              <td>Pengikut</td>
              <td>:</td>
              <td>
                  <ul style="padding:0;margin:0;">
                      <?php
                      foreach ($data['pengikut'] as $p) {
                        echo '<li style="list-style-type:none;">'.$p->nama.' - '.$p->nip.'</li>';
                      }
                      ?>
                  </ul>
              </td>
            </tr>
          </table>
        </div>
        <div class="footer">
          <p>
            Demikian agar yang berkepentingan mengetahui dan memberi bantuan seperlunya.
          </p>
        </div>
      </div>
    </center>
    <div class="text">
      <table>
      <table>
    </div>

    <div class="sign">
      <div class="top">
        <p>Banjarbaru, <?= dateID($data['surattugas']->tanggal_permohonan); ?></p>
        <p>Kepala </p>
      </div>
      <div class="ttd">
        <img src="<?php echo qrcode('120',$data['sign']) ?>" alt="">
      </div>
      <div class="name">
        <u><b><?= strtoupper($data['kepala_balai'][0]->nama) ?></b></u>
        <br>
        NIP : <?= $data['kepala_balai'][0]->nip ?>
      </div>
    </div>
    
    <script>
        window.print();
    </script>
</body>
</html>