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
            echo "<br><br>";


            //Entrar nas matículas
            $query1 = "select * from matricula_migra where codigo_aluno = '{$d->codigo}'";
            $result1 = mysql_query($query1);
            while($d1 = mysql_fetch_object($result1)){

                $campos = [];
                foreach($d1 as $i => $v){
                    if($i != 'codigo'){
                        if($i == 'codigo_matricula'){
                            $campos[] = "codigo_matricula = '[codigo_matricula]'";
                        }else{
                            $campos[] = "{$i} = '{$v}'";
                        }
                        
                    }
                    
                }    
                echo $q = "insert into matricula set ".implode(", ", $campos);
                echo "<br>";                

            }
            echo "<hr>";                




        }