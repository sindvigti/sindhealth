<?php

class FichaAdesaoPdf 
{
  
  private function init_pdf()
  {
    $config = sfTCPDFPluginConfigHandler::loadConfig();
    return new sfTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true);
  }

  public function renderFicha($titular)
  {
    $pdf = $this->init_pdf();

    $doc_title    = "Proposta de adesão para " . $titular->getNome();
    $doc_subject  = "test description";
    $doc_keywords = "test keywords";
    //Inicio do Conteudo
    $htmlcontent = "<div class=\"displayData\">";
    $htmlcontent .= "<h3>" . $titular->getNome(). "&nbsp;&nbsp;&nbsp;Matricula:&nbsp;" . $titular->getMatricula() ."</h3>";
    $htmlcontent .= "</div>";
    $htmlcontent .= "<p>Estado civil: " . $titular->getEstadoCivil() . "</p>";
    $htmlcontent .= "<p>Data de Associação: " . $titular->getDateTimeObject('data_admiss')->format('d/m/Y')  . "</p>";
    $htmlcontent .=  <<< EOT
      <div id="dependentes">
      <h4>Dependentes</h4>
      <table>
      <tr>
      <th>Nome</th>
      <th>Parentesco</th>
      <th colspan="2">Data de Nasc.</th>
      </tr>
EOT;

      foreach ($titular->getDependentes() as $dependente)
      {
        $htmlcontent .= "<tr>";
        $htmlcontent .=   "<td>" . $dependente->getNome() . "</td>";
        $htmlcontent .=   "<td>" . $dependente->getParentesco() . "</td>";
        $htmlcontent .=   "<td>" . $dependente->getDateTimeObject('nasc')->format('d/m/Y') . "</td>";
        $htmlcontent .= "</tr>";
      }
    $htmlcontent .= "</table> </div>";
    //Fim do Conteudo


    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor(PDF_AUTHOR);
    $pdf->SetTitle($doc_title);
    $pdf->SetSubject($doc_subject);
    $pdf->SetKeywords($doc_keywords);

    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    //set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

    //set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); //set image scale factor

    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', '14'));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    //initialize document
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // set barcode
    $pdf->SetBarcode(date("Y-m-d H:i:s", time()));

    // output some HTML code
    $pdf->writeHTML($htmlcontent , true, 0);
    $pdf->Ln(30);

    $assinatura_titular_str = <<< EOT
    _____________________________
        Assinatura do Titular
EOT;

    $visto_atendente_str = <<< EOT
    _____________________________
          Visto do Atendente
EOT;
    $pdf->MultiCell(80,0, $assinatura_titular_str , 0, 'C', 0, 0, '', '', true, 0);
    $pdf->MultiCell(100,0, $visto_atendente_str , 0, 'C', 0, 0, '', '',true, 0);

    ob_clean();
    // Close and output PDF document
    $pdf->Output();


  }

  public function renderEncaminha($associado, $tipo='titular')
  {
    $pdf = $this->init_pdf();

    if($tipo == 'titular')
    {
      $nome = $associado->getNome();
      $codigo = $associado->getMatricula();
      
    }
    elseif ($tipo == 'dependente')
    {
      $nome = $associado->getNome();
      $codigo = $associado->getTitular()->getMatricula();
      $nome_titular = $associado->getTitular()->getNome();
    }


    $doc_title    = "Encaminhamento Dentário para " . $nome;
    $doc_subject  = "test description";
    $doc_keywords = "test keywords";
    //Inicio do Conteudo
    $htmlcontent = "Sindicato dos Vigilantes do RJ  -  Convenio(A-6570)<br />";
    $htmlcontent .= "Data: " . date("d/m/Y") . "<br /><br />";
    $htmlcontent .= "Nome do Associado: " . $nome . "<br /><br />";
    
    if($tipo == 'dependente')
    {
      $htmlcontent .= "Dependente do Titular: " . $nome_titular . "<br />";
    }
    else
    {
      $htmlcontent .= "Titular<br />";
    }

    $htmlcontent .= "<br />Matrícula: " . $codigo . "<br /><br />";
    $htmlcontent .= "PREENCHIMENTO OBRIGATÓRIO PELO CONSULTÓRIO<br /><br /><br />"; 
    $htmlcontent .= "Espécie de tratamento: _________________________________________<br /><br /><br />"; 
    $htmlcontent .= "Odontologia: _________________________________________<br /><br /><br />"; 
    $htmlcontent .= "Observações: <strong>DEVOLVER O ENCAMINHAMENTO APÓS O TRATAMENTO</strong><br /><br /><br /><br />"; 
    //Fim do Conteudo


    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor(PDF_AUTHOR);
    $pdf->SetTitle($doc_title);
    $pdf->SetSubject($doc_subject);
    $pdf->SetKeywords($doc_keywords);

    $pdf->SetHeaderData("timbre.png", 50, '', '');

    //set margins
    //$pdf->SetMargins(2, 2, 2);
    //set font
    $pdf->SetFont('Times', '', 14);

    //set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->SetHeaderMargin(50);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); //set image scale factor

    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', '14'));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    //initialize document
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Image(K_PATH_IMAGES . "timbre.png", 15, 14, 170, 0, 'PNG', 'http://www.tcpdf.org', '', false, 150, '', false, false, 0, false, false, false);
    $pdf->Ln(50);

    // set barcode
    //$pdf->SetBarcode(date("Y-m-d H:i:s", time()));

    // output some HTML code
    $pdf->writeHTML($htmlcontent , true, 0);

    $assinatura_diretor = <<< EOT
    _____________________________________________
              Assinatura do  Diretor
EOT;
    $pdf->MultiCell(180,0, $assinatura_diretor , 0, 'C', 0, 0, '', '', true, 0);
    $pdf->Ln(30);

    $pe_de_pagina = <<< EOT
    RUA ANDRÉ CAVALCANTI, 126 - BAIRRO DE FÁTIMA - CENTRO - CEP: 20231-050
    Rio de Janeiro - RJ - Tels: 3861-7050 e 3861-7051
    Site: www.sindvig.org.br - Email: sindvigilantesrj@isbt.com.br
    SUBSEDE ZONA OESTE: Rua Albertina, 70 - Tel: 2413-1424 - Campo Grande - RJ
EOT;

    $pdf->MultiCell(180,0, $pe_de_pagina , 'T', 'C', 0, 0, '', '', true, 0);

    ob_clean();
    // Close and output PDF document
    $pdf->Output();


  }


}
?>
