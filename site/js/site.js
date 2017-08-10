// funcões
function abrirWidget(widget){
	var classe = "aberto"; 

	var widget_elemento = widget.parent();

	if(widget_elemento.hasClass(classe)){
		widget_elemento.removeClass(classe);
	}else{
		$(".widget").removeClass(classe);
		widget_elemento.addClass(classe);
	}
}

function elementoVisivel(elemento){
    if (typeof jQuery === "function" && elemento instanceof jQuery) {
        elemento = elemento[0];
    }
    var area_visivel_do_elemento = elemento.getBoundingClientRect();
    return (
        area_visivel_do_elemento.top >= 0 &&
        area_visivel_do_elemento.left >= 0 &&
        area_visivel_do_elemento.bottom <= (window.innerHeight || document.documentElement.clientHeight) && /*or $(window).height() */
        area_visivel_do_elemento.right <= (window.innerWidth || document.documentElement.clientWidth) /*or $(window).width() */
    );
}

function googleReady(elemento){
    elemento.removeClass('google-maps');
    elemento.attr("placeholder", "");
}
autocompletes = new Array();
function setupAutocomplete(elemento, id, funcao){
    var opt = {
        types: ['(cities)'],
        componentRestrictions: {country: "br"}
    };

    autocompletes[id] = new google.maps.places.Autocomplete(elemento[0], opt);

    google.maps.event.addListener(autocompletes[id], 'place_changed', function(){
        var dados_localidade = autocompletes[id].getPlace();
        global_lat = dados_localidade.geometry.location.lat();
        global_lng = dados_localidade.geometry.location.lng();
        elemento.change();
    });
}
$(document).ready(function(){
    $(".google-maps").each(function(index, elemento) {
        setupAutocomplete($(elemento), $(elemento).attr("id"));
        googleReady($(elemento));
    });
})
$(document).on("focus", ".google-maps", function(e){
    setupAutocomplete($(this), $(this).attr("id"));
    googleReady($(this));
});

function googlemaps(){
}


function addCotacao(id){
    atual_cotacoes = $("#cont_cotacoes").text();
    $("#cont_cotacoes").html("<i class='fa fa-spinner fa-pulse'></i>");
    $.ajax({
        url: root_url+'/processador.php?add_cotacao',
        type: 'POST',
        data: {
            id_aeronave: id
        },
    }).done(function(data){
        if(data == "ok"){
            
            atual_cotacoes = parseInt(atual_cotacoes) + 1;
            $("#cont_cotacoes").text(atual_cotacoes);
            alert("Cotacao adicionada com sucesso.");
        }else{
            alert(data);
            $("#cont_cotacoes").text(atual_cotacoes);
        }
    });
}

function carregaDropdown(token){
    $(".loading-cotacoes").show();
    $.ajax({
        url: root_url+'/processador.php?dropdown_cotacoes',
        type: 'GET'
    }).done(function(data){
        $("#loadcotacoes").html(data);
        $("#cont_cotacoes").text($(".submenu-cotacao").length);
        $(".loading-cotacoes").hide();
    });
}

function removerCotacao(id){
    atual_cotacoes = $("#cont_cotacoes").text();
    $("#cont_cotacoes").html("<i class='fa fa-spinner fa-pulse'></i>");
    $.ajax({
        url: root_url+'/processador.php?remove_cotacao',
        type: 'POST',
        data: {
            id_cotacao: id
        },
    }).done(function(data){
        if(data == "ok"){
            
            atual_cotacoes = parseInt(atual_cotacoes) - 1;
            $("#cont_cotacoes").text(atual_cotacoes);
            alert("Cotacao removida com sucesso.");
            $("#cotacao-id-"+id).slideUp(100);
            $("#cotacao-id-"+id).remove();
        }else{
            alert(data);
            $("#cont_cotacoes").text(atual_cotacoes);
        }
    });
}

// abrir submenu dropdown (cotacoes/login)
$("a[data-abrir-submenu]").click(function(e){
    carregaDropdown(token_cotacao);
    if($(this).hasClass('ativo')){
        $(".menu-conta li a").removeClass('ativo');
        $(this).removeClass('ativo');
        $(".submenu").hide();
    }else{
        $(".menu-conta li a").removeClass('ativo');
        $(this).addClass('ativo');
        $(".submenu").hide();
        $("#"+$(this).data("abrir-submenu")).show();
    }
    e.preventDefault();
    e.stopPropagation();
});
// ao clicar no site o submenu fecha
$(document).click(function(e){
    $(".menu-conta li a").removeClass('ativo');
    $(".submenu").hide();
});
// impede que o submenu feche ao clicar nele mesmo
$(".submenu").click(function(e){
    e.stopPropagation();
});


