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
		$(document).find('.mask-telfr').mask('00 00 00 00 00');
	})();
	//====================================================================
	
	
	//=======================JS==SPECIFIQUE===============================
	//dispatch actions (selon vue affichee, connectee ou non, ...)
	//console.log(jsdata); //defini grace a recources/view/templates/app.twig 
	switch(jsdata['view']){
		
		case "/users/list" :
			if( typeof($.cookie('toastClosed'))=='undefined' )
			{
				var toast = new ax5.ui.toast();
				toast.setConfig({
					theme: "danger",
					containerPosition: "top-right"
				});
				toast.confirm({
					msg: 'Étant administrateur, vous avez été redirigé directement vers la page de gestion des utilisateurs.',
				}, function () {
					$.cookie("toastClosed", 1);
				});
			}
		break;
		
	}
	$("form").submit(function (e) {
		//var formId = this.id;
		//todo: possibilité d'afficher des retours dans toast javascript
		switch(jsdata['view']){
		
			case "/auth/signup" :
				mask.open({
					content: '<h1><i class="fa fa-spinner fa-spin"></i>Veuillez patienter</h1>'
				});
			break;
			
		}
	});
	//====================================================================
	
	
	
	

	console.log( "FIN EXECUTION JS" );
});


//========================JS==FONCTIONS===================================
function getAvailableHeight(){
	return window.innerHeight - $("#navbar").outerHeight(true);
}