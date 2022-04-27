<?php

  function timeFilter($time){
    $timenew = strtotime($time);
    return date('H:i', $timenew);
  }

  function dateID($tanggal){
    $bulan = array (
      1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    
    // variabel pecahkan 0 = tahun
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tanggal
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
  }

  function timeID($time){
    $timenew = strtotime($time);
    $waktu = date('H:i A', $timenew);
    $pecah = explode(' ', $waktu);
    if ($pecah[1] == 'AM') {
        $pecah[1] = 'Pagi';
    }else{
        $waktubaru = explode(':',$pecah[0]);
        $waktubaru[0] = $waktubaru[0]-12;
        if($waktubaru[0] > 3){
          $pecah[1] = 'Sore';
        }else if($waktubaru[0] > 6){
          $pecah[1] = 'Malam';
        }else{
          $pecah[1] = 'Siang';
        }
        $pecah[0] = implode(':',$waktubaru);
    }
    $res = implode(' ',$pecah);
    return $res;
  }

  function dayID($tanggal){
    $hari = date('l', strtotime($tanggal));

    switch ($hari) {
      case 'Sunday':
        return 'Minggu';
      case 'Monday':
        return 'Senin';
      case 'Tuesday':
        return 'Selasa';
      case 'Wednesday':
        return 'Rabu';
      case 'Thursday':
        return 'Kamis';
      case 'Friday':
        return 'Jumat';
      case 'Saturday':
        return 'Sabtu';
      default:
        return 'hari tidak valid';
    }
  }

  function dateDiff($date1, $date2)
  {
      $date1_ts = strtotime($date1);
      $date2_ts = strtotime($date2);
      $diff = $date2_ts - $date1_ts;
      return round($diff / 86400);
  }