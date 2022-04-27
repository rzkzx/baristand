<?php
  class Middleware extends Controller
  {

    public static function admin($akses){
      $result = self::model('AdminModel')->cekAkses($akses);
      return $result;
    }

    public static function jabatan($akses){
      $result = self::model('JabatanModel')->cekAkses($akses);
      return $result;
    }

  }