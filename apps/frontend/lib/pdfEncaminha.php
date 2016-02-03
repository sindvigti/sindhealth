<?php

class EncaminhaPdf 
{
  
  private function init_pdf()
  {
    $config = sfTCPDFPluginConfigHandler::loadConfig();
    return new sfTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true);
  }


  public function render($associado, $local, $tipo='titular')
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
    $htmlcontent = "<br />";
    $htmlcontent .= "Data: " . date("d/m/Y") . "<br /><br />";
    $htmlcontent .= "Local: <br />";
    $htmlcontent .=  $local['endereco'] . "<br />";
    $htmlcontent .=  "Tel:" . $local['telefone'] . "<br />";
    $htmlcontent .=  $local['dentista'] . "<br /><br />";
    
    if($tipo == 'dependente')
    {
      $htmlcontent .= "Dependente: " . $nome . "<br /><br />";
      $htmlcontent .= "Titular: " . $nome_titular . "<br />";
    }
    else
    {
      $htmlcontent .= "Titular: " . $nome . "<br />";
    }

    $htmlcontent .= "<br />Matrícula: " . $codigo . "<br /><br />";
    $htmlcontent .= "PREENCHIMENTO OBRIGATÓRIO PELO CONSULTÓRIO<br /><br /><br />"; 
    $htmlcontent .= "Espécie de tratamento: __________________________________________________<br /><br /><br />"; 
    $htmlcontent .= "Odontologia: ________________________________________________<br /><br /><br />"; 
    $htmlcontent .= "Observações: <strong>DEVOLVER O ENCAMINHAMENTO APÓS O TRATAMENTO</strong><br /><br /><br /><br /><br /><br /><br />"; 
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
    $pdf->SetFont('Times', '', 12);

    //set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, 15);
    $pdf->SetHeaderMargin(50);
    $pdf->SetFooterMargin(4);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); //set image scale factor

    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', '14'));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    //initialize document
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Image(K_PATH_IMAGES . "timbre.png", 15, 14, 170, 0, 'PNG', 'http://www.tcpdf.org', '', false, 150, '', false, false, 0, false, false, false);
    $pdf->Ln(45);

    $titulo = <<< EOT
ENCAMINHAMENTO DENTÁRIO
EOT;
    $pdf->MultiCell(180,0, $titulo , 0, 'C', 0, 0, '', '', true, 0);
    $pdf->Ln(10);


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
