var apareceu = false;
pagina = 2;
var sem_resultado = false;


$(document).scroll(function(e){
    if($(".aeronave").length > 0){

        elemento = $(".aeronave").last();
      
        if(elementoVisivel(elemento)){

            if(sem_resultado == false){
                $(".carregando_aeronaves").show();
                if(apareceu == false){
                    carregarAeronaves(cidade, global_lat, global_lng, global_lat_destino, global_lng_destino, pagina, passageiros, ordenar);
                    pagina++;
                    apareceu = true;
                }
            }
        
        }else{
            $(".carregando_aeronaves").hide();
        }
    }
});

$(document).scroll(function(e){

    var scroll = $(window).scrollTop();
    sidebar_position = $(".sidebar").position();
    $(".sidebar-fixed").css("left", sidebar_position.left);
        
    if(scroll > sidebar_position.top-20){
        $(".sidebar-fixed").addClass("fixed");
    }else{
        $(".sidebar-fixed").removeClass("fixed");
    }
});

var parametros = {};
parametros['categoria_voo'] = {};
parametros['categoria_aeronave'] = {};

// parametros["categoria_aeronave_jato_leve"]          = "";
// parametros["categoria_aeronave_jato_medio"]         = "";
// parametros["categoria_aeronave_jato_longo_alcance"] = "";
// parametros["categoria_aeronave_jato_turbo_helice"] = "";
// parametros["categoria_aeronave_bimotor"] = "";
// parametros["categoria_aeronave_monomotor"] = "";
// parametros["categoria_aeronave_anfibio"] = "";
// parametros["categoria_aeronave_helicoptero"] = "";
// parametros["categoria_aeronave_agricola"] = "";
// parametros["categoria_aeronave_instrucao"] = "";



$("[data-parametro]").change(function(e){
    if(formatarParametros()){
        primeira_pagina = false;
        $(".resultado-aeronaves").html("");
        carregarAeronaves(cidade, global_lat, global_lng, global_lat_destino, global_lng_destino, 1, passageiros, ordenar);
    }
});


function carregarAeronaves(cidade, lat, lng, lat_destino, lng_destino, pagina, passageiros, ordenar="distance"){
    if(formatarParametros()){

    $(".carregando_aeronaves").show();

    console.API;

    if (typeof console._commandLineAPI !== 'undefined') {
        console.API = console._commandLineAPI; //chrome
    } else if (typeof console._inspectorCommandLineAPI !== 'undefined') {
        console.API = console._inspectorCommandLineAPI; //Safari
    } else if (typeof console.clear !== 'undefined') {
        console.API = console;
    }

    console.API.clear();


    parametros2 = parametros;
    parametros_json = JSON.stringify(parametros2);
    console.log(passageiros);
    $.post(root_url+"/processador.php?busca_aeronaves", {lat: lat, lng: lng, lat_destino: lat_destino, lng_destino: lng_destino, pagina: pagina, passageiros: passageiros, ordenar: ordenar ,parametros:parametros_json, cidade: cidade}, function(aeronaves){

        if(aeronaves != "sem_resultado"){
            $(".resultado-aeronaves").append(aeronaves);
            var base_operacao = $("#base_operacao_qtd").text();

            base_operacao = base_operacao.split(' - ')

            total_resultados = $("[data-base="+base_operacao[0].toLowerCase()+"]").size();
            $("#qtd_resultados").text(total_resultados);
        }else{
            sem_resultado = true;
        }
        $(".carregando_aeronaves").hide();
        primeira_pagina = true;

    });


    }
}

$("input.selecionar-todos").change(function(e){
    if($(this).is(':checked')){
        $(this).parent().parent().find("input[type=checkbox]").each(function(i, el){
            $(el).prop('checked', true);
        });
    }else{
        $(this).parent().parent().find("input[type=checkbox]").each(function(i, el){
            $(el).prop('checked', false);
        });
    }

    formatarParametros();
});

$(".input-checkbox input[type=checkbox]").change(function(e){
    if(!$(this).is(":checked")){
        checkall = $(this).parent().parent().find("input[type=checkbox].selecionar-todos");

        if($(checkall).is(':checked')){
            checkall.prop("checked", false);

            formatarParametros();
        }
    }
});

$("[data-tipo-parametro=categoria_voo]").click(function(e){
    $("[data-tipo-parametro=categoria_voo]").prop("checked", false);

    $(this).prop("checked", true);
});

function formatarParametros(){

    elementos = $("[data-parametro]");
    count = elementos.length;

    for(var i=0; i<count; i++){
        e = elementos[i];
        if($(e).is(':checked')){
            parametros[$(e).data("tipo-parametro")][$(e).data("parametro")] = "ok";
        }else{
            parametros[$(e).data("tipo-parametro")][$(e).data("parametro")] = "";
        }
    }

    return true;
}


function finalizarCotacao(token){
    $.ajax({
        url: root_url+'/processador.php?finaliza_cotacao',
        type: 'POST',
        data: {token: token},
    }).done(function(data){
        if(data == "ok"){
            alert("Cotação finalizada com sucesso.");
        }else{
            alert(data);
        }
    });
    
}