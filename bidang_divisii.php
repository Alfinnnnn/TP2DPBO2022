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

if(isset($_GET['delete_key'])){
    $BidangDivisi->deleteBidangDivisi($_GET['delete_key']);   
}
$BidangDivisi->getBidangDivisi();

while(list($id_bidang, $id_divisi, $jabatan) = $BidangDivisi->getResult()){
    $divisi->getWhereDivisi($id_divisi);
    $nama_divisi = $divisi->getResult();
    $data .= "<tr>
    <td>". $no ." </td> 
    <td>". $jabatan."</td>
    <td>". $nama_divisi['nama_divisi']."</td>
    <td><button class='btn btn-danger' name='hapus'><a href='bidang_divisii.php?delete_key=$id_bidang' style='color: white; font-weight: bold; text-decoration: none'>Delete</a>&nbsp</button>
    <button class='btn btn-primary' ><a href='add_bidang_divisi.php?update_key=$id_bidang' style='color: white; font-weight: bold; text-decoration: none'>Update</a></button>
    
    </tr>";
    $no++;
}
$pengurus->close();
$BidangDivisi->close();
$divisi->close();
$tpl = new Template("templates/bidang_divisi.html");
$tpl->replace("DATA_TABEL", $data);


$tpl->write();