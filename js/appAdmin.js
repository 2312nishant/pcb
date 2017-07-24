var adminApp = angular.module('adminApp', ['ngRoute', 'ngFileUpload']);

// configure our routes
adminApp.config(function ($routeProvider) {
    //	createMarquee({ });
    $routeProvider

        // route for the home page
        .when('/', {
            templateUrl: 'pages/admin_portal/dashboard.php',
            controller: 'mainController'
        })

        // route for the about page
        .when('/addNews', {
            templateUrl: 'pages/admin_portal/addNews.php',
            controller: 'addNewsController',
            resolve: {
                newsTypeList: ['myServices', function (myServices) {
                    return myServices.serverCall();
                }]
            }
        })
        .when('/breakingNews', {
            templateUrl: 'pages/admin_portal/addBreakingNews.php',
            controller: 'addBreakingNews',
            resolve: {
                breakingNewsList: ['myServices', function (myServices) {
                    return myServices.getBreakingNews();
                }]
            }
        })
        .when('/updateNews', {
            templateUrl: 'pages/admin_portal/updateNews.php',
            controller: 'updateNewsController',
            resolve: {
                newsTypeList: ['myServices', function (myServices) {
                    return myServices.serverCall();
                }],
                NewsList: ['myServices', function (myServices) {
                    return myServices.getNewsService();
                }]
            }
        })
        .when('/addPoll', {
            templateUrl: 'pages/admin_portal/addPoll.php',
            controller: 'addPollController'
        })
        .when('/updatePoll', {
            templateUrl: 'pages/admin_portal/updatePoll.php',
            controller: 'updatePollController',
            resolve: {
                pollList: ['myServices', function (myServices) {
                    return myServices.getPollList();
                }]
            }
        }).when('/candidateInfo', {
            templateUrl: 'pages/admin_portal/candidateInfo.php',
            controller: 'candidateInfoController',
            resolve: {
                wardInfo: ['myServices', function (myServices) {
                    return myServices.getWardInfo();
                }],
                electionReservations: ['myServices', function (myServices) {
                    return myServices.getElectionReservations();
                }],
                electionParty: ['myServices', function (myServices) {
                    return myServices.getElectionParty();
                }]
            }
        }).when('/wardInfo', {
            templateUrl: 'pages/admin_portal/wardInfo.php',
            controller: 'wardInfoController',
            resolve: {
                electionReservations: ['myServices', function (myServices) {
                    return myServices.getElectionReservations();
                }]
            }
        }).when('/partyInfo', {
            templateUrl: 'pages/admin_portal/partyInfo.php',
            controller: 'partyInfoController',
            resolve: {
                electionReservations: ['myServices', function (myServices) {
                    return myServices.getElectionReservations();
                }]
            }
        })
        .when('/rashi', {
            templateUrl: 'pages/admin_portal/rashi.php',
            controller: 'addRashiController'
        })
        .when('/notification', {
            templateUrl: 'pages/admin_portal/notification.php',
            controller: 'notificationController'
        })
        .when('/addWebAds', {
            templateUrl: 'pages/admin_portal/addAds.php',
            controller: 'addAdsController',
			 resolve: {
                getAdsType: ['myServices', function (myServices) {
                    return myServices.getAdsType();
                }]
            }
        })
        .when('/deleteAds', {
            templateUrl: 'pages/admin_portal/deleteAds.php',
            controller: 'deleteAdsController',
            resolve: {
                getAds: ['myServices', function (myServices) {
                    return myServices.getAds();
                }]
            }
        })

		.when('/addVideo', {
            templateUrl: 'pages/admin_portal/addVideo.php',
            controller: 'addVideoController',
			 resolve: {
                getVideoType: ['myServices', function (myServices) {
                    return myServices.getVideoType();
                }]
            }
        }) .when('/candidateVotes', {
            templateUrl: 'pages/admin_portal/candidateVotes.php',
            controller: 'candidateVotesController',
			 resolve: {
                 getAllCandidateInfo: ['myServices', function (myServices) {
                    return myServices.getAllCandidateInfo();
                }],
                 getWardInfo: ['myServices', function (myServices) {
                     return myServices.getWardInfo();
                 }]
            }
        })
        .otherwise({
            redirectTo: '/'
        });
    /*// route for the contact page
     .when('/contact', {
     templateUrl : 'pages/contact.html',
     controller  : 'contactController'
     });*/
});


/*adminApp.service("myService", function ($rootScope) {
 this.getAddition = function (a, b) {
 return a + b;
 }
 });*/
