'use strict';

tileTypes

.run(['tileState', function(tileState){
    tileState.addTemplate(
    {
        size: "",
        colour: "purple",
        icon: "file-text-o",
        type: "default",
        name: "Content tile",
        description: "Supply content",
        template: {
            size: "",
            colour: "purple",
            name: "new content",
            icon: "file-text-o",
            position: 0,
            settings: {
                html: '',
                title: ''
            },
            type: "default"
        }
        
    }
    );
}])
.controller('defaultTileController', ['tileState', 'callApi', '$scope', function (tileState, callApi, $scope) {
    //make sure the inserted tile is not a template
    if(!$scope.tilereadonly && callApi.state.tiles[$scope.tileindex].template){
        callApi.state.tiles[$scope.tileindex] = callApi.state.tiles[$scope.tileindex].template;
        $scope.tile = callApi.state.tiles[$scope.tileindex];
    }
    
    this.tileEdit = function ($event) {
        tileState.tileEdit($event, $scope.tile, $scope.tileindex);
    };
    
    this.tileClick = function ($event) {
       if(!$scope.tiletemplate){
            tileState.toggleSelect($event, 'off');
            tileState.setTile($scope.tile, "full", $scope.tileindex);
     //       tileState.fullscreen = true;
       }
    };
    
    this.tileTemplateUrl = function(){
       return  "components/tile-types/default/tile.html";
    };

}])

.controller('defaultFullController', ['tileState', '$sce', function(tileState, $sce){
        
    this.tile = tileState.selectedTile;
    this.tile.settings.htmlSafe = $sce.trustAsHtml(this.tile.settings.html);
    
    this.tileClose = function ($event) {
       tileState.setTile();
    };
}])

.controller('defaultMenuController', ['callApi', 'tileState', function(callApi, tileState){
    
    this.html = angular.copy(tileState.selectedTile.settings.html);
    this.title = tileState.selectedTile.settings.title;
    
    this.tileDelete = function (){
        console.log('index',tileState);
        callApi.deleteTile(tileState.tileindex);
        tileState.setTile();
        
    };
    
    this.saveHtml = function(){
        tileState.selectedTile.settings.html = this.html;
    };
    
    this.resetHtml = function(){
        this.html = angular.copy(tileState.selectedTile.settings.html);
    }
    
}])

;