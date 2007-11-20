$(document).ready(function(){
	function showRequest(){ return false; }
	function showResponse()
	{
		ajax_forms();	
		ajax_links_on_content();
	}
	/**
	 * Faz todos os links virarem ajax.
	 */
	function ajax_links()
	{
		/*/
		$('a').click(function(){
			get_string = (this.href.match(/layout/)) ? "&" : "?";
			var html = $.ajax({
				url: this.href + get_string + "layout=ajax",
				async: false
			}).responseText;
			$("div#content").html(html);
		});
		 /**/
		$('a').click(function(){
			get_string = (this.href.match(/\?/)) ? "&" : "?";
			$.get(this.href + get_string + "layout=ajax", function(data){
				//por data dentro do content
				$("div#content").html(data);
				ajax_forms(); ajax_links_on_content()
			});
			
			return false;
		});
		/**/
	}
	/**
	 * Gambiarra, a arrumar
	 */
	function ajax_links_on_content()
	{
		$('div#content a').click(function(){
			get_string = (this.href.match(/layout/)) ? "&" : "?";
			$.get(this.href + get_string + "layout=ajax", function(data){
					//por data dentro do content
					$("div#content").html(data);
					ajax_forms();
				});
			return false
		});
	}
	ajax_links();
	
	/**
	 *
	 */
	function ajax_forms()
	{
		var options = {
						target:'div#content', 
						beforeSubmit:function(){
							return true;
						}, 
						success:function(){
							ajax_forms();
							ajax_links_on_content();
						}
		};
		$('form').attr('action', $('form').attr('action') + "?layout=ajax").ajaxForm(options);
	}
	
	function ajax_init()
	{
		ajax_links(); ajax_forms();
	}
	
	function flash(flashMessage)
	{
		$("#flash")
			.html(flashMessage)
			.fadeIn(2000, function()
			{
				window.setTimeout(function()
				{
					$("#flash")
						.fadeOut(2000)
						.html(null);
				},
				2000)
			})
	}
	

});

	function flash(flashMessage)
	{
		$("#flash")
			.html(flashMessage)
			.fadeIn(2000, function()
			{
				window.setTimeout(function()
				{
					$("#flash")
						.fadeOut(2000)
						.html(null);
				},
				2000)
			})
	}
	
	/*function startvisits()
	{
		$("#VisitsForm").attr('target', 'slot_' + $("#SlotsId").val()).ajaxForm(null).submit();
		//alert("OK");
	}*/
/***
Garbage section

input[@type="submit"],input[@type="image"]
	function ajax_forms()
	{
		$('form').submit(function(){
			ajax_init();
			alert('oi');
			return false;
		});
	}

****/
