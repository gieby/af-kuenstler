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
      'SELECT title, entries, entries_af FROM tl_af_vitablock WHERE pid=?'
    )->execute(6);

    while ($objKuenstler->next()) {
        /**
         * Ergebnisse... handle me!
         */

        $block = array();

        $block['title'] = $objKuenstler->title;
        $block['type'] = ($objKuenstler->entries_af == null) ? 'default' : 'af';
        if($block['type'] == 'default') {
          $block['entries'] = deserialize($objKuenstler->entries);
          $block['dropFirstColumn'] = $this->canFirstColumBeDropped($block['entries']);
        } else {
          $block['entries'] = deserialize($objKuenstler->entries_af);
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
}