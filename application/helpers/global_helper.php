<?php

if (!function_exists('filter')) {
  function filter($data)
  {    
    $filter = stripslashes(strip_tags(htmlspecialchars(htmlentities($data,ENT_QUOTES))));
    return $filter;
  }
}

if (!function_exists('random_number')) {
  function random_number($length) {
    $str = "";
    $karakter = array_merge(range('0','9'));
    $max_karakter = count($karakter) - 1;
    for ($i = 0; $i < $length; $i++) {
      $rand = mt_rand(0, $max_karakter);
      $str .= $karakter[$rand];
    }
    return $str;
  }
}

if (!function_exists('currency')) {
  function currency($value) {
      $currency = number_format($value, 0, ".", ".");
      return $currency;
  }
}

if (!function_exists('random')) {
  function random($length) {
    $str = "";
    $karakter = array_merge(range('A','Z'), range('a','z'), range('0','9'));
    $max_karakter = count($karakter) - 1;
    for ($i = 0; $i < $length; $i++) {
      $rand = mt_rand(0, $max_karakter);
      $str .= $karakter[$rand];
    }
    return $str;
  }
}

if (!function_exists('random_number')) {
  function random_number($length) {
    $str = "";
    $karakter = array_merge(range('0','9'));
    $max_karakter = count($karakter) - 1;
    for ($i = 0; $i < $length; $i++) {
      $rand = mt_rand(0, $max_karakter);
      $str .= $karakter[$rand];
    }
    return $str;
  }
}

if (!function_exists('capital_random')) {
  function capital_random($length) {
    $str = "";
    $karakter = array_merge(range('A','Z'));
    $max_karakter = count($karakter) - 1;
    for ($i = 0; $i < $length; $i++) {
      $rand = mt_rand(0, $max_karakter);
      $str .= $karakter[$rand];
    }
    return $str;
  }
}

if (!function_exists('hash_pw')) {
  function hash_pw($data) {
    $hash = password_hash($data, PASSWORD_DEFAULT);
    return $hash;
  }
}

if (!function_exists('tanggal_indo')) {
  function tanggal_indo($tanggal){
    $bulan = array (1 =>   'Januari',
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
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
  }
}

if (!function_exists('db_query')) {
  function db_query($table = '', $data = []){
      $ci = get_instance();
      if($data == false) {
        $result = $ci->db->get($table);
      } else {
        $result = $ci->db->get_where($table, $data);
      }
      return array('count' => $result->num_rows(), 'rows' => $result->row_array());
  }
}