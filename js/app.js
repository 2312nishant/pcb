var adminApp = angular.module('adminApp', ['ngRoute']);

    // configure our routes
    adminApp.config(function($routeProvider) {
        $routeProvider

            // route for the home page
            .when('/', {
                templateUrl : 'pages/home.html',
                controller  : 'mainController'
            })

            // route for the about page
            .when('/table', {
                templateUrl : 'pages/table.html',
                controller  : 'tableController'
            })
            . otherwise({
		        redirectTo: '/'
		      });
            /*// route for the contact page
            .when('/contact', {
                templateUrl : 'pages/contact.html',
                controller  : 'contactController'
            });*/
    });

    adminApp.service ("myService", function($rootScope){
    	this.getAddition = function(a,b){
    		return a+b;
    	}
    });
    // create the controller and inject Angular's $scope
    adminApp.controller('mainController', function($scope, $location, myService) {
        // create a message to display in our view
        //$scope.message = 'Everyone come and see how good I look!'+myService.getAddition(5,20);
        /*$scope.clickFun = function(){
        	$location.path("/about");
			
        }*/
		$(document).ready(function(){

        	demo.initChartist();

        	/*$.notify({
            	icon: 'ti-gift',
            	message: "Welcome to <b>Paper Dashboard</b> - a beautiful Bootstrap freebie for your next project."

            },{
                type: 'success',
                timer: 4000
            });*/

    	});
    });

    adminApp.controller('tableController', function($scope, $location) {
        $scope.message = 'Look! I am an about page.';
        $scope.clickFun = function(){
        	$location.path("/");
        }
    });

    adminApp.controller('contactController', function($scope) {
        $scope.message = 'Contact us! JK. This is just a demo.';
    });

	adminApp.directive('footerPanel', function () {
    return {
        restrict: 'A', //This menas that it will be used as an attribute and NOT as an element. I don't like creating custom HTML elements
        replace: true,
        templateUrl: "pages/footer.html"
       
    }
});
adminApp.directive('headerPart', function () {
    return {
        restrict: 'A', //This menas that it will be used as an attribute and NOT as an element. I don't like creating custom HTML elements
        replace: true,
        templateUrl: "pages/header.html"
       
    }
});
adminApp.directive('sideBar', function () {
    return {
        restrict: 'A', //This menas that it will be used as an attribute and NOT as an element. I don't like creating custom HTML elements
        replace: true,
        templateUrl: "pages/siderBar.html"
       
    }
});
    
