<?php

include('connect.php');

if(isset($_FILES["imagem"]) && !empty($_FILES["imagem"]))
{
   move_uploaded_file($_FILES["imagem"]["tpm_name"], "./img/".$_FILES["imagem"]["name"] );
   echo "upload realizado com sucesso";

}




?>