<?php

include_once 'includes/dbh.inc.php';

if ( isset($_POST['filter'])) {
  if (isset($_POST['categories'])) {
    $categories = $_POST['categories'];
    $clean_categories = array_map('intval', $categories);
    $category_condition = implode(', ', $clean_categories);
  
    $query_category = "SELECT * FROM produits WHERE id_categorie IN ($category_condition)";
  }



  

}else {
  $query_category = "SELECT * FROM produits ";

}

$stmt = $conn->query($query_category);
    
$userdata = $stmt->fetchall();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
      <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
          <div class="container-fluid">
            <button
              class="navbar-toggler"
              type="button"
              data-mdb-toggle="collapse"
              data-mdb-target="#navbarExample01"
              aria-controls="navbarExample01"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarExample01">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item active">
                  <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="produit.php">produits</a>
                </li>
                <?php 

                  if (isset($_POST["out"])) {
                    session_destroy();
                    header("location: index.php");
                    exit();
                  }



                  if (!empty($_SESSION["userName"])) {
                
                ?>
             <form method="post">
             <li class="nav-item">
                  <button type="submit" class="nav-link" name="out" >sign out</button>
                </li>
             </form>
                <?php     
                  } 
            
                  
                  
                  
                  ?>
              </ul>
            </div>
          </div>
        </nav>
        <!-- Navbar -->
      
      </header>


    <main> 

    <section style="background-color: #eee;">
      <div class="text-center container py-5">
        <h4 class="mt-4 mb-5"><strong>OUR PRODUCTS</strong></h4>
        
        <form method="post" class="mb-5">
      <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
  <input type="checkbox" name ="categories[]" value = "1" class="btn-check" id="btncheck1" autocomplete="off">
  <label class="btn btn-outline-primary"  for="btncheck1">Téléphones & Tablettes</label>

  <input type="checkbox" name ="categories[]"  value = "2" class="btn-check" id="btncheck2" autocomplete="off">
  <label class="btn btn-outline-primary" for="btncheck2">Appareils Électroménagers</label>

  <input type="checkbox" name ="categories[]" value = "3" class="btn-check" id="btncheck3" autocomplete="off">
  <label class="btn btn-outline-primary"  for="btncheck3">Accessoires Tech</label>

  <input type="checkbox" name ="categories[]" value = "4" class="btn-check" id="btncheck4" autocomplete="off">
  <label class="btn btn-outline-primary"  for="btncheck4">Technologie Spécialisée</label>

  <button type="submit" name ="filter" class="btn btn-primary">appliquer</button>
</div>
      </form>


      <div class="row">

      <?php 
            if(!empty($userdata)){
              foreach($userdata as $row){

          
          ?>
        <div class="col-lg-4 col-md-12 mb-4">
          <div class="card">
            <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
            data-mdb-ripple-color="light">
              <img src="<?php echo $row["image"] ?>"
              class="w-100" />
              <a href="#!">
              <div class="mask">
                <div class="d-flex justify-content-start align-items-end h-100">
                  <h5><span class="badge bg-primary ms-2">New</span></h5>
                </div>
              </div>
              <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
            </div>
            </a>
          </div>
       
          <div class="card-body">
            <a href="" class="text-reset">
              <h5 class="card-title mb-3"><?php echo $row["libelle"] ?></h5>
            </a>
            <a href="" class="text-reset">
              <p>Quantité stock : <?php echo $row["quantite_stock"] ?></p>
            </a>
            <h6 class="mb-3">Prix : <?php echo $row["prix_unitaire"] ?></h6>
          </div>
        </div>
      </div>
<?php 
    }
  }
?>
     
</section>
    </main>
     
    
    
    <footer class="bg-dark text-center text-white">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
          <!-- Section: Social media -->
          <section class="mb-4">
            <!-- Facebook -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
              ><i class="fab fa-facebook-f"></i
            ></a>
      
            <!-- Twitter -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
              ><i class="fab fa-twitter"></i
            ></a>
      
            <!-- Google -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
              ><i class="fab fa-google"></i
            ></a>
      
            <!-- Instagram -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
              ><i class="fab fa-instagram"></i
            ></a>
      
            <!-- Linkedin -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
              ><i class="fab fa-linkedin-in"></i
            ></a>
      
            <!-- Github -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
              ><i class="fab fa-github"></i
            ></a>
          </section>
          <!-- Section: Social media -->
        </div>
        <!-- Grid container -->
      
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
          © 2020 Copyright:
          
        </div>
        <!-- Copyright -->
      </footer>
      <script src="https://kit.fontawesome.com/e9ea9ee727.js" crossorigin="anonymous"></script>
</body>
</html>