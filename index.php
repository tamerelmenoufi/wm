<?php

        mysql_connect("mysql","root","SenhaDoBanco");
        mysql_select_db("ciec_ead");


        $query = "select * from pre_cadastro_aluno_migra";
        $result = mysql_query($query);
        while($d = mysql_fetch_object($result)){
            echo $d->nome."<br>";
        }