<!DOCTYPE html>
<html>
<head>
    <title>Surat Perbaikan - Baristand Banjarbaru</title>
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

      .judul{
        margin-top: 20px;
      }

      .tanggal{
        text-align: right;
        margin-right: 40px;
        margin-top: 30px;
      }

      .teks{
        margin-top: 30px;
        margin-left: 35px;
        width: 90%;
      }

      .isi{
        margin-top: 10px;
        margin-left: 35px;
        width: 90%;
      }

      .teks p{
        text-indent: 10px;
        text-align: justify;
        line-height: 130%;
      }

      .isi p{
        text-indent: 40px;
        text-align: justify;
        line-height: 130%;
      }

      .teks table th,.teks table td{
        border-style: solid;
        text-align: center;
      }

      .isi table th,.isi table td{
        border-style: ridge;
        text-align: center;
      }


    </style>
</head>
<body>

<div class="teks">
<table style="width: 100%">
<tr>
  <td rowspan="2">
    <b>BARISTAND INDUSTRI BANJARBARU</b>
    <p></p> Panglima Batur Barat No.2 Banjarbaru
    <p></p> Telp (0511)4774861, 4772461 Fax. 4772115
  </td>
  <td><?= $data['perbaikan']['serial_number'] ?></td>
</tr>
<tr>
  <td>
    <p>
      Banjarbaru, <?= $data['perbaikan']['tanggal']; ?> 
    </p>
  </td>
</tr>
<tr>
  <td>
  <b>PERMOHONAN PERBAIKAN BARANG</b>
  </td>
  <td rowspan="2">
  <p>Kepada</p>
  <p>Yth. Bapak Kepala Barisstand Banjarbaru</p>
  <p>Di</p>
  <p style="padding-left: 1em">Banjarbaru</p>
  </td>
</tr>
</table>
<table style="width: 100%">
<tr>
  <td>
  <P>Guna menanjung kelancaran kegiatan pada unit kerja kami, mohon dengan hormat persetujuan Bapak untuk pengadaan bahan/alat sebagai berikut :</P>
  </td>
</tr>
</table>
</div>
<div class="isi">
                      <table  style="width: 100%">
                          <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Petugas</th>
                            <th>Dealine</th>
                            <th>Waktu selesai</th>
                          </tr>
                        <?php 
                        $no = 1;
                        foreach ($data['barang'] as $b) : ?>
                          <tr>
                            <td><?=$no?></td>
                            <td><?= $b['nbarang']; ?></td>
                            <td><?= $b['jumlah']; ?></td>
                            <td><?= $b['keterangan']; ?></td>
                            <td><?= $b['petugas_perbaikan']; ?></td>
                            <td><?= $b['deadline']; ?></td>
                            <td><?= $b['waktu_selesai']; ?></td>
                          <?php endforeach; 
                          $no++; ?>
                          </tr>
                      </table>
                  </div>
    <script>
        window.print();
    </script>
</body>
</html>