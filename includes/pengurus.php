<?php

class pengurus extends db
{
    function getPengurus(){
        $query = "SELECT * from pengurus";
        return $this->execute($query);
    }
    function getWherePengurus($id_pengurus){
        $query = "SELECT * from pengurus where id_pengurus = $id_pengurus";
        return $this->execute($query);
    }
    function addPengurus($nim, $nama, $semester, $id_bidang, $foto){
        $query = "INSERT INTO pengurus VALUES (NULL, $nim, '$nama', '$semester', '$id_bidang', '$foto')";
        return $this->execute($query);
    }
    function deletePengurus($id_pengurus){
        $query = "DELETE FROM pengurus WHERE id_pengurus='$id_pengurus'";
        return $this->execute($query);
    }
    function updatePengurus($id_pengurus, $nim, $nama, $semester, $id_bidang, $foto){
        $query = "UPDATE pengurus SET nim='$nim', nama='$nama', semester='$semester', id_bidang='$id_bidang', foto='$foto' where id_pengurus='$id_pengurus'";
        return $this->execute($query);
    }

}
?>