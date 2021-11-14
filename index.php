<?php
require_once('../core/core.php');
Page::header('test');
?>
<div class="row">
    <div class="col s6 input-field"><input type="text" name="code" id="code"></div>
    <div class="col s3"><img src="captcha.php" id="captcha_image"></div>
    <div class="col s3"><button class="btn waves-effect" id="reload_btn"><i class="material-icons">refresh</i></button></div>
    <div class="col s12"><button class="btn waves-effect" id="check"><i class="material-icons">done_all</i> Check</button></div>
    <div class="col s12"><div id="status"></div></div>
</div>
<?php
Page::footer('<script>
var check = document.getElementById("check");
check.addEventListener("click", function () {
    var xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                if(document.getElementById("code").value == this.responseText) {
                    document.getElementById("status").innerHTML = \'<span class="green-text"><i class="material-icons">done_all</i> Correct code!</span>\';
                    setTimeout(function () {
                        document.getElementById("code").value = "";
                        var img = document.getElementById("captcha_image");
                        img.setAttribute("src","captcha.php?rand=" + Math.random());
                        document.getElementById("status").innerHTML = "";
                    }, 2000);
                    } else {
                        document.getElementById("status").innerHTML = \'<span class="red-text"><i class="material-icons">error</i> Wrong code!</span>\';
                        console.log("Input:" + document.getElementById("code").value);
                        console.log("Session: " + code);
                    }
            }
        }
    xmlhttp.open("GET", "ajax.php");
    xmlhttp.send();
});
var reloadBtn = document.getElementById("reload_btn");
reloadBtn.addEventListener("click", function() {
    var img = document.getElementById("captcha_image");
    img.setAttribute("src","captcha.php?rand=" + Math.random());
});
</script>');
?>