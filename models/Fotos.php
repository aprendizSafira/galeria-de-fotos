<?php
class Fotos extends model {
    
    public function getSaveFotos() {
       if(isset($_FILES['arquivo']) && !empty($_FILES['arquivo']['tmp_name'])) {
           $fotos_permitidas = array('image/jpeg', 'image/png', 'image/jpg');
           
           //Verificando se a foto enviada é uma das 3 permitida
           if(in_array($_FILES['arquivo']['type'], $fotos_permitidas)) {
               
               $nome = "imagem(".rand(0, 9999999).")".".jpg";
               //Salvando a img no Servidor
               move_uploaded_file($_FILES['arquivo']['tmp_name'], 'assets/images/galeria/'.$nome);
               
               //Salvando no banco
               $titulo = "";//É opcional enviar o titulo
               if(isset($_POST['titulo']) & !empty($_POST['titulo'])) {
                   $titulo = addslashes($_POST['titulo']);
               }
               $sql = "INSERT INTO fotos SET titulo = '$titulo', url = '$nome'";
               $this->db->query($sql);
           }
       }
    }
    
    public function getFotos() {
        $array = array();
        
        $sql = "SELECT * FROM fotos ORDER BY id DESC";
        $sql = $this->db->query($sql);
        
        if($sql->rowCount() > 0) {
           $array = $sql->fetchAll();
        }
        return $array;
    }
}

