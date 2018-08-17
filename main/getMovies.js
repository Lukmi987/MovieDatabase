var xhr = new XMLHttpRequest();
xhr.open('GET', 'moviesData.json',true);
xhr.onreadystatechange = function () {
  if (xhr.readyState === 4) {

    var movies = JSON.parse(xhr.responseText);
    console.log(movies);
    var statusHTML = '<tr>';
    for(var i=0; i<movies.length; i+=1){

      statusHTML += '<td>';
      statusHTML += movies[i].title;
      statusHTML += '</td>';
      statusHTML += '<td>';
      statusHTML += movies[i].description;
      statusHTML += '</td>';
      statusHTML += '<td>';
      statusHTML += movies[i].release_year;
      statusHTML += '</td>';
      statusHTML += '<td>';
      statusHTML += movies[i].length;
      statusHTML += '</td>';
      statusHTML += '<td>';
      statusHTML += '<a href="UpdateMovie.php?id=';
      statusHTML += movies[i].film_id;
      statusHTML += ' ">Update</a>';
      statusHTML += '</td>';
      statusHTML += '<td>';
      statusHTML += '<a href="DeleteMovie.php?id=';
      statusHTML += movies[i].film_id;
      statusHTML += ' ">Delete</a>';
      statusHTML += '</td>';
      statusHTML += '</tr>';

    }
    document.getElementById('listOfMoviesBody').innerHTML = statusHTML;
  }
};

xhr.send();
