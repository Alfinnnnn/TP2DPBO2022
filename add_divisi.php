<?php
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED); 
include("conf.php");
include("includes/Template.php");
include("includes/db.php");
include("includes/divisi.php");
include("includes/bidang_divisi.php");
include("includes/pengurus.php");



$divisi = new divisi($db_host, $db_user, $db_pass, $db_name);
$divisi->open();

$BidangDivisi = new bidang_divisi($db_host, $db_user, $db_pass, $db_name);
$BidangDivisi->open();

$pengurus = new pengurus($db_host, $db_user, $db_pass, $db_name);
$pengurus->open();

$data = null;
$no = 1;

$divisi->getDivisi();
if(isset($_GET['update_key_divisi'])){
    $key = $_GET['update_key_divisi'];
    $divisi->getWhereDivisi($key);
    list($id_bidang, $nama_divisi) = $divisi->getResult();
    if(isset($_POST['submit'])){
        
        $nama_divisi_post = $_POST['nama_divisi'];
        $divisi->updateDivisi($key, $nama_divisi_post);
        header('location: divisi.php');
    }
}else if(isset($_GET['id_add_divisi'])){
    $nama_divisi = null;
    $divisi->getDivisi();
    
    if(isset($_POST['submit'])){
        
        $nama_divisi_post = $_POST['nama_divisi'];
        $divisi->addDivisi($nama_divisi_post);
        header('location: divisi.php');
    }
}
$pengurus->close();
$BidangDivisi->close();
$divisi->close();
$tpl = new Template("templates/add_divisi.html");
$tpl->replace("DATA_Nama_divisi", $nama_divisi);
$tpl->write();