let echo_service;
let append = function(text){
    document.getElementById("wesocket_events").insertAdjacentHTML('beforeend', "<li>" + text + ";</li>");
}
window.onload = function(){
    echo_service = new WebSocket('ws://127.0.0.1:9501');
    echo_service.onmessage = function(event) {
        append(event.data);
    }
    echo_service.onopen = function(){
        append("Connected to WebSocket!");
    }
    echo_service.onclose = function(){
        append("Connection closed");
    }
    echo_service.onerror = function(error){
        append("Connection error: " + error);
    }
}
function sendMessage(event){
    console.log(event);
    let message = document.getElementById("message").value;
    console.log(message);
    echo_service.send(message);
}