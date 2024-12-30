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
                echo "<br><b>Matriculas</b><br>";
                $campos = [];
                foreach($d1 as $i => $v){
                    if($i != 'codigo'){
                        if($i == 'codigo_aluno'){
                            $campos[] = "codigo_aluno = '[codigo_aluno]'";
                        }else{
                            $campos[] = "{$i} = '{$v}'";
                        }
                        
                    }
                    
                }    
                echo $q = " - insert into matricula set ".implode(", ", $campos);
                echo "<br>";   
                
                //Entrar nas Provas
                
                $query2 = "select * from provas_migra where codigo_matricula = '{$d1->codigo}'";
                $result2 = mysql_query($query2);
                while($d2 = mysql_fetch_object($result2)){
                    echo "<br><b>Porvas</b><br>";
                    $campos = [];
                    foreach($d2 as $i => $v){
                        if($i != 'codigo'){
                            if($i == 'codigo_matricula'){
                                $campos[] = "codigo_matricula = '[codigo_matricula]'";
                            }else if($i == 'codigo_aluno'){
                                $campos[] = "codigo_aluno = '[codigo_aluno]'";
                            }else{
                                $campos[] = "{$i} = '{$v}'";
                            }
                            
                        }
                        
                    }    
                    echo $q = " . -- insert into provas set ".implode(", ", $campos);
                    echo "<br>";  
                    
                    // Listando as questoes

                    $query3 = "select * from provas_perguntas_migra where codigo_prova = '{$d2->codigo}'";
                    $result3 = mysql_query($query3);
                    while($d3 = mysql_fetch_object($result3)){
                        echo "<br><b>Porvas Perguntas</b><br>";
                        $campos = [];
                        foreach($d3 as $i => $v){
                            if($i != 'codigo'){
                                if($i == 'codigo_prova'){
                                    $campos[] = "codigo_prova = '[codigo_prova]'";
                                }else{
                                    $campos[] = "{$i} = '{$v}'";
                                }
                                
                            }
                            
                        }    
                        echo $q = " . -- insert into provas set ".implode(", ", $campos);
                        echo "<br>";  
                        
                        // Listando as questoes
    
                        
                        
        
        
        
        
                    }
                    
    
    
    
    
                }


            }
            echo "<hr>"; 
            




        }