// abas do menu da cotação (informacoes tecnicas/visao geral)
$(".menu-abas li a").each(function(i, e){
    if(!$(e).hasClass('ativo')){
        $("#"+$(e).data("abrir")).hide();
    }
});
$(".menu-abas li a").click(function(e){
    $(".menu-abas li a").removeClass('ativo');
    $(this).addClass('ativo');
    $(".menu-aba").hide();
    $("#"+$(this).data("abrir")).show();
    e.preventDefault();
});


//abrir tela de fazer cotacao com informacoes da aeronave (pega dados da aeronave e joga pra tela de cotacao)
$(document).on("click", ".abrir-pagina-cotacao", function(e){
    e.preventDefault();
    var open = window.open($(this).attr("href"));
    $(this).parent().parent().parent().parent().addClass('visualizado');
    
});

function voltarbusca(){
    window.top.close();
}

//fecha tela
// $(".fazer-cotacao .voltar").click(function(e){
//     $("body").removeClass('na_cotacao');
//     $("#cotacao-wrapper").hide();
//     e.preventDefault();
// });


$('input[type=range]').on('input', function () {
    $(this).trigger('change');
});
$("#range-valor").change(function(e){
    $("#preco-maximo").val($(this).val());
});


function abrirModal(id){
    $(id).fadeIn(100);
}

$(".fechar_modal").click(function(){
    $(".modal").fadeOut(100);
});

$(document).keyup(function(e){
    if(e.keyCode == 27){
        $(".modal").fadeOut(100);
    }
});

$(".modal").click(function(){
    $(".modal").fadeOut(100);
});

$(".modal_corpo_login").click(function(e){
    e.stopPropagation();
});

$(".cadastro-tabs ul li a").click(function(e){
    e.preventDefault();
    var id = $(this).attr("href");

    $(".cadastro-tabs ul li a").removeClass('ativo');
    $(this).addClass('ativo');
    $(".cadastro-form form").removeClass('ativo');
    $(id).addClass('ativo');
});

// $("select").change(function(e){
//     valor = $(this).val();
//     $(this).find('option[selected]').removeAttr('selected');
//     $(this).find('option[value='+valor+']').attr("selected", "");
// });

// $(".outras-linhas-campos select").change(function(e){
//     options = $(this).find('option');

//     $(".outras-linhas-campos select").html(options);
// });

var countinput = 0;
$('.outras-linhas-campos').on('click', '.add-cidade', function(e){
    e.preventDefault();
  
  $(this).remove();
  
  btn_adicionar = $("<button><i class='fa fa-plus'></i></button>").addClass("add-cidade").addClass('menor');
  btn_remover = $("<button><i class='fa fa-minus'></i></button>").addClass("remover-cidade").addClass('menor');
  clone = $(".linha-campos").last().clone();
  clone.find(".remover-cidade").remove();
  countinput++;

  clone.find('input').each(function(i, e){
    if($(e).attr("name") == "origem[]"){
        $(e).addClass('origens');
    }
    if($(e).attr("name") == "destino[]"){
        $(e).addClass('destinos');
    }



        if($(e).attr("name") == "data_volta[]"){
            $(this).val();
        }else if($(e).attr("name") == "hora_volta[]"){
            $(this).val();
        }else if($(e).attr("name") == "passageiros[]"){
            $(this).val();
        }else{
            $(e).val("");      
        }
  });


  select = $(".linha-campos").first().find('select option').clone();

  clone.find("select").attr("disabled", "");

  
  btn_remover.appendTo(clone);
  btn_adicionar.appendTo(clone);
  $(clone).appendTo(".outras-linhas-campos"); 
});

$('.outras-linhas-campos').on('click', '.remover-cidade', function(e){
    if($(".linha-campos").length == 2){
        $(this).parent().remove();
        e.preventDefault();
        btn_adicionar = $("<button>Adicionar</button>").addClass("add-cidade").addClass('maior');
        btn_adicionar.appendTo($(".linha-campos").first());
  }else{
    $(this).parent().remove();
    e.preventDefault();
  }
});

