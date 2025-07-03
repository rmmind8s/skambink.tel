function showNotification(msg) {
    var mb = document.getElementById("notification");
    mb.innerHTML = msg;
    mb.className = "show";
    setTimeout(()=>{ mb.className = mb.className.replace("show", ""); }, 3000);
}

async function copy(id) {
    try {
        var text = document.getElementById(id).innerHTML;
        await navigator.clipboard.writeText(text);
        showNotification("Nukopijuota");
        console.log('Content copied to clipboard');
    } catch (err) {
        console.error('Failed to copy: ', err);
    }
}

function toggle_visibility(id) {
  var e = document.getElementById(id);
  if(e.style.visibility == 'hidden')
    e.style.visibility = 'visible';
  else
    e.style.visibility = 'hidden';
}
