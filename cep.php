<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Webservice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Adicionando Javascript -->
    <script type="text/javascript" >
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
            document.getElementById('ibge').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
            document.getElementById('ibge').value=(conteudo.ibge);
        }
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisalocal(str) {

    if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
    } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {

        document.getElementById("txtHint").value = this.responseText;

      }};

    xmlhttp.open("GET","selectcep.php?q="+str,true);
    xmlhttp.send();}

    setTimeout(() => {  
        var myInnerHtmlv = document.getElementById("txtHint").value;
        if(myInnerHtmlv != ""){window.location.replace('https://viacep.com.br/ws/'+ str + '/xml/');}
        if(myInnerHtmlv == ""){
            
        //Nova variável "cep" somente com dígitos.
        var cep = str.replace(/\D/g, '');

//Verifica se campo cep possui valor informado.
if (cep != "") {

    //Expressão regular para validar o CEP.
    var validacep = /^[0-9]{8}$/;

    //Valida o formato do CEP.
    if(validacep.test(cep)) {

        //Preenche os campos com "..." enquanto consulta webservice.
        //document.getElementById('rua').value="...";
        document.getElementById('bairro').value="...";
        document.getElementById('cidade').value="...";
        document.getElementById('uf').value="...";
        document.getElementById('ibge').value="...";

        //Cria um elemento javascript.
        var script = document.createElement('script');

        //Sincroniza com o callback.
        script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
        //script.src = 'https://viacep.com.br/ws/'+ cep + '/xml/';

        //window.location.replace('https://viacep.com.br/ws/'+ cep + '/xml/');

        //Insere script no documento e carrega o conteúdo.
        document.body.appendChild(script);

        setTimeout(() => {  
        var xhttp = new XMLHttpRequest();
        var clog = document.getElementById("rua").value;
        var cbai = document.getElementById("bairro").value;
        var ccid = document.getElementById("cidade").value;
        var cuf = document.getElementById("uf").value;
        var cibg = document.getElementById("ibge").value;

        xhttp.open("GET", "insertcep.php?rcep=" + cep + "&rlogradouro=" + clog + "&rbairro=" + cbai + "&rcidade=" + ccid + "&restado=" + cuf + "&ribge=" + cibg + "", true);
        xhttp.send();
            }, 2000);

            setTimeout(() => {  
                window.location.replace('https://viacep.com.br/ws/'+ cep + '/xml/');
            }, 2000);
        
    }
    else {
        //cep é inválido.
        limpa_formulário_cep();
        alert("Formato de CEP inválido.");
    }
}
else {
    //cep sem valor, limpa formulário.
    limpa_formulário_cep();
}
        
    }}, 2000);}

    </script>
    </head>

    <body>
    <!-- Inicio do formulario -->
      <form method="get" action=".">
        <label>Cep:
        <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" onblur="pesquisalocal(this.value);" /></label><br />
        <label>Rua:
        <input name="rua" type="text" id="rua" size="60" /></label><br />
        <label>Bairro:
        <input name="bairro" type="text" id="bairro" size="40" /></label><br />
        <label>Cidade:
        <input name="cidade" type="text" id="cidade" size="40" /></label><br />
        <label>Estado:
        <input name="uf" type="text" id="uf" size="2" /></label><br />
        <label>IBGE:
        <input name="ibge" type="text" id="ibge" size="8" /></label><br />
      </form>

      <input name="txtHint" type="text" id="txtHint" size="60" />
      
    </body>

    </html>