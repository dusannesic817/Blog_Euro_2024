<?php
require_once 'inc/header.php';
require_once 'app/classes/Home.php';

$home = new Home();

$page = isset($_GET['page']) ? $_GET['page'] : 1; 
$perPage = 4; 


$index = $home->index($page, $perPage);

?>
<?php if(isset($_SESSION['success_reg']) || isset($_SESSION['login_success']) || isset($_SESSION['success_delete'])): ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <?php 
  if(isset($_SESSION['success_reg'])){
    echo $_SESSION['success_reg'];
    unset($_SESSION['success_reg']);
  } elseif(isset($_SESSION['login_success'])){
    echo $_SESSION['login_success'];
    unset($_SESSION['login_success']);
  } elseif(isset($_SESSION['success_delete'])){
    echo $_SESSION['success_delete'];
    unset($_SESSION['success_delete']);
  }
  ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif; ?>

<div class="container mt-5">

  <div class="row mb-3">
    <div id="myModal"></div>
    <div class="col-md-12">
      <h3 class=" ml-2">Top Topics</h3>
    </div>
  </div>

  <div class="row mt-2">
    <div class="col-md-12">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <?php
          $first = true;
          foreach ($index as $value) {
          ?>
          <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
            <a href="show_post.php?id=<?php echo $value['id'] ?>">
              <img class="d-block w-100" src="public/images/euro_finalists.jpeg" alt="Slide">
            </a>
          </div>
          <?php
            $first = false;
          }
          ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
  </div>
    <div class="container-fluid" style="background-color:#f1f3f8;">
      <div class="container">
      <div class="row gy-3 mt-5">
            <div class="col-md-12" style="margin-top:5rem;">
                <h3 class="mb-5 ml-2" >Event Guide</h3>
            </div>
            <div class="col-md-12 d-flex">
                    <div class="card mr-3" style="width: 20rem;">
                        <a href="https://www.uefa.com/euro2024/event-guide/berlin/" target="blank" class="image-zoom"><img src="public/images/cities/berlin.png" class="card-img-top img-fluid" alt="..."></a>
                    </div>
                
                    <div class="card mr-3" style="width: 20rem;">
                        <a href="https://www.uefa.com/euro2024/event-guide/cologne/" target="blank" class="image-zoom"><img src="public/images/cities/cologne.png" class="card-img-top img-fluid" alt="..."></a>
                    </div>
                <div class="card mr-3" style="width: 20rem;">
                    
                        <a  href="https://www.uefa.com/euro2024/event-guide/dusseldorf/" target="blank" class="image-zoom"><img src="public/images/cities/dusseldorf.png" class="card-img-top img-fluid" alt="..."></a>
                   
                </div>
                <div class="card mr-3" style="width: 20rem;">
                    
                        <a href="https://www.uefa.com/euro2024/event-guide/dortmund/" target="blank" class="image-zoom"><img src="public/images/cities/dortmund.png" class="card-img-top img-fluid" alt="..."></a>
                   
                </div>
                <div class="card mr-3" style="width:20rem;">
                    
                        <a href="https://www.uefa.com/euro2024/event-guide/frankfurt/" target="blank" class="image-zoom"><img src="public/images/cities/frankfurt.png" class="card-img-top img-fluid" alt="..."></a>
                    
                </div>
                
            </div>
        </div>
        <div class="row  mt-3" style="padding-bottom:85px">
            <div class="col-md-12 d-flex">
                    <div class="card mr-3" style="width: 20rem;">
                        <a  href="https://www.uefa.com/euro2024/event-guide/gelsenkirchen/" target="blank" class="image-zoom"><img src="public/images/cities/gelsenkirchen.png" class="card-img-top img-fluid" alt="..."></a>
                    </div>
                
                <div class="card mr-3" style="width: 20rem;">
                    <a  href="https://www.uefa.com/euro2024/event-guide/hamburg/" target="blank" class="image-zoom"><img src="public/images/cities/hamburg.png" class="card-img-top img-fluid" alt="..."></a>
                </div>
                <div class="card mr-3" style="width: 20rem;">
                    
                       <a  href="https://www.uefa.com/euro2024/event-guide/leipzig/" target="blank" class="image-zoom"> <img src="public/images/cities/leipzig.png" class="card-img-top img-fluid" alt="..."></a>
                   
                </div>
                <div class="card mr-3" style="width: 20rem;">
                    
                        <a  href="https://www.uefa.com/euro2024/event-guide/munich/" target="blank" class="image-zoom"><img src="public/images/cities/munich.png" class="card-img-top img-fluid" alt="..."></a>
                    
                </div>
                <div class="card mr-3" style="width:20rem;">
                    
                        <a  href="https://www.uefa.com/euro2024/event-guide/stuttgart/" target="blank" class="image-zoom"><img src="public/images/cities/stuttgart.png" class="card-img-top img-fluid" alt="..."></a>
                    
                </div>
                
            </div>
        </div>

        </div>
    </div>
