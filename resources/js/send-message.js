document.getElementById('send-button').addEventListener('click', function() {
    var messageInput = document.getElementById('message-input');
    var message = messageInput.value.trim();

    // Verifica si el mensaje no está vacío
    if (message !== '') {
        var friendId = getSelectedFriendId(); // Obtén el ID del amigo seleccionado

        // Envía el mensaje al archivo SendMessage.php
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Actualiza la vista de mensajes con el nuevo mensaje enviado
                document.querySelector('.chat-messages').innerHTML += '<p>' + message + '</p>';

                // Limpia el campo de entrada de mensajes
                messageInput.value = '';
            }
        };
        xhttp.open('POST', '../controllers/SendMessageController.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('friendId=' + friendId + '&message=' + encodeURIComponent(message));
    }
});

function getSelectedFriendId() {
    var selectedFriend = document.querySelector('.friend-card.selected');
    return selectedFriend.dataset.id;
}