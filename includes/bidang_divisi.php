<?php

class bidang_Divisi extends db
{
    function getBidangDivisi()
    {
        $query = "SELECT * FROM bidang_divisi";
        return $this->execute($query);
    }
    function getWhereBidangDivisi($id_bidang){
        $query = "SELECT * FROM bidang_divisi where id_bidang = $id_bidang";
        return $this->execute($query);
    }
    function deleteBidangDivisi($id_bidang){
        $query = "DELETE FROM bidang_divisi where id_bidang = $id_bidang";
        return $this->execute($query);
    }
    function updateBidangDivisi($id_bidang, $id_divisi, $jabatan){
        $query = "UPDATE bidang_divisi SET id_divisi=$id_divisi ,jabatan='$jabatan' where id_bidang = $id_bidang";
        return $this->execute($query);
    }
    function addBidangDivisi($id_divisi, $jabatan ){
        $query = "INSERT INTO bidang_divisi VALUES (NULL,$id_divisi, '$jabatan')";
        return $this->execute($query);
    }   
}
?>