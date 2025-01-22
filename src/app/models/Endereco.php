<?php

namespace Maria\AcmeFitness\Models;

use JsonSerializable;
class Endereco implements JsonSerializable{
    private $id;
    private $logradouro;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $cep;
    private $complemento;
    private $cliente;

    const TAM_MAX_LOGRADOURO = 100;
    const TAM_MAX_BAIRRO = 50;
    const TAM_MAX_CIDADE = 50;
    const TAM_MAX_ESTADO = 2;
    const TAM_MAX_CEP = 8;
    const TAM_MAX_COMPLEMENTO = 100;
    public function __construct(Cliente $cliente, $logradouro, $numero, $bairro, $cidade, $estado, $cep, $complemento = "") {

        $this->setLogradouro($logradouro);
        $this->setNumero($numero);
        $this->setBairro($bairro);
        $this->setCidade($cidade);
        $this->setEstado($estado);
        $this->setCep($cep);
        $this->setComplemento($complemento);
        $this->setCliente($cliente);
    }
    
    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente(Cliente $valor): self
    {
        $this->cliente = $valor;

        return $this;
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

    public function getLogradouro()
    {
        return $this->logradouro;
    }

    public function setLogradouro($logradouro): self
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setBairro($bairro): self
    {
        $this->bairro = $bairro;

        return $this;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setCidade($cidade): self
    {
        $this->cidade = $cidade;

        return $this;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setCep($cep): self
    {
        $this->cep = $cep;

        return $this;
    }

    public function getComplemento()
    {
        return $this->complemento;
    }

    public function setComplemento($complemento): self
    {
        $this->complemento = $complemento;

        return $this;
    }
    
    public function jsonSerialize():mixed {
        return [
            'id' => $this->id,
            'logradouro' => $this->logradouro,
            'numero' => $this->numero,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'cep' => $this->cep,
            'complemento' => $this->complemento,
            'cliente' => $this->cliente
        ];
    }
}