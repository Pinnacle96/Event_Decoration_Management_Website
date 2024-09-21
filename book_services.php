<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
{
    $bid=$_GET['bookid'];
    $name=$_POST['name'];
    $mobnum=$_POST['contact'];
    $email=$_POST['email'];
    $edate=$_POST['eventdate'];
    $est=$_POST['est'];
    $eetime=$_POST['eetime'];
    $vaddress=$_POST['address'];
    $eventtype=$_POST['eventtype'];
    $addinfo=$_POST['info'];
    $bookingid=mt_rand(100000000, 999999999);
    $sql="insert into tblbooking(BookingID,ServiceID,Name,MobileNumber,Email,EventDate,EventStartingtime,EventEndingtime,VenueAddress,EventType,AdditionalInformation)values(:bookingid,:bid,:name,:mobnum,:email,:edate,:est,:eetime,:vaddress,:eventtype,:addinfo)";
    $query=$dbh->prepare($sql);
    $query->bindParam(':bookingid',$bookingid,PDO::PARAM_STR);
    $query->bindParam(':bid',$bid,PDO::PARAM_STR);
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    $query->bindParam(':mobnum',$mobnum,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':edate',$edate,PDO::PARAM_STR);
    $query->bindParam(':est',$est,PDO::PARAM_STR);
    $query->bindParam(':eetime',$eetime,PDO::PARAM_STR);
    $query->bindParam(':vaddress',$vaddress,PDO::PARAM_STR);
    $query->bindParam(':eventtype',$eventtype,PDO::PARAM_STR);
    $query->bindParam(':addinfo',$addinfo,PDO::PARAM_STR);

    $query->execute();
    $LastInsertId=$dbh->lastInsertId();
    if ($LastInsertId>0) {
        echo '<script>alert("Your Booking Request Has Been Send. We Will Contact You Soon")</script>';
        echo "<script>window.location.href ='services.php'</script>";
    }
    else
    {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

}
?>

<?php include("includes/header.php");?> 

<!-- Page Title -->
<div class="page-title light-background">
  <div class="container d-lg-flex justify-content-between align-items-center">
    <h1 class="mb-2 mb-lg-0">Book Services</h1>
    <nav class="breadcrumbs">
      <ol>
        <li><a href="index.php">Home</a></li>
        <li class="current">Book Services</li>
      </ol>
    </nav>
  </div>
</div><!-- End Page Title -->

<!-- Booking Section -->
<section id="book-services" class="contact section">

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4">

      <div class="col-lg-8">
        <div class="contact-wrap w-100 p-md-5 p-4">
          <h3 class="mb-4">Book Service</h3>
          <form method="POST" id="contactForm" name="contactForm" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4">

              <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Full Name" required="">
              </div>

              <div class="col-md-6">
                <input type="email" class="form-control" name="email" placeholder="Email Address" required="">
              </div>

              <div class="col-md-6">
                <input type="text" class="form-control" name="contact" placeholder="Contact No" required="">
              </div>

              <div class="col-md-6">
                <input type="date" class="form-control" name="eventdate" placeholder="" required="">
              </div>

              <div class="col-md-6">
                <select class="form-control" name="est" required="">
                  <option value="">Select Starting Time</option>
                  <?php for ($i = 1; $i <= 12; $i++): ?>
                    <option value="<?php echo $i; ?> a.m"><?php echo $i; ?> a.m</option>
                  <?php endfor; ?>
                  <?php for ($i = 1; $i <= 12; $i++): ?>
                    <option value="<?php echo $i; ?> p.m"><?php echo $i; ?> p.m</option>
                  <?php endfor; ?>
                </select>
              </div>

              <div class="col-md-6">
                <select class="form-control" name="eetime" required="">
                  <option value="">Select Finish Time</option>
                  <?php for ($i = 1; $i <= 12; $i++): ?>
                    <option value="<?php echo $i; ?> a.m"><?php echo $i; ?> a.m</option>
                  <?php endfor; ?>
                  <?php for ($i = 1; $i <= 12; $i++): ?>
                    <option value="<?php echo $i; ?> p.m"><?php echo $i; ?> p.m</option>
                  <?php endfor; ?>
                </select>
              </div>

              <div class="col-md-12">
                <textarea class="form-control" name="address" rows="4" placeholder="Venue Address" required=""></textarea>
              </div>

              <div class="col-md-12">
                <select class="form-control" name="eventtype" required="">
                  <option value="">Choose Event Type</option>
				  <?php 
                            $sql2 = "SELECT * from tbleventtype";
                            $query2 = $dbh->prepare($sql2);
                            $query2->execute();
                            $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
                            foreach ($result2 as $row) {          
                          ?>  
                          <option value="<?php echo htmlentities($row->EventType); ?>"><?php echo htmlentities($row->EventType); ?></option>
                          <?php } ?>
                </select>
              </div>

              <div class="col-md-12">
                <textarea class="form-control" name="info" rows="4" placeholder="Additional Information"></textarea>
              </div>

              <div class="col-md-12 text-center">
          <button type="submit"  name="submit">Book</button>
              </div>

            </div>
          </form>
        </div>
      </div><!-- End Booking Form -->

      <div class="col-lg-4">
        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
          <img src="assets/img/7.jpg" alt="Booking Image" style="width: 100%; height: auto; border-radius: 8px;">
        </div><!-- End Info Item -->
      </div><!-- End Info Column -->

    </div><!-- End Row -->

  </div>

</section><!-- End Booking Section -->

<?php include("includes/footer.php");?>

