'use strict';

var LTBApp = angular.module('LTBApp', [
    'ngRoute',
    'LTBApp.stack',
    'LTBApp.tileTypes',
    'ngCordova',
    'ltbapi'
    ]);

LTBApp.controller('defaultController', ['callApi', function(callApi){
   this.apisettings = callApi.apisettings;
}]);



/*LTBApp.directive('searchhhBar', function(){
    return {
        restrict:'A',
        templateUrl:"../searchBarStacks.html",
        controller:function(){
            $scope.text_controller = '';
            $scope.results={};
            $scope.aux='helloo';
            $scope.setSearchText = function(text_to_search){
                $scope.text_controller = text_to_search;

                $http.get('data/data-results-a.json').success (function(data){
                    $scope.results=data;
                    $scope.aux='bye';
                });
            };
        },
        controllerAs:'searchBar'
    };
});*/   