<?php 

class Carta extends Aluno {
    private string $mensagem;
    private bool $temIdadeMinima;

    public function getMensagem() {
        return $this->mensagem;
    }

    public function getTemIdadeMinima() {
        return $this->temIdadeMinima;
    }


    public function verificaIdade() {

        $idade = $this->getIdade();
        $this->temIdadeMinima = ($idade >= 11);
    }

    public function enviaCarta() {
        
        $nome = $this->getNome();

        if($this->temIdadeMinima) {
            $this->mensagem =  
            ' Prezado Sr./Sra.'  . $nome . '
            Temos o prazer de informá-lo que foi aceito na Escola de Magia e Bruxaria de Hogwarts. 
            Estão anexadas a esta carta as informações sobre a lista de materiais 
            necessários para o ano letivo, que começa em 1º de setembro. 
            Aguardamos ansiosamente o seu retorno até 31 de julho. 
            Atenciosamente,
            Diretor de Hogwarts';
        }
    }
 
}

?>