// create the controller and inject Angular's $scope
adminApp.controller('candidateVotesController', function ($scope,$http,getAllCandidateInfo,getWardInfo) {
    $scope.updateCandidateData={};
$scope.candidateInfo=getAllCandidateInfo.data;
$scope.wardInfo=getWardInfo.data;
$scope.vote;
    $scope.setupdateCandidate=function(candidate_id){

    var vote=$('#candidate_'+candidate_id).val();
        $http({
            method: 'post',
            url: pcbPath + 'Admin/updateCandidateVotes',
            data: {'no_of_votes':vote,'candidateId':candidate_id},
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (data) {

                console.log(data);
                if (data == "1") {

                    swal({
                        title: "Success",
                        text: "Information saved successfully.",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });
                  //  $scope.resetForm();
                    // $('.fr-view').html('');
                }
            });


    }
    $scope.setFilter = function () {
        $scope.filter_text = $("#update_ward option:selected").text();

        if ($scope.filter_text == 'All') {
            $scope.filter_text = "";
        }
    }
    setTimeout(function () {

        $('.selectpicker').selectpicker({
            size: 10
        });

        $('.js-basic-example').DataTable();

        //Exportable table
        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
            "bSort": false
        });


    }, 50);
});
adminApp.controller('mainController', function ($scope, $location,$http) {
    // create a message to display in our view
    //$scope.message = 'Everyone come and see how good I look!'+myService.getAddition(5,20);
    /*$scope.clickFun = function(){
     $location.path("/about");

     }*/

   /* $.getJSON("js/election/election2017.json", function (data) {
         //console.log(data[0])

        $.each(data[0], function (key, val) {
       //     console.log(val)
            $scope.info={};
            var minfont = 50000;
            var maxfont = 300000;
            $scope.info.prabhag_no = "प्रभाग "+val.id;
            $scope.info.prabhag_area = val.area;
            $scope.info.prabhag_A = val.subward.A
            $scope.info.prabhag_B = val.subward.B
            $scope.info.prabhag_C = val.subward.C
            $scope.info.prabhag_D = val.subward.D
            $scope.info.population= Math.floor(Math.random() * (maxfont - minfont + 1)) + minfont;
            $http({
                method: 'post',
                url: pcbPath + 'Admin/saveWardInfo',
                data: $scope.info,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data) {

                    console.log(data);

                });
        });
    });*/


    $(function () {

        // createMarquee({ });

        //example of overwriting defaults:

        setTimeout(function () {

            /* Right Sidebar - Function ================================================================================================
             *  You can manage the right sidebar menu options
             *
             */
            $.AdminBSB.rightSideBar = {
                activate: function () {
                    var _this = this;
                    var $sidebar = $('#rightsidebar');
                    var $overlay = $('.overlay');

                    //Close sidebar
                    $(window).click(function (e) {
                        var $target = $(e.target);
                        if (e.target.nodeName.toLowerCase() === 'i') {
                            $target = $(e.target).parent();
                        }

                        if (!$target.hasClass('js-right-sidebar') && _this.isOpen() && $target.parents('#rightsidebar').length === 0) {
                            if (!$target.hasClass('bars')) $overlay.fadeOut();
                            $sidebar.removeClass('open');
                        }
                    });

                    $('.js-right-sidebar').on('click', function () {
                        $sidebar.toggleClass('open');
                        if (_this.isOpen()) {
                            $overlay.fadeIn();
                        } else {
                            $overlay.fadeOut();
                        }
                    });
                },
                isOpen: function () {
                    return $('.right-sidebar').hasClass('open');
                }
            }
//==========================================================================================================================

        }, 50);

    });
});

