<!DOCTYPE html>
<html>

<head>
  <title>Surat Perbaikan - Baristand Banjarbaru</title>
  <style>
    * {
      font-family: sans-serif;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      padding: 0;
      margin: 0;
      color: #292929;
    }

    p {
      margin: 0;
      padding: 0;
    }

    hr {
      border-bottom: 1px solid black;
    }

    .row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 10px;
    }

    .gambar img {
      object-fit: cover;
      height: 70px;
    }

    .title p {
      padding: 0;
      margin: 0;
      font-size: 10px;
      color: #2b2b2b;
    }

    .judul {
      margin-top: 20px;
    }

    .tanggal {
      text-align: right;
      margin-right: 40px;
      margin-top: 30px;
    }

    .teks {
      margin-top: 10px;
      margin-left: 50px;
      width: 92%;
    }

    .isi {
      margin-top: 10px;
      margin-left: 50px;
      width: 92%;
    }

    .teks p {
      text-indent: 10px;
      text-align: justify;
      line-height: 130%;
    }

    .isi p {
      text-indent: 40px;
      text-align: justify;
      line-height: 130%;
    }

    .teks table th,
    .teks table td {
      border: 1px solid black;
      text-align: center;
    }

    .isi table th,
    .isi table td {
      border-style: hidden;
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
        <td><?= $data['form']->kode ?> - <?= $data['form']->nama ?></td>
      </tr>
      <tr>
        <td>
          <p>
            Banjarbaru, <?= $data['perbaikan']->tanggal; ?>
          </p>
        </td>
      </tr>
      <tr>
        <td>
          <b>PERMOHONAN PERBAIKAN BARANG</b>
        </td>
        <td rowspan="2">
          <p>Kepada</p>
          <p>Yth. Bapak Kepala Baristand Banjarbaru</p>
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
    <table style="width: 100%">
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
          <td><?= $no ?></td>
          <td><?= $b->nbarang; ?></td>
          <td><?= $b->jumlah; ?></td>
          <td><?= $b->keterangan; ?></td>
          <td><?= $b->petugas_perbaikan; ?></td>
          <td><?= $b->deadline; ?></td>
          <td><?= $b->waktu_selesai; ?></td>
        <?php 
      $no++;   
      endforeach;
      ?>
        </tr>
    </table>
  </div>
  <div class="teks">
    <table style="width: 100%">
      <tr>
        <td>
          <P>Atas persutujuan Bapak diucapkan terimakasih.</P>
        </td>
      </tr>
    </table>
  </div>

  <div class="teks">
    <table style="width: 100%">
      <tr>
        <td>
          <P>Atasan langsung : <?= $data['atasan']->nama . ' / ' . $data['perbaikan']->waktu_validasi1 ?></P>
        </td>
        <td>
          <P>Pemohon : <?= $data['perbaikan']->nama . ' / ' . $data['perbaikan']->tanggal . ' ' . $data['perbaikan']->jam ?></P>
        </td>
      </tr>
      <tr>
        <td>
          <P>Kepala Balai : <?= $data['kepala_balai'][0]->nama . ' / ' . $data['perbaikan']->waktu_disposisi ?></P>
        </td>
        <td>
        <P>Catatan kepala balai : <?= $data['perbaikan']->validasi2 ?></P>
        </td>
      </tr>
      <tr>
        <td>
          <P>Kasubag TU : <?= $data['kasubag'][0]->nama . ' / ' . $data['perbaikan']->waktu_disposisi ?></P>
        </td>
        <td>
        <P>Disposisi : <?= $data['perbaikan']->disposisi ?></P>
        </td>
      </tr>
      <tr>
        <td>
          <P>Penanggung jawab : <?= $data['penanggung']->nama . ' / ' . $data['perbaikan']->waktu_penugasan ?></P>
        </td>
        <td>
        <P>Catatan penugasan : <?= $data['perbaikan']->penugasan ?></P>
        </td>
      </tr>
      <tr>
        <td>
          <P>Penyelesaian pekerjaan : <?= $data['perbaikan']->waktu_selesai ?></P>
        </td>
        <td>
        <P>Terima hasil pekerjaan : <?= $data['perbaikan']->waktu_hasil ?></P>
        </td>
      </tr>
    </table>
  </div>
  <script>
    window.print();
  </script>
</body>

</html>