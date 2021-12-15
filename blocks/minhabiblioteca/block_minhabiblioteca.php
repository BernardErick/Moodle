<?php

class block_minhabiblioteca extends block_base {

    public function init() {
        $this->title = get_string('minhabiblioteca', 'block_minhabiblioteca');
    }

    public function get_content(){

        global $CFG;

        if($this->content !== null) {
            return $this->content;
        }

        $this->content         = new stdClass;
        $this->content->text   = '<div style="text-align: center; width: 100%;">
                                   <a href="'.$CFG->wwwroot.'/blocks/minhabiblioteca/request_minhabiblioteca.php" target="_blank">
                                  <img style="width: 80%" src="https://uol.unifor.br/oul/conteudo?cdConteudo=7069777"/>
                                  </a>
                                  </div>';

        return $this->content;
    }

}