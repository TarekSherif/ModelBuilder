
var app = angular
.module("AlhendyModule",['angular-nicescroll'])
.controller("DocumentServesController", function ($scope, $http) {
    
      $scope.ListOfCurrentDocumentServes = [];

    $http.get('{{url("/")}}/api/ListOfCurrentDocumentServes')
        .then(function (response) {
            if (data.Records)
			{
				
                $scope.ListOfCurrentDocumentServes = response.data.Records;
                console.log(response.data.Records);

			}

           
  
    });
   


});
