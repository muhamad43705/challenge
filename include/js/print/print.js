 $(document).ready(function() {

    window.readingWeight = false;   
    startConnection();   
    
 });



function startConnection(config) {
         
         if (!qz.websocket.isActive()) {
            updateState('Waiting', 'default');

            qz.websocket.connect({ retries: 5, delay: 1}).then(function() {
                updateState('Active', 'success');
                findDefaultPrinter(true);
            }).catch(handleConnectionError);
                                                                
            /*                                          
            qz.websocket.connect(config).then(function() {
                updateState('Active', 'success');
                findDefaultPrinter(true);
                 
            }).catch(handleConnectionError);*/
        } else {
            displayMessage('An active connection with QZ already exists.', 'alert-warning');
        } 
         
    }

    function endConnection() {
        if (qz.websocket.isActive()) {
            qz.websocket.disconnect().then(function() {
                updateState('Inactive', 'default');
            }).catch(handleConnectionError);
        } else {
            displayMessage('No active connection with QZ exists.', 'alert-warning');
        }
    }
    
    function updateState(text, css) {
        console.log(text) 
    }
    
      function handleConnectionError(err) {
        updateState('Error', 'danger');

        if (err.target != undefined) {
            if (err.target.readyState >= 2) { //if CLOSING or CLOSED
                displayError("Connection to QZ Tray was closed");
            } else {
                displayError("A connection error occurred, check log for details");
                console.error(err);
            }
        } else {
            displayError(err);
        }
    }
     
    var cfg = null;
    function getUpdatedConfig() {
        if (cfg == null) {
            cfg = qz.configs.create(null);
        }

        updateConfig();
        return cfg
    }

    function updateConfig() {
        var pxlSize = null;
        if ($("#pxlSizeActive").prop('checked')) {
            pxlSize = {
                width: $("#pxlSizeWidth").val(),
                height: $("#pxlSizeHeight").val()
            };
        }

        var pxlMargins = $("#pxlMargins").val();
        if ($("#pxlMarginsActive").prop('checked')) {
            pxlMargins = {
                top: $("#pxlMarginsTop").val(),
                right: $("#pxlMarginsRight").val(),
                bottom: $("#pxlMarginsBottom").val(),
                left: $("#pxlMarginsLeft").val()
            };
        }

        var copies = 1;
        var jobName = null;
        if ($("#rawTab").hasClass("active")) {
            copies = $("#rawCopies").val();
            jobName = $("#rawJobName").val();
        } else {
            copies = $("#pxlCopies").val();
            jobName = $("#pxlJobName").val();
        }

        cfg.reconfigure({
                            altPrinting: $("#rawAltPrinting").prop('checked'),
                            encoding: $("#rawEncoding").val(),
                            endOfDoc: $("#rawEndOfDoc").val(),
                            perSpool: $("#rawPerSpool").val(),

                            colorType: $("#pxlColorType").val(),
                            copies: copies,
                            density: $("#pxlDensity").val(),
                            duplex: $("#pxlDuplex").prop('checked'),
                            interpolation: $("#pxlInterpolation").val(),
                            jobName: jobName,
                            margins: pxlMargins,
                            orientation: $("#pxlOrientation").val(),
                            paperThickness: $("#pxlPaperThickness").val(),
                            printerTray: $("#pxlPrinterTray").val(),
                            rasterize: $("#pxlRasterize").prop('checked'),
                            rotation: $("#pxlRotation").val(),
                            scaleContent: $("#pxlScale").prop('checked'),
                            size: pxlSize,
                            units: $("input[name='pxlUnits']:checked").val()
                        });
    }
    
    function findDefaultPrinter(set) {
        qz.printers.getDefault().then(function(data) { 
            console.log("<strong>Found:</strong> " + data);
            if (set) { setPrinter(data); }
        }).catch(displayError);
    }

    function displayError(err) {
        console.log( err);
       // displayMessage(err, 'alert-danger');
    }
    
    
    function setPrinter(printer) {
        var cf = getUpdatedConfig();
        cf.setPrinter(printer);

        if (typeof printer === 'object' && printer.name == undefined) {
            var shown;
            if (printer.file != undefined) {
                shown = "<em>FILE:</em> " + printer.file;
            }
            if (printer.host != undefined) {
                shown = "<em>HOST:</em> " + printer.host + ":" + printer.port;
            }
 
        } else {
            if (printer.name != undefined) {
                printer = printer.name;
            }

            if (printer == undefined) {
                printer = 'NONE';
            } 
        }
    } 