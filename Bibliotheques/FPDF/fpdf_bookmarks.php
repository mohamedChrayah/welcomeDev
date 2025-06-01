<?php

include('FPDI/src/Fpdi.php');
require('fpdf.php');

class PDF_Bookmark extends FPDF{

  protected $outlines = array();
  protected $outlineRoot;

  function Bookmark($txt, $isUTF8=false, $level=0, $y=0){
      if(!$isUTF8)
          $txt = utf8_encode($txt);
      if($y==-1)
          $y = $this->GetY();
          $this->outlines[] = array('t'=>$txt, 'l'=>$level, 'y'=>($this->h-$y)*$this->k, 'p'=>$this->PageNo());
  }

  function _putbookmarks(){
      $nb = count($this->outlines);
      if($nb==0)
          return;
      $lru = array();
      $level = 0;
      foreach($this->outlines as $i=>$o){
          if($o['l']>0)
          {
              $parent = $lru[$o['l']-1];
              // Set parent and last pointers
              $this->outlines[$i]['parent'] = $parent;
              $this->outlines[$parent]['last'] = $i;
              if($o['l']>$level)
              {
                  // Level increasing: set first pointer
                  $this->outlines[$parent]['first'] = $i;
              }
          }
          else
              $this->outlines[$i]['parent'] = $nb;
          if($o['l']<=$level && $i>0)
          {
              // Set prev and next pointers
              $prev = $lru[$o['l']];
              $this->outlines[$prev]['next'] = $i;
              $this->outlines[$i]['prev'] = $prev;
          }
          $lru[$o['l']] = $i;
          $level = $o['l'];
      }
      // Outline items
      $n = $this->n+1;
      foreach($this->outlines as $i=>$o){
          $this->_newobj();
          $this->_put('<</Title '.$this->_textstring($o['t']));
          $this->_put('/Parent '.($n+$o['parent']).' 0 R');
          if(isset($o['prev']))
              $this->_put('/Prev '.($n+$o['prev']).' 0 R');
          if(isset($o['next']))
              $this->_put('/Next '.($n+$o['next']).' 0 R');
          if(isset($o['first']))
              $this->_put('/First '.($n+$o['first']).' 0 R');
          if(isset($o['last']))
              $this->_put('/Last '.($n+$o['last']).' 0 R');
          $this->_put(sprintf('/Dest [%d 0 R /XYZ 0 %.2F null]',$this->PageInfo[$o['p']]['n'],$o['y']));
          $this->_put('/Count 0>>');
          $this->_put('endobj');
      }
      // Outline root
      $this->_newobj();
      $this->outlineRoot = $this->n;
      $this->_put('<</Type /Outlines /First '.$n.' 0 R');
      $this->_put('/Last '.($n+$lru[0]).' 0 R>>');
      $this->_put('endobj');
  }

  function _putresources(){
      parent::_putresources();
      $this->_putbookmarks();
  }

  function _putcatalog(){
      parent::_putcatalog();
      if(count($this->outlines)>0)
      {
          $this->_put('/Outlines '.$this->outlineRoot.' 0 R');
          $this->_put('/PageMode /UseOutlines');
      }
  }

  function WordWrap($text, $maxwidth){
      $text = trim($text);
      if ($text==='')
          return 0;
      $space = $this->GetStringWidth(' ');
      $lines = explode("\n", $text);
      $text = '';
      $count = 0;

      foreach ($lines as $line)
      {
          $words = preg_split('/ +/', $line);
          $width = 0;

          foreach ($words as $word)
          {
              $wordwidth = $this->GetStringWidth($word);
              if ($wordwidth > $maxwidth)
              {
                  // Word is too long, we cut it
                  for($i=0; $i<strlen($word); $i++)
                  {
                      $wordwidth = $this->GetStringWidth(substr($word, $i, 1));
                      if($width + $wordwidth <= $maxwidth)
                      {
                          $width += $wordwidth;
                          $text .= substr($word, $i, 1);
                      }
                      else
                      {
                          $width = $wordwidth;
                          $text = rtrim($text)."\n".substr($word, $i, 1);
                          $count++;
                      }
                  }
              }
              elseif($width + $wordwidth <= $maxwidth)
              {
                  $width += $wordwidth + $space;
                  $text .= $word.' ';
              }
              else
              {
                  $width = $wordwidth + $space;
                  $text = rtrim($text)."\n".$word.' ';
                  $count++;
              }
          }
          $text = rtrim($text)."\n";
          $count++;
      }
      $text = rtrim($text);
      return $count;
  }

  function Justify($text, $w, $h, $xPath){
      $tab_paragraphe = explode("\n", $text);
      $nb_paragraphe = count($tab_paragraphe);
      $j = 0;

      while ($j<$nb_paragraphe) {

          $paragraphe = $tab_paragraphe[$j];
          $tab_mot = explode(' ', $paragraphe);
          $nb_mot = count($tab_mot);

          // Handle strings longer than paragraph width
          $tab_mot2 = array();
          $k = 0;
          $l = 0;
          while ($k<$nb_mot) {

              $len_mot = strlen ($tab_mot[$k]);
              if ($len_mot<($w-5) )
              {
                  $tab_mot2[$l] = $tab_mot[$k];
                  $l++;
              } else {
                  $m=0;
                  $chaine_lettre='';
                  while ($m<$len_mot) {

                      $lettre = substr($tab_mot[$k], $m, 1);
                      $len_chaine_lettre = $this->GetStringWidth($chaine_lettre.$lettre);

                      if ($len_chaine_lettre>($w-7)) {
                          $tab_mot2[$l] = $chaine_lettre . '-';
                          $chaine_lettre = $lettre;
                          $l++;
                      } else {
                          $chaine_lettre .= $lettre;
                      }
                      $m++;
                  }
                  if ($chaine_lettre) {
                      $tab_mot2[$l] = $chaine_lettre;
                      $l++;
                  }

              }
              $k++;
          }

          // Justified lines
          $nb_mot = count($tab_mot2);
          $i=0;
          $ligne = '';
          while ($i<$nb_mot) {

              $mot = $tab_mot2[$i];
              $len_ligne = $this->GetStringWidth($ligne . ' ' . $mot);

              if ($len_ligne>($w-5)) {

                  $len_ligne = $this->GetStringWidth($ligne);
                  $nb_carac = strlen ($ligne);
                  $ecart = (($w-2) - $len_ligne) / $nb_carac;
                  $this->SetX($xPath);
                  $this->_out(sprintf('BT %.3F Tc ET', $ecart*$this->k));
                  $this->MultiCell($w,$h,$ligne);
                  $ligne = $mot;

              } else {

                  if ($ligne)
                  {
                      $ligne .= ' ' . $mot;
                  } else {
                      $ligne = $mot;
                  }

              }
              $i++;
          }

          // Last line
          $this->SetX($xPath);
          $this->_out('BT 0 Tc ET');
          $this->MultiCell($w,$h,$ligne);
          $j++;
      }
  }

}
?>
