 var closeIcon = '<svg fill="#ddd" class="remove-field closeIcon" viewBox="0 0 32 32"><polygon points="24.485,27.314 27.314,24.485 18.828,16 27.314,7.515 24.485,4.686 16,13.172 7.515,4.686 4.686,7.515 13.172,16 4.686,24.485 7.515,27.314 16,18.828 "></polygon></svg>';
 var userIcon = '<svg title="UserIcon" viewBox="0 0 32 32"><path d="M20.534,16.765C23.203,15.204,25,12.315,25,9c0-4.971-4.029-9-9-9S7,4.029,7,9c0,3.315,1.797,6.204,4.466,7.765C5.962,18.651,2,23.857,2,30c0,0.681,0.065,1.345,0.159,2h27.682C29.935,31.345,30,30.681,30,30C30,23.857,26.038,18.651,20.534,16.765z M9,9c0-3.86,3.14-7,7-7s7,3.14,7,7s-3.14,7-7,7S9,12.86,9,9z M4,30c0-6.617,5.383-12,12-12s12,5.383,12,12H4z"></path></svg>';


// request permission on page load
document.addEventListener('DOMContentLoaded', function () {
  if(Notification){
    if (Notification.permission !== "granted"){
      Notification.requestPermission();
    }
  }
});

// Notify Box
function notifyBox(msg)
{
    if (!Notification) {
      alert('Desktop notifications not available in your browser. Try Chrome.');
      return;
    }

    if (Notification.permission !== "granted")
      Notification.requestPermission();
    else {
      var notification = new Notification('Time App', {
        icon: '',
        body: msg.type+'\n'+msg.description
      });

      notification.onclick = function () {
        window.open("http://sandpit.timelyacademy.co.uk/notification");
      };

    }
      // var notifyBox = document.createElement('div');
      //     notifyBox.setAttribute('class','notifyBox active');

      // var notifyClose = document.createElement('div');
      //     notifyClose.setAttribute('class','notifyClose');
      //     notifyClose.setAttribute('onclick','closeNotifyBox(this)');
      //     notifyClose.innerHTML = closeIcon;
      //     notifyBox.appendChild(notifyClose);

      // var avatar = document.createElement('div');
      //     avatar.setAttribute('class','avatar');
      //     avatar.innerHTML = userIcon;
      //     notifyBox.appendChild(avatar);

      // var content = document.createElement('div');
      //     content.setAttribute('class','notify-content');

      // var p = document.createElement('p');
      //     p.innerHTML = msg.type+' - '+msg.description;
      //     content.appendChild(p);

      // var span = document.createElement('span');
      //     span.innerHTML = msg.created_at;
      //     content.appendChild(span);

      //     notifyBox.appendChild(content);

      // document.body.appendChild(notifyBox);

      var audio = document.getElementById('audio');
      audio.play();
}

// Remove Notify Box
function closeNotifyBox(elem)
{
  $(elem).parent().remove();
}

// Notifications Dropdown
function notifyDrop(msg)
{
      var nCounter = document.getElementById('notification-counter');

      var count = parseInt(nCounter.getAttribute('data-value'),10) + 1;

      nCounter.setAttribute('data-value',count);
      nCounter.innerHTML = count;

      var li = document.createElement('li');

      var a = document.createElement('a');
          a.setAttribute('href','/notification');

      var avatar = document.createElement('div');
          avatar.setAttribute('class','avatar');

          avatar.innerHTML = userIcon;

          a.appendChild(avatar);

      var content = document.createElement('div');
          content.setAttribute('class','notification-content');

      var p = document.createElement('p');
          p.innerHTML = msg.type+' - '+msg.description;
          content.appendChild(p);

      var span = document.createElement('span');
          span.innerHTML = msg.created_at;
          content.appendChild(span);

          a.appendChild(content);

      li.appendChild(a);

     $('.notifications-list ul').prepend(li);
}

var socket = io(document.getElementById('ip_addr').value);

socket.on(document.getElementById('app_name').value + '-notifications-'+userID, function(msg){
  notifyBox(msg);
  notifyDrop(msg);
});
