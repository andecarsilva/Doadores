<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Clientes</title>
	<head>
	<body>
        @php
		$arquivo = 'Clientes.xls';
		
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="5">Planilha Clientes</tr>';
		$html .= '</tr>';
		
		
		$html .= '<tr>';
		$html .= '<td><b>Nome</b></td>';
		$html .= '<td><b>Email</b></td>';
		$html .= '<td><b>CPF</b></td>';
		$html .= '<td><b>Telefone</b></td>';
		$html .= '<td><b>Telefone_dois</b></td>';
		$html .= '<td><b>Data Nascimento</b></td>';
		$html .= '<td><b>Data de Cadastro</b></td>';
		$html .= '<td><b>Intervalo para doações</b></td>';
		$html .= '<td><b>Valor de Doações</b></td>';
		$html .= '<td><b>id forma de pagamento</b></td>';
		$html .= '<td><b>CEP</b></td>';
		$html .= '<td><b>Rua</b></td>';
		$html .= '<td><b>Nº</td>';
		$html .= '<td><b>Complemento</b></td>';
        $html .= '</tr>';

        $clientes = App\Clientes::all();
        
        foreach ($clientes as $key => $dados) {
            $html .= '<tr>';
			$html .= '<td>'.$dados->nome.'</td>';
			$html .= '<td>'.$dados->email.'</td>';
			$html .= '<td>'.$dados->cpf.'</td>';
            $html .= '<td>'.$dados->telefone.'</td>';
            $html .= '<td>'.$dados->telefone_dois.'</td>';
			$html .= '<td>'.$dados->data_nascimento.'</td>';
			$html .= '<td>'.$dados->data_cadastro.'</td>';
            $html .= '<td>'.$dados->intervalo_doacao.'</td>';
            $html .= '<td>'.$dados->valor_doacao.'</td>';
            $html .= '<td>'.$dados->id_forma_pg.'</td>';
			$html .= '<td>'.$dados->cep.'</td>';
			$html .= '<td>'.$dados->rua.'</td>';
			$html .= '<td>'.$dados->numero.'</td>';
			$html .= '<td>'.$dados->complemento.'</td>';
			$html .= '</tr>';
        }
		
	
		// Configurações header para forçar o download
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generated Data" );
		// Envia o conteúdo do arquivo
		echo $html;
		exit;
        @endphp
	</body>
</html>