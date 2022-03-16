
jQuery.validator.addMethod("cnpj", function (value, element) {

	var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
	if (value.length == 0) {
		return false;
	}

	value = value.replace(/\D+/g, '');
	digitos_iguais = 1;

	for (i = 0; i < value.length - 1; i++)
		if (value.charAt(i) != value.charAt(i + 1)) {
			digitos_iguais = 0;
			break;
		}
	if (digitos_iguais)
		return false;

	tamanho = value.length - 2;
	numeros = value.substring(0, tamanho);
	digitos = value.substring(tamanho);
	soma = 0;
	pos = tamanho - 7;
	for (i = tamanho; i >= 1; i--) {
		soma += numeros.charAt(tamanho - i) * pos--;
		if (pos < 2)
			pos = 9;
	}
	resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
	if (resultado != digitos.charAt(0)) {
		return false;
	}
	tamanho = tamanho + 1;
	numeros = value.substring(0, tamanho);
	soma = 0;
	pos = tamanho - 7;
	for (i = tamanho; i >= 1; i--) {
		soma += numeros.charAt(tamanho - i) * pos--;
		if (pos < 2)
			pos = 9;
	}

	resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;

	return (resultado == digitos.charAt(1));
})

jQuery.validator.addMethod("cpf", function (value, element) {
	value = jQuery.trim(value);

	value = value.replace('.', '');
	value = value.replace('.', '');
	cpf = value.replace('-', '');
	while (cpf.length < 11) cpf = "0" + cpf;
	var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
	var a = [];
	var b = new Number;
	var c = 11;
	for (i = 0; i < 11; i++) {
		a[i] = cpf.charAt(i);
		if (i < 9) b += (a[i] * --c);
	}
	if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11 - x }
	b = 0;
	c = 11;
	for (y = 0; y < 10; y++) b += (a[y] * c--);
	if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11 - x; }
	if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) return false;
	return true;
}, "Informe um CPF válido."); 




// FUNÇÃO PARA ADICIONAR CLASSE
// função para adicionar nova classe a objetos
// exemplo para adicionar a classe cpf que tem a mascara do cpf
// no final do formulário basta colocar
// <script>  addclass('cpf','cpf'); </script>
// onde id é o id do campo e new class é a nova classe a ser adicionada neste caso cpfmask que coloca mascara no cpf
function addclass(id,newclass){
  var element = document.getElementById(id);
  var addclass = newclass;
  element.classList.add(addclass);
}



// FUNÇÃO PARA COLOCAR TUDO EM MAIÚSCULO
// onkeydown="upperCaseF(this)" 
function upperCaseF(a){
  setTimeout(function(){
      a.value = a.value.toUpperCase();
  }, 1);
}


//FUNÇÃO PARA PERMITIR APENAS NÚMEROS
//PARA USAR BASTA COLOCAR O CAMPO COMO CLASSE onlynumbers
//E PARA EXIBIR A MENSAGEM COLOCAR UM <span id="errmsg"></span>
//USE TAMBÉM O TIPO NUMBER NO INPUT type="number" 
$(document).ready(function () {
	//called when key is pressed in textbox
	$(".onlynumbers").keypress(function (e) {
	   //if the letter is not digit then display error and don't type anything
	   if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		  //display error message
		  alert("Ops! Apenas números são permitidos.");
				 return false;
	  }
	 });
  });




//mascaras para os formulários todas se aplicam a classe
// no caso de aplicar mascara a telefone é só 
//fazer <input type="tel" class="telefone"
//vai aplicar somente depois de carregar o documento 
//por isso esta dentro da (document).ready()
//tem que colocar o footer que está neste projeto para lincar com maskedinput.min.js
$(document).ready(function() {
	$('.cpf').mask('000.000.000-00', {reverse: true});
	$(".telefone").mask("(00) 00000-0009");
	});
//********************fim mascaras**************** */
