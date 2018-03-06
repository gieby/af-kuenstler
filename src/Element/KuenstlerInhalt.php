<?php

namespace yupdesign\AFKuenstler\Element;

class KuenstlerInhalt extends \ContentElement
{

  /**
   * @var string Template
   */
  protected $strTemplate = 'ce_kuenstler_inhalt';

  /**
   * @return string
   */
  public function generate()
  {
    if (TL_MODE === 'BE') {
      $template = new \BackendTemplate('be_wildcard');
      $template->wildcard = '### KÜNSTLER-Inhalt ###';
			$template->title = $this->name;
			$template->id = $this->id;
			$template->link = $this->name;
      $template->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;
      
      return $template->parse();
    }

    return parent::generate();
  }

  /**
   * Erstellt das Modul
   */
  protected function compile()
  {
    $objKuenstler = $this->Database->prepare(
      'SELECT custom_title, type, entries, entries_af FROM tl_af_vitablock WHERE pid=?'
    )->execute(6);

    while ($objKuenstler->next()) {
        /**
         * Ergebnisse... handle me!
         */

        $block = array();

        $block['custom_title'] = $objKuenstler->custom_title;
        $block['type'] = $objKuenstler->type;
        if($block['type'] != 'entries_af') {
          $entries = deserialize($objKuenstler->entries);
          $block['dropFirstColumn'] = $this->canFirstColumBeDropped($entries);
          $block['entries'] = $this->formatEntries($entries);
        } else {
          $entries = deserialize($objKuenstler->entries_af);
          $block['entries'] = $this->formatExhibitions($entries);
        }


        $blocks[] = $block;

    }

    $this->Template->blocks = $blocks;

  }

  /**
   * Weitere Helferfunktionen, die für die Liste relevant sind.
   */

   function canFirstColumBeDropped($block) {
     foreach ($block as $entries) {
       if($entries['date_from'] != '' || $entries['date_to'] != '') {
         return false;
       }
     }

     return true;
   }

   function formatEntries($block) {
     $arrReturn = array();
     foreach ($block as $entry) {
        $data = array(
          'date' => $this->formatDate($entry['date_from'],$entry['date_to']),
          'text' => $entry['entry_text']
        );

        $arrReturn[] = $data;
     }

    return $arrReturn;
   }
   
   function formatExhibitions($block) {
     $arrReturn = array();
     $exhibDB = $this->Database->prepare("SELECT title, date, exhib_page FROM tl_ausstellung WHERE id=?");
     foreach ($block as $entry) {
       $exhib = $exhibDB->execute($entry['exhib_id'])->next();

        $data = array(
          'debug-block' => $block,
          'debug_entry' => $entry,
          'debug_exhib' => $exhib,
          'debug_exhibDB' => $exhibDB,
          'date' => date('Y',$exhib->date),
          'text' => $exhib->title
        );

        $arrReturn[] = $data;
     }

    return $arrReturn;
   }

   function formatDate($date_from,$date_to) {
      $text = 'FEHLER';  
      if($date_from != '' && $date_from != '...') {
        if($date_to == '') {
          $text = $date_from;
        } elseif ($date_to == '...') {
          $text = 'seit&nbsp;'.$date_from;
        } else {
          $text = $date_from . '&nbsp;-&nbsp;' . $date_to;
        }
      } elseif ($date_from != '' && $date_from == '...') {
        if($date_to != '') {
          $text = 'bis&nbsp;'.$date_to;
        }
      } elseif ($date_from == '' && $date_to == '') {
        $text = '';
      }

      return $text;
   }
}