
$(document).ready(function (e) {
  var offset = 0;
  $("#ButtonImgs").on('click',(function(e){
var movieId = document.getElementById("mynumber").value;
console.log({limit: offset, id: movieId});

    $.ajax({
      url: 'phpForDisplayingPictureIntoGallery.php',
      type: "POST",
      data: {limit: offset, id:movieId},
        success: function(data){
          $("#ImgsGallery").append(data); //append
      }
    });
    offset += 2;
  }));


});
