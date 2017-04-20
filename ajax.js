function play(column)
{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("body").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "play.php?column=" + column, true);
  xhttp.send();
} 