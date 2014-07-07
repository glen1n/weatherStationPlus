  
    var gauges = [];
    var weatherDataObj = { }
    var pirMotionDataObj = { }

    function createGauge(name, label, min, max) {
        var config = {
            size: 220,
            label: label,
            min: undefined != min ? min : 0,
            max: undefined != max ? max : 100,
            minorTicks: 5
        }
        var range = config.max - config.min;
        
        if(name == 'temperature') {
            config.yellowZones = [{ from: config.min + range*0.75, to: config.min + range*0.9 }];
            config.redZones = [{ from: config.min + range*0.9, to: config.max }];
        } else if (name =='humidity') {
            config.blueZones = [{ from: config.min + range*0.8, to: config.max }];
        } 
        
        gauges[name] = new Gauge(name + "GaugeContainer", config);
        gauges[name].render();
    }

    function createGauges() {
        createGauge("temperature", "Temperature", 0, 140);
        createGauge("humidity", "Humidity");
        createGauge("barometer", "Barometer", 28, 32);
        //createGauge("test", "Test", -50, 50 );
    }

    function updateGauges() {

        // Update Object

        $.ajax({
            url: "db_gaugeData.php",
            type: 'GET',
            cache: false,
            dataType: 'json',

            error: function(xhr){

                var dataError = $.parseJSON(xhr.responseText);
                console.log(dataError.msg);
                
            },

            success: function(xhr) { 

                weatherDataObj.weatherlog_time = xhr.weatherlog_time;
                weatherDataObj.weatherlog_temperature = xhr.weatherlog_temperature;
                weatherDataObj.weatherlog_humidity = xhr.weatherlog_humidity;
                weatherDataObj.weatherlog_barometric = xhr.weatherlog_barometric;
                
                $('.lastUpdateTimeStamp').text(weatherDataObj.weatherlog_time);

                // Then Update Guages

                for (var key in gauges)
                {

                    if (key == 'temperature') {
                        gauges[key].redraw(weatherDataObj.weatherlog_temperature);
                    }
                    if (key == 'humidity') {
                        gauges[key].redraw(weatherDataObj.weatherlog_humidity);  
                    }
                    if (key == 'barometer') {
                        gauges[key].redraw(weatherDataObj.weatherlog_barometric); 
                    }

                }                    
                // console.log('updateGauges');
                // console.log(weatherDataObj);

            }


        }); 


    }

    function getRandomValue(gauge) {
        var overflow = 0; //10;
        return gauge.config.min - overflow + (gauge.config.max - gauge.config.min + overflow*2) *  Math.random();
        // return gauge.config.min - overflow + (gauge.config.max - gauge.config.min + overflow*2) *  Math.random();
    }

    function createGraphs() {

        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });
    
       var chart;

        $('#temperatureGraph').highcharts({
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function() {
    
                        // set up the updating of the chart each second
                        var series = this.series[0];
                            $.ajax({
                                url: "db_gaugeData.php",
                                type: 'GET',
                                cache: false,
                                dataType: 'json',

                                error: function(xhr){

                                    var dataError = $.parseJSON(xhr.responseText);
                                    console.log(dataError.msg);
                                    
                                },

                                success: function(xhr) { 

                                    weatherDataObj.weatherlog_time = xhr.weatherlog_time;
                                    weatherDataObj.weatherlog_temperature = xhr.weatherlog_temperature;

                                }

                            }); 

                        setInterval(function() {

                            // console.log('update temperature graph');
                            // console.log(weatherDataObj);
                            // console.log(weatherDataObj.weatherlog_temperature);

                            var x = (new Date()).getTime(), // current time
                                y = parseFloat(weatherDataObj.weatherlog_temperature);

                            series.addPoint([x, y], true, true);
                        }, 10000);
                    }
                }
            },
            title: {
                text: 'Temperature'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Value'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: 'Temperature measurement',
                data: (function() {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;
    
                    for (i = -19; i <= 0; i++) {
                        data.push({
                            x: time + i * 1000,
                            y: 0
                        });
                    }
                    return data;
                })()
            }]
        }); // end of temperature

        var chart;

        $('#humidityGraph').highcharts({
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function() {
    
                        // set up the updating of the chart each second
                        var series = this.series[0];
                            $.ajax({
                                url: "db_gaugeData.php",
                                type: 'GET',
                                cache: false,
                                dataType: 'json',

                                error: function(xhr){

                                    var dataError = $.parseJSON(xhr.responseText);
                                    console.log(dataError.msg);
                                    
                                },

                                success: function(xhr) { 
                                    weatherDataObj.weatherlog_time = xhr.weatherlog_time;
                                    weatherDataObj.weatherlog_humidity = xhr.weatherlog_humidity;
                                }

                            }); 

                        setInterval(function() {

                            // console.log('update graph');
                            // console.log(weatherDataObj);
                            // console.log(weatherDataObj.weatherlog_time);

                            var x = (new Date()).getTime(), // current time
                            // var x = new Date(weatherDataObj.weatherlog_time),
                            // var x = (weatherDataObj.weatherlog_time),
                                y = parseFloat(weatherDataObj.weatherlog_humidity);
                            // console.log(x);


                            series.addPoint([x, y], true, true);
                        }, 10000);
                    }
                }
            },
            title: {
                text: 'Humidity'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Value'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: 'Humidity measurement',
                data: (function() {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;
    
                    for (i = -19; i <= 0; i++) {
                        data.push({
                            x: time + i * 1000,
                            y: 0
                        });
                    }
                    return data;
                })()
            }]
        }); // end of humidity graph

       var chart;

        $('#barometricGraph').highcharts({
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function() {
    
                        // set up the updating of the chart each second
                        var series = this.series[0];
                            $.ajax({
                                url: "db_gaugeData.php",
                                type: 'GET',
                                cache: false,
                                dataType: 'json',

                                error: function(xhr){

                                    var dataError = $.parseJSON(xhr.responseText);
                                    console.log(dataError.msg);
                                    
                                },

                                success: function(xhr) { 

                                    weatherDataObj.weatherlog_time = xhr.weatherlog_time;
                                    weatherDataObj.weatherlog_barometric = xhr.weatherlog_barometric;

                                }

                            }); 

                        setInterval(function() {

                            var x = (new Date()).getTime(), // current time
                                y = parseFloat(weatherDataObj.weatherlog_barometric);

                            series.addPoint([x, y], true, true);
                        }, 10000);
                    }
                }
            },
            title: {
                text: 'Barometric Pressure'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Value'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: 'Pressure measurement',
                data: (function() {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;
    
                    for (i = -19; i <= 0; i++) {
                        data.push({
                            x: time + i * 1000,
                            y: 0
                        });
                    }
                    return data;
                })()
            }]
        }); // end of barometric pressure graph


       var chart;

        $('#pirGraph').highcharts({
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function() {
    
                        // set up the updating of the chart each second
                        var series = this.series[0];
                            $.ajax({
                                url: "db_pirMotionData.php",
                                type: 'GET',
                                cache: false,
                                dataType: 'json',

                                error: function(xhr){

                                    var dataError = $.parseJSON(xhr.responseText);
                                    console.log(dataError.msg);
                                    
                                },

                                success: function(xhr) { 

                                    pirMotionDataObj.pirmotion_count = xhr.pirmotion_count;
                                    pirMotionDataObj.pirmotion_time = xhr.pirmotion_time;
                                }

                            }); 

                        setInterval(function() {

                            var x = (new Date()).getTime(), // current time
                                y = parseFloat(pirMotionDataObj.pirmotion_count);

                            series.addPoint([x, y], true, true);
                        }, 10000);
                    }
                }
            },
            title: {
                text: 'P.I.R. Events'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Value'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: 'Motion events detected',
                data: (function() {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;
    
                    for (i = -19; i <= 0; i++) {
                        data.push({
                            x: time + i * 1000,
                            y: 0
                        });
                    }
                    return data;
                })()
            }]
        }); // end of P.I.R. graph
}



    function initialize() {
        createGauges();
        createGraphs();





        setInterval(updateGauges, 5000);
    }

