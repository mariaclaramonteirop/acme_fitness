<?php

class Pedido{
    private $id;
    private $cliente; 
    private $endereco; 
	private $itensPedido = [];
    private $valorFrete = 10.00;
    private $desconto = 0;
    private $formaPagamento;
    private $dataPedido;

    public function __construct($id, $cliente, $endereco, $formaPagamento, $dataPedido) {
        $this->id = $id;
        $this->cliente = $cliente;
        $this->endereco = $endereco;
        $this->formaPagamento = $formaPagamento;
        $this->dataPedido = $dataPedido;
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

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente($cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }


    public function getValorFrete()
    {
        return $this->valorFrete;
    }

    public function setValorFrete($valorFrete): self
    {
        $this->valorFrete = $valorFrete;

        return $this;
    }

    public function getDesconto()
    {
        return $this->desconto;
    }
    
    public function setDesconto($desconto): self
    {
        $this->desconto = $desconto;

        return $this;
    }
    
    public function getFormaPagamento()
    {
        return $this->formaPagamento;
    }

    public function setFormaPagamento($formaPagamento): self
    {
        $formasPagamentoValidas = ['pix', 'cartao', 'boleto'];
        $formaPagamento = strtolower($formaPagamento);

        if (in_array($formaPagamento, $formasPagamentoValidas)) {
            $this->formaPagamento = $formaPagamento;

            // Aplica o desconto fixo de 10% para pagamentos via PIX
            $this->desconto = ($formaPagamento === 'pix') ? 0.10 : 0.0;
        } else {
            throw new InvalidArgumentException("Forma de pagamento inválida.");
        }

        return $this;
    }

    public function getDataPedido()
    {
        return $this->dataPedido;
    }

    public function setDataPedido($dataPedido): self
    {
        $this->dataPedido = $dataPedido;

        return $this;
    }

	public function getItensPedido()
	{
		return $this->itensPedido;
	}

	public function setItensPedido($itensPedido): self
	{
		$this->itensPedido = $itensPedido;

		return $this;
	}
}