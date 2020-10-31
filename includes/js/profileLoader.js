function readURL(input) {
  setHeight();
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }

    }


    function setHeight()
    {
      var elmnt = document.getElementById("blah");
      elmnt.style.height = (elmnt.offsetWidth)+"px";
    }
    setHeight();
