
function setHeight()
{
  var elmnt = document.getElementById("head");
  elmnt.style.height = (elmnt.offsetWidth / 2)+"px";
  hideSide();
}
setHeight();

function hideSide()
{
  var limit = 1442;
  var elmnt = document.getElementById("sideone");
  if(document.body.clientWidth <= limit)
  {
      elmnt.style.display = "none";
  }

  else if(document.body.clientWidth > limit)
  {
    elmnt.style.display = "inline-block";
  }

  var elmnt = document.getElementById("side");
  if(document.body.clientWidth <= limit)
  {
      elmnt.style.display = "none";
  }

  else if(document.body.clientWidth > limit)
  {
    elmnt.style.display = "inline-block";
  }

  var elmnt = document.getElementById("reportside");
  if(document.body.clientWidth <= limit)
  {
      elmnt.style.display = "none";
  }

  else if(document.body.clientWidth > limit)
  {
    elmnt.style.display = "inline-block";
  }
}
