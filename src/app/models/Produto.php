<?php
namespace Maria\AcmeFitness\Models;
use JsonSerializable;
class Produto implements JsonSerializable {
    
    private $id;
    private $codigo;
    private $nome;
    private $descricao;
    private $preco;
    private $peso;
    private $dataCadastro;
    private $categoria;

    public function __construct($codigo, $nome, $descricao, $preco, $peso, $dataCadastro, Categoria $categoria) {
        $this->setCodigo($codigo);
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setPreco($preco);
        $this->setPeso($peso);
        $this->setDataCadastro($dataCadastro);
        $this->setCategoria($categoria);
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

    
    public function getCodigo()
    {
        return $this->codigo;
    }

    
    public function setCodigo($codigo): self
    {
        $this->codigo = $codigo;

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

    
    public function getPreco()
    {
        return $this->preco;
    }

    
    public function setPreco($preco): self
    {
        $this->preco = $preco;

        return $this;
    }

    
    public function getPeso()
    {
        return $this->peso;
    }

    
    public function setPeso($peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    
    public function setDataCadastro($dataCadastro): self
    {
        $this->dataCadastro = $dataCadastro;

        return $this;
    }

    
    public function getCategoria()
    {
        return $this->categoria;
    }

    
    public function setCategoria($categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }   

    public function jsonSerialize():mixed {
        return [
            'codigo' => $this->codigo,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'preco' => $this->preco,
            'peso' => $this->peso,
            'dataCadastro' => $this->dataCadastro,
            'categoria' => $this->categoria
        ];
    }
}