
<?php
session_start();
error_reporting(0);

include('includes/dbconnection.php');
?>
<?php include("includes/header.php");?> 

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Services</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Services</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Pricing Section -->
    <section id="pricing" class="pricing section">

      <div class="container">

        <div class="row gy-3">
        <?php
      $sql="SELECT * from tblservice";
      $query = $dbh -> prepare($sql);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);

      $cnt=1;
      if($query->rowCount() > 0)
      {
        foreach($results as $row)
        {  
          ?>

          <div class="col-xl-3 col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="pricing-item">
              <h3><?php  echo htmlentities($row->ServiceName);?></h3>
              <h5 class="btn-buy"><sup>&#8358;</sup><?php  echo htmlentities($row->ServicePrice);?></h5>
              <p><?php  echo htmlentities($row->SerDes);?></p>
              <div class="btn-wrap">
              <a href="book_services.php?bookid=<?php echo $row->ID;?>" class="btn-buy">Book Now</a>
              </div>
            </div>
          </div><!-- End Pricing Item -->
          <?php 
          $cnt=$cnt+1;
        }
      } ?>
        </div>

      </div>

    </section><!-- /Pricing Section -->

    <?php include("includes/footer.php");?> 