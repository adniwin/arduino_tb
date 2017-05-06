<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title><?= $title_page ?></title>
        <?php $this->load->view('admin/static/files'); ?>
        <script src="<?= BACKEND_STATIC_FILES ?>plugins/chartjs/canvasjs.min.js"></script>
    </head>

    <?php
    $this->load->view('admin/include/function');
    $this->load->view('admin/include/modal');
    $this->load->view('admin/include/top_menu');
    $this->load->view('admin/include/sidebar_menu');
    ?>
    <section class="content">
        <div class="container-fluid">
            <!-- Widgets -->
            <div class="row clearfix " style="margin-bottom: 420px;">
                <div id="chartContainer" ></div>
            </div>

            <div class="row">
                <div class="card">
                    <div class="body ">
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-info btn-lg" onclick="predictModal()">Click here to predict </button>
                            </div>
                            <div class="col-md-6 text-right font-18">
                              <?php
                                if ($last_predict) {
                                    $predict = $last_predict->prediction.'('.$last_predict->time.')';
                                } else {
                                    $predict = "No prediction before";
                                }
                              ?>
                                <font id="predict_result" class="font-bold"><?=  $predict;?></font>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- #END# Widgets -->
        <!-- CPU Usage -->
    </section>

    <!-- Jquery Core Js -->

    <?php $this->load->view('admin/include/footer_menu'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $(function () {
                loadData();
            });
        })
    </script>


</html>
