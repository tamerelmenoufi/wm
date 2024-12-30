<?php

        mysql_connect("mysql","root","SenhaDoBanco") or die("erro conexao");
        mysql_select_db("cieceja_ead") or die('erro banco');


        $query = "select * from pre_cadastro_aluno_migra";
        $result = mysql_query($query);
        
        while($d = mysql_fetch_object($result)){
            $campos = [];
            foreach($d as $i => $v){
                if($i != 'codigo'){
                    $campos[] = "{$i} = '{$v}'";
                }
                
            }    
            echo $q = "insert into pre_cadastro_aluno set ".implode(", ", $campos);
            echo "<hr>";
        }