'use strict';

angular.module('ltbapi', [])

//settings
.value('apisettings', {
        apiuri: 'https://api.ltb.io/',
        authprovider: 'http://api.learning-layers.eu/o/oauth2',
        authclientid: '889b4051-bdbb-40e9-8692-251a93e239c7',
        apistack: 'stack',
        apitile: 'tile',
        apiembed: 'embed'
    }
).value('localsettings', {
        apiuri: 'http://localhost/LTB-API/public/',
        authprovider: 'http://api.learning-layers.eu/o/oauth2',
        authclientid: '889b4051-bdbb-40e9-8692-251a93e239c7',
        apistack: 'stack',
        apitile: 'tile',
        apiembed: 'embed'
    }
)

.service('callApi', ["apisettings", "$http", "$filter", "$routeParams", function(apisettings, $http, $filter, $routeParams) {
    
    this.state = {
        stackid : 0,
        screenIndex : -1,
        stack : [],
        screen : [],
        tiles : [],
        lastScreens : []
    };
//    this.device = {
//        os: deviceDetector.os,
//        browser: deviceDetector.browser,
//        device: deviceDetector.device,
//        raw: deviceDetector.raw
//    };
//    console.log(this.device);
    
//  API SETTINGS:  
//  apisettings = global settings
//  localsetttings = local settings
    this.apisettings = apisettings;
    

    this.jsonp = function(request, success, fail){
        var promise = $http.jsonp(request);
        if(success){
            promise.success(success);
        }
        if(fail){
            promise.error(fail);
        }
    };
    
    this.rawget = function(request, success, fail, options){
        var promise = $http.get(request, options);
        if(success){
            promise.success(success);
        }
        if(fail){
            promise.error(fail);
        }
    };
    
    this.get = function(request, success, fail){
        this.rawget(this.apisettings.apiuri + request, success, { headers: null });
    };
    
    this.patch = function(request, data, success, fail){
        console.log(this.apisettings.apiuri + request, data, { headers: this.headers() });
        var promise = $http.patch(this.apisettings.apiuri + request, data, { headers: this.headers() });
        
        if(success){
            promise.success(success);
        }
        if(fail){
            promise.error(fail);
        }
    };

    //Stack collection
    this.getStacks = function(){
        var stackcntr = this;
        
        this.get(this.apisettings.apistack, function(data){
//            stackcntr.state.mystacks = angular.fromJson(data);
            console.log(angular.fromJson(data));
        });
    };
    
    
    
    //Stack Entity
    this.getStack = function(stackid){
        stackid = stackid || 1;
        var stackcntr = this;
        
        this.get(this.apisettings.apistack + "/"+ stackid, function(data){
            stackcntr.state.stack = angular.fromJson(data.details);
           
            stackcntr.state.stackid = stackid;
            stackcntr.getTiles();
        });
        
//        $http.get('data-stack-1.json').success(function(data){
//
//          stackcntr.state.stack = angular.fromJson(data);
//          stackcntr.getTiles();
//      });
    };
    
    this.reloadStack = function(stackid) {
        this.state.screenIndex = -1;
        this.state.lastScreens = [];
        this.getStack(stackid);
    };

    this.getTiles = function(screen){
        var thescreen = screen || this.state.stack.startscreen || 1;
        this.state.screen = $filter('filter')(this.state.stack.screens, function (s) {return s.id === thescreen;})[0];
        this.state.tiles = this.state.screen.tiles;
        
        if(this.hasFolllowingScreens()) {
            var i = this.state.lastScreens.length -1;
            for(; i>this.state.screenIndex; i--) {
                this.state.lastScreens.pop();
            }   
        }
        this.state.lastScreens.push(thescreen);
        this.state.screenIndex = this.state.screenIndex + 1;
        console.log(this.state.tiles);
    };
    
    this.getStartScreen = function(){
        var thescreen = this.state.stack.startscreen || 1;
        this.state.screen = $filter('filter')(this.state.stack.screens, function (s) {return s.id === thescreen;})[0];
        this.state.tiles = this.state.screen.tiles;
        
        this.state.lastScreens = [];
        this.state.lastScreens.push(thescreen);
        this.state.screenIndex = 0;
    };
    
    this.goBack = function() {
        this.state.screenIndex = this.state.screenIndex - 1;
        var thescreen = this.state.lastScreens[this.state.screenIndex];
        
        this.state.screen = $filter('filter')(this.state.stack.screens, function (s) {return s.id === thescreen;})[0];
        this.state.tiles = this.state.screen.tiles;
    };
    
    this.goForward = function() {
        this.state.screenIndex = this.state.screenIndex + 1;
        var thescreen = this.state.lastScreens[this.state.screenIndex];
        
        this.state.screen = $filter('filter')(this.state.stack.screens, function (s) {return s.id === thescreen;})[0];
        this.state.tiles = this.state.screen.tiles;
    };
    
    this.isStartScreen = function() {
        return this.state.screen.id === this.state.stack.startscreen;    
    };
    
    this.hasPreviousScreens = function() {
        return (this.state.screenIndex !== 0 && this.state.screenIndex !== -1);
    };
    
    this.hasFolllowingScreens = function() {
        return this.state.screenIndex < (this.state.lastScreens.length -1);   
    };
}]);