@extends('layouts.app')

@section('content')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Gerar relatório</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total de clientes cadastrados ({{date('m/Y')}})</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$dados['total_cliente']}} </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Doações recebidas até ({{date('d/m/Y')}})</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Content Row -->

  <div class="row">

    @if (session('status'))
    <div class="col-sm-12">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Cliente</strong> {{session('status')}}!.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
    @endif


    <!-- Pie Chart -->
    <div class="col-xl-12 col-lg-5">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Dados</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">

          <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>CPF</th>
                      <th>Idade</th>
                      <th>Ações</th>
                      
                    </tr>
                  </thead>

                  <tbody>
                    @foreach ($dados['dados_clientes'] as $dados)

                    <tr>
                      <td>{{$dados->nome}}</td>
                      <td>{{$dados->email}}</td>
                      <td>{{$dados->cpf}}</td>
                      <td>
                        @php
                              $data = date('d/m/Y', strtotime($dados->data_nascimento));
                              list($dia, $mes, $ano) = explode('/', $data);
                              $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                              $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
                              $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
                              echo $idade;
                        @endphp
                      </td>
                      <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_client" onclick="ObterDadosClientes( {{$dados->id_cliente}})"><i class="far fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm" onclick="apagarCliente( {{$dados->id_cliente}} )"><i class="far fa-trash-alt"></i></button>
                      </td>
                    </tr>

                    @endforeach
                  </tbody>
                </table>
              </div>
        </div>
      </div>
    </div>
  </div>


  


  <script>
    function apagarCliente(id)
    {
        swal({
        title: "Tem certeza?",
        text: "Se clicar em ok o cliente sera excluido do sistema!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {

          $.ajax({
            method:'GET',
            data:'id='+id,
            url: '/deletecliente',
            success:function(r){

              if(r == 1){
                swal("Cliente apagado com sucesso!", {
                 icon: "success",
                });
                 window.location.href='';
              }else{
                swal("Ops houve um erro ao apagar o cliente!", {
                 icon: "warning",
                });
                 window.location.href='';

              }

              
            }
          });
        } else {
          swal("OK! nada foi apagado");
        }
      });
    }
  </script>



<script>
  function ObterDadosClientes(id){
    $.ajax({
				method:"GET",
				data:"id=" + id,
				url:"/getclientes",
				success:function(r){
         
					dado=jQuery.parseJSON(r);
					$('#id_clienteU').val(dado['id_cliente']);
					$('#nomeU').val(dado['nome']);
					$('#emailU').val(dado['email']);
					$('#cpfU').val(dado['cpf']);
					$('#telefoneU').val(dado['telefone']);
					$('#telefone_doisU').val(dado['telefone_dois']);
					$('#data_nascimentoU').val(dado['data_nascimento']);
					$('#data_cadastroU').val(dado['data_cadastro']);
					$('#intervalo_doacaoU').val(dado['intervalo_doacao']);
					$('#valor_doacaoU').val(dado['valor_doacao']);
					$('#id_forma_pgU').val(dado['id_forma_pg']);
					$('#cepU').val(dado['cep']);
					$('#ruaU').val(dado['rua']);
					$('#numeroU').val(dado['numero']);
					$('#complementoU').val(dado['complemento']);
					
				}
			});
  }
</script>


  <!-- Modal novo cliente -->
  <div class="modal fade" id="edit_client" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/editliente" method="POST" id="editliente">
                @csrf
                <div class="row">
                    <div class="col-sm">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control" name="nomeU"  id="nomeU" placeholder="digite o nome do cliente ...">
                    </div>

                    <div class="col-sm">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="emailU" id="emailU" placeholder="Digite seu email..">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm">
                        <label for="cpf">CPF:</label>
                        <input type="text" class="form-control" name="cpfU" id="cpfU" placeholder="Digite seu CPF...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm">
                        <label for="telefone1">Telefone:</label>
                        <input type="text" class="form-control" name="telefoneU" id="telefoneU" placeholder="Digite o numero de telefone...">
                    </div>

                    <div class="col-sm">
                        <label for="telefone2">Telefone de contato 2:</label>
                        <input type="text" class="form-control" name="telefone_doisU" id="telefone_doisU" placeholder="Digite o numero de telefone...">
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm">
                        <label for="">Data de nascimento</label>
                        <input type="date" name="data_nascimentoU"  id="data_nascimentoU" class="form-control">
                    </div>

                    <div class="col-sm">
                        <label for="">Data de cadastro</label>
                        <input type="date" name="data_cadastroU" id="data_cadastroU" class="form-control"  readonly>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <label for="">Intervalo para doação</label>
                        <select name="intervalo_doacaoU" id="intervalo_doacaoU" class="form-control">
                            <option value="Unico">Unico</option>
                            <option value="Bimestral">Bimestral</option>
                            <option value="Semestral">Semestral</option>
                            <option value="Anual">Anual</option>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label for="">Valor da doação</label>
                        <input type="text" name="valor_doacaoU" id="valor_doacaoU" class="form-control">
                    </div>

                    
                    <div class="col-sm-4">
                        <label for="">Formas de Pagamento</label>
                        <select name="forma_pagamentoU" id="forma_pagamentoU" class="form-control" id="">
                            <option value="">1</option>
                        </select>
                    </div>
             
                </div>

                <div class="row">
                  <div class="col-sm">
                      <label for="">CEP</label>
                      <input type="text" name="cepU" id="cepU" maxlength="12" class="form-control">
                  </div>

                  <div class="col-sm">
                      <label for="">Rua</label>
                      <input type="text" name="ruaU" id="ruaU" maxlength="12" class="form-control">
                  </div>

                  <div class="col-sm">
                      <label for="">Nº</label>
                      <input type="text" name="numeroU" id="numeroU" maxlength="12" class="form-control">
                  </div>
              </div>

              <div class="row">
                <div class="col-sm">
                  <label for="">Complemento</label>
                  <input type="text" name="complementoU" id="complementoU" class="form-control">
                </div>
              </div>

              <input type="hidden" name="id_clienteU" id="id_clienteU">

            </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <button type="button" onclick="validaFormClientesEdit()" class="btn btn-success">salvar</button>
        </div>

      </div>
    </div>
  </div>


  <script>
    function validaFormClientesEdit(){

      $('#editliente').submit();
    }

  </script>

    
@endsection 