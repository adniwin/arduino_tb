<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title><?= $title_page ?></title>
        <?php
        $this->load->view('admin/static/files');
        $this->load->view('admin/static/table');
        ?>
    </head>
    <?php
    $this->load->view('admin/include/function');
    $this->load->view('admin/include/modal');
    $this->load->view('admin/include/top_menu');
    $this->load->view('admin/include/sidebar_menu');
    ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?= $title_page ?>
                            </h2>
                        </div>
                        <div class="body">
                          <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#value" data-toggle="tab" aria-expanded="true">Sensor Values</a></li>
                                <li role="presentation" class=""><a href="#prediction" data-toggle="tab" aria-expanded="false">Prediction</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="value">
                                  <small>
                                      <table class="table table-bordered table-striped table-hover dataTable table1">
                                          <thead>
                                              <tr>
                                                  <th>#</th>
                                                  <th>Temperature</th>
                                                  <th>Humidity</th>
                                                  <th>Light</th>
                                                  <th>Date</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php
                                              $no = 1;
                                              if ($sensor_values != "") {
                                                  foreach ($sensor_values as $item) {
                                                      echo "<tr>";
                                                      echo "<td>$no</td>";
                                                      echo "<td>$item->suhu</td>";
                                                      echo "<td>$item->kelembapan</td>";
                                                      echo "<td>$item->cahaya</td>";
                                                      echo "<td>$item->waktu</td>";
                                                      $no++;
                                                  }
                                              } else {
                                                  echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
                                              }
                                              ?>
                                          </tbody>
                                      </table>
                                  </small>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="prediction">
                                  <small>
                                      <table class="table table-bordered table-striped table-hover dataTable table1">
                                          <thead>
                                              <tr>
                                                  <th>#</th>
                                                  <th>Temperature</th>
                                                  <th>Humidity</th>
                                                  <th>Light</th>
                                                  <th>Prediction</th>
                                                  <th>Time</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php
                                              $no = 1;
                                              if ($prediction_values != "") {
                                                  foreach ($prediction_values as $item) {
                                                      echo "<tr>";
                                                      echo "<td>$no</td>";
                                                      echo "<td>$item->temperature</td>";
                                                      echo "<td>$item->humidity</td>";
                                                      echo "<td>$item->light</td>";
                                                      echo "<td>$item->prediction</td>";
                                                      echo "<td>$item->time</td>";
                                                      $no++;
                                                  }
                                              } else {
                                                  echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
                                              }
                                              ?>
                                          </tbody>
                                      </table>
                                  </small>
                                </div>

                            </div>
                        </div>
                        <!-- #END# Widgets -->
                        <!-- CPU Usage -->

                    </div>

                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
        <!-- Exportable Table -->
    </section>

    <script>
        var table = function () {
            $('.table1').DataTable({
                "dom": 'Bfrtip',
                "buttons": [
                    'copy', 'excel', 'pdf', 'print'
                ],
            });

        }
        table();
//        setInterval(function () {
//            table();
////                chart.render();
//        }, 1000);
    </script>
    <?php $this->load->view('admin/include/footer_menu'); ?>

</html>