$("#form-login").submit(function(e){
    e.preventDefault();
    $(".loading").fadeIn(50);

    dados = $(this).serialize();

    $.ajax({
        url: root_url+'/processador.php?login',
        type: 'POST',
        data: dados
    }).done(function(data){
        if(data == "ok"){
            location.href = root_url+"/busca";
        }else{
            alert("Dados Incorretos");
            console.log(data);
        }

        $(".loading").fadeOut(100);
    });
});

// $('.data-input').mask('00/00/0000');
$('.cpf-input').mask('000.000.000-00');
$('.cnpj-input').mask('00.000.000/0000-00');
$('.telefone-input').mask('(00) 00000-0000');
$('.cep-input').mask('00000-000');
$('.ano-input').mask('0000');
$('.autonomia-input').mask('0\.0');
$(".valor-input").maskMoney({showSymbol:true, symbol:"", decimal:",", thousands:".", allowZero:true, precision: 2});
$(".velocidade-input").maskMoney().attr('maxlength', 4);
$(".peso-input").maskMoney().attr('maxlength', 4);
// $(".")
$('#aeronave_prefixo').mask('AA-AAAA');
$("#aeronave_prefixo").keyup(function(){
    $(this).val($(this).val().toUpperCase());
});

$(document).on("focus", ".hora_ida", function(e){
    $('.hora_ida').mask('00:00');
});

$(document).on("focus", ".hora_volta", function(e){
    $('.hora_volta').mask('00:00');
});

$(document).on("focus", ".data-input", function(e){
    $(this).removeClass('hasDatepicker');
    $(this).datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
    });
});

$("#formulario-de-busca").submit(function(e){
    campo_faltando = false;

    //$(this).find("[name]").each(function(index, el) {
    $(this).find(".obrigatorio").each(function(index, el) {
        if($(el).val() == "" && $(el).attr("name") !== undefined){
            console.log($(el).attr("name"));
            campo_faltando = true;
        }
    });

    if(campo_faltando == true){
        alert("Preencha todos os campos para continuar.");
        e.preventDefault();
    }
});

$(".modal-mapa").click(function(e){
    $(this).fadeOut(100);
});
$(".corpo-mapa").click(function(e){
    e.stopPropagation();
});

$("[data-token]").click(function(){
    var token = $(this).data("token");

    $.ajax({
        url: root_url+'/processador.php?info_token',
        type: 'POST',
        data: {token: token},
    })
    .done(function(data) {
        $("#info_token .widget_body").html(data);
        $("#info_token .widget_title").html("Visualizando: "+token);
    });
    
});

$(document).on("click", ".info_cotacao,.ver-detalhe-cotacao", function(){
    $(".detalhe_cotacao").slideUp(100);
    $(this).find(".detalhe_cotacao").slideDown(100);
});


$(document).on("click", "[data-status-dados]", function(){
    var status = $(this).data("status-dados");
    var id_cotacao = $(this).data("id-cotacao");


    $.ajax({
        url: root_url+'/processador.php?muda_statusCotacao',
        type: 'POST',
        data: {
            status: status,
            id_cotacao: id_cotacao
        },
    })
    .done(function(data) {
        if(data == "ok"){
            alert("Status Atualizado com sucesso!");
        }else{
            alert(data);
        }
    });
    
});


$("#add_mensagem").submit(function(e){
    $(".loading").fadeIn(100);
    e.preventDefault();
    tinymce.triggerSave();

    dados = "none=none";
    $(this).find("[name]").each(function(i, elemento){
        nome_input = $(elemento).attr("name");
        valor_input = escape($(elemento).val());

        dados += "&"+nome_input+"="+valor_input;

    }); 

    // var dados = new FormData(this);
    // var dados = $(this).serialize();
    $.ajax({
        url: root_url+'/processador.php?add_mensagem',
        type: 'POST',
        data: dados,
        // processData: false,
        // contentType: false

    }).done(function(data) {

        if(data == "ok"){
            $(".sucesso").html("Mensagem adicionada com sucesso!");
            $(".sucesso").show();
            $("#add_mensagem")[0].reset();
            window.location.reload(true);
        }else{
            $(".erro").html("Ocorreu um erro ao criar mensagem. "+data);
            $(".erro").show();
        }

        $('html, body').animate({ scrollTop: 0 }, 200);
        $(".loading").fadeOut(100);
    }); 


});