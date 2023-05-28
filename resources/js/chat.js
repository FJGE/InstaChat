// Funcion para que cuando se haga click al amigo recoja el id y muestre el chat
document.querySelectorAll('.friend-card').forEach(item => {
    item.addEventListener('click', event => {
        event.preventDefault();
        var friendId = event.currentTarget.id;
        console.log('ID del amigo: ' + friendId);
        chat(friendId);
    });
});

// Funcion para enviar el id del amigo y recoger el chat
function chat(friendId) {
    // Deselecciona todos los amigos
    document.querySelectorAll('.friend-card').forEach(item => {
        item.classList.remove('selected');
    });

    // Selecciona el amigo actual
    document.getElementById(friendId).classList.add('selected');

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector('.chat-messages').innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "chat.php?friendId=" + friendId, true);
    xhttp.send();
}