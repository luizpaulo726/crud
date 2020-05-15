$("#form_produtos").validate({
    rules:{
      nome:              {required:true},
      preco:             {required:true},
      descricao_produto: {required:true},
      categoria:         {required:true}       
    },
    messages: {
      nome: {required: 'Informe o Nome!'},
      preco: {required: 'Informe o preço!'},
      descricao_produto: {required: 'Informe a descrição!'},
      categoria: {required: 'Selecione pelo menos uma categoria!'}
    },    
    highlight: function (element) {
      $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    unhighlight: function (element) {
      $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function (error, element) {
      if (element.parent('.input-group').length) {
        error.insertAfter(element.parent());
      }
      else {
        error.insertAfter(element);
      }
    },
    submitHandler: function(e) {
  
      var form_produto = new FormData($("#form_produtos")[0]);
      console.log(form_produto);

      $.ajax({
        url:"http://localhost/teste/loja/produto/salvar",
        type: "POST",
        data: form_produto,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {

          console.log(response);
     
          if(response == 'success') {
            $("#form_produtos")[0].reset();
            $("#categoria option[value]").remove();
            $("#sucesso_produto").css('display', 'block');  
          }else{
            $("#erro_produto").css('display', 'block');
          }

        },
        error:function () {
          alert("erro");
        }
      });
    },
    errorPlacement : function(error, element) {
      error.insertAfter(element.parent());
    }
  });

  
  //INICIALIZA O SELECT MULTIPLE DO FORM PRODUTOS
$(function() {
  $("select").select2({
    placeholder: "Selecione uma Categoria",
    width: "100%"
  });

  getProdutos();

});


function getCategorias() {

  $.get("http://localhost/teste/loja/produto/getCategorias", function( data ) {

    var retorno = JSON.parse(data);
    var options = "";
    
    for(var i = 0; i < retorno.length; i++) {
      console.log(retorno);
      options += `<option value = '${retorno[i].id}'>${retorno[i].nome}</option>`;
    }
   
    $("#categoria").html(options);
  });

}


function getProdutos() {

  $.ajax({
    url:"http://localhost/teste/loja/produto/IndexJson",
    type: "POST",
    data: $('#form_pesquisa').serialize(),
    success: function (response) {

      console.log(response);

    var produtos = JSON.parse(response);

    var dados = "";

      console.log(produtos.length);

      if(produtos.length == 0) {
        $("#warning_produto").css("display", "block");
        $("#painel_produtos").css("display", "none");
        $("#corpo_produtos").html("");
      }
      else {
        $("#warning_produto").css("display", "none");
        $("#painel_produtos").css("display", "block");

        for(let i = 0;i < produtos.length; i++) {
      
          dados +=
          `<tr>
        <td> ${produtos[i]['produto'].id} </td>
        <td> ${produtos[i]['produto'].nome} </td>
        <td> ${produtos[i]['produto'].descricao} </td>
        <td> ${produtos[i]['produto'].preco} </td>
        <td><a href='produto/visualizar/${produtos[i]['produto'].id}' class='btn btn-info btn-sm'>Visualizar</a>
        <a onclick='adicionarProdutoCarrinho(${produtos[i]['produto'].id})' class='btn btn-success btn-sm'>Adicionar no carrinho</a>
        </td>`;

      }  

      $("#corpo_produtos").html(dados);
      }

    },
    error:function () {
      alert("Erro");
    }
  });
  
}


function adicionarProdutoCarrinho(id_produto) {

  $.ajax({
    url:"http://localhost/teste/loja/carrinho/carrinho",
    type: "POST",
    data: {"id_produto":id_produto},
    success: function (response) {

      if(response == 'success') {
        $("#carrinho_success").css("display", "block");
      }else {
        $("#carrinho_error").css("display", "block");
      }

    },
    error:function () {
      alert("Erro");
    }
  });

}