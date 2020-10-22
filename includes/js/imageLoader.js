function readURL(input)
{
    document.getElementById("blah").style.display = "block";
    if (input.files && input.files[0])
    {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result)
                .width(1000)
                .height(500);

        };

        reader.readAsDataURL(input.files[0]);
    }
}
