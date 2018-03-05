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
      'SELECT title, entries, entries_af FROM tl_af_vitablock WHERE id=?'
    )->execute(6);

    if($objKuenstler->numRows < 1) {
      /**
       * keine Ergebnisse... handle this shit!
       */

       return;
    }

    while ($objKuenstler->next()) {
        /**
         * Ergebnisse... handle me!
         */
    }

    $this->Template

  }

  /**
   * Weitere Helferfunktionen, die für die Liste relevant sind.
   */
}