<?php

namespace yupdesign\AFKuenstler\Module;

class KuenstlerListe extends \Module
{

  /**
   * @var string Template
   */
  protected $strTemplate = 'mod_kuenstler_liste';

  /**
   * @return string
   */
  public function generate()
  {
    if (TL_MODE === 'BE') {
      $template = new \BackendTemplate('be_wildcard');
      $template->wildcard = '### KÜNSTLER-LISTE ###';
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
    $this->Template->test = '';

  }

  /**
   * Weitere Helferfunktionen, die für die Liste relevant sind.
   */
}