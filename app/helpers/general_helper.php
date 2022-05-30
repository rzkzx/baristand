<?php

  function rupiah($price)
  {
    $res = "Rp. " . number_format($price, 0, ",", ".");
    return $res;
  }

  function notifWA($data)
  {
      $apikey= API_WA;
      $tujuan= $data['no_telp'];
      $pesan= $data['isi_pesan'];

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://starsender.online/api/sendText?message='.rawurlencode($pesan).'&tujuan='.rawurlencode($tujuan.'@s.whatsapp.net'),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
          'apikey: '.$apikey
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      echo $response;
  }

  function qrcode($size,$content)
  {
      // CHart Type
      $cht = "qr";

      // CHart Size
      $chs = $size."x".$size;

      // CHart Link
      // the url-encoded string you want to change into a QR code
      $chl = urlencode($content);

      // CHart Output Encoding (optional)
      // default: UTF-8
      $choe = "UTF-8";

      $qrcode = 'https://chart.googleapis.com/chart?cht=' . $cht . '&chs=' . $chs . '&chl=' . $chl . '&choe=' . $choe;

      return $qrcode;
  }