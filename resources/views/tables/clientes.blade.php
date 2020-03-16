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
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>
            <button class="btn btn-info btn-sm"><i class="far fa-eye"></i></button>
            <button class="btn btn-warning btn-sm"><i class="far fa-edit"></i></button>
            <button class="btn btn-danger btn-sm" onclick="apagarCliente(  )"><i class="far fa-trash-alt"></i></button>
          </td>
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>