function ajaxRequest() {
    var xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var resp = this.responseText;
            return resp;
        }
    }
    xmlhttp.open("GET", "ajax.php");
    xmlhttp.send();
}