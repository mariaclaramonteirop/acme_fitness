<?php

namespace App\models;

use JsonSerializable;
class Categoria implements JsonSerializable{
    private $id;

    private $codigo;
    private $nome;
    private $descricao;
    
    const TAM_MIN_NOME = 3;
    const TAM_MIN_DESCRICAO = 5;

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

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'descricao' => $this->descricao
        ];
    }
    

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }
}