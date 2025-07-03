function showNotification(msg) {
    var mb = document.getElementById("notification");
    mb.innerHTML = msg;
    mb.className = "show";
    setTimeout(()=>{ mb.className = mb.className.replace("show", ""); }, 3000);
}

async function copy(text) {
    try {
        await navigator.clipboard.writeText(text);
        showNotification("Nukopijuota");
        console.log('Content copied to clipboard');
    } catch (err) {
        console.error('Failed to copy: ', err);
    }
}


