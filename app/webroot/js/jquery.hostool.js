/**
 *	Funções nativas do Hostool
 *	@author Thiago Bocchile <tykoth@gmail.com>
 */


/**
 * Funções para Checkbox em linha
 * @requires jQuery Core
 */
	$.fn.selectableLine = function()
	{
		// Esconde todos os checkboxes
		$(this).find(":checkbox").hide();
		// Adiciona evento de click nesta linha
		$(this).click(function(){			
			// Clicando, adiciona evento de click no checkbox
			$(this).find(":checkbox").toggleselectLine();
		})
	}
	$.fn.toggleselectLine = function(force_check)
	{
		
		$(this).click(function(){
			if(force_check == true || force_check == false) this.checked = force_check;
			$checked = !this.checked;
			$grampa = $(this).parent().parent();
			if($checked) $grampa.addClass("selected");
			else $grampa.removeClass("selected");
		})
		.click()
		.unbind('click');
	}
	$.fn.selectAllLines = function(from)
	{
		$(this).click(function(){
			$(from).toggleselectLine(!this.checked);
		})
	}


/**
 * Funções para habilitar/desabilitar campos
 * @requires jQuery Core
 */
	$.fn.disable = function()
	{
		$(this).attr("disabled", true).addClass("disabled");
	}
	
	$.fn.enable = function()
	{
		$(this).attr("disabled", false).removeClass("disabled");
	}

/**
 * Função para ativar o mask em inputs
 * @requires jQuery Core
 * @requires jQuery Metadata Plugin
 */
	// Para que haja compatibilidade com o validator
	$.validator.addMethod('mask', function(){return true;}, "");
	$.fn.maskAll = function()
	{
		this.each(function(){
		if($(this).data().mask)
			{
				$(this).mask($(this).data().mask);
			}
		})
	}

/**
 * Função para executar "blur" em um campo indo diretamente a aba
 * @requires jQuery Core
 * @requires jQuery UI Tabs
 */
	$.fn.tabFocus = function()
	{
		var id = $(this).parents("div.ui-tabs-panel").attr("id").match(/\d/);
		$(".ui-tabs-container ul").tabsClick(id);
	}

/**
 * Função para adicionar itens em formularios com multiplos campos
 * @requires jQuery Core
 */
	$.fn.itemAddon = function(options)
	{
		options = $.extend({
			// Pattern e Subject utilizam os padrões do CakePHP
			fieldnamePattern:/data\[(.+)\]\[(\d+)\]\[(.+)\]/gi,
			fieldnameSubject:"data[$1][#][$3]",
			fxFade:false,
			fxSpeed:'normal'
		}, options);
		
		$(this).click(function(){
			// Coletar tamanho
			var size = $(this).parent().find(".added_itens div").size();
			
			// Criar um clone
			var clone = $(this).parent().find(".added_itens div:first").clone();
			
			// Alterar indices de campos do form, usando o tamanho	
			clone.find("input, select").each(function(){
				var new_name = $(this).attr("name").replace(options.fieldnamePattern, options.fieldnameSubject.replace("#", size));
				$(this).attr("name", new_name);
			});
			
			// Resetar campos
			clone.find("input, select").clearFields();
			
			// Esconder item adicionado
			clone.hide();
			
			// Inserir item adicionado ao formulario
			$(this).parent().find(".added_itens").append(clone);
			
			// Efeito para exibir
			if(options.fxFade)
			{
				clone.slideDown(options.fxSpeed);
			}
			else
			{
				clone.show();
			}
		
			// Evitar submit
			return false;
		});
	}