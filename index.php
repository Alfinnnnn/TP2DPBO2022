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
    if(isset($_GET['id_pengurus'])){
        $pengurus->getWherePengurus($_GET['id_pengurus']);
        (list($id_pengurus, $nim, $nama, $semester, $id_bidang, $foto) = $pengurus->getResult());
        $BidangDivisi->getWhereBidangDivisi($id_bidang);
        $jabatan = $BidangDivisi->getResult();
        $divisi->getWhereDivisi($jabatan['id_divisi']);
        $iddivisi = $divisi->getResult();
        $data .= "
        <div class='col-md-4'>
            <div class='card-columns' style='text-align:center;'>
                <div class='card'>
                <a href='index.php?id_pengurus=". $id_pengurus ."'>
                    <img class='card-img-top' src='pict/". $foto ."' alt='gambar' style='width: 200px; height: 200px; object-fit: cover;'>
                    <div class='card-body'>
                        <h4 class='card-title'>". $nama ."</h4>
                        <h6 class='card-subtitle text-muted'>". $jabatan['jabatan'] ."</h6>
                        <p class='card-text p-y-1' >". $iddivisi["nama_divisi"] ."</p>
                        <button class='btn btn-danger' name='hapus' ><a href='add_pengurus.php?id_hapus=" . $id_pengurus . "'>Hapus</a></button>
                        <button class='btn btn-success' ><a href='add_pengurus.php?id_update=" . $id_pengurus .  "'>Update</a></button>
                    </div>
                    </a>
                </div>
            </div>
        </div>";
    
    }else{
        $pengurus->getPengurus();
        while (list($id_pengurus, $nim, $nama, $semester, $id_bidang, $foto) = $pengurus->getResult()) {
            $BidangDivisi->getWhereBidangDivisi($id_bidang);
            $jabatan = $BidangDivisi->getResult();
            $divisi->getWhereDivisi($jabatan['id_divisi']);
            $iddivisi = $divisi->getResult();
            $data .= "
            <div class='col-md-4'>
            <div class='card-columns'>
                <div class='card' style='text-align:center;'>
                <a href='index.php?id_pengurus=". $id_pengurus ."'>
                    <img class='card-img-top' src='pict/". $foto ."' alt='Card image cap' style='width: 200px; height: 200px; object-fit: cover;'>
                    <div class='card-body'>
                        <h4 class='card-title'>". $nama ."'</h4>
                        <h6 class='card-subtitle text-muted'>". $jabatan['jabatan'] ."'</h6>
                        <p class='card-text p-y-1'>". $iddivisi["nama_divisi"] ."'</p>
                    </div>
                    </a>
                </div>
            </div>
        </div>";
        }
    }
    


$pengurus->close();
$BidangDivisi->close();
$divisi->close();
$tpl = new Template("templates/index.html");
$tpl->replace("DATA_TABEL", $data);
$tpl->write();
?>