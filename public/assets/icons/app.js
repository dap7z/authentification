/********************************************
 Librairies js incluses directement via cdn :
	- JQuery
	- Bootstrap
	- Ax5ui
	- JQuery Mask Plugin (apres tests: ax5formatter pas top)
 (voir resources/views/templates/app.twig)
*******************************************/
$(document).ready(function() {
	
	
	//========================JS==GLOBAL==================================
	//Gestion format/mask inputs :
	(function () {
		$('[data-mask="telfr"]').mask('00 00 00 00 00');
	})();
	//====================================================================
	
	
	//=======================JS==SPECIFIQUE===============================
	//(selon vue affichee, connectee ou non, ect...)
	var js = {};
	$(document).find("input[name^='js_']").each(function(){
		var inputName = $(this).attr('name');
		var inputValue = $(this).val();
		inputName = inputName.substring(3);
		js[inputName] = inputValue;
	});
	//console.log(js);
	if(typeof(js['view'])=='undefined') js['view'] = '';
	if(typeof(js['auth'])=='undefined') js['auth'] = '';
	
	switch(js['view']){
		
		case "home" :
			if(js['auth']=='1'){
				if( typeof($.cookie('toastClosed'))=='undefined' )
				{
					var toast = new ax5.ui.toast();
					toast.setConfig({
						theme: "danger",
						containerPosition: "top-right"
					});
					
					toast.confirm({
						msg: 'Naviguez dans le menu en haut à droite pour acceder à la gestion des utilisateurs.',
						onStateChanged: function () {
							console.log(this);
						}
					}, function () {
						console.log("toast closed");
						$.cookie("toastClosed", 1);
						
					});
				}
			}
		break;
		
	}
	//====================================================================
	
	
	
	
	
	console.log( "FIN JS" );
	
});