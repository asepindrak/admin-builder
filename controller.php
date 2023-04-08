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
          <?php if(isset($model) && count($params) == 1){ ?>


              <!-- Recent Sales -->
              <div class="col-12">
                <div class="card recent-sales overflow-auto">

                  <div class="card-body">
                  <a href="<?=$SERVER?>/page/<?=$route?>/create" class="btn btn-primary mt-3"><i class="bi bi-plus"></i> Data Baru</a>
                  <?php if(isset($tables[$model]["filters"])){ ?>
                    <div class="w-25">
                      <form action="<?=$actual_link?>" method="post" class="p-3">
                          <h6>Filter</h6>
                          <?php foreach($tables[$model]["filters"] as $row) { ?>
                            <?php
                              if(is_array($row)){
                                ?>
                                  <div class="form-group mt-3">
                                    <label>Date Range</label>
                                    <div class="input-group mt-3">
                                      <input type="date" name="date_from_<?=$row[0]?>" class="form-control" placeholder="date_from_<?=$row[0]?>..." />
                                      <input type="date" name="date_to_<?=$row[0]?>" class="form-control" placeholder="date_to_<?=$row[0]?>..." />
                                    </div>
                                  </div>
                                <?php
                              } else{
                                ?>
                                  <div class="form-group mt-3">
                                    <input type="text" name="<?=$row?>" class="form-control" placeholder="<?=$row?>..." />
                                  </div>
                                <?php
                              }
                            ?>
                          <?php } ?>
                        
                        <div class="mt-3 form-group">
                            <button class="btn btn-primary"><i class="bi bi-filter"></i> Filter</button>
                        </div>
                      </form>
                    </div>
                  <?php } ?>

                    <table class="table table-borderless datatable mt-3">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <?php foreach($tables[$model]["titles"] as $row) { ?>
                            <th scope="col"><?=$row?></th>
                          <?php } ?>
                          <!-- is edit -->
                          <?php if($tables[$model]["isEdit"]===true){ ?>
                            <th scope="col">Edit</th>
                          <?php } ?>

                          <!-- is trash -->
                          <?php if($tables[$model]["isTrash"]===true){ ?>
                            <th scope="col">Trash</th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if($result) { $no = 1; while($row = $result->fetch_array(MYSQLI_ASSOC)){ ?>
                        <tr>
                          <td><?=$no?></td>
                          <?php foreach($tables[$model]["models"] as $row_model) { ?>
                            <?php
                              if(is_array($row_model)) {
                                ?>
                                <td scope="col">
                                  <?php
                                    $include_model = $row_model['model'];
                                    $datas = json_decode($row[$include_model]);
                                    // var_dump($datas)
                                    $value = $row_model['value'];
                                    echo $datas[0]->$value;
                                  ?>
                                </td>
                                <?php
                                continue;
                              }

                              if(!isset($tables[$model]["types"])){
                                ?><td scope="col"><?=$row[$row_model]?></td><?php
                                continue;
                              }

                              if(isset($tables[$model]["types"])){
                                if(isset($tables[$model]["types"][$row_model])){
                                  if($tables[$model]["types"][$row_model]=='image'){
                                    ?>
                                      <td scope="col">
                                        <a href="<?=$image.$row[$row_model]?>" target="_new">
                                            <img src="<?=$image.$row[$row_model]?>" width="50" height="50" />
                                        </a>
                                      </td>
                                    <?php
                                  } else if($tables[$model]["types"][$row_model]=='password'){
                                    ?><td scope="col">***</td><?php
                                  } else{
                                    ?><td scope="col"><?=$row[$row_model]?></td><?php
                                  }
                                } else{
                                  ?><td scope="col"><?=$row[$row_model]?></td><?php
                                }
                              }
                            ?>
                          <?php } ?>

                          <!-- is edit -->
                          <?php if($tables[$model]["isEdit"]===true){ ?>
                            <td scope="col">
                              <a href="<?=$SERVER?>/page/<?=$route?>/edit/<?=$row['id']?>" class="btn btn-success">
                                <i class="bi bi-pencil"></i>
                              </a>
                            </td>
                          <?php } ?>

                          <!-- is trash -->
                          <?php if($tables[$model]["isTrash"]===true){ ?>
                            <td scope="col">
                              <a href="<?=$SERVER?>/api/v1/delete.php?model=<?=$model?>&route=<?=$route?>&id=<?=$row['id']?>" class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                              </a>
                            </td>
                          <?php } ?>
                        </tr>
                        <?php $no++; } } ?>
                      </tbody>
                    </table>

                  </div>

                </div>
              </div><!-- End Recent Sales -->


              
          <?php } ?>

          <!-- Create Data -->

          <?php if($isCreate){ ?>
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                  <div class="card-body">
                    <!-- form create -->
                    <form class="form-horizontal" role="form" action="<?=$SERVER?>/api/v1/create.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="model" class="form-control mt-2" value="<?=$model?>" />
                        <input type="hidden" name="route" class="form-control mt-2" value="<?=$route?>" />
                        <?php $no=0; foreach($tables[$model]["models"] as $row_model) {
                            $model_column = $row_model;
                            $model_data = "";
                            $model_id = "";
                            $model_value = "";
                            if(is_array($row_model)) {
                              $model_column = array_search ($row_model, $tables[$model]["models"]);
                              $model_data = $tables[$model]["models"][$model_column]['model'];
                              $model_id = $tables[$model]["models"][$model_column]['id'];
                              $model_value = $tables[$model]["models"][$model_column]['value'];
                              require 'api/v1/data.php';
                            }
                        ?>
                          <?php if(isset($tables[$model]["types"])){ ?>
                            <?php if(isset($tables[$model]["types"][$model_column])){ ?>
                              <?php if($tables[$model]["types"][$model_column]=='image'){ ?>
                                  <div class="form-group mt-3">
                                    <label><?=$tables[$model]["titles"][$no]?></label>
                                    <div class="input-group mt-2">
                                      <span class="input-group-addon">
                                        <i class="bi bi-picture"></i>
                                      </span>
                                      <input type="file" name="<?=$model_column?>" class="form-control mt-2" id="<?=$model_column?>" required />
                                    </div>
                                  </div>
                              <?php } else if($tables[$model]["types"][$model_column]=='password'){ ?>
                                <div class="form-group mt-3">
                                  <label><?=$tables[$model]["titles"][$no]?></label>
                                  <input type="password" name="<?=$model_column?>" class="form-control mt-2" id="<?=$model_column?>" required />
                                </div>
                              <?php } else if($tables[$model]["types"][$model_column]=='email'){ ?>
                                <div class="form-group mt-3">
                                  <label><?=$tables[$model]["titles"][$no]?></label>
                                  <input type="email" name="<?=$model_column?>" class="form-control mt-2" id="<?=$model_column?>" required />
                                </div>
                              <?php } else if($tables[$model]["types"][$model_column]=='date'){ ?>
                                <div class="form-group mt-3">
                                  <label><?=$tables[$model]["titles"][$no]?></label>
                                  <input type="date" name="<?=$model_column?>" class="form-control mt-2" id="<?=$model_column?>" required />
                                </div>
                              <?php } else if($tables[$model]["types"][$model_column]=='select'){ ?>
                                <div class="form-group mt-3">
                                  <label><?=$tables[$model]["titles"][$no]?></label>
                                  <select name="<?=$model_column?>" class="form-control mt-2" id="<?=$model_column?>" required>
                                    <option value="">-- Select --</option>
                                    <?php foreach($data as $key => $value){ ?>
                                      <option value="<?=$value[$model_id]?>"><?=$value[$model_value]?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              <?php } else { ?>
                                <div class="form-group mt-3">
                                  <label><?=$tables[$model]["titles"][$no]?></label>
                                  <input type="text" name="<?=$model_column?>" class="form-control mt-2" id="<?=$model_column?>" required />
                                </div>
                              <?php } ?>
                            <?php } else { ?>
                              <div class="form-group mt-3">
                                <label><?=$tables[$model]["titles"][$no]?></label>
                                <input type="text" name="<?=$model_column?>" class="form-control mt-2" id="<?=$model_column?>" required />
                              </div>
                            <?php } ?>
                              
                          <?php } else { ?>
                            <div class="form-group mt-3">
                              <label><?=$tables[$model]["titles"][$no]?></label>
                              <input type="text" name="<?=$model_column?>" class="form-control mt-2" id="<?=$model_column?>" required />
                            </div>
                          <?php } ?>
                        <?php $no++; } ?>

                        <div class="form-group mt-3 row">
                          <div class="col">
                            <a href="<?=$SERVER?>/page/<?=$route?>" class="btn btn-danger"><i class="bi bi-arrow-left"></i> Kembali</a>
                          </div>
                          <div class="col">
                            <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                          </div>
                        </div>

                    </form>
                  </div>
                </div>
            </div>
          <?php } ?>

          <!-- End Create Data -->

          <!-- Edit Data -->

          <?php if($isEdit){ $edit_data = $result->fetch_array(MYSQLI_ASSOC); 
          ?>
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                  <div class="card-body">
                    <!-- form create -->
                    <form class="form-horizontal" autocomplete="off" role="form" action="<?=$SERVER?>/api/v1/update.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="model" class="form-control mt-2" value="<?=$model?>" />
                        <input type="hidden" name="route" class="form-control mt-2" value="<?=$route?>" />
                        <input type="hidden" name="id" class="form-control mt-2" value="<?=$id?>" />
                        <?php $no=0; foreach($tables[$model]["models"] as $row_model) {
                            $model_column = $row_model;
                            $model_data = "";
                            $model_id = "";
                            $model_value = "";
                            if(is_array($row_model)) {
                              $model_column = array_search ($row_model, $tables[$model]["models"]);
                              $model_data = $tables[$model]["models"][$model_column]['model'];
                              $model_id = $tables[$model]["models"][$model_column]['id'];
                              $model_value = $tables[$model]["models"][$model_column]['value'];
                              require 'api/v1/data.php';
                              
                                            
                              $include_model = $row_model['model'];
                              $datas = json_decode($edit_data[$include_model]);
                              // var_dump($datas)
                              $value = $row_model['value'];
                              $edit_id = $row_model['id'];

                            }

                            
                        ?>
                          <?php if(isset($tables[$model]["types"])){ ?>
                            <?php if(isset($tables[$model]["types"][$model_column])){ ?>
                              <?php if($tables[$model]["types"][$model_column]=='image'){ ?>
                                  <div class="form-group mt-3">
                                    <label><?=$tables[$model]["titles"][$no]?></label>
                                    <div class="input-group mt-2">
                                      <span class="input-group-addon">
                                        <i class="bi bi-picture"></i>
                                      </span>
                                      <input type="file" name="<?=$model_column?>" class="form-control mt-2" id="<?=$model_column?>" />
                                    </div>
                                  </div>
                              <?php } else if($tables[$model]["types"][$model_column]=='password'){ ?>
                                <div class="form-group mt-3">
                                  <label><?=$tables[$model]["titles"][$no]?></label>
                                  <input type="password" name="<?=$model_column?>" class="form-control mt-2" id="<?=$model_column?>" />
                                </div>
                              <?php } else if($tables[$model]["types"][$model_column]=='email'){ ?>
                                <div class="form-group mt-3">
                                  <label><?=$tables[$model]["titles"][$no]?></label>
                                  <input type="email" name="<?=$model_column?>" class="form-control mt-2" id="<?=$model_column?>" value="<?=$edit_data[$row_model]?>" required />
                                </div>
                              <?php } else if($tables[$model]["types"][$model_column]=='date'){ ?>
                                <div class="form-group mt-3">
                                  <label><?=$tables[$model]["titles"][$no]?></label>
                                  <input type="date" name="<?=$model_column?>" class="form-control mt-2" id="<?=$model_column?>" value="<?=$edit_data[$row_model]?>" required />
                                </div>
                              <?php } else if($tables[$model]["types"][$model_column]=='select'){ ?>
                                <div class="form-group mt-3">
                                  <label><?=$tables[$model]["titles"][$no]?></label>
                                  <select name="<?=$model_column?>" class="form-control mt-2" id="<?=$model_column?>" value="<?=$datas[0]->$edit_id?>" required>
                                    <option value="">-- Select --</option>
                                    <?php foreach($data as $key => $value){ ?>
                                      <option value="<?=$value[$model_id]?>" <?php if($datas[0]->$edit_id == $value[$model_id]){ echo "selected"; }?>><?=$value[$model_value]?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              <?php } else { ?>
                                <div class="form-group mt-3">
                                  <label><?=$tables[$model]["titles"][$no]?></label>
                                  <input type="text" name="<?=$model_column?>" class="form-control mt-2" id="<?=$model_column?>" value="<?=$edit_data[$row_model]?>" required />
                                </div>
                              <?php } ?>
                            <?php } else { ?>
                              <div class="form-group mt-3">
                                <label><?=$tables[$model]["titles"][$no]?></label>
                                <input type="text" name="<?=$model_column?>" class="form-control mt-2" id="<?=$model_column?>" value="<?=$edit_data[$row_model]?>" required />
                              </div>
                            <?php } ?>
                              
                          <?php } else { ?>
                            <div class="form-group mt-3">
                              <label><?=$tables[$model]["titles"][$no]?></label>
                              <input type="text" name="<?=$model_column?>" class="form-control mt-2" id="<?=$model_column?>" value="<?=$edit_data[$row_model]?>" required />
                            </div>
                          <?php } ?>
                        <?php $no++; } ?>

                        <div class="form-group mt-3 row">
                          <div class="col">
                            <a href="<?=$SERVER?>/page/<?=$route?>" class="btn btn-danger"><i class="bi bi-arrow-left"></i> Kembali</a>
                          </div>
                          <div class="col">
                            <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                          </div>
                        </div>

                    </form>
                  </div>
                </div>
            </div>
          <?php } ?>

          <!-- End Edit Data -->
              

        </div>
      </section>

    </main><!-- End #main -->
    

  <?php require 'components/footer2.php'; ?>