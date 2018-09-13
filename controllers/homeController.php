<?php
class homeController extends Controller {
    
    public function index() {
        $fotos = new Fotos();
        
        $fotos->getSaveFotos();
        
        $dados = array();
        $dados['fotos'] = $fotos->getFotos();
        
        $this->loadTemplete('home', $dados);
    }
}