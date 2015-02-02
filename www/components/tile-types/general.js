'use strict';

var tileTypes = angular.module('LTBApp.tileTypes', [])


.directive("tile", ['$compile', function($compile) {
    return {
        restrict: "E",
        
        scope: {
            tiletype: '=',
            tile: '=',
            tileindex: '=',
            tiletemplate: "="
        },
        link: function(scope, element, attrs){
            element.html('<div  ><ng-include src="TileCtrl.tileTemplateUrl()"/></div>').show();
            
            var div = element.find('div');
            div.attr('ng-controller',scope.tiletype+'TileController as TileCtrl');
            $compile(element.contents())(scope);
        }
    };
}])

.service('tileState', function(){
    this.templates = [];
    this.selectedTile = {};
    this.fullscreen = false;
    this.edit = false;
    this.tileindex = null;
    
    this.tileEdit = function ($event, tile, tileindex) {
        if (this.toggleSelect($event)) {
            this.setTile(tile, 'edit', tileindex);
        } else {
            this.setTile();
        }
    };
    
    this.setTile = function(tile, mode, index){
        this.selectedTile = tile || {};
        mode = mode || 'fullscreen';
        index = index || null;
        if(!tile){
            this.fullscreen = false;
            this.edit = false;
            this.tileindex = null;
        }else if(mode == 'full'){
            this.fullscreen = true;
            this.edit = false;
            this.tileindex = index;            
        }else if(mode == 'edit'){
            this.fullscreen = false;
            this.edit = true;
            this.tileindex = index;      
        }
    };
    
    this.getTile = function(){
        return this.selectedTile;
    };
    
    this.getProp = function(prop){
        return this.selectedTile[prop] || '';
    };
    
    this.addTemplate = function(template){
        this.templates.push(template);
        console.log(template);
        console.log(this.templates);
    };
    
    this.toggleSelect = function($event, select){
        var obj = $($event.target).closest(".tile");
        select = select || null;
        
        if(select === 'off'){
            obj.removeClass('selected');
            //unselected
            return false;
        }else if(select === 'on'){
            $(".tile.selected").removeClass('selected');
            $($event.target).closest(".tile").addClass('selected');
            //selected
            return true;
        }else if (obj.hasClass('selected')) {
            obj.removeClass('selected');
            
            //unselected
            return false;
        } else {
            $(".tile.selected").removeClass('selected');
            $($event.target).closest(".tile").addClass('selected');
            
            //selected
            return true;
        }
    };
})

.directive("tileFull", function(){
    return {
        restrict: "E",
        template: '<ng-include src="tileTCtrl.tileTypeTemplateUrl(\'full\')"/>',
        controller: 'tileTypeController',
        controllerAs: 'tileTCtrl'
    };
})

.controller('tileTypeController', ['tileState', '$scope', function(tileState, $scope){
    this.selectedTile = tileState.selectedTile;
    var tileMCtrl = this;
    
    $scope.$watch(
        function(){ return tileState.selectedTile },
    
        function(newVal) {
            tileMCtrl.selectedTile = newVal;
            
            
        },
        true
    );
    
    this.tileTypeTemplateUrl = function(what) {
        if(what === 'prop'){
            return 'components/tile-types/' + this.selectedTile.type + '/prop.html';
        }else if(what === 'settings'){
            return 'components/tile-types/' + this.selectedTile.type + '/settings.html';
        }else if(what === 'full'){
            return 'components/tile-types/' + this.selectedTile.type + '/full.html';
        }
    };
}])

;