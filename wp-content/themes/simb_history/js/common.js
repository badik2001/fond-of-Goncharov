window.onload = function() {

  console.log(document.getElementById('post_silder'), document.getElementById('cat_silder'));

    
  if(document.getElementById('post_silder')){
    $('#post_silder').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      infinite: false,
    });
  }

  if(document.getElementById('cat_silder')){
    $('#cat_silder').slick({
      slidesToShow: 4,
          slidesToScroll: 1,
          infinite: false,
    });
  }

};