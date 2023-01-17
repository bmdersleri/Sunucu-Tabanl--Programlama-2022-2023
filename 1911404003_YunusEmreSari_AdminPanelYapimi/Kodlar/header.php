<link rel="stylesheet" type="text/css" href="css/header.css"><!-- Css'i farklı bir dosyada oluşturduk burada da çağırıyoruz -->
<!-- css.gg -->
<!-- ******************************** Header Start ***************************************** -->

<div class="header">
      
  <div class="header-left">

    <div class="header-logo">
      <a href ="index.php" ><img src="images/sdeals.png" alt=""></a>
    </div>

    <div class="header-items">
      <ul>
        <a href ="index.php" ><li>Home</li></a>
      </ul>  
    </div>
    
  </div>
    
  <div class="search">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" name="" id="search-input" value="" placeholder="Search Game">
    <div class="search-results">

      <!-- <div class="search-result-item anim-hover-bright">
        <div class="result-item-image">
          <img src="images/mbbannerlord-h.jpg" alt="">
        </div>
        <div class="result-item-name">
        Amnesia: The Dark Descent
        </div>
        <div class="result-item-price">
          <h5>99.99$</h5>
          <h3>19.99$</h3>
        </div>
      </div> -->


      <!-- <div class="search-result-item anim-hover-bright">
        <div class="result-item-no-result">
          No Result Found
        </div>
      </div>  -->


    </div>
  </div>
  
</div>


<script>

  $('#search-input').on("input", function(e) {
    e.stopPropagation(); // this stops the event from bubbling up to the body


    var searchValue = this.value;

    if(searchValue.trim() == ""){
      $(".search-results").hide();
      $(".search-results").html("");
      
    }

    post_data = {
        'search' : 1,
        'search-value' : searchValue,
      };


    $.ajax({
        type: "POST",
        url: 'ajax/ajax-search.php',
        data:  post_data,
        success: function(result) {
          
          if(searchValue.trim() != "")
            $(".search-results").show();
          // console.log(result);

          $(".search-results").html(result);

        }
      });

  });

  $(document).mouseup(function(e) 
  {
      var container =$('#search-input');
      var container1 =$('.search-results ');

      // if the target of the click isn't the container nor a descendant of the container
      if ((!container.is(e.target) && container.has(e.target).length === 0) && (!container1.is(e.target) && container1.has(e.target).length === 0)) 
      {
        $(".search-results").html("");
      }
  });


</script>



<!-- ******************************** Header End ***************************************** -->
