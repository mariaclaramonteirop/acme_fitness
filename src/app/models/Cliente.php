<?php
namespace Maria\AcmeFitness\Models;

use JsonSerializable;
class Cliente implements JsonSerializable{
    private $id;
    private  $nome;
    private  $cpf;
    private $dataDeNascimento;
    
    const TAM_MIN_NOME = 3;
    const TAM_MIN_CPF = 11;
    
    public function __construct($nome, $cpf , $dataDeNascimento){
        
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setDataDeNascimento($dataDeNascimento);
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }
    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): self
    {
        $this->nome = $nome;

        return $this;
    }
    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }
    public function getDataDeNascimento()
    {
        return $this->dataDeNascimento;
    }
    public function setDataDeNascimento($dataDeNascimento): self
    {
        $this->dataDeNascimento = $dataDeNascimento;

        return $this;
    }

    public function jsonSerialize():mixed
    {
        return [
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'dataDeNascimento' => $this->dataDeNascimento
        ];
    }
}