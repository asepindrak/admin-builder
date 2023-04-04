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

                  <div class="card-body">
                  <?php if(isset($tables[$model]["filters"])){ ?>
                    <form action="<?=$actual_link?>" method="post" class="p-3">
                        <h6>Filter</h6>
                        <?php foreach($tables[$model]["filters"] as $row) { ?>
                          <div class="form-group mt-3">
                            <input type="text" name="<?=$row?>" class="form-control" placeholder="<?=$row?>..." />
                          </div>
                        <?php } ?>
                      
                      <div class="mt-3 form-group">
                          <button class="btn btn-primary">Filter</button>
                      </div>
                    </form>
                  <?php } ?>

                    <table class="table table-borderless datatable mt-3">
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
                            <?php if(isset($tables[$model]["types"])){ ?>
                              <?php if(isset($tables[$model]["types"][$row_model])){ ?>
                                <?php if($tables[$model]["types"][$row_model]=='image'){ ?>
                                  <td scope="col">
                                    <a href="<?=$row[$row_model]?>" target="_new">
                                        <img src="<?=$row[$row_model]?>" width="50" height="50" />
                                    </a>
                                  </td>
                                <?php } else { ?>
                                  <td scope="col"><?=$row[$row_model]?></td>
                                <?php } ?>
                              <?php } else { ?>
                                <td scope="col"><?=$row[$row_model]?></td>
                              <?php } ?>
                                
                            <?php } else { ?>
                            <td scope="col"><?=$row[$row_model]?></td>
                            <?php } ?>
                          <?php } ?>

                          <!-- is edit -->
                          <?php if($tables[$model]["isEdit"]===true){ ?>
                            <td scope="col">
                              <button class="btn btn-success">
                                <i class="bi bi-pencil"></i>
                              </button>
                            </td>
                          <?php } ?>

                          <!-- is trash -->
                          <?php if($tables[$model]["isTrash"]===true){ ?>
                            <td scope="col">
                              <button class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                              </button>
                            </td>
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