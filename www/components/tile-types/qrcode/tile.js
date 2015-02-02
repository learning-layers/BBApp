'use strict';

tileTypes

.run(['tileState', function(tileState){
    tileState.addTemplate(
    {
        size: "",
        colour: "red",
        icon: "camera",
        type: "qrcode",
        name: "Qr Code",
        description: "Open camera for decode qrcode",
        template: {
            size: "",
            colour: "red",
            name: "new content",
            icon: "camera",
            position: 0,
            settings: {},
            type: "qrcode"
        }
        
    }
    );
}])

.controller('qrcodeTileController', ["tileState", "callApi", "$scope", "$cordovaBarcodeScanner", function (tileState, callApi, $scope, $cordovaBarcodeScanner) {
    //make sure the inserted tile is not a template
    if(!$scope.tiletemplate && callApi.state.tiles[$scope.tileindex].template){
        callApi.state.tiles[$scope.tileindex] = callApi.state.tiles[$scope.tileindex].template;
        $scope.tile = callApi.state.tiles[$scope.tileindex];
    }
    this.tileEdit = function ($event) {
        tileState.tileEdit($event, $scope.tile, $scope.tileindex);
    };
    
    this.tileTemplateUrl = function(){
       return  "components/tile-types/qrcode/tile.html";
    };
    
    this.scanQR = function() {
//        $cordovaBarcodeScanner
//        .scan()
//        .then(function(barcodeData) {
//            alert("Scanning: " + barcodeData);
//            window.document.location = 'index.html';
//        }, function(error) {
//          // An error occurred
//        });
        $cordovaBarcodeScanner.scan(
                function (result) {
                    alert("We got a barcode\n" +
                        "Result: " + result.text + "\n" +
                        "Format: " + result.format + "\n" +
                        "Cancelled: " + result.cancelled);
                }, 
                function (error) {
                    alert("Scanning failed: " + error);
            }
        );
    };
    
}])

.controller('qrcodeMenuController', ['callApi', 'tileState', function(callApi, tileState){
    this.tileDelete = function (){
        console.log('index',tileState);
        callApi.deleteTile(tileState.tileindex);
        tileState.setTile();
        
    };
}])

;