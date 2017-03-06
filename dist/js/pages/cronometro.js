var _initialDate = null;
var centesimas = null;
var segundos = 0;
var minutos = 0;
var horas = 0;
var counter = 0;
var running = false;

setInterval(cronometro_pausa,1000);


function inicio() {
    running = true;
    _initialDate = new Date();
	console.log("initial Date: "+_initialDate);
	control = setInterval(cronometro,1000);
	document.getElementById("inicio").disabled = true;
	document.getElementById("parar").disabled = false;
    var datetime = getFormattedDate();
    document.getElementById("initDate").value = datetime;
    var user_id = document.getElementById("user_id").value;
    console.log("user: "+user_id);
    realizaProceso(datetime,user_id);
}

function inicioAutomatico (date) {
    running = true;
    console.log("Fecha Inicio Automatico: "+date);
    _initialDate = date;
	console.log("date: "+date);
	control = setInterval(cronometro,1000);
	document.getElementById("inicio").disabled = true;
	document.getElementById("parar").disabled = false;
    var datetime = getFormattedDate();
    document.getElementById("initDate").value = datetime;
    //realizaProceso(datetime);
}

function parar () {
    running = false;
	clearInterval(control);
	document.getElementById("parar").disabled = true;
    document.getElementById("stopForm").submit();
}

function cronometro () {
    
    var seconds = getTimeDifference();
    // multiply by 1000 because Date() requires miliseconds
    var date = new Date(seconds * 1000);
    var hh = date.getUTCHours();
    var mm = date.getUTCMinutes();
    var ss = date.getSeconds();
    // If you were building a timestamp instead of a duration, you would uncomment the following line to get 12-hour (not 24) time
    // if (hh > 12) {hh = hh % 12;}
    // These lines ensure you have two-digits
    if (hh < 10) {hh = "0"+hh;}
    if (mm < 10) {mm = "0"+mm;}
    if (ss < 10) {ss = "0"+ss;}
    // This formats your string to HH:MM:SS
    
    Segundos.innerHTML = ":"+ss;
    Minutos.innerHTML = ":"+mm;
    Horas.innerHTML = hh;
    var hora = hh+":"+mm+":"+ss;
    document.getElementById("endTime").value = hora;
    
        if(mm == "00" || mm == "30") {
            if((ss == "00")  ){
                notifyMe();
            }
        }
}

function cronometro_pausa () {
    if(!running){
        counter++;
        if(counter == 1800){
            notifyMeNotWorking();
            counter = 0;
        }
    }
}

function getTimeDifference(){
        var _current = new Date();
        var seconds = (_current.getTime() - _initialDate.getTime())/1000;
        seconds = Math.floor(seconds);
    return seconds;
}

function getFormattedDate() {
	
    var str = _initialDate.getFullYear() + "/" + (_initialDate.getMonth() + 1) + "/" + _initialDate.getDate() + " " +  _initialDate.getHours() + ":" + _initialDate.getMinutes() + ":" + _initialDate.getSeconds();
    return str;
}


function realizaProceso(datetime,user){
        var parametros = {
                "tiempo" : datetime,
                "user" : user
        };
        $.ajax({
                data:  parametros,
                url:   'pages/backend/init_reg.php',
                type:  'post',
                beforeSend: function () {
                        console.log("iniciando");
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        console.log("finalizado");
                        $("#resultado").html(response);
                }
        });
}

// request permission on page load
document.addEventListener('DOMContentLoaded', function () {
  if (Notification.permission !== "granted")
    Notification.requestPermission();
});

function notifyMe() {
  if (!Notification) {
    alert('Desktop notifications not available in your browser. Try Chromium.'); 
    return;
  }

  if (Notification.permission !== "granted")
    Notification.requestPermission();
  else {
    var notification = new Notification('Bitacora de operación', {
      icon: 'http://es.calcuworld.com/wp-content/uploads/sites/2/2015/06/cronometro2.png',
      body: "Hay una tarea en ejecución!!",
    });

    notification.onclick = function () {
      window.open("http://bitacora.compuredes.com.co:8082/vista/actividad.php");      
    };

  }

}

function notifyMeNotWorking() {
  if (!Notification) {
    alert('Desktop notifications not available in your browser. Try Chromium.'); 
    return;
  }

  if (Notification.permission !== "granted")
    Notification.requestPermission();
  else {
    var notification = new Notification('Bitacora de operación', {
      icon: 'http://www.ubrn.org/wp-content/uploads/2015/01/icon-sleep.png',
      body: "No hay tareas en proceso!!",
    });

    notification.onclick = function () {
      window.open("http://bitacora.compuredes.com.co:8082/vista/actividad.php");      
    };

  }

}
