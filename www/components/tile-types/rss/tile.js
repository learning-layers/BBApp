'use strict';

tileTypes
.run(['tileState', function(tileState){
    tileState.addTemplate(
    {
        size: "",
        colour: "purple",
        name: "RSS",
        description: "Show RSS Feed",
        icon: "rss",
        type: "rss",
        template: {
            size: "",
            colour: "purple",
            name: "new rss",
            description: "",
            icon: "rss",
            position: 0,
            settings: {
                query: "",
                url: ""
            },
            type: "rss"
          }
        
        }
    );
}])

.controller('rssTileController', ['tileState', 'callApi', '$scope', '$sce', function (tileState, callApi, $scope, $sce) {
        
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
            tileState.setTile($scope.tile, 'full', $scope.tileindex);
        }
    };
    
    this.tileTemplateUrl = function(){
       return  "components/tile-types/rss/tile.html";
    };
    
    this.readFeed = function(){
        
        callApi.jsonp('http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&callback=JSON_CALLBACK&q='+$scope.tile.settings.url, function(data){
            $scope.tile.settings.feed = data.responseData.feed;
            $scope.tile.settings.count = $scope.tile.settings.feed.entries.length;
        });
    };
    if(!$scope.tilereadonly) this.readFeed();
    
}])

.controller('rssFullController', ['tileState', 'callApi', function(tileState, callApi){
        
    this.tile = tileState.selectedTile;
    
    this.tileClose = function ($event) {
       tileState.setTile();
    };
}])

.controller('rssMenuController', ['callApi', 'tileState', function(callApi, tileState){
        
    this.query = angular.copy(tileState.selectedTile.settings.query);
    
    this.tileDelete = function (){
        console.log('index',tileState);
        callApi.deleteTile(tileState.tileindex);
        tileState.setTile();
        
    };
    
    this.findFeed = function(){
        callApi.jsonp('http://ajax.googleapis.com/ajax/services/feed/lookup?v=1.0&callback=JSON_CALLBACK&q='+this.query, function(data){
            console.log(data);
            if(data.responseStatus === 200){
                tileState.selectedTile.settings = data.responseData;
                callApi.jsonp('http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&callback=JSON_CALLBACK&q='+tileState.selectedTile.settings.url, function(data){
                    tileState.selectedTile.settings.feed = data.responseData.feed;
                    tileState.selectedTile.settings.count = tileState.selectedTile.settings.feed.entries.length;
                    tileState.selectedTile.name = tileState.selectedTile.settings.feed.title;
                });
            }else{
                //no feed found
            }            
        });
        console.log(callApi.state);
    };
    
}])

;