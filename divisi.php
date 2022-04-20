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


if(isset($_GET['delete_key_divisi'])){
    $divisi->deleteDivisi($_GET['delete_key_divisi']);  
}
$divisi->getDivisi();

while(list($id_divisi, $nama_divisi) = $divisi->getResult()){
    $data .= "<tr>
    <td>". $no ." </td> 
    <td>". $nama_divisi."</td>
    <td><button class='btn btn-danger' name='hapus'><a href='divisi.php?delete_key_divisi=$id_divisi' style='color: white; font-weight: bold; text-decoration: none'>Delete</a>&nbsp</button>
    <button class='btn btn-primary' ><a href='add_divisi.php?update_key_divisi=$id_divisi' style='color: white; font-weight: bold; text-decoration: none'>Update</a></button>
    
    </tr>";
    $no++;
}
$pengurus->close();
$BidangDivisi->close();
$divisi->close();
$tpl = new Template("templates/divisi.html");
$tpl->replace("DATA_TABEL", $data);


$tpl->write();