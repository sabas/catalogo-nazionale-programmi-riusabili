<?php
 require 'scraperwiki.php';
 require 'simple_html_dom.php';
 
 $html = scraperwiki::scrape("http://www.agid.gov.it/catalogo-nazionale-programmi-riusabili");

$dom = new simple_html_dom();
$dom->load($html);
$tab=$dom->find("table.views-table");
$tab=$tab[0]->find("tbody tr");
foreach($tab as $row)
{
 $row=$row->find("td");
 if (!isset($row[0])) continue;
 $ID=trim($row[0]->plaintext);
 $Titolo=trim(utf8_decode($row[1]->plaintext));
 $Anno=trim(utf8_decode($row[2]->plaintext));
 $Amministrazione=trim(utf8_decode($row[3]->plaintext));
 $Scheda_Applicazione=trim(utf8_decode($row[4]->plaintext));
 $record = array(
   'ID' => $ID,
   'Titolo' => $Titolo,
   'Anno' => $Anno,
   'Amministrazione' => $Amministrazione,
   'Scheda_Applicazione' => $Scheda_Applicazione
 );
 scraperwiki::save_sqlite(array('ID'), $record); 
}
?>
