<?php
        exit();

        mysql_connect("mysql","root","SenhaDoBanco") or die("erro conexao");
        mysql_select_db("cieceja_ead") or die('erro banco');

        $homologacao = false;


        $query = "select * from pre_cadastro_aluno_migra where codigo = 12381";
        $result = mysql_query($query);
        
        while($d = mysql_fetch_object($result)){
            set_time_limit(90);
            $campos = [];
            foreach($d as $i => $v){
                if($i != 'codigo'){
                    $campos[] = "{$i} = '{$v}'";
                }
                
            }    
            $q = str_replace($de, $para,"insert into pre_cadastro_aluno{$homologacao} set ".implode(", ", $campos));
            mysql_query($q);
            $codigo_aluno = mysql_insert_id();
            $de = ['[codigo_aluno]','[codigo_matricula]','[codigo_prova]'];
            $para = [$codigo_aluno,$codigo_matricula,$codigo_prova];
            // echo "<br><br>";


            //Entrar nas matículas
            
            $query1 = "select * from matricula_migra where codigo_aluno = '{$d->codigo}'";
            $result1 = mysql_query($query1);
            while($d1 = mysql_fetch_object($result1)){
            set_time_limit(90);
                // echo "<br><b>Matriculas</b><br>";
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
                $q = str_replace($de, $para,"insert into matricula{$homologacao} set ".implode(", ", $campos));
                mysql_query($q);
                $codigo_matricula = mysql_insert_id();
                $de = ['[codigo_aluno]','[codigo_matricula]','[codigo_prova]'];
                $para = [$codigo_aluno,$codigo_matricula,$codigo_prova];
                // echo "<br>";   
                
                //Entrar nas Provas
                
                $query2 = "select * from provas_migra where codigo_matricula = '{$d1->codigo}'";
                $result2 = mysql_query($query2);
                while($d2 = mysql_fetch_object($result2)){
                    set_time_limit(90);
                    // echo "<br><b>Porvas</b><br>";
                    $campos = [];
                    foreach($d2 as $i => $v){
                        if($i != 'codigo'){
                            if($i == 'codigo_matricula'){
                                $campos[] = "codigo_matricula = '[codigo_matricula]'";
                            }else if($i == 'codigo_aluno'){
                                $campos[] = "codigo_aluno = '[codigo_aluno]'";
                            }else if($i == 'chave'){
                                $campos[] = "{$i} = '{$v}xyz'";
                            }else{
                                $campos[] = "{$i} = '{$v}'";
                            }
                            
                        }
                        
                    }
                    set_time_limit(90);
                    $q = str_replace($de, $para,"insert into provas{$homologacao} set ".implode(", ", $campos));
                    mysql_query($q);
                    $codigo_prova = mysql_insert_id();
                    set_time_limit(90);
                    $de = ['[codigo_aluno]','[codigo_matricula]','[codigo_prova]'];
                    $para = [$codigo_aluno,$codigo_matricula,$codigo_prova];
                    // echo "<br>";  
                    
                    // Listando as questoes

                    $query3 = "select * from provas_perguntas_migra where codigo_prova = '{$d2->codigo}'";
                    $result3 = mysql_query($query3);
                    while($d3 = mysql_fetch_object($result3)){
                        set_time_limit(90);
                        // echo "<br><b>Porvas Perguntas</b><br>";
                        $campos = [];
                        foreach($d3 as $i => $v){
                            if($i != 'codigo'){
                                if($i == 'codigo_prova'){
                                    $campos[] = "codigo_prova = '[codigo_prova]'";
                                }else if($i == 'chave'){
                                    $campos[] = "{$i} = '{$v}xyz'";
                                }else{
                                    $campos[] = "{$i} = '{$v}'";
                                }
                                
                            }
                            
                        }
                        set_time_limit(90);
                        $q = str_replace($de, $para,"insert into provas_perguntas{$homologacao} set ".implode(", ", $campos));
                        mysql_query($q);
                        set_time_limit(90);
                        // echo "<br>";  
                        
                        // Listando as questoes
    
                        
        
                    }
                    
    
    
    
    
                }


            }
            // echo "<hr>"; 
            




        }

        echo "Concluido!!!";