/**
 * Função para validar o cpf pelo jqueryvalidator é só colocar na classe
 * do input class="cnpj"
 */
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





/**
 * Função para validar o cpf pelo jqueryvalidator é só colocar na classe
 * do input class="cpf"
 */
jQuery.validator.addMethod("cpf", function(value, element) {
  value = jQuery.trim(value);

   value = value.replace('.','');
   value = value.replace('.','');
   cpf = value.replace('-','');
   while(cpf.length < 11) cpf = "0"+ cpf;
   var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
   var a = [];
   var b = new Number;
   var c = 11;
   for (i=0; i<11; i++){
       a[i] = cpf.charAt(i);
       if (i < 9) b += (a[i] * --c);
   }
   if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
   b = 0;
   c = 11;
   for (y=0; y<10; y++) b += (a[y] * c--);
   if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }

   var retorno = true;
   if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;

   return this.optional(element) || retorno;

}, "Informe um CPF válido");

/**
 * 
 * FUNÇÃO PARA ADICIONAR CLASSE
 * função para adicionar nova classe a objetos
 * exemplo para adicionar a classe cpf que tem a mascara do cpf
 * no final do formulário basta colocar
 * <script>  addclass('cpf','cpf'); </script>
 * onde id é o id do campo e new class é a nova classe a ser adicionada neste
 * caso cpfmask que coloca mascara no cpf
 * 
 */
function addclass(id,newclass){
  var element = document.getElementById(id);
  var addclass = newclass;
  element.classList.add(addclass);
}

/**
 * 
 * FUNÇÃO PARA COLOCAR TUDO EM MAIÚSCULO
 * onkeydown="upperCaseF(this)" 
 */
function upperCaseF(a){
  setTimeout(function(){
      a.value = a.value.toUpperCase();
  }, 1);
}

/**
 * 
 * FUNÇÃO PARA PERMITIR APENAS NÚMEROS
 * PARA USAR BASTA COLOCAR O CAMPO COMO CLASSE onlynumbers
 * E PARA EXIBIR A MENSAGEM COLOCAR UM <span id="errmsg"></span>
 * USE TAMBÉM O TIPO NUMBER NO INPUT type="number"
 * 
 * 
 */
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

/**
 * 
 * mascaras para os formulários todas se aplicam a classe
 * no caso de aplicar mascara a telefone é só 
 * fazer <input type="tel" class="telefone"
 * vai aplicar somente depois de carregar o documento
 * por isso esta dentro da (document).ready()
 * tem que colocar o footer que está neste projeto para lincar com maskedinput.min.js
 * 
 */
$(document).ready(function() {
	$('.cpf').mask('000.000.000-00', {reverse: true});
	$(".telefone").mask("(00) 00000-0009");
});

/**
 * 
 * Função para dar o foco em um campo
 * 
 */
 function focofield(field)
 {
	 document.getElementById(field).focus();
 }

/**
 * 
 * Funçõ que retorna true se confirmar e false se não confirmar uma pergunta
 * 
 */
 function question(ask)
{
	return confirm (ask);
}	










/**
 * 
 * 
 * DAQUI PARA BAIXO TEM QUE TESTAR
 * 
 * 
 * 
 */


function CheckForm(id){
	var checked=false;
	var elements = document.getElementsByName(id);
	for(var i=0; i < elements.length; i++){
		if(elements[i].checked) {
			checked = true;
		}
	}
	if (!checked) {
		checked = false;
	}
	return checked;
}

function checkedRadioBtn(sGroupName)
    {   
        var group = document.getElementsByName(sGroupName);

        for ( var i = 0; i < group.length; i++) {
            if (group.item(i).checked) {
                return group.item(i).id;
            } else if (group[0].type !== 'radio') {
                //if you find any in the group not a radio button return null
                return null;
            }
        }
		}
		
	


//função para o botão avançar do formulário
$(document).ready(function () {
	//Initialize tooltips
	$('.nav-tabs > li a[title]').tooltip();
	
	//Wizard
	$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

		var $target = $(e.target);
	
		if ($target.parent().hasClass('disabled')) {
			return false;
		}
	});

	$(".next-step").click(function (e) {

		var $active = $('.nav-tabs li>a.active');
		$active.parent().next().removeClass('disabled');
		nextTab($active);

	});
	$(".prev-step").click(function (e) {

		var $active = $('.nav-tabs li>a.active');
		prevTab($active);

	});
});

function nextTab(elem) {
	$(elem).parent().next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
	$(elem).parent().prev().find('a[data-toggle="tab"]').click();
}


//mostrar o nome do arquivo no file custom - no selecionar arquivo
$('.custom-file input').change(function (e) {
	$(this).next('.custom-file-label').html(e.target.files[0].name);
});



//fileValidation(campo tipo field,id do span para apresentar o erro);"
// onchange="return fileValidation('comprovante_residencia','res_erro');"
function fileValidation(myfiel,span)
{
	var fileInput = document.getElementById(myfiel);
	var filePath = fileInput.value;
	var errorspan = span;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.pdf)$/i;
    if(!allowedExtensions.exec(filePath)){				
		document.getElementById(errorspan).textContent="Apenas arquivo do tipo JPEG, PNG ou PDF são permitidos!";
		fileInput.value = '';			
        return false;
    }else{
		document.getElementById(errorspan).textContent="";
        return true;
    }
}


//função jquery para esconder paginação quando é muito grande coloca ... para esconder
// ul tem que ser classe pagination <ul class="pagination">
$(document).ready(function() {
	// I'ts ugly but works
	$('.pagination').each(function(){
		var allLi = $(this).find('li');
		if(allLi.length > 20) {
		var activeId = allLi.filter('.active').index();
		allLi.eq(0)
		.add(allLi.eq(1))
		.add(allLi.eq(2))
		.add(allLi.eq(3))
		.add(allLi.eq(4))
		.add(allLi.eq(-1))
		.add(allLi.eq(-2))
		.add(allLi.eq(-3))
		.add(allLi.eq(-4))
		.add(allLi.eq(activeId))
		.add(allLi.eq(activeId-1))
		.add(allLi.eq(activeId-2))
		.add(allLi.eq(activeId-3))
		.add(allLi.eq(activeId+1))
		.add(allLi.eq(activeId+2))
		.add(allLi.eq(activeId+3))
		.addClass('allow');
		var replacedWithDots = false;
		allLi.each(function() {
			if( $(this).hasClass('allow') ) {
			replacedWithDots = false;
			} else if(!replacedWithDots) {
			replacedWithDots = true;
			$(this).html('<a>...</a>');
			} else {
			$(this).remove();
			}
		})
		}
	});	
});