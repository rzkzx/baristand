<!DOCTYPE html>
<html>
<head>
    <title>Surat Perintah Kerja Lembur - Baristand Banjarbaru</title>
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
        text-indent: 50px;
        text-align: justify;
        line-height: 130%;
      }

      .sign{
        float: right;
        margin-top: 30px;
        text-align: center;
        font-size: 0.9rem;
      }

      .isi{
        margin-top: 250px;
      }

      .isi table{
        border: 0px solid black;
        text-align: center;
        margin-top: 10px;
      }
      .isi table td{
        padding: 10px;
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
        <u>SURAT PERINTAH KERJA LEMBUR</u>
        <p style="margin-top:10px">Nomor: <?= $data['ijinlembur']->nomor_surat ?></p>

        <div class="text">
          <p>
          Yang bertanda tangan dibawah ini, Kepala Baristand Industri Banjarbaru, memerintahkan kerja lembur kepada pegawai tersebut dibawah ini pada tanggal <?= $data['ijinlembur']->tanggal_ijin ?>, hari <?= $data['hari'] ?> selama <?= $data['ijinlembur']->lama_tugas ?> untuk pekerjaan yang penyelesaiannya tidak dapat ditangguhkan.
          </p>
          <p>Demikian agar dilaksanakan dengan penuh tanggung jawab.</p>
        </div>
      </div>
    </center>

    <div class="sign">
      <div class="top">
        <p>Banjarbaru, <?= $data['ijinlembur']->tanggal_ijin ?></p>
        <p>Kepala Baristand Industri Banjarbaru</p>
      </div>
      <div class="ttd">
        <img src="<?php echo qrcode('120',$data['sign']) ?>" alt="">
      </div>
      <div class="name">
        <u><b><?= strtoupper($data['kepala_balai']->nama) ?></b></u>
        <br>
        NIP : <?= $data['kepala_balai']->nip ?>
      </div>
    </div>

    <div class="isi">
      <p>Daftar : Nama Pegawai yang melaksanakan kerja lembur</p>
      <table border="1" style="width: 100%">
        <tr rowspan="5">
          <td>No</th>
          <td>Nama Pegawai</td>
          <td>Jabatan</th>
          <td>Golongan</th>
          <td>Jenis Pekerjaan yang dilembur</td>
          <td>Ket.</th>
        </tr>
        <?php
        $index = 1;
        foreach ($data['pemohon'] as $k) {
        ?>
        <tr>
          <td><?= $index ?></td>
          <td><?= $k->nama ?></td>
          <td><?= $k->jabatan ?></td>
          <td><?= $k->golongan ?></td>
          <?php
          if($index == 1){
            ?>
          <td rowspan="<?= count($data['pemohon']) ?>"><?= $data['ijinlembur']->keperluan ?></td>
          <td rowspan="<?= count($data['pemohon']) ?>"><?= $data['ijinlembur']->keterangan ?></td>
            <?php
          }
          ?>
        </tr>
        <?php
        $index++;
        }
        ?>
    </table>
    </div>
    
    <script>
        window.print();
    </script>
</body>
</html>