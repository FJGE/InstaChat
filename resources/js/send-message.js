document.getElementById('send-button').addEventListener('click', function() {
    var messageInput = document.getElementById('message-input');
    var message = messageInput.value.trim();

    // Verifica si el mensaje no está vacío
    if (message !== '') {
        var friendId = getSelectedFriendId(); // Obtén el ID del amigo seleccionado
        var date = new Date();
        var formattedDate = formatDate(date);

        // Envía el mensaje al archivo SendMessage.php
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Actualiza la vista de mensajes con el nuevo mensaje enviado
                document.querySelector('.chat-messages').innerHTML += '<p class="sent">' + message + '</p>';
                document.querySelector('.chat-messages').innerHTML += '<p class="sentDate"><small>' + formattedDate + '</small></p>';

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

function formatDate(date) {
    var year = date.getFullYear();
    var month = String(date.getMonth() + 1).padStart(2, '0');
    var day = String(date.getDate()).padStart(2, '0');
    var hours = String(date.getHours()).padStart(2, '0');
    var minutes = String(date.getMinutes()).padStart(2, '0');
    var seconds = String(date.getSeconds()).padStart(2, '0');

    return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
}