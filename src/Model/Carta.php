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
        } else {
            $this->mensagem = 
            ' Prezado Sr./Sra.'  . $nome . '
            Lamentamos informar que você não atende aos requisitos de idade mínima para ser aceito na Escola de Magia e Bruxaria de Hogwarts. 
            Agradecemos o seu interesse e esperamos que você possa se inscrever novamente no futuro. 
            Atenciosamente,
            Diretor de Hogwarts';
        }
    }
 
}

?>