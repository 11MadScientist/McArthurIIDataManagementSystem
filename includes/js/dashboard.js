
function setHeight()
{
  var elmnt = document.getElementById("head");
  elmnt.style.height = (elmnt.offsetWidth / 2)+"px";
  hideSide();
}
setHeight();

function hideSide()
{
  var elmnt = document.getElementById("sideone");
  if(document.body.clientWidth <= 1410)
  {
      elmnt.style.display = "none";
  }

  else if(document.body.clientWidth > 1410)
  {
    elmnt.style.display = "inline-block";
  }

  var elmnt = document.getElementById("side");
  if(document.body.clientWidth <= 1410)
  {
      elmnt.style.display = "none";
  }

  else if(document.body.clientWidth > 1410)
  {
    elmnt.style.display = "inline-block";
  }
}
