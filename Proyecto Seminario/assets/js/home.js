$(function(){
  obtenerDataInicial();
})

function obtenerDataInicial() {
    let url = 'server/getDatosHome.php'
    $.ajax({
      url: url,
      dataType: "json",
      cache: false,
      processData: false,
      contentType: false,
      type: 'GET',
      success: (data) => {
        if(data.msg == 'OK'){
          alert('Session ok');
          $('.options').hide();
        }else if(data.msg == 'No hay sesión abierta.'){
          alert('Sesión no iniciada');
        }else {
          console.log(data.msg);
        }
      }
    })
}
