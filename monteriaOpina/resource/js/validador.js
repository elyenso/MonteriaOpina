/*
var verificar = true;	

var alertUserVacio=document.getElementById("alertUserVacio");
	var alertUserExiste=document.getElementById("alertUserExiste");
	var alertEdadVacio=document.getElementById("alertEdadVacio");
	var alertEmailExiste=document.getElementById("alertEmailExiste");
	var alertEmailVacio=document.getElementById("alertEmailVacio");
	var alertEmailIncorrecto=document.getElementById("alertEmailIncorrecto");
	var alertPasswordVacio=document.getElementById("alertPasswordVacio");
		

function Limpiar(){

	var alertUserVacio=document.getElementById("alertUserVacio");
	var alertUserExiste=document.getElementById("alertUserExiste");
	var alertEdadVacio=document.getElementById("alertEdadVacio");
	var alertEmailExiste=document.getElementById("alertEmailExiste");
	var alertEmailVacio=document.getElementById("alertEmailVacio");
	var alertEmailIncorrecto=document.getElementById("alertEmailIncorrecto");
	var alertPasswordVacio=document.getElementById("alertPasswordVacio");

	alertUserVacio.style.display='none';
	alertUserExiste.style.display='none';
	alertEdadVacioVacio.style.display='none';
	alertEmailExisteExiste.style.display='none';
	alertEmailVacio.style.display='none';
	alertEmailIncorrecto.style.display='none';
	alertPasswordoVacio.style.display='none';
	alertEmailIncorrecto.style.display='none';
	
}


function validarUsuario()
{

	var formulario = document.getElementById("form1");
	var usuario = document.getElementById("usuario").value;
	var email= document.getElementById("avatar").value;
	var edad=document.getElementById("edad").value;
	var password=document.getElementById("password").value;
	var expRegEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;


	var alertUserVacio=document.getElementById("alertUserVacio");
	var alertUserExiste=document.getElementById("alertUserExiste");
	var alertEdadVacio=document.getElementById("alertEdadVacio");
	var alertEmailExiste=document.getElementById("alertEmailExiste");
	var alertEmailVacio=document.getElementById("alertEmailVacio");
	var alertEmailIncorrecto=document.getElementById("alertEmailIncorrecto");
	var alertPasswordVacio=document.getElementById("alertPasswordVacio");

	


	if(!usuario)
	{
		
		alertUserVacio.style.display='block';
		usuario.focus();
		verificar = false;
	}
	else{
		validar();
	}

	if(!email){
		alertEmailVacio.style.display='block';
		email.focus();
		verificar = false;
	}
	 if(!expRegUrl.exec(email)){
		alertEmailIncorrecto.style.display='block';
		email.focus();
		verificar = false;
	}
	else{
		validar();
	}

 if(!edad){
		alertEdadVacioVacio.style.display='block';
		edad.focus();
		verificar = false;
	}

	 if(!password){
		alertPasswordVacio.style.display='block';
			password.focus();
		verificar = false;
	}
}

	function validar()
	{
		
		var datos = new FormData();

		datos.append("usuario",usuario);
		datos.append("email", email);
			$.ajax({
			url:'validacion.php',
			type:'POST',
			contentType:false,
			data:datos,
			processData:false,
			cache:false
		}).done(function(msg){
			MensajeFin(msg)
			
		});
	

function MensajeFin(msg){
	$('#cont').html(msg);	
	
}
}


*/



	var verificar = true;	

function Limpiar(){

	
	var mensaje_correo_existe =document.getElementById("mensaje_correo_repetido");

	mensaje_correo_existe.style.display='none';

}

function validarUsuario()
{



	var usuario = document.getElementById("correo_user").value;
	


		
		var datos = new FormData();

		datos.append("usuario",usuario);
			$.ajax({
			url:'?c=Usuario&a=validarCorreo',
			type:'POST',
			contentType:false,
			data:datos,
			processData:false,
			cache:false
		}).done(function(msg){
			MensajeFin(msg)
			
		});
	

function MensajeFin(msg){
	$('#cont').html(msg);	
	
		
	
}
}



	


	

