/**
* jQuery Extends
*/
$.fn.extend({
	reset: function() {
		return this.each(function() {
			$(this).is('form') && this.reset();
		})
	}
});

/**
* Função para limpar os campos de um fieldset
*/
function clear_fieldset(id)
{
	$("#"+id).find(".clear").each(function(){this.value = "";});

}
function delDomain(n)
{
	if(confirm('Deseja remover este domínio de sua lista?')) $("#added_domain_"+n).slideUp('slow', function(){$(this).remove();});
}
function editDomain(n)
{
	var fields = ['data_domain_url', 'data_domain_login', 'data_domain_password'];
	for(a in fields) $("#"+fields[a]).val($("#added_domain_"+n).find("input."+fields[a]).val());
	$("#added_domain_"+n).remove();
}
function in_array(val, array)
{
	for(x in array)
	{
		if(array[x] == val) return true;
	}
	return false;
}
function array_push(val, array)
{
	array[array.length] = val;
	return array;
}
function array_merge(array1, array2)
{
	return array1.concat(array2);
}
function print_r(array, alertit)
{
	var o=""; for(x in array){ o+= '['+x+'] => ' + array[x] + '\n'; }
	if(alertit) alert(o);
	return o;
}
function flash_msg(msg, obj, fade)
{
	if(!fade) fade = {};
	$(obj + " .msg").html(msg)
	$(obj).fadeIn(1000, function(){
		$(obj).children("button").click(function(){
			//alert("oi");
			$(obj).fadeOut(500);
		})
		if(fade.timeout > 0 && fade.out > 0){
			window.setTimeout(function(){
				$(obj).fadeOut(fade);
			}, fade.timeout);
		}
		else if(fade > 0)
		{
			$(obj).fadeOut(fade);
		}
	});
}
function slide_msg(msg, obj, fade)
{
	$(obj + " .msg").html(msg)
	$(obj).slideDown(1000, function(){
		$(obj).children("button").click(function(){
			//alert("oi");
			$(obj).fadeOut(500);
		})
		if(fade > 0){
			$(obj).fadeOut(fade);
		}
	});
}
//array = new Array();
//array = array_push(array, 'orkutools.com');
//array[array.length] = 'orkutools.com';
//var array2 = ['thiago', 'fernando', 'bocchile'];
//print_r(array_merge(array, array2), true);
//print_r(array.concat(array2), true);
//array = ['thiago', 'fernando', 'bocchile', 'orkutools.com'];
//alert(in_array('orkutools.com', array));
//alert(in_array('mano', array));
function check_fieldset(fieldset, config)
{
	var output = true;
	if(!config) config = new Object();
	$(fieldset).find("input, select").each(function(){
		if(config.noempty == true && this.value == ""){
			output = false;
		}
	});
	return output;
}
//var added_domains = new Array();
function fielderror(field)
{
	$(field).css({border:"2px solid red"}).attr({error:true});
}


function add_domain()
{

	// versao 1
	/*	$.ajax({
	type: "POST",
	url: baseURL + '/add_domain/',
	data: "name=John&location=Boston",
	success: function(msg){
	alert( "Data Saved: " + msg );
	}
	});*/

	// versao 2
	var options = {
		url: baseURL + '/add_domain/',
		target:".added_domains",
		beforeSubmit:function(){
			//			alert("Coletando dados do formulario");
			$("form.ajax input, form.ajax select").each(function(){
				$(this).attr("disabled", "true");
			})
			$(".added_domains").slideUp(500);
		},
		success:function(){
			//
			$("form.ajax").reset();
			$("form.ajax input, form.ajax select").each(function(){
				$(this).attr("disabled", false);
			})
			$(".added_domains").slideDown(500);
		}
	};
	if(validator.form() == true){
		if(in_array( $("#data_domain_url").val(), added_domains) || in_array( $("#data_domain_login").val(), added_logins))
		{
			alert("Este dominio e/ou login ja consta em sua lista");
			return false;
		}
		$("form.ajax").ajaxSubmit(options);
	}


}
function addDomain2()
{
	/**/
	if(!check_fieldset($("#domains_data"), {noempty:true})){
		flash_msg("Preencha todos os campos", ".fieldset_tip");
		return false;
	}
	//	alert(in_array('oi', array2));
	//	alert(array_push('oi', array2));
	/**
	* @todo verificar repetição do mesmo domínio
	* @todo verificar repetição do mesmo login
	*/

	var count = ($("div.added_domains div").size());
	var domainform = '<div class="added_domain" id="added_domain_'+count+'"><div style="clear:both"></div>'+
	'<span><b>Url:</b>'+$("#data_domain_url").val()+'<input class="data_domain_url" type="hidden" name="data[Domain]['+ count +'][url]" value="'+$("#data_domain_url").val()+'"></span>'+
	'<span><b>Login:</b>'+$("#data_domain_login").val()+'<input class="data_domain_login" type="hidden" name="data[Domain]['+ count +'][login]" value="'+$("#data_domain_login").val()+'"></span>'+
	'<span><b>Password:</b> ***** <input class="data_domain_password" type="hidden" name="data[Domain]['+ count +'][password]" value="'+$("#data_domain_password").val()+'"></span>'+
	'<span>&nbsp;</span><button onclick="editDomain('+count+')">[editar]</button><button onclick="delDomain('+count+')">[excluir]</button>			<div style="clear:both"></div>		</div>';

	clear_fieldset("domains_data");
	$("div.added_domains").append(domainform);
}
function ajax_whois(url)
{

}
function checkloign()
{

}
function addAddress()
{
	var addressfieldset = document.getElementById('adress_data');
	var count = (addressfieldset.getElementsByTagName('div').length);
	var addressform ='<div class="adress">';
	addressform+=    '<p><label>address: 	</label>  <input type="text" name="data[Adress]['+count+'][address]" size="40"></p>';
	addressform+=    '<p><label>address_c: 	</label>  <input type="text" name="data[Address]['+count+'][address_c]" size="40"></p>';
	addressform+=    '<p><label>neighborhood: 	</label>  <input type="text" name="data[Address]['+count+'][neighborhood]" size="40"></p>';
	addressform+=    '<p><label>zipcode: 	</label>  <input type="text" name="data[Address]['+count+'][zipcode]" size="40"></p>';
	addressform+=    '<p><label>city: 	</label>  <input type="text" name="data[Address]['+count+'][city]" size="40"></p>';
	addressform+=    '<p><label>state: 	</label>  <input type="text" name="data[Address]['+count+'][state]" size="40"></p>';
	addressform+=    '<p><label>country: 	</label>  <input type="text" name="data[Address]['+count+'][country]" size="40"></p>';
	addressform+='</div>';
	addressfieldset.innerHTML=addressfieldset.innerHTML+addressform;
}