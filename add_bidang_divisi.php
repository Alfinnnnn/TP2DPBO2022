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

$BidangDivisi->getBidangDivisi();
if(isset($_GET['update_key'])){
    $key = $_GET['update_key'];
    $BidangDivisi->getWhereBidangDivisi($key);
    list($id_bidang, $id_divisi, $jabatan) = $BidangDivisi->getResult();
    $divisi->getDivisi();
    while(list($id_divisi2, $nama_divisi) = $divisi->getResult()){
        $data .= "<option value='".$id_divisi2."'"; 
        if($id_divisi == $id_divisi2){
            $data .= " selected='selected'";
        }
        $data .= ">". $nama_divisi. "</option>";
    }
    if(isset($_POST['submit'])){
        
        $id_divisi_post = $_POST['id_divisi'];
        $jabatan_post = $_POST['jabatan'];
        $BidangDivisi->updateBidangDivisi($key, $id_divisi_post, $jabatan_post);
        header('location: bidang_divisii.php');
    }
}else if(isset($_GET['id_add_divisi'])){
    echo "Submit Pos Add Recod";
    $jabatan = null;
    $divisi->getDivisi();
    while(list($id_divisi2, $nama_divisi) = $divisi->getResult()){
        $data .= "<option value='".$id_divisi2."'"; 
        $data .= ">". $nama_divisi. "</option>";
    }
    if(isset($_POST['submit'])){
                
        $id_divisi_post = $_POST['id_divisi'];
        $jabatan_post = $_POST['jabatan'];
        echo "==========".$id_divisi_post.$jabatan_post;
        $BidangDivisi->addBidangDivisi($id_divisi_post, $jabatan_post);
        header('location: bidang_divisii.php');
    }
}
$pengurus->close();
$BidangDivisi->close();
$divisi->close();
$tpl = new Template("templates/add_bidang_divisi.html");
$tpl->replace("DATA_Jabatan", $jabatan);
$tpl->replace("DATA_Divisi", $data);
$tpl->write();