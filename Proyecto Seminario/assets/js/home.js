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
        alert(data.msg);
}
    })

}
