/**
 * Created by Stefan on 2/14/2017.
 */

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function crop() {
    var box = $('#box')[0];
    $('#top').val(box.offsetTop);
    $('#left').val(box.offsetLeft);
    $('#right').val(box.offsetWidth);
    $('#bottom').val(box.offsetHeight);

    return true;
}

/*function aspectRatio() {
    var path = window.location.pathname;
    if(path.indexOf('profile')>0){
        return 16 / 16;
    }else{
        return 13 / 7;
    }
}*/

$(document).ready(function () {
    $('#file').on('click', function () {
        $("input:file").change(function (){
            $('#myModal').modal('show');

            var box = $('#box').draggable({containment: '#img'});
            $('#box').resizable({
                containment: '#img',
                aspectRatio: 16 / 16,
                minWidth: 100,
                minHeight: 100
            });
        });
    });

    $('#crop').on('click', function (event) {
        event.preventDefault();
        crop();

        var width = $("#img").width(),
            height = $("#img").height();

        var top = $('#top').val(),
            left = $('#left').val(),
            right = $('#right').val(),
            bottom = $('#bottom').val();

        var formData = new FormData();
        formData.append('top', top);
        formData.append('left', left);
        formData.append('right', right);
        formData.append('bottom', bottom);
        formData.append('width', width);
        formData.append('height', height);
        formData.append('file', $('input[type=file]')[0].files[0]);

        d = new Date();
        $.ajax({
            url: 'http://localhost/CMS/app/ajax/crop.php',
            method: 'post',
            mimeType: "multipart/form-data",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                $('#myModal').modal('hide');
                $("#img-output").attr("src", "../../app/img/" + response + "?"+d.getTime());
            }, error: function (response) {
                console.log("Error: " + response);
            }
        });
    });
});