<?php
  require 'components/head2.php';
?>

    <main id="main" class="main">

      <div class="pagetitle">
        <h1><?=$title?></h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active"><?=$title?></li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <section class="section dashboard">
        <div class="row">
          <?php if(isset($model)){ ?>


              <!-- Recent Sales -->
              <div class="col-12">
                <div class="card recent-sales overflow-auto">

                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                      </li>

                      <li><a class="dropdown-item" href="#">Today</a></li>
                      <li><a class="dropdown-item" href="#">This Month</a></li>
                      <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                  </div>

                  <div class="card-body">

                    <table class="table table-borderless datatable">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <?php foreach($tables[$model]["titles"] as $row) { ?>
                            <th scope="col"><?=$row?></th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1; while($row = $result->fetch_array(MYSQLI_ASSOC)){ ?>
                        <tr>
                          <td><?=$no?></td>
                          <?php foreach($tables[$model]["models"] as $row_model) { ?>
                            <td scope="col"><?=$row[$row_model]?></td>
                          <?php } ?>
                        </tr>
                        <?php $no++; } ?>
                      </tbody>
                    </table>

                  </div>

                </div>
              </div><!-- End Recent Sales -->


              
          <?php } ?>
              

        </div>
      </section>

    </main><!-- End #main -->
    

  <?php require 'components/footer2.php'; ?>