adminApp.controller('partyInfoController', function($scope, $http, $timeout,Upload, $timeout){
    $scope.partyInfo={};
    $scope.uploadFiles = function (file, errFiles) {
        $scope.partyInfo.imageFile = file;
        $scope.errFile = errFiles && errFiles[0];
    }


    $scope.addParty=function(){


        swal({
            title: "Are you sure?",
            text: "You want to save information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, save it!",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {

                if ($scope.partyInfo.imageFile) {
                    $scope.partyInfo.imageFile.upload = Upload.upload({
                        url: pcbPath + 'Admin/uploadFile',
                        data: {file: $scope.partyInfo.imageFile, id: 'party'}
                    });

                    $scope.partyInfo.imageFile.upload.then(function (response) {
                        $timeout(function () {
                            $scope.partyInfo.imageFile.result = response.data;

                            $scope.partyInfo.imageFile = (response.data)
                        });
                    }, function (response) {
                        if (response.status > 0) {
                            $scope.errorMsg = response.status + ': ' + response.data;
                            alert(response.data)
                        }
                    }, function (evt) {
                        $scope.partyInfo.imageFile.progress = Math.min(100, parseInt(100.0 *
                            evt.loaded / evt.total));
                    });
                }else{

                    alert('Please check your image size or name')
                    return;
                }
                 $scope.partyInfo.imageFile = $scope.partyInfo.imageFile['name']

                $http({
                    method: 'post',
                    url: pcbPath + 'Admin/savePartyInfo',
                    data: $scope.partyInfo,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function (data) {

                        console.log(data);
                        if (data == "1") {

                            swal({
                                title: "Success",
                                text: "Information saved successfully.",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            });
                            $scope.resetForm();
                            // $('.fr-view').html('');
                        }
                    });

            }
        });

    }

    $scope.resetForm = function () {

        $scope.partyInfo = angular.copy($scope.originForm); // Assign clear state to modified form
        $scope.addPartyFrom.$setPristine(); // this line will update status of your form, but will not clean your data, where `registrForm` - name of form.

        $scope.partyInfo = {};

    }
})
adminApp.controller('wardInfoController', function ($scope, $http, $timeout, electionReservations ) {

    $scope.electionReservations=electionReservations.data;
    $scope.pcbwardInfo = {};
    $scope.addpcbwardInfo = function(){



        swal({
            title: "Are you sure?",
            text: "You want to save information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, save it!",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {


                $http({
                    method: 'post',
                    url: pcbPath + 'Admin/saveWardInfo',
                    data: $scope.pcbCandidate,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function (data) {

                        console.log(data);
                        if (data == "1") {

                            swal({
                                title: "Success",
                                text: "Information saved successfully.",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            });
                             $scope.resetForm();
                            // $('.fr-view').html('');
                        }
                    });

            }
        });

    }

    $scope.resetForm = function () {

        $scope.pcbwardInfo = angular.copy($scope.originForm); // Assign clear state to modified form
        $scope.pcbwardInfoFrom.$setPristine(); // this line will update status of your form, but will not clean your data, where `registrForm` - name of form.

        $scope.pcbwardInfo = {};

    }

})
adminApp.controller('candidateInfoController', function (Upload, $timeout,$scope, $http, $timeout,wardInfo,electionReservations,electionParty ) {

    $scope.electionReservations=electionReservations.data;
    $scope.electionParties=electionParty.data;
    $scope.wards=wardInfo.data;
    $scope.sub_wards=sub_ward;
    console.log($scope.sub_wards)
    $scope.pcbCandidate = {};

    $scope.uploadFiles = function (file, errFiles) {
        $scope.pcbCandidate.imageFile = file;
        $scope.errFile = errFiles && errFiles[0];
    }

    $scope.setSubWard=function(){
      //  alert($scope.pcbCandidate.ward)


        $http({
            method: 'post',
            url: pcbPath + 'Admin/getSubWards',
            data: $scope.pcbCandidate.ward,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (data) {

                console.log(data);
                if (data == "1") {

                    swal({
                        title: "Success",
                        text: "Information saved successfully.",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    $scope.resetForm();
                    // $('.fr-view').html('');
                }
            });

    }
    $scope.addpcbCandidate = function(){


        swal({
            title: "Are you sure?",
            text: "You want to save information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, save it!",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {



                if ($scope.pcbCandidate.imageFile) {
                    $scope.pcbCandidate.imageFile.upload = Upload.upload({
                        url: pcbPath + 'Admin/uploadFile',
                        data: {file: $scope.pcbCandidate.imageFile, id: 'candidate'}
                    });

                    $scope.pcbCandidate.imageFile.upload.then(function (response) {
                        $timeout(function () {
                            $scope.pcbCandidate.imageFile.result = response.data;

                            $scope.pcbCandidate.imageFile = (response.data)
                        });
                    }, function (response) {
                        if (response.status > 0) {
                            $scope.errorMsg = response.status + ': ' + response.data;
                            alert(response.data)
                        }
                    }, function (evt) {
                        $scope.pcbCandidate.imageFile.progress = Math.min(100, parseInt(100.0 *
                            evt.loaded / evt.total));
                    });
                }else{

                    alert('Please check your image size or name')
                    return;
                }
                $scope.pcbCandidate.photo = $scope.pcbCandidate.imageFile['name']


                $scope.pcbCandidate.description = $('.fr-view').html();
             //   console.log($scope.pcbCandidate);
                $http({
                    method: 'post',
                    url: pcbPath + 'Admin/saveCandidateInfo',
                    data: $scope.pcbCandidate,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function (data) {

                        console.log(data);
                        if (data == "1") {

                            swal({
                                title: "Success",
                                text: "Information saved successfully.",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            });
                             $scope.resetForm();
                             $('.fr-view').html('');
                        }
                    });

            }
        });

    }

    $scope.resetForm = function () {

        $scope.pcbCandidate = angular.copy($scope.originForm); // Assign clear state to modified form
        $scope.pcbCandidateFrom.$setPristine(); // this line will update status of your form, but will not clean your data, where `registrForm` - name of form.

        $scope.pcbCandidate = {};

    }
    setTimeout(function () {


        $scope.description = '';

        $('#edit').froalaEditor({
            imageUploadURL: 'your_upload_image_script.php',

            imageUploadParams: {
                id: 'edit'
            }
        })


        /*$('.selectpicker').selectpicker({
         size: 4
         });*/

    }, 50);

})

adminApp.controller('addBreakingNews', function ($scope, $http, $timeout, breakingNewsList) {

    $scope.breakingNewsList = breakingNewsList.data;

    $scope.breakingNews = {};


    $scope.breakingNews.news1 = $scope.breakingNewsList[0].text;
    $scope.breakingNews.news2 = $scope.breakingNewsList[1].text;
    $scope.breakingNews.news3 = $scope.breakingNewsList[2].text;
    $scope.breakingNews.news4 = $scope.breakingNewsList[3].text;
    $scope.breakingNews.news5 = $scope.breakingNewsList[4].text;
    $scope.breakingNews.news6 = $scope.breakingNewsList[5].text;
    $scope.breakingNews.news7 = $scope.breakingNewsList[6].text;
    $scope.breakingNews.news8 = $scope.breakingNewsList[7].text;
    $scope.breakingNews.news9 = $scope.breakingNewsList[8].text;
    $scope.breakingNews.news10 = $scope.breakingNewsList[9].text;

    $scope.addBreakingNews = function () {


        swal({
            title: "Are you sure?",
            text: "You want to save information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, save it!",
            closeOnConfirm: true,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {

                console.log()
                $http({
                    method: 'post',
                    url: pcbPath + 'Admin/saveBreakingNews',
                    data: $scope.breakingNews,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function (data) {

                        console.log(data);
                        if (data == "1") {

                            swal({
                                title: "Success",
                                text: "Information saved successfully.",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            });
                            //  $scope.resetForm();
                            // $('.fr-view').html('');
                        }
                    });

            }
        });

    }

    $scope.resetForm = function () {

        $scope.breakingNews = angular.copy($scope.originForm); // Assign clear state to modified form
        $scope.pcbBreakingNewsFrom.$setPristine(); // this line will update status of your form, but will not clean your data, where `registrForm` - name of form.

        $scope.breakingNews = {};

    }

});
adminApp.controller('addNewsController', function ($scope, $location, $http, newsTypeList, Upload, $timeout) {
    $scope.uploadFiles = function (file, errFiles) {
        $scope.pcbNews.imageFile = file;
        $scope.errFile = errFiles && errFiles[0];
    }

    $scope.newsType = newsTypeList.data;

    $scope.tag = '';
    $scope.pcbNews = {};
    $scope.addPcbNews = function () {

         $scope.typetemp=$scope.pcbNews.type;


        swal({
            title: "Are you sure?",
            text: "You want to save information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, save it!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                if ($scope.pcbNews.imageFile) {
                    $scope.pcbNews.imageFile.upload = Upload.upload({
                        url: pcbPath + 'Admin/uploadFile',
                        data: {file: $scope.pcbNews.imageFile, id: $scope.pcbNews.type}
                    });

                    $scope.pcbNews.imageFile.upload.then(function (response) {


                        $scope.pcbNews.description = $('.fr-view').html();

                        $scope.pcbNews.imageFile =response.data;// $scope.pcbNews.imageFile['name']

                        console.log($scope.pcbNews.imageFile)

                        $http({
                            method: 'post',
                            url: pcbPath + 'Admin/savePcbNews',
                            data: $scope.pcbNews,
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                        }).success(function (data) {


                                if (data == "1") {

                                    swal({
                                        title: "Success",
                                        text: "Information saved successfully.",
                                        type: "success",
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                    $scope.resetForm();
                                    // $('.fr-view').html('');
                                }
                            });



                        $timeout(function () {
                            $scope.pcbNews.imageFile.result = response.data;

                            $scope.pcbNews.imageFile = (response.data)

                        });
                    }, function (response) {
                        if (response.status > 0) {
                            $scope.errorMsg = response.status + ': ' + response.data;
                            alert(response.data)
                        }
                    }, function (evt) {
                        $scope.pcbNews.imageFile.progress = Math.min(100, parseInt(100.0 *
                            evt.loaded / evt.total));
                    });
                }else{

                    alert('Please check if file browsed or file size')
                    return;
                }





            } else {
                // swal("Cancelled d", "Your imaginary file is safe :)", "error");
                swal({
                    title: "Cancelled",
                    text: "You Cancelled Information save request.",
                    type: "warning",
                    timer: 2000,
                    showConfirmButton: false
                });

            }
            //  swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });


    }
    $scope.resetForm = function () {

        $scope.pcbNews = angular.copy($scope.originForm); // Assign clear state to modified form
        $scope.pcbNewsFrom.$setPristine(); // this line will update status of your form, but will not clean your data, where `registrForm` - name of form.
        $('.fr-view').html('');
        $scope.pcbNews = {};
        $('#newsImage').val('');
        $scope.pcbNews.type=$scope.typetemp;
        $scope.pcbNews.tag=' ';
    }

    $scope.showConfirmMessage = function () {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });
    }

    setTimeout(function () {


        $scope.description = '';

        $('#edit').froalaEditor({
            imageUploadURL: 'your_upload_image_script.php',

            imageUploadParams: {
                id: 'edit'
            }
        })


        $('.selectpicker').selectpicker({
            size: 4
        });

    }, 50);


});

adminApp.controller('updateNewsController', function ($scope, $http, $location, newsTypeList, NewsList, Upload, $timeout) {

    $scope.newsType = newsTypeList.data;
    $scope.newsList = NewsList.data;
    $scope.updateNewsData = {};
    console.log($scope.newsList)
    $scope.tag = '';
    $scope.update_news = true;

    //  $scope.newsType = ['Banner News', 'Chinchwad News', 'Bhosari News', 'Pune News', 'Pune Gramin News', 'Pimpri News', 'Maharashtra News', 'Desh (देश) News', 'Videsh (विदेश)', 'Krida (क्रीडा)', 'Sampadakiya', 'Rojgar Info', 'Aarogya News', 'Technical News(तंत्राड्यान)', 'Lifestyle News', 'HasyaJagat News', 'Busniess World'];


    $scope.uploadFiles = function (file, errFiles) {
        $scope.updateNewsData.imageFile = file;
        $scope.errFile = errFiles && errFiles[0];


    }


    $scope.save = function () {
        $('.fr-view').html('<p><strong>पिंपरी, दि. २० (पीसीबी)</strong> - <span style="color: rgb(251, 160, 38);">मोबाईल चोरणाऱ्या एकाला निगडी पोलिसांनी अटक केली. ही कारवाई बुधवारी (दि. १९) निगडी परिसरात करण्यात आली. त्याच्याकडून दोन मोबाईल फोन जप्त करण्यात आले आहेत.</span><span style="color: rgb(251, 160, 38);">​<img class="fr-dib fr-draggable" src="http://pcbtoday.in/uploads/Website/PimpariNews_Registration/atak44.jpg" style="width: 300px;"></span></p>')
    }

    $scope.cancelUpdateForm = function () {
        $scope.update_news = true;
    }
    $scope.setFilter = function () {
        $scope.filter_text = $("#update_type option:selected").text();

        if ($scope.filter_text == 'All') {
            $scope.filter_text = "";
        }
    }

    $scope.deleteNews = function (news_id) {

        var row = this.$index + 1;
        swal({
            title: "Are you sure?",
            text: "You want to Delete information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {

                $http({
                    method: 'post',
                    url: pcbPath + 'Admin/deletePcbNewsById',
                    data: news_id,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function (data) {

                        if (data == '1') {
                            document.getElementById('updateTable').deleteRow(row);

                        }
                    });


            }
        });


    }

    $scope.updateNews = function () {

        $scope.updateNewsData.description = $('.fr-view').html();
        console.log($scope.updateNewsData)
        swal({
            title: "Are you sure?",
            text: "You want to save information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, save it!",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {

                if ($scope.updateNewsData.imageFile) {
                    $scope.updateNewsData.imageFile.upload = Upload.upload({
                        url: pcbPath + 'Admin/changeUploadFile',
                        data: {file: $scope.updateNewsData.imageFile, id: $scope.updateNewsData.type, oldImage: $scope.updateNewsData.oldImage, oldType: $scope.updateNewsData.Oldtype}
                    });

                    $scope.updateNewsData.imageFile.upload.then(function (response) {

                        console.log($scope.updateNewsData.imageFile);
                        $scope.updateNewsData.imageFile = response.data;
                        $http({
                            method: 'post',
                            url: pcbPath + 'Admin/updatePcbNews',
                            data: $scope.updateNewsData,
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                        }).success(function (data) {

                                console.log(data);
                                if (data == "1") {

                                    swal({
                                        title: "Success",
                                        text: "Information saved successfully.",
                                        type: "success",
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                    $scope.update_news = true;
                                    // $scope.resetForm();
                                    // $('.fr-view').html('');
                                }

                            });


                        $timeout(function () {
                            $scope.updateNewsData.imageFile.result = response.data;

                            $scope.updateNewsData.imageFile = (response.data)
                        });
                    }, function (response) {
                        if (response.status > 0) {
                            $scope.errorMsg = response.status + ': ' + response.data;
                            alert(response.data)
                        }
                    }, function (evt) {
                        $scope.updateNewsData.imageFile.progress = Math.min(100, parseInt(100.0 *
                            evt.loaded / evt.total));
                    });
                } else if ($scope.updateNewsData.Oldtype != $scope.updateNewsData.type) {

                    $http({
                        method: 'post',
                        url: pcbPath + 'Admin/changeUploadFilePath',
                        data: {id: $scope.updateNewsData.type, oldImage: $scope.updateNewsData.oldImage, oldType: $scope.updateNewsData.Oldtype},
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).success(function (data) {

                        });

                }else{

                    alert('Please check if file browsed or file size')
                    return;
                }




            }
        });


    }
    $scope.setupdateNews = function (news_id) {

        $scope.updateNewsData.collectionID = news_id;
        swal({
            title: "Are you sure?",
            text: "Do you want to modify information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, modify it!",
            closeOnConfirm: true,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {

                /////  Ajax request

                $http({
                    method: 'post',
                    url: pcbPath + 'Admin/getPcbNewsById',
                    data: news_id,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function (data) {
                        //   console.log(data[0]);
                        var newsData = data; // $.parseJSON(data[0])
                        //  console.log(newsData.id);
                        $scope.updateNewsData.tag = newsData.tag;
                        $scope.updateNewsData.title = newsData.title;
                        $scope.updateNewsData.type = newsData.pcb_news_id;
                        $scope.updateNewsData.Oldtype = newsData.pcb_news_id;
                        console.log("type=" + $scope.updateNewsData.type)
                        var element = document.getElementById('update_type');
                        element.value = newsData.pcb_news_id;
                        $scope.updateNewsData.type_text = $("#update_type option:selected").text();
                        $scope.updateNewsData.oldImage = newsData.image;
                        //   console.log($scope.updateNewsData.type)
                        $scope.uploadImg = pcbPath + 'uploads/' + newsData.pcb_news_id + '/' + newsData.image;
                        $('.fr-view').html(newsData.description);
                        $scope.update_news = false;

                    });


                //// Ajax request end


            } else {
                // swal("Cancelled d", "Your imaginary file is safe :)", "error");
                swal({
                    title: "Cancelled",
                    text: "You Cancelled Information modify request.",
                    type: "warning",
                    timer: 2000,
                    showConfirmButton: false
                });

            }
        });


    }
    setTimeout(function () {


        $scope.description = '';

        $('#edit').froalaEditor({
            imageUploadURL: 'your_upload_image_script.php',

            imageUploadParams: {
                id: 'edit'
            }
        })


        $('.selectpicker').selectpicker({
            size: 4
        });

        $('.js-basic-example').DataTable();

        //Exportable table
        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
            "bSort": false
        });


    }, 50);


});

adminApp.controller('notificationController', function ($scope,$http, Upload, $timeout) {


    $scope.pcbNewsNotification = {};

    $scope.uploadFiles = function (file, errFiles) {
        $scope.pcbNewsNotification.imageFile = file;
        $scope.errFile = errFiles && errFiles[0];


    }

    $scope.addpcbNewsNotification = function () {
        $scope.pcbNewsNotification.type = "17";

        swal({
            title: "Are you sure?",
            text: "You want to send Notification!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, send it!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                if ($scope.pcbNewsNotification.imageFile) {
                    $scope.pcbNewsNotification.imageFile.upload = Upload.upload({
                        url: pcbPath + 'Admin/uploadFile',
                        data: {file: $scope.pcbNewsNotification.imageFile, id: $scope.pcbNewsNotification.type}
                    });

                      $scope.pcbNewsNotification.imageFile.upload.then(function (response) {
					
					  $scope.pcbNewsNotification.description = $('.fr-view').html();

                     $scope.pcbNewsNotification.imageFile = response.data;//$scope.pcbNewsNotification.imageFile['name']

					
					$http({
						method: 'post',
						url: pcbPath + 'Admin/savePcbNews',
						data: $scope.pcbNewsNotification,
						headers: {'Content-Type': 'application/x-www-form-urlencoded'}
					}).success(function (data) {
                        if (data == "1") {

                            swal({
                                title: "Success",
                                text: "Information saved successfully.",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            });
                            $scope.resetForm();
                            // $('.fr-view').html('');
                        }
                    });
					
                        $timeout(function () {
                            $scope.pcbNewsNotification.imageFile.result = response.data;
                            $scope.pcbNewsNotification.imageFile = (response.data);
							
                        });
                    }, function (response) {
                        if (response.status > 0) {
                            $scope.errorMsg = response.status + ': ' + response.data;
                            alert(response.data)
                        }
                    }, function (evt) {
                        $scope.pcbNewsNotification.imageFile.progress = Math.min(100, parseInt(100.0 *
                            evt.loaded / evt.total));
                    });
                }


              
                // console.log($scope.pcbNews)

                


            } else {
                // swal("Cancelled d", "Your imaginary file is safe :)", "error");
                swal({
                    title: "Cancelled",
                    text: "You Cancelled Information send request.",
                    type: "warning",
                    timer: 2000,
                    showConfirmButton: false
                });

            }
            //  swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });


    }

    $scope.resetForm = function () {

        $scope.pcbNewsNotification = angular.copy($scope.originForm); // Assign clear state to modified form
        $scope.pcbNewsNotificationFrom.$setPristine(); // this line will update status of your form, but will not clean your data, where `registrForm` - name of form.
        $('.fr-view').html('');
        $scope.pcbNewsNotification = {};
        $('#newsImage').val('');
    }


    setTimeout(function () {


        $scope.description = '';

        $('#edit').froalaEditor({
            imageUploadURL: 'your_upload_image_script.php',

            imageUploadParams: {
                id: 'edit'
            }
        })


        $('.selectpicker').selectpicker({
            size: 4
        });

    }, 50);


});

adminApp.controller('updatePollController', function ($scope, $location, $http, pollList, myServices, $q) {
    $scope.pollList = pollList.data;

    console.log($scope.pollList)
    $scope.updatePollData = {}
    $scope.updateFlag = true;

    //   $.parseJSON();


    $scope.updatePoll = function () {


        swal({
            title: "Are you sure?",
            text: "You want to update Poll!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, save it!",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {


                $http({
                    method: 'post',
                    url: pcbPath + 'Admin/updatePcbPoll',
                    data: $scope.updatePollData,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function (data) {

                        //   console.log(data)
                        if (data == '1') {
                            swal({
                                title: "Success",
                                text: "Information saved successfully.",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            });

                            var polldata = myServices.getPollList();

                            polldata.then(

                                function (payload) {

                                    $scope.pollList = payload.data;


                                });
                            $scope.updateFlag = true;
                        } else {
                            swal({
                                title: "Error",
                                text: "There is Problem in Update, Please try again!.",
                                type: "warning",
                                timer: 2000,
                                showConfirmButton: false
                            });

                            showConfirmButton: false
                        }

                    });


            }
        });


    }

    $scope.deletePoll = function (id) {


        swal({
            title: "Are you sure?",
            text: "You want to Delete POLL information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {

                $http({
                    method: 'post',
                    url: pcbPath + 'Admin/deletePcbPollById',
                    data: id,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function (data) {

                        if (data == '1') {

                            var polldata = myServices.getPollList();

                            polldata.then(

                                function (payload) {

                                    $scope.pollList = payload.data;


                                });
                        }
                    });


            }
        });

    }
    $scope.setupdatePoll = function (id) {


        $scope.updatePollData.id = id;
        swal({
            title: "Are you sure?",
            text: "Do you want to modify Poll!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, modify it!",
            closeOnConfirm: true,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {

                /////  Ajax request

                $http({
                    method: 'post',
                    url: pcbPath + 'Admin/getPcbPollbyID',
                    data: $scope.updatePollData.id,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function (data) {

                        var pollData = data[0]; // $.parseJSON(data[0])
                        $scope.updatePollData.que = pollData.question;
                        $scope.updatePollData.A = pollData.option_a;
                        $scope.updatePollData.B = pollData.option_b;
                        $scope.updatePollData.C = pollData.option_c;
                        $scope.updatePollData.D = pollData.option_d;
                        $scope.updateFlag = false;

                    });


                //// Ajax request end


            } else {
                // swal("Cancelled d", "Your imaginary file is safe :)", "error");
                swal({
                    title: "Cancelled",
                    text: "You Cancelled Information modify request.",
                    type: "warning",
                    timer: 2000,
                    showConfirmButton: false
                });

            }
        });
    }

    setTimeout(function () {
        //Exportable table
        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
            "bSort": false
        });

    }, 500);


});


adminApp.controller('addPollController', function ($scope, $location, $http) {

    $scope.poll = {};


    $scope.savePcbPoll = function () {


        swal({
            title: "Are you sure?",
            text: "You want to save Poll!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, save it!",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {


                $http({
                    method: 'post',
                    url: pcbPath + 'Admin/savePcbPoll',
                    data: $scope.poll,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function (data) {

                        console.log(data);
                        if (data == "1") {

                            swal({
                                title: "Success",
                                text: "Information saved successfully.",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            });
                            //  $scope.resetForm();
                            // $('.fr-view').html('');
                        }
                    });

            }
        });

    }

    setTimeout(function () {


    }, 50);


});

adminApp.controller('addRashiController', function ($scope, $location, $http) {

    $scope.rashi = {};

    $scope.savePcbRashi = function () {


        swal({
            title: "Are you sure?",
            text: "You want to save Rashi!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, save it!",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {

                console.log()
                $http({
                    method: 'post',
                    url: pcbPath + 'Admin/savePcbRashi',
                    data: $scope.rashi,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function (data) {

                        console.log(data);
                        if (data == "1") {

                            swal({
                                title: "Success",
                                text: "Information saved successfully.",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            });
                            $scope.rashi = angular.copy($scope.originForm); // Assign clear state to modified form
                            $scope.pcbRashiFrom.$setPristine(); // this line will update status of your form, but will not clean your data, where `registrForm` - name of form.
                            $scope.rashi = {};
                        }
                    });

            }
        });

    }

    setTimeout(function () {


    }, 50);


});


adminApp.controller('readAreaNewsController', function ($scope, $location) {
    $scope.ads = false;
    $scope.rashi = false;
    $scope.poll = false;

    $scope.news = [
        {id: '1', imageUrl: 'img/flexslider/1.jpg', title: ' निगडीत दोन हजार नागरिकांना मोफत विमा '},
        {id: '2', imageUrl: 'img/flexslider/1.jpg', title: ' आंबेडकरी कार्यकर्त्यांनी मराठा मोर्च्यांच्या विरोधात प्रती मोर्चे काढू नये '},
        {id: '3', imageUrl: 'img/flexslider/1.jpg', title: ' पिंपरीगावातील टपाल कार्यालय फोडण्याचा प्रयत्न '},
        {id: '4', imageUrl: 'img/flexslider/1.jpg', title: ' निगडीत दोन हजार नागरिकांना मोफत विमा '},
        {id: '2', imageUrl: 'img/flexslider/1.jpg', title: ' मजुरांच्या मुलांसोबत केक कापून नेहरूनगरमध्ये मोदींचा वाढदिवस साजरा '},
        {id: '6', imageUrl: 'img/flexslider/1.jpg', title: ' निराधारनगर झोपडपट्टीत मोबाईल टॉयलेट उपलब्ध करावेत '},
        {id: '7', imageUrl: 'img/flexslider/1.jpg', title: ' नमोदींच्या वाढदिवसानिमित्त दापोडीत राष्ट्रीय महिला खेळाडूंचा सत्कार '},
        {id: '14', imageUrl: 'img/flexslider/1.jpg', title: ' निगडीत दोन हजार नागरिकांना मोफत विमा '},
        {id: '7', imageUrl: 'img/flexslider/1.jpg', title: ' पंतप्रधान मोदींच्या वाढदिवसानिमित्त निगडीत रक्तदान शिबीर '},
        {id: '8', imageUrl: 'img/flexslider/1.jpg', title: ' अंनिसच्या वतीने चिंचवडमध्ये मंगळवारी वाचक मेळाव्याचे आयोजन अंनिसच्या वतीने चिंचवडमध्ये मंगळवारी '},
        {id: '9', imageUrl: 'img/flexslider/1.jpg', title: ' पंतप्रधान नरेंद्र मोदी यांच्या वाढदिवसानिमित्त भाजपतर्फे स्वच्छता अभियान '},
        {id: '14', imageUrl: 'img/flexslider/1.jpg', title: ' निगडीत दोन हजार नागरिकांना मोफत विमा '},
        {id: '10', imageUrl: 'img/flexslider/1.jpg', title: ' विष्णू सावरांची मंत्रिमंडळातून हकालपट्टीची काँग्रेसची मागणी '},
        {id: '11', imageUrl: 'img/flexslider/1.jpg', title: ' पिंपरीत वाणी समाजाच्या वतीने गुणवंत विद्यार्थ्यांचा रविवारी सत्कार '},
        {id: '12', imageUrl: 'img/flexslider/1.jpg', title: ' निगडीत दोन हजार नागरिकांना मोफत विमा '},
        {id: '13', imageUrl: 'img/flexslider/1.jpg', title: ' पिंपरीतील सराईत गुन्हेगारावर एमपीडीए '},
        {id: '14', imageUrl: 'img/flexslider/1.jpg', title: ' निगडीत दोन हजार नागरिकांना मोफत विमा '},
        {id: '15', imageUrl: 'img/flexslider/1.jpg', title: ' कंपनीतील व्हिलचेअर चोरणारा पिंपरीत जेरबंद'},
        {id: '15', imageUrl: 'img/flexslider/1.jpg', title: ' पिंपरीत दुचाकी चोरटा जेरबंद '},
        {id: '15', imageUrl: 'img/flexslider/1.jpg', title: ' निगडीत सराईत गुन्हेगार पिस्तूलासह जेरबंद '},
        {id: '15', imageUrl: 'img/flexslider/1.jpg', title: ' पोलिसांवरील हल्ल्याचा अदिम यंग ग्लॅडीएटर्स संघटनेच्या वतीने निषेध '},
        {id: '16', imageUrl: 'img/flexslider/1.jpg', title: ' निगडीत दोन हजार नागरिकांना मोफत विमा '},
        {id: '17', imageUrl: 'img/flexslider/1.jpg', title: ' मराठी साम्राज्य सेनेच्या वतीने पोलीस आरती उपक्रम '},
        {id: '1', imageUrl: 'img/flexslider/1.jpg', title: ' निगडीत दोन हजार नागरिकांना मोफत विमा '},
        {id: '2', imageUrl: 'img/flexslider/1.jpg', title: ' आंबेडकरी कार्यकर्त्यांनी मराठा मोर्च्यांच्या विरोधात प्रती मोर्चे काढू नये '},
        {id: '3', imageUrl: 'img/flexslider/1.jpg', title: ' पिंपरीगावातील टपाल कार्यालय फोडण्याचा प्रयत्न '},
        {id: '4', imageUrl: 'img/flexslider/1.jpg', title: ' निगडीत दोन हजार नागरिकांना मोफत विमा '},
        {id: '2', imageUrl: 'img/flexslider/1.jpg', title: ' मजुरांच्या मुलांसोबत केक कापून नेहरूनगरमध्ये मोदींचा वाढदिवस साजरा '},
        {id: '6', imageUrl: 'img/flexslider/1.jpg', title: ' निराधारनगर झोपडपट्टीत मोबाईल टॉयलेट उपलब्ध करावेत '},
        {id: '7', imageUrl: 'img/flexslider/1.jpg', title: ' नमोदींच्या वाढदिवसानिमित्त दापोडीत राष्ट्रीय महिला खेळाडूंचा सत्कार '},
        {id: '14', imageUrl: 'img/flexslider/1.jpg', title: ' निगडीत दोन हजार नागरिकांना मोफत विमा '},
        {id: '7', imageUrl: 'img/flexslider/1.jpg', title: ' पंतप्रधान मोदींच्या वाढदिवसानिमित्त निगडीत रक्तदान शिबीर '},
        {id: '8', imageUrl: 'img/flexslider/1.jpg', title: ' अंनिसच्या वतीने चिंचवडमध्ये मंगळवारी वाचक मेळाव्याचे आयोजन अंनिसच्या वतीने चिंचवडमध्ये मंगळवारी '},
        {id: '9', imageUrl: 'img/flexslider/1.jpg', title: ' पंतप्रधान नरेंद्र मोदी यांच्या वाढदिवसानिमित्त भाजपतर्फे स्वच्छता अभियान '},
        {id: '14', imageUrl: 'img/flexslider/1.jpg', title: ' निगडीत दोन हजार नागरिकांना मोफत विमा '},
        {id: '10', imageUrl: 'img/flexslider/1.jpg', title: ' विष्णू सावरांची मंत्रिमंडळातून हकालपट्टीची काँग्रेसची मागणी '},
        {id: '11', imageUrl: 'img/flexslider/1.jpg', title: ' पिंपरीत वाणी समाजाच्या वतीने गुणवंत विद्यार्थ्यांचा रविवारी सत्कार '},
        {id: '12', imageUrl: 'img/flexslider/1.jpg', title: ' निगडीत दोन हजार नागरिकांना मोफत विमा '},
        {id: '13', imageUrl: 'img/flexslider/1.jpg', title: ' पिंपरीतील सराईत गुन्हेगारावर एमपीडीए '},
        {id: '14', imageUrl: 'img/flexslider/1.jpg', title: ' निगडीत दोन हजार नागरिकांना मोफत विमा '},
        {id: '15', imageUrl: 'img/flexslider/1.jpg', title: ' कंपनीतील व्हिलचेअर चोरणारा पिंपरीत जेरबंद'},
        {id: '15', imageUrl: 'img/flexslider/1.jpg', title: ' पिंपरीत दुचाकी चोरटा जेरबंद '},
        {id: '15', imageUrl: 'img/flexslider/1.jpg', title: ' निगडीत सराईत गुन्हेगार पिस्तूलासह जेरबंद '},
        {id: '15', imageUrl: 'img/flexslider/1.jpg', title: ' पोलिसांवरील हल्ल्याचा अदिम यंग ग्लॅडीएटर्स संघटनेच्या वतीने निषेध '},
        {id: '16', imageUrl: 'img/flexslider/1.jpg', title: ' निगडीत दोन हजार नागरिकांना मोफत विमा '},
        {id: '17', imageUrl: 'img/flexslider/1.jpg', title: ' मराठी साम्राज्य सेनेच्या वतीने पोलीस आरती उपक्रम '}
    ];


    $scope.currentPage = 0;
    $scope.pageSize = 30;

    $scope.numberOfPages = function () {
        return Math.ceil($scope.news.length / $scope.pageSize);
    }

    /*   jQuery( "#accordion" ).accordion({
     heightStyle: "content"
     });

     !function (d, s, id) {
     var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
     if (!d.getElementById(id)) {
     js = d.createElement(s);
     js.id = id;
     js.src = p + "://platform.twitter.com/widgets.js";
     fjs.parentNode.insertBefore(js, fjs);
     }
     }(document, "script", "twitter-wjs")

     createMarquee({  });*/
});

adminApp.controller('contactController', function ($scope) {
    $scope.message = 'Contact us! JK. This is just a demo.';
});

adminApp.controller('addAdsController', function ($scope,getAdsType,Upload, $timeout,$http) {
    $scope.adsType = getAdsType.data;
    console.log($scope.adsType)
	$scope.pcbadd = {};
	$scope.uploadFiles = function (file, errFiles) {
        $scope.pcbadd.imageFile = file;
        $scope.errFile = errFiles && errFiles[0];
    }
	
	$scope.addPcbAds = function(){
        swal({
            title: "Are you sure?",
            text: "You want to save.!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, save it!",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
				if ($scope.pcbadd.imageFile) {
                    $scope.pcbadd.imageFile.upload = Upload.upload({
                        url: pcbPath + 'Admin/uploadFile',
                        data: {file: $scope.pcbadd.imageFile, id: $scope.pcbadd.type}
                    });

                    $scope.pcbadd.imageFile.upload.then(function (response) {
                        $timeout(function () {
                            $scope.pcbadd.imageFile.result = response.data;

                            $scope.pcbadd.imageFile = (response.data);
                            console.log(response.data);
                            console.log( $scope.pcbadd);
                            $http({
                                method: 'post',
                                url: pcbPath + 'Admin/savePcbAds',
                                data: $scope.pcbadd,
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                            }).success(function (data) {
                                    if (data == "1") {
                                        swal({
                                            title: "Success",
                                            text: "Information saved successfully.",
                                            type: "success",
                                            timer: 2000,
                                            showConfirmButton: false
                                        });
                                    }
                                });
                        });
                    }, function (response) {
                        if (response.status > 0) {
                            $scope.errorMsg = response.status + ': ' + response.data;
                            alert(response.data)
                        }
                    }, function (evt) {
                        $scope.pcbadd.imageFile.progress = Math.min(100, parseInt(100.0 *
                            evt.loaded / evt.total));
                    });
                }else{

                    alert('Please check your image size or name')
                    return;
                }
				
			    //$scope.pcbadd.imageFile = $scope.pcbadd.imageFile['name']


            }
        });
	}
	setTimeout(function () {      

        $('.selectpicker').selectpicker({
            size: 4
        });

    }, 50);
});

adminApp.controller('addVideoController', function ($scope,getVideoType, $timeout,$http) {
    $scope.videoType = getVideoType.data;
	$scope.video = {};
		
	$scope.savePcbVideo = function(){
        swal({
            title: "Are you sure?",
            text: "You want to save.!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, save it!",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
				    $http({
                    method: 'post',
                    url: pcbPath + 'Admin/savePcbVideo',
                    data: $scope.video,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function (data) {
                        if (data == "1") {
                            swal({
                                title: "Success",
                                text: "Information saved successfully.",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    });

            }
        });
	}
	setTimeout(function () {      

        $('.selectpicker').selectpicker({
            size: 4
        });

    }, 50);
});



adminApp.controller('deleteAdsController', function ($scope, $http, $timeout, getAds) {

    $scope.ads=getAds.data;

    console.log($scope.ads)
    $scope.pcbwardInfo = {};

    $scope.deleteAd=function(adv_type,image,id){

        $scope.adData={};
        $scope.adData.adv_type=adv_type;
        $scope.adData.image=image;
        $scope.adData.id=id;
        swal({
            title: "Are you sure?",
            text: "You want to delete advertisement!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {


                $http({
                    method: 'post',
                    url: pcbPath + 'Admin/deleteAdv',
                    data: $scope.adData,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function (data) {

                        if (data == "1") {

                            swal({
                                title: "Success",
                                text: "Information deleted successfully.",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            });

                        }
                    });

            }
        });

    }



})


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

adminApp.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;

            element.bind('change', function () {
                scope.$apply(function () {
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}]);


adminApp.filter('startFrom', function () {
    return function (input, start) {
        start = +start; //parse to int
        return input.slice(start);
    }
});


adminApp.run(function ($timeout) { // instance-injector


})
