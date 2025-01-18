<?php

class Endereco {
    private int $id;
    private string $logradouro;
    private int $numero;
    private string $bairro;
    private string $cidade;
    private string $estado;
    private string $cep;

    private string $complemento;

    const TAM_MAX_LOGRADOURO = 100;
    const TAM_MAX_BAIRRO = 50;
    const TAM_MAX_CIDADE = 50;
    const TAM_MAX_ESTADO = 2;
    const TAM_MAX_CEP = 8;
    const TAM_MAX_COMPLEMENTO = 100;
    public function __construct($id, $logradouro, $numero, $bairro, $cidade, $estado, $cep) {
        $this->id = $id;
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->cep = $cep;
    }

    public function getId() {
        return $this->id;
    }

    public function getLogradouro() {
        return $this->logradouro;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getCep() {
        return $this->cep;
    }

    public function getComplemento(): string
    {
        return $this->complemento;
    }

    public function setComplemento(string $complemento): self
    {
        $this->complemento = $complemento;

        return $this;
    }
}