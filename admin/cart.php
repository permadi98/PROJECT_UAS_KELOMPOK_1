<?php
    include_once '../koneksi.php';
    if (!isset($_SESSION)) {
        session_start();
    }
     
    if (isset($_GET['act']) && isset($_GET['ref'])) {
        $act = $_GET['act'];
        $ref = $_GET['ref'];
             
        if ($act == "add") {
            if (isset($_GET['id_buku'])) {
                $id_buku = $_GET['id_buku'];
                if (isset($_SESSION['items'][$id_buku])) {
                    $_SESSION['items'][$id_buku] += 1;
                } else {
                    $_SESSION['items'][$id_buku] = 1; 
                }
            }
        } elseif ($act == "plus") {
            if (isset($_GET['id_buku'])) {
                $id_buku = $_GET['id_buku'];
                if (isset($_SESSION['items'][$id_buku])) {
                    $_SESSION['items'][$id_buku] += 1;
                }
            }
        } elseif ($act == "min") {
            if (isset($_GET['id_buku'])) {
                $id_buku = $_GET['id_buku'];
                if (isset($_SESSION['items'][$id_buku])) {
                    $_SESSION['items'][$id_buku] -= 1;
                }
            }
        } elseif ($act == "del") {
            if (isset($_GET['id_buku'])) {
                $id_buku = $_GET['id_buku'];
                if (isset($_SESSION['items'][$id_buku])) {
                    unset($_SESSION['items'][$id_buku]);
                }
            }
        } elseif ($act == "clear") {
            if (isset($_SESSION['items'])) {
                foreach ($_SESSION['items'] as $key => $val) {
                    unset($_SESSION['items'][$key]);
                }
                unset($_SESSION['items']);
            }
        } 
         
        header ("location:" . $ref);
    }   
     
