
  <?php
    require 'config/config.php';
  ?>
  
    <!-- loading block -->
    <div id="loading">
        <span class="loading"></span>
    </div>


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?=$PATH?>assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?=$PATH?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=$PATH?>assets/vendor/chart.js/chart.umd.js"></script>
    <script src="<?=$PATH?>assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?=$PATH?>assets/vendor/quill/quill.min.js"></script>
    <script src="<?=$PATH?>assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?=$PATH?>assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?=$PATH?>assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?=$PATH?>assets/js/main.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
          $('#select').select2();
      });
    </script>

    <script>
      $(document).ready(function() {
          $("#loading").removeClass("hidden").addClass("hidden");
      });

      $('form').submit(function(){
          $('button').prop("disabled", true);
          $("#loading").removeClass("hidden");
      });

      function resetForm(url) {
          $('button').prop("disabled", true);
          $("#loading").removeClass("hidden");
          document.location.href=url;
      }
    </script>
  </body>

  </html>