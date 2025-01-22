<?php

namespace Maria\AcmeFitness\Models;

use JsonSerializable;
class Categoria implements JsonSerializable{
    private $id;
    private $nome;
    private $descricao;
    
    const TAM_MIN_NOME = 3;
    const TAM_MIN_DESCRICAO = 5;

    public function __construct($nome, $descricao){
        $this->nome = $nome;
        $this->descricao = $descricao;
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

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function jsonSerialize():mixed
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'descricao' => $this->descricao
        ];
    }
}