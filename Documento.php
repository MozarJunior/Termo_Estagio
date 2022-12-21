<?php

Class Documento
{
    private function consulta()
    {
        include_once 'database\Consulta_docs.php';
        $class = new Consulta_docs();

        return $class;
    }

    public function baseline()
    {
        $arquivo = 'Estrutura\novo.html';
        $fp = fopen($arquivo, "a");

        fwrite($fp, "
        <!DOCTYPE html>
        <html lang=\"pt-br\">
        <head>
            <meta charset=\"UTF-8\">
            <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <link rel=\"stylesheet\" href=\"arquivo.css\">
            <title>Termo de Estagio</title>
        </head>
        <body>
            <div class=\"topo\" align=\"center\">
                <img src='brasao.png' id=\"imagem\">
                <br>
                <p class=\"topo-p2\"><b>MINISTÉRIO DA EDUCAÇÃO</b></p>
                <p class=\"topo-p\"><b>SECRETARIA DE EDUCAÇÃO PROFISSIONAL E TECNOLÓGICA</b> </p>
                <p class=\"topo-p\"><b>INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SERTÃO PERNAMBUCANO</b></p>
                <p class=\"topo-p\"><b>CAMPUS SALGUEIRO – COORDENAÇÃO DE EXTENSÃO E RELAÇÕES EMPRESARIAIS</b> </p>
                <br>
                <p class=\"topo-p2\"><b>TERMO DE COMPROMISSO DE ESTÁGIO OBRIGATÓRIO </b></p>
                </div>    
                ");
                fclose($fp);
    }
    // Tabelas a ser consultada
    //Concedente, Representante, Supervisor
    function tabela_concedente()
    {
        session_start();
        $consulta = $this->consulta();//Instancia da Class 
        $estudante_id = $_SESSION['estudante'];
        $estudante = $consulta->estudante($estudante_id);
        $estagio = $consulta->estagio($estudante_id);
        $concedente = $consulta->concedente($estagio['CONCEDENTE_ID']);
        $representante = $consulta->representante($concedente['ID']);
        $supervisor = $consulta->supervisor($estudante['SUPERVISOR_ID']);
        //Fim da consulta

        $arquivo = 'Estrutura\novo.html';
        $fp = fopen($arquivo, "a");

        fwrite($fp, "<div class=\"concedente\">
        <h4><b>1. CONCEDENTE</b></h4>
        <table>
            <tr>
                <td colspan=\"2\" width=\"70%\" height=\"40px\">");fwrite($fp, "<b>".$concedente['NOME']."</b>");fwrite($fp, ", Adiante CONCEDENTE</td>
            </tr>
            <tr>
                <td colspan=\"2\" width=\"70%\" height=\"25px\">CNPJ Nº ");fwrite($fp, $concedente['CNPJ']);fwrite($fp, "</td>
            </tr>
            <tr>
                <td colspan=\"2\" width=\"70%\" height=\"30px\">Natureza Jurídica da Instituição: ");fwrite($fp, $concedente['RAZAO_SOCIAL']);fwrite($fp, "</td>
            </tr>
            <tr>
                <td colspan=\"2\" width=\"70%\" height=\"40px\">Endereço: ");fwrite($fp, ""."; ");fwrite($fp, " Telefone: ");fwrite($fp, $concedente['TELEFONE']. "</td>
            </tr>
            <tr class=\"maior\" >
                <td colspan=\"2\" width=\"70%\" height=\"50px\">Representada por: ");fwrite($fp, $representante['NOME']. "; Cargo: " . "; CPF: "
                . $representante['CPF'] . "; RG: " . $representante['RG'] . "; Orgão Expedidor : " . $representante['ORGAO_EXPEDIDOR']);
                fwrite($fp, "</td>
            </tr>
            <tr>
                <td width=\"70%\" height=\"25px\">Supervisor do Estágio: ");fwrite($fp, $supervisor['NOME']);fwrite($fp, "</td>
                <td width=\"30%\" height=\"25px\">Cargo: ");fwrite($fp, $supervisor['CARGO']);fwrite($fp, "</td>
            </tr>
            <tr>
                    <td width=\"70%\" height=\"25px\">E-mail do Supervisor: ");fwrite($fp, $supervisor['EMAIL']);fwrite($fp, "</td>
                <td width=\"30%\" height=\"25px\">Contato: ");fwrite($fp, $supervisor['TELEFONE']);fwrite($fp, "</td>
            </tr>
        </table>\n<br>");

        fclose($fp);
    }
    // Tabela Completa
    function tabela_estagiario()
    {
        //Realizar consultas nas tabelas Estagiario, Curso
        //Consultas na tabela Estagiario
        $consulta = $this->consulta();
        session_start();
        $estudante_id = $_SESSION['estudante'];

        $estudante = $consulta->estudante($estudante_id);
        $pessoa = $consulta->pessoa($estudante['PESSOA_ID']);
        $endereco = $consulta->endereco($pessoa['ENDERECO_ID']);
        $estagio = $consulta->estagio($estudante['ID']);
        $curso = $consulta->curso($estudante['CURSO_ID']);

        $endereco_completo = "Residente à Rua : ". $endereco['LOGRADOURO'] . " Nº : " . $endereco['NUMERO'] . 
        " Bairro : " . $endereco['BAIRRO'] . " CEP " . $endereco['CEP'] . " Cidade : " . $endereco['CIDADE'] . " UF : " . $endereco['ESTADO'];
        
        $arquivo = 'Estrutura\novo.html';
        $fp = fopen($arquivo, "a");
        fwrite($fp, "
        <h4><b>2. ESTAGIÁRIO</b></h4>
        <table>
            <tr>
                <td width=\"100%\" height=\"40px\" colspan=\"3\">");fwrite($fp, $pessoa['NOME']);fwrite($fp, ", Adiante ESTAGIÁRIO</td>");fwrite($fp, "
            </tr>
            <tr>
                <td height=\"25px\">CPF nº: ");fwrite($fp, $pessoa['CPF']);fwrite($fp, "</td>
                <td>RG nº: ");fwrite($fp, $pessoa['RG']);fwrite($fp, "</td>
                <td>Orgão Expedidor: ");fwrite($fp, $pessoa['ORGAO_EXPEDIDOR']);fwrite($fp, " </td>
            </tr>
            <tr>
                <td height=\"60px\" width=\"40%\">Data de Nasciemento: ");fwrite($fp,'');fwrite($fp, "</td>
                <td colspan=\"2\">");fwrite($fp , $endereco_completo);fwrite($fp,"</td>
            </tr>
            <tr>
                <td height=\"25px\">Telefone: ");fwrite($fp, $pessoa['TELEFONE']);fwrite($fp, "</td>");
                fwrite($fp, "<td colspan=\"2\" height=\"25px\">E-Mail: ");fwrite($fp, $pessoa['EMAIL']);fwrite($fp, "</td>
            </tr>
            <tr>
                <td colspan=\"3\" height=\"25px\">Curso: ");fwrite($fp, $curso['NOME']);fwrite($fp, "</td>
            </tr>\n
        </table>");
        fclose($fp);
    }
    //Tabela Completa
    function tabela_instituicao()
    {
        $estudante_id = $_SESSION['estudante'];
        $consulta = $this->consulta();

        $estudante = $consulta->estudante($estudante_id);
        $orientador = $consulta->orientador($estudante['ORIENTADOR_ID']);
        $pessoa = $consulta->pessoa($orientador['PESSOA_ID']);

        $arquivo = 'Estrutura\novo.html';
        $fp = fopen($arquivo, "a");
        fwrite($fp,"<h4><b>3. INSTITUIÇÃO DE ENSINO</b></h4>
        <table>
            <tr>
            <td  width=\"100%\" height=\"40px\">
                <b>INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SERTÃO
                PERNAMBUCANO – CAMPUS SALGUEIRO</b>, adiante INSTITUIÇÃO DE ENSINO
            </td>
            </tr>
            <tr>
                <td height=\"25px\">
                    CNPJ N° 10.830.301/0005-20
                </td>
            </tr>
            <tr>
                <td height=\"25px\">
                    Natureza jurídica da instituição: Autarquia Federal vinculada ao Ministério da Educação
                </td>
            </tr>
            <tr>
                <td height=\"25px\">
                    Endereço: BR 232, Km 508, Zona Rural, Salgueiro/PE, CEP 56000-000. Telefone (87) 3421-0050
                </td>
            </tr>
            <tr>
                <td height=\"40px\">
                    Representada por: JOSENILDO FORTE DE BRITO, Diretor Geral do Campus Salgueiro,
                CPF nº 023.364.814-30, RG nº 1375692 Órgão Expedidor: SSP/RN
                </td>            
            </tr>
            <tr>
                <td height=\"30px\">Professor(a) orientador(a): ");fwrite($fp, $pessoa['NOME']);fwrite($fp, "</td>
            </tr>
        </table>\n");
        fclose($fp);
    }
    // Pagina Completa
    function pagina2(){
        session_start();
        $estudante_id = $_SESSION['estudante'];
        //Realizar consultas nas tabelas Estagio, Estagiario e Curso
        //Consultas na tabela Estagiario e Estagio
        $consulta = $this->consulta();

        $estudante = $consulta->estudante($estudante_id);
        $pessoa = $consulta->pessoa($estudante['PESSOA_ID']);

        $estagio = $consulta->estagio($estudante['ID']);
        $curso = $consulta->curso($estudante['CURSO_ID']);

        $arquivo = 'Estrutura\novo.html';
        $fp = fopen($arquivo, "a");
        fwrite($fp, "
        <div class=\"page2\">
        <div class=\"topo\" align=\"center\">
            <img src='brasao.png' id=\"imagem\">
            <br>
            <p class=\"topo-p2\"><b>MINISTÉRIO DA EDUCAÇÃO</b></p>
            <p class=\"topo-p\"><b>SECRETARIA DE EDUCAÇÃO PROFISSIONAL E TECNOLÓGICA</b> </p>
            <p class=\"topo-p\"><b>INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SERTÃO PERNAMBUCANO</b></p>
            <p class=\"topo-p\"><b>CAMPUS SALGUEIRO – COORDENAÇÃO DE EXTENSÃO E RELAÇÕES EMPRESARIAIS</b> </p>
            </div>
            <br>
        <p class=\"clausula\">
            As partes acima nomeadas celebram entre si este TERMO DE COMPROMISSO DE ESTÁGIO, de acordo
            com o disposto na Lei 11.788, de 25 de setembro de 2008 e legislação complementar, mediante as cláusulas
            e condições a seguir estabelecidas:
        </p>
        <br>
        <h5><b>CLÁUSULA 1ª – DA VINCULAÇÃO AO CONVÊNIO</b></h5>
        <p class=\"clausula\">
            Este Termo de Compromisso vincula-se, para todos os efeitos legais, ao Convênio para Concessão de
            Estágio, celebrado entre a CONCEDENTE e a INSTITUIÇÃO DE ENSINO.
        </p>
        <br>
        <h5><b>CLÁUSULA 2ª – DO OBJETIVO</b></h5>
        <p class=\"clausula\">
            O presente Termo de Compromisso tem por objetivo estabelecer as normas e condições de realização do
            ESTÁGIO OBRIGATÓRIO, em consonância com o que estabelece a Lei 11.788/2008 e normas
            complementares.
        </p>
        <br>
        <h5><b>CLÁUSULA 3ª – DO ESTAGIÁRIO (A)</b></h5>
        <p class=\"clausula\">
            O(a) ESTAGIÁRIO(A) é aluno(a) do INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO
            SERTÃO PERNAMBUCANO – CAMPUS SALGUEIRO, estando regularmente matriculado(a) no Período ");
            fwrite($fp, $estudante['PERIODO_CURSO'] . "º");
            fwrite($fp, " do Curso ");fwrite($fp, $curso['NOME']);
        
        fwrite($fp ,"</p>
        <br>
        <h5><b>CLÁUSULA 4ª – DAS CONDIÇÕES DO ESTÁGIO</b></h5>
        <p class=\"clausula\">
            O estágio será realizado na concedente, no período de ");fwrite($fp, $estagio['DATA_INICIO']);
            fwrite($fp, " a ".$estagio['DATA_FIM']);
            fwrite($fp, ", com a seguinte
            jornada: de segunda-feira a sexta-feira, das ");fwrite($fp, "h ");fwrite($fp," às "."h");
            fwrite($fp,", com a carga horária total de ");fwrite($fp, $estagio['DURACAO']);
            fwrite($fp, " horas
        </p>
        <br>
        <p class=\"clausula\">
            <strong>SUBCLÁUSULA 1ª - </strong>
            Em nenhuma hipótese as atividades de estágio poderão coincidir com o horário das
            aulas do ESTAGIÁRIO(A).
        </p>
        <br>
        <p class=\"clausula\">
            <strong>SUBCLÁUSULA 2ª - </strong>
            A jornada de atividade do estagiário(a)(a) poderá ser flexibilizada pela
            CONCEDENTE, desde que mantidas sua supervisão e a carga horária definida nesta cláusula.
        </p>
        <br>
        <p class=\"clausula\">
            <strong>SUBCLÁUSULA 3ª - </strong>
            A critério da CONCEDENTE poderá ser adotado o sistema de compensação de horas,
            quando compatível com a jornada de atividade definida nesta cláusula.
        </p>
        <br>
        
        <p class=\"clausula\">
            <strong>SUBCLÁUSULA 4ª - </strong>
            <b>
                O estágio terá duração de meses e dias, podendo ser prorrogado
                sucessivamente por igual período até o máximo de 2 (dois) anos, à exceção para estagiário(a)(a)
                portador de deficiência.
            </b>
        </p>
        <br>
        <p class=\"clausula\">
        <strong>CLÁUSULA 5ª – DO PLANO DE ATIVIDADES</strong>
            Integra o presente para todos os efeitos legais o PLANO DE ATIVIDADES do estágio, elaborado em
            conjunto pelo ESTAGIÁRIO(A), pela INSTITUIÇÃO DE ENSINO e pela CONCEDENTE, onde deverão
            constar as condições de adequação do estágio à proposta pedagógica do curso, à etapa e modalidade da
            formação escolar do estudante e ao horário e calendário escolar.
        </p>
        <br>
        <h5><b>CLÁUSULA 6ª – DAS OBRIGAÇÕES E RESPONSABILIDADES DA CONCEDENTE</b></h5>
        <p class=\"clausula\">
            A CONCEDENTE deverá:<br>
            - manter as instalações com condições de proporcionar ao ESTAGIÁRIO(A) atividades de aprendizagem
            social, profissional e cultural;<br>
            - respeitar o limite máximo legal de 10 estagiário(a)(a)s por SUPERVISOR(A);<br>
            - enviar à INSTITUIÇÃO DE ENSINO, semestralmente, relatório de atividades do estágio, com vista
            obrigatória do ESTAGIÁRIO(A).<br>
            - disponibilizar ao ESTAGIÁRIO(A) os equipamentos de segurança que se fizerem necessário e exigir o seu
            uso durante o desempenho das atividades do estágio;<br>
            - não expor o ESTAGIÁRIO(A) a riscos ambientais insalubres ou perigosos, sem o uso dos EPI's e EPC's
            obrigatórios, dentro dos limites de tolerância;<br>
            - informar ao ESTAGIÁRIO(A) todas as normas de Segurança do Trabalho previstas para seu estágio;<br>
            - entregar quando do desligamento do ESTAGIÁRIO(A), termo de realização do estágio, com indicação
            resumida das atividades desenvolvidas, dos períodos e da avaliação de desempenho.<br>
            </p>
        </div>\n");
        fclose($fp);
    }
    // Pagina Completa
    function pagina3(){
        $arquivo = 'Estrutura\novo.html';
        $fp = fopen($arquivo, "a");
        fwrite($fp, "
        <div class=\"page3\">
        <div class=\"topo\" align=\"center\">
            <img src='brasao.png' id=\"imagem\">
            <br>
            <p class=\"topo-p2\"><b>MINISTÉRIO DA EDUCAÇÃO</b></p>
            <p class=\"topo-p\"><b>SECRETARIA DE EDUCAÇÃO PROFISSIONAL E TECNOLÓGICA</b> </p>
            <p class=\"topo-p\"><b>INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SERTÃO PERNAMBUCANO</b></p>
            <p class=\"topo-p\"><b>CAMPUS SALGUEIRO – COORDENAÇÃO DE EXTENSÃO E RELAÇÕES EMPRESARIAIS</b> </p>
        </div>
        <br>
        <h5><b>CLÁUSULA 7ª – DAS OBRIGAÇÕES E RESPONSABILIDADES DA INSTITUIÇÃO DE ENSINO</b></h5>
        <p class=\"clausula\">
            A INSTITUIÇÃO DE ENSINO se compromete a colaborar com a CONCEDENTE e com o ESTAGIÁRIO(A)
            para que a realização do estágio atinja os seus objetivos acadêmicos e ocorra em observância aos
            dispositivos legais e regulamentares pertinentes, devendo para tanto:<br>
            - avaliar as instalações do local em que será realizado o estágio e sua adequação à formação cultural e
            profissional do ESTAGIÁRIO(A);<br>
            - exigir do ESTAGIÁRIO(A) a apresentação semestral ao Professor Orientador do relatório de atividades;<br>
            - zelar pelo cumprimento deste termo de compromisso, reorientando o ESTAGIÁRIO(A) para outro local em
            caso de descumprimento de suas normas;<br>
            - comunicar à CONCEDENTE o início do período letivo e a datas de realização de avaliações escolares ou
            acadêmicas;<br>
            - comunicar à CONCEDENTE o desligamento do ESTAGIÁRIO(A) da INSTITUIÇÃO DE ENSINO.
        </p>
        <br>
    
        <h5><b>CLÁUSULA 8ª – DAS OBRIGAÇÕES E RESPONSABILIDADES DO ESTAGIÁRIO(A)</b></h5>
        <p class=\"clausula\">
            O ESTAGIÁRIO(A) deverá:<br>
            a) atuar com zelo e dedicação na execução de suas atribuições, de forma a evidenciar desempenho
            satisfatório nas avaliações periódicas a serem realizadas pelo Supervisor do estágio;<br>
            b) cumprir fielmente todas as instruções, recomendações de normas relativas ao estágio, emanadas da
            Instituição de Ensino e da CONCEDENTE, em especial as constantes do Plano de Estágio;<br>
            c) manter total reserva em relação a quaisquer dados ou informações a que venha a ter acesso em razão de
            sua atuação no cumprimento do estágio, não as repassando a terceiros sob qualquer forma ou pretexto, sem
            prévia autorização formal da CONCEDENTE independentemente de se tratar ou não de informação
            reservada, confidencial ou sigilosa;<br>
            d) preencher e assinar a proposta de seguro de acidentes pessoais referentes ao Plano de Seguro Contra
            Acidentes de Trabalho no ato da celebração deste instrumento;<br>
            e) responsabilizar-se por qualquer dano ou prejuízo que venha a causar ao patrimônio da CONCEDENTE
            por dolo ou culpa;<br>
            f) manter conduta compatível com a ética, os bons costumes e a probidade administrativa no
            desenvolvimento do estágio, evitando a prática de atos que caracterizem falta grave.
        </p>
        <br>
    
        <h5><b>CLÁUSULA 9ª – DO RECESSO</b></h5>
        <p class=\"clausula\">
            A cada um ano de duração do estágio o ESTAGIÁRIO(A) gozará de trinta dias de recesso. 
        </p>
        <br>
    
        <h5><b>CLÁUSULA 10ª – DO SEGURO CONTRA ACIDENTES PESSOAIS</b></h5>
        <p class=\"clausula\">
            A ESTAGIÁRIO(A) encontra-se assegurada contra acidentes pessoais, através do Contrato nº 06/2021 da
            Seguradora SURA, tendo como ESTIPULANTE o(a) próprio(a) aluno(a), nas condições e valores fixados na
            referida APÓLICE, compatíveis com os valores de mercado.
        </p>
        <br>
    
        <h5><b>CLÁUSULA 11ª –DO VÍNCULO EMPREGATÍCIO</b></h5>
        <p class=\"clausula\">
            Conforme o previsto na legislação vigente, o estágio não gera vínculo empregatício de qualquer natureza,
            desde que observados os incisos do Art. 3º da Lei 11.788/2008 e as obrigações contidas no presente
            Convênio, independentemente da concessão de benefícios relacionados a transporte, alimentação e saúde,
            ressalvado o disposto sobre a matéria na legislação previdenciária e no Art. 15 da Lei 11.788/2008 e nem
            haverá, por parte da CONCEDENTE, qualquer compromisso em estabelecer futuramente tal vínculo.
        </p>
        <br>
        
        <h5><b>CLÁUSULA 12ª – DA EXTINÇÃO DO ESTÁGIO</b></h5>
        <p class=\"clausula\">
            O estágio será extinto;<br>
            - por iniciativa de quaisquer das partes, mediante comunicação por escrito, feita com antecedência mínima
            de cinco (05) dias, respeitando-se o período de recesso;<br>
            - por decurso do prazo fixado para o estágio, sem que tenha sido prorrogado mediante Termo Aditivo ao
            presente;<br>
            - na hipótese do ESTAGIÁRIO(A) ser desvinculado da INSTITUIÇÃO DE ENSINO.
        </p>
        </div>
        ");
        fclose($fp);
    }
    // Pagina Completa
    function pagina4(){
        $arquivo = 'Estrutura\novo.html';
        $fp = fopen($arquivo, "a");
        fwrite($fp, "
        <div class=\"page4\">
            <div class=\"topo\" align=\"center\">
                <img src='brasao.png' id=\"imagem\">
                <br>
                <p class=\"topo-p2\"><b>MINISTÉRIO DA EDUCAÇÃO</b></p>
                <p class=\"topo-p\"><b>SECRETARIA DE EDUCAÇÃO PROFISSIONAL E TECNOLÓGICA</b> </p>
                <p class=\"topo-p\"><b>INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SERTÃO PERNAMBUCANO</b></p>
                <p class=\"topo-p\"><b>CAMPUS SALGUEIRO – COORDENAÇÃO DE EXTENSÃO E RELAÇÕES EMPRESARIAIS</b> </p>
            </div>
            <br><br><br><br><br><br><br><br><br>
            <p class=\"clausula\">     
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E por estarem de acordo, firmam as partes o presente Termo de Compromisso em <strong>DUAS</strong> vias de igual teor para um só efeito, 
                na presença das testemunhas abaixo nomeadas e assinadas.
            </p>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            
            <p id=\"local\">
            Salgueiro, ____ de ____________ de 20____.
            </p><br><br><br>
    
            <p class=\"line\">
            _______________________________<br>
            Concedente
            <p><br><br><br>
    
            <p class=\"line\">
            _______________________________<br>
            Josenildo Forte de Brito<br>
            Diretor-Geral / IFSertãoPE – Campus Salgueiro
            <p><br><br><br>
    
            <p class=\"line\">
            _______________________________<br>
            Estagiário(a)
            <p><br><br><br>
            </div>\n</body>\n</html>
        ");
        fclose($fp);
    }
    public function lerArquivo(){
        $arq = 'Estrutura\novo.html';
        $handle = fopen($arq, "r");
        $ler = fread($handle, filesize($arq));
        $vazio = 0;

        if($ler != ""){
            $reescreve = fopen($arq, "w");
            fwrite($reescreve, $this->baseline());
            fwrite($reescreve, $this->tabela_concedente());
            fwrite($reescreve, $this->tabela_estagiario());
            fwrite($reescreve, $this->tabela_instituicao());
            fwrite($reescreve, $this->pagina2());
            fwrite($reescreve, $this->pagina3());
            fwrite($reescreve, $this->pagina4());
            fclose($reescreve);
        }else{
            $escreve = fopen($arq, "w");
            fwrite($escreve, $this->baseline());
            fwrite($escreve, $this->tabela_concedente());
            fwrite($escreve, $this->tabela_estagiario());
            fwrite($escreve, $this->table_instituicao());
            // fwrite($escreve, $this->pagina2());
            // fwrite($escreve, $this->pagina3());
            // fwrite($escreve, $this->pagina4());
            fclose($escreve);
            $vazio = 1;
        }
        fclose($handle);

        return $vazio;
    }
}