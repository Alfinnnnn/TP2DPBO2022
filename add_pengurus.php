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
$tpl = new Template("templates/add_pengurus.html");
if(isset($_GET['id_hapus'])){
    $pengurus->deletePengurus($_GET['id_hapus']);
    header('location: index.php');
}
if(isset($_GET['id_update'])){
    $key = $_GET['id_update'];
    $pengurus->getWherePengurus($_GET['id_update']);
    list($id_pengurus, $nim, $nama, $semester, $id_bidang, $foto) = $pengurus->getResult();
    $BidangDivisi->getBidangDivisi();
    while(list($id_bidang2, $id_divisi, $jabatan) = $BidangDivisi->getResult()){
        $divisi->getWhereDivisi($id_divisi);
        $namadivisi = $divisi->getResult();
        
        $data .= "<option value='".$id_bidang2."'"; 
        if($id_bidang == $id_bidang2){
            $data .= " selected='selected'";
        }
        $data .= ">" . $jabatan. " ". $namadivisi['nama_divisi'] . "</option>";
    }
    if(isset($_POST['submit'])){
        $nimPost = $_POST['nim'];
        $namaPost = $_POST['nama'];
        $semesterPost = $_POST['semester'];
        $id_bidangPost = $_POST['jabatan_divisi'];

        $image    = upload();

        $pengurus->updatePengurus($key, $nimPost, $namaPost, $semesterPost, $id_bidangPost, $image);
        header('location: index.php');
    }
    
}
if(isset($_GET['id_submit'])){
    $nim = null;
    $nama = null;
    $semester = null;
    $BidangDivisi->getBidangDivisi();
    while(list($id_bidang2, $id_divisi, $jabatan ) = $BidangDivisi->getResult()){
        $divisi->getWhereDivisi($id_divisi);
        $namadivisi = $divisi->getResult();
        $data .= "<option value='".$id_bidang2."'"; 
        $data .= ">" . $jabatan. " ". $namadivisi['nama_divisi'] ."</option>";
        
    }
    if(isset($_POST['submit'])){
        $nimPost = $_POST['nim'];
        $namaPost = $_POST['nama'];
        $semesterPost = $_POST['semester'];
        $id_bidangPost = $_POST['jabatan_divisi'];

        $image    = upload();
        $pengurus->addPengurus($nimPost, $namaPost, $semesterPost, $id_bidangPost, $image);

        header('location: index.php');
    }
}

function upload()
    {
        $fileName = $_FILES["foto"]["name"];
        $fileTemp = $_FILES["foto"]["tmp_name"];
        $fileType = explode(".", $fileName);
        $fileType = strtolower(end($fileType));
        $validExt = ["jpg", "jpeg", "png"];

        if(!in_array($fileType, $validExt)) return "default.jpg";

        $fileImage = uniqid() . "." . $fileType;
        move_uploaded_file($fileTemp, "pict/".$fileImage);

        return $fileImage;
    }

$pengurus->close();
$BidangDivisi->close();
$divisi->close();
$tpl->replace("NIM_", $nim);
$tpl->replace("Nama_", $nama);
$tpl->replace("Semester_", $semester);
$tpl->replace("D_Jabatan", $data);

$tpl->write();