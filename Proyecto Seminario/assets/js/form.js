$(function(){
  $('select').material_select();
  $('.datepicker').pickadate({
    selectMonths: true,
    selectYears: 50,
    format: 'yyyy-mm-dd'
  });

btnActions();

  $('#formularioUser').submit(function(event){
    event.preventDefault();
    checkContrasena()
  })

})

function btnActions(){
  $('#formularioPersona').submit(function(event){
    event.preventDefault();
    $('.segundaPersona').hide();
    $('#step1').removeClass('active');
    $('#step2').addClass('active');
    $('.terceraEmpresa').show();
  })

  $('#formularioEmpresa').submit(function(event){
    event.preventDefault();
    $('.terceraEmpresa').hide();
    $('#step2').removeClass('active');
    $('#step3').addClass('active');
    $('.cuartaUser').show();
  })

  $('.volverEmp').click(function(event){
    event.preventDefault();
    $('.terceraEmpresa').hide();
    $('.segundaPersona').show();
    $('#step2').removeClass('active');
    $('#step1').addClass('active');
  });

  $('#volverUser').click(function(event){
    event.preventDefault();
    $('.cuartaUser').hide();
    $('.terceraEmpresa').show();
    $('#step3').removeClass('active');
    $('#step2').addClass('active');
  });
}

function checkContrasena(){
  var contrasena = $('#contrasena').val();
  var repContrasena = $('#contrasenaRepetida').val();

  if (contrasena===repContrasena) {
    getDatos();

  }else {
    alert('Las contraseñas no coinciden')
  }
}

function getDatos(){
  var form_data = new FormData();

    form_data.append('nombrePersona', $('#nombrePersona').val());
    form_data.append('apellido', $('#apellido').val());
    form_data.append('fechaNacimiento', $('#fechaNacimiento').val());
    form_data.append('email', $('#email').val());

    form_data.append('nit', $('#nit').val());
    form_data.append('nombreEmp', $('#nombreEmp').val());
    form_data.append('descripcion', $('#descripcion').val());

    form_data.append('username', $('#username').val());
    form_data.append('contrasena', $('#contrasena').val());
    sendForm(form_data);
}

function sendForm(formData){
  $.ajax({
    url: 'server/create_user.php',
    dataType: "json",
    cache: false,
    processData: false,
    contentType: false,
    data: formData,
    type: 'POST',
    success: function(php_response){
      if (php_response.msg == "exito en la inserción") {
        window.location.href = 'login.html';
      }else {
        alert(php_response.msg);
      }
    },
    error: function(err){
      console.log(err);
    }
  })
}
