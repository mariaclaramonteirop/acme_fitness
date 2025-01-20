<?php
namespace App\models;

use JsonSerializable;
class Cliente implements JsonSerializable{
    private $id;
    private  $nome;
    private  $cpf;
    private $dataDeNascimento;
    
    const TAM_MIN_NOME = 3;
    const TAM_MIN_CPF = 11;
    
    public function __construct(Cliente $cliente){
        $this-setNome($nome);
        $this-setCpf($cpf);
        $this-setDataDeNascimento($dataDeNascimento);
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

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'dataDeNascimento' => $this->dataDeNascimento
        ];
    }
}