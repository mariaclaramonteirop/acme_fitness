<?php
namespace Maria\AcmeFitness\Models;

use JsonSerializable;
class Variacao implements JsonSerializable {
    private $id;
    private $cor;
    private $tamanho;
    private $quantidade;
    private $imagem;
    private $produto;

    public function __construct($cor, $tamanho, $quantidade, $imagem, $produto) {
        $this->cor = $cor;
        $this->tamanho = $tamanho;
        $this->quantidade = $quantidade;
        $this->imagem = $imagem;
        $this->produto = $produto;
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

    public function getCor()
    {
        return $this->cor;
    }

    public function setCor($cor): self
    {
        $this->cor = $cor;

        return $this;
    }

    public function getTamanho()
    {
        return $this->tamanho;
    }

    public function setTamanho($tamanho): self
    {
        $this->tamanho = $tamanho;

        return $this;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade): self
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    public function getImagem()
    {
        return $this->imagem;
    }

    public function setImagem($imagem): self
    {
        $this->imagem = $imagem;

        return $this;
    }

    public function getProduto()
    {
        return $this->produto;
    }

    public function setProduto($produto): self
    {
        $this->produto = $produto;

        return $this;
    }

    public function jsonSerialize(): mixed {
        return [
            'cor' => $this->cor,
            'tamanho' => $this->tamanho,
            'quantidade' => $this->quantidade,
            'imagem' => $this->imagem,
            'produto' => $this->produto
        ];
    }
}