<?php
    function format_date ($value){
        return date('d-m-Y h:i:s', strtotime($value));
    }

    function rupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
?>