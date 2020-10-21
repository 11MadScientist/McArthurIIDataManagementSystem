
function setHeight()
{
  var elmnt = document.getElementById("content-box");
  elmnt.style.height = (elmnt.offsetWidth - 300)+"px";
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
}
