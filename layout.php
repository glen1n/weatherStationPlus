<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Weather Station Plus</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS for the 'Heroic Features' Template -->
    <link href="css/heroic-features.css" rel="stylesheet">

    <!-- Custom CSS for this page -->
    <link href="css/weatherStation.css" rel="stylesheet">

<script src="http://d3js.org/d3.v3.js"></script>
    <script type="text/javascript" src="js/gauge.js"></script>
    <script type="text/javascript" src="js/gaugeConfig.js"></script>

</head>

<body onload="initialize()">

    <div class="container">

        <div class="jumbotron hero-spacer">
            <div class="row topControls">
                <div class="col-sm-4">
                    <p> Data last updated: <span class="lastUpdateTimeStamp"> Time </span></p>
                </div>
                <div class="col-sm-4">
                    <p><span></span></p>
                    <h2>Weather Station +</h2>
                </div>
                <div class="col-sm-4">
                    <p><a class="navbar-brand" href="index.php">Update Data Now</a></p>
                </div>
            </div>
        </div>

        <div class="jumbotron hero-spacer">
            <div class="row">
                <div class="col-sm-4">
                    <p><span id="temperatureGaugeContainer"></span></p>
                    <h2>Temperature</h2>
                </div>
                <div class="col-sm-4">
                    <p><span id="humidityGaugeContainer"></span></p>
                    <h2>Humidity</h2>
                </div>
                <div class="col-sm-4">
                    <p><span id="barometerGaugeContainer"></span></p>
                    <h2>Barometer</h2>
                </div>
            </div>
        </div>

        <hr>

<!--         <div class="row">
            <div class="col-lg-12">
                <h3>Graphs</h3>
            </div>
        </div> -->
        <!-- /.row -->

        <div class="row text-center">
            <div class="col-lg-3 col-md-6 hero-feature">
                <div class="thumbnail">
                    <!-- <div id="temperatureGraph" style="min-width: 253px; height: 229px; margin: 0 auto"></div> -->
                    <div id="temperatureGraph"></div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 hero-feature">
                <div class="thumbnail">
                    <!-- <div id="humidityGraph" style="min-width: 253px; height: 229px; margin: 0 auto"></div> -->
                    <div id="humidityGraph"></div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 hero-feature">
                <div class="thumbnail">
                    <!-- <div id="barometricGraph" style="min-width: 253px; height: 229px; margin: 0 auto"></div> -->
                    <div id="barometricGraph"></div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 hero-feature">
                <div class="thumbnail">
                    <div id="pirGraph"></div>
                </div>
            </div>

        </div>
        <!-- /.row -->

        <div class="row controls-bottom">

            <div class="col-lg-3 col-md-6 hero-feature">
                <div class="thumbnail">
                    <div class="caption myDiv">
                        <form action="">
                            <input type="checkbox" name="beeper" value="Beep">Beeper On<br>
                        </form>
                        <h3>Beeper Control</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 hero-feature">
                <div class="thumbnail">
                    <form action="">
                        <input type="checkbox" name="light" value="Light">Light On
                    </form>
                    <div class="caption">
                        <h3>Light Control</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 hero-feature">
                <div class="thumbnail">
                    <form action="">
                        <input type="checkbox" name="alarm" value="Alarm">Sound Alarm  
                    </form>
                    <div class="caption">
                        <h3>Alarm Control</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 hero-feature">
                <div class="thumbnail">
                    <form action="">
                        <input type="checkbox" name="updaterndm" value="UpdateRndDB">Update Random DB Data 
                    </form>
                    <!-- <img src="http://placehold.it/250x150" alt=""> -->
<!--                     <div class="caption">
                        <h3>Communications</h3>
                    </div> -->
                </div>
            </div>

        </div>
        <hr>

        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Weather Station Plus</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- JavaScript -->

    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>

</body>

</html>