<div class="container">
  <div class="row mt-5">
    <div class="col-md-12">
      <h3 class="ml-2">Euro Topics</h3>
    
    </div>
  </div>

  <div class="row mt-5 card-container justify-content-center" id="cardContainer">
    <?php
    foreach ($index as $value) {
      $time = strtotime($value['created_at']);
      $format_date = date('j M, Y', $time);
    ?>
      <div class="col-12 col-md-6" style='margin-bottom: 100px;'>
        <div class="card h-100">
          <div class="card-header bg-transparent">
            <small><?php echo $format_date ?> | </small>
            <small>By <a href="show_profile.php?id=<?php echo $value['user_id'] ?>"><?php echo $value['name'] . ' ' . $value['surname'] ?></a></small>
          </div>
          <?php if ($value['img'] == NULL) { ?>
            <img class="card-img-top" src="public/images/euro_finalists.jpeg" alt="Card image cap">
          <?php } else { ?>
            <img class="card-img-top" src="public/images/<?php echo $value['img'] ?>" alt="Card image cap">
          <?php } ?>
          <div class="card-body">
            <h5 class="card-text"><?php echo $value['title'] ?></h5>
            <p id="short-text" class="card-text short-text"><?php echo $value['text'] ?></p>
            <div><a href="show_post.php?id=<?php echo $value['id'] ?>" class="btn btn-link" style="text-decoration: none;">READ MORE</a></div>
          </div>
          <div class="card-footer bg-transparent d-flex align-items-end justify-content-end">
            <small style="margin-right: 0.5rem;">Like(<?php echo $value['count_mark_1'] ?>)</small>
            <small> Dislike (<?php echo $value['count_mark_0'] ?>)</small>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

  <div class="row mt-3 mb-5">
    <div class="col-md-12 text-center">
      <button id="loadMoreButton" class="btn btn-link" style="text-decoration: none;"><h5>Load More</h5></button>
    </div>
  </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  var currentPage = <?php echo $page; ?>; 
  var perPage = <?php echo $perPage; ?>; 
  var loading = false; 
 
  function loadMoreCards() {
    if (loading) return; 

    loading = true; 

    var xhr = new XMLHttpRequest();
    var url = 'load_more_index.php?page=' + (currentPage + 1) + '&perPage=' + perPage; 
    xhr.open('GET', url, true);

    xhr.onload = function() {
      if (xhr.status === 200) {
        var newCards = xhr.responseText;      
        var cardContainer = document.getElementById('cardContainer');
    
        cardContainer.insertAdjacentHTML('beforeend', newCards);       
        currentPage++;

        loading = false; 
      } 
    };

    xhr.send();
  }
  
  var loadMoreButton = document.getElementById('loadMoreButton');
  loadMoreButton.addEventListener('click', function() {
    loadMoreCards();
  });
});
</script>

<?php
require_once 'inc/footer.php';
?>
