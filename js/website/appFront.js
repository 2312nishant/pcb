var frontApp = angular.module('frontApp', ['ui.router', 'ui.bootstrap', 'infinite-scroll']);
frontApp.config(function ($stateProvider, $urlRouterProvider) {

    $urlRouterProvider.otherwise('/home');


    $stateProvider.state('web', {
        abstract: true,
        views: {
            '': {
                templateUrl: 'pages/content.html',
                controller: 'ContentController'

            },
            'header': {
                templateUrl: 'pages/header.php',
                controller: 'headerController',
                resolve: {
                    websiteData: ['frontEndServices', function (frontEndServices) {
                        return frontEndServices.websiteCall();
                    }]
                }
            },
            'rightBar': {
                templateUrl: 'pages/rightBar.html',
                controller: 'rightBarController',
                resolve: {
                    websiteData: ['frontEndServices', function (frontEndServices) {
                        return frontEndServices.websiteCall();
                    }],
                    pollData: ['frontEndServices', function (frontEndServices) {
                        return frontEndServices.pollCall();
                    }],
                    topReadCollectionNews: ['frontEndServices', function (frontEndServices) {
                        return frontEndServices.getTopReadCollectionNews();
                    }],
                    hashTag: ['frontEndServices', function (frontEndServices) {
                        return frontEndServices.getHashTag();
                    }],
                    getAds: ['frontEndServices', function (frontEndServices) {
                        return frontEndServices.getAds();
                    }]
                }
            },
            'footer': {
                templateUrl: 'pages/footer.html',
                controller: 'footerController',
                resolve: {
                    websiteData: ['frontEndServices', function (frontEndServices) {

                        return frontEndServices.websiteCall();
                    }]
                }
            }
        }
    }).state('electionPage', {
            abstract: true,
            views: {
                'election': {
                    templateUrl: 'pages/content.html',
                    controller: 'ContentController'

                },
                'header': {
                    templateUrl: 'pages/header.php',
                    controller: 'headerController',
                    resolve: {
                        websiteData: ['frontEndServices', function (frontEndServices) {
                            return frontEndServices.websiteCall();
                        }]
                    }
                },
                'footer': {
                    templateUrl: 'pages/footer.html',
                    controller: 'footerController',
                    resolve: {
                        websiteData: ['frontEndServices', function (frontEndServices) {
                            return frontEndServices.websiteCall();
                        }]
                    }
                }
            }
        })
        .state('web.home', {
            url: '/home',
            templateUrl: 'pages/home.html',
            controller: 'mainController',
            resolve: {
                websiteData: ['frontEndServices', function (frontEndServices) {
                    console.log("rest website call loaded-" + new Date())
                    return frontEndServices.websiteCall();
                }],
                topCollectionNews: ['frontEndServices', function (frontEndServices) {
                    return frontEndServices.getTopCollectionNews();
                }],
                getAds: ['frontEndServices', function (frontEndServices) {
                    return frontEndServices.getAds();
                }]
            }
        }).state('web.readAreaNews', {
            url: '/readAreaNews/:id',
            templateUrl: 'pages/readAreaNews.html',
            controller: 'readAreaNewsController',
            resolve: {
                getPcbNewsByType: ['frontEndServices', '$stateParams', function (frontEndServices, $stateParams) {
                    return frontEndServices.getPcbNewsByType($stateParams.id);
                }]
            }
        }).state('web.readNews', {
            url: '/readNews/:id',
            templateUrl: 'pages/readNews.html',
            controller: 'readNewsController',
            resolve: {
                getNews: ['getNewsService', '$stateParams', function (getNewsService, $stateParams) {
                    return getNewsService.getNews($stateParams.id);
                }],
                getRelatedNews: ['getNewsService', '$stateParams', function (getNewsService, $stateParams) {
                    return getNewsService.getRelatedNews($stateParams.id);
                }]
            }
        }).state('electionPage.election', {
            url: '/election',
            templateUrl: 'pages/election.php',
            controller: 'electionController',
            resolve: {
                getNews: ['getNewsService', '$stateParams', function (getNewsService, $stateParams) {

                    return getNewsService.getNews($stateParams.id);
                }]
            }
        }).state('electionPage.electionwards', {
            url: '/electionwards',
            templateUrl: 'pages/electionWards.php',
            controller: 'electionWardsController',
            resolve: {
                wardInfo: ['frontEndServices', function (frontEndServices) {
                    return frontEndServices.getWardInfo();
                }]
            }
        }).state('electionPage.wardInfo', {
            url: '/wardInfo/:id',
            templateUrl: 'pages/wardInfo.php',
            controller: 'wardsInfoController',
            resolve: {
                wardAllInfo: ['frontEndServices', '$stateParams', function (frontEndServices) {
                    return frontEndServices.getWardInfo();
                }],
                wardCandidateInfo: ['frontEndServices', '$stateParams', function (frontEndServices, $stateParams) {
                    return frontEndServices.wardCandidateInfo($stateParams.id);
                }],
                getCandidateWardInfo: ['frontEndServices', '$stateParams', function (frontEndServices, $stateParams) {
                    return frontEndServices.getCandidateWardInfo($stateParams.id);
                }]
            }
        }).state('electionPage.electionresult', {
            url: '/electionResult',
            templateUrl: 'pages/electionResult.php',
            controller: 'electionResultController',
            resolve: {
                getAllCandidateInfo: ['frontEndServices', function (frontEndServices) {
                    return frontEndServices.getAllCandidateInfo();
                }],
                getWardInfo: ['frontEndServices', function (frontEndServices) {
                    return frontEndServices.getWardInfo();
                }]
            }
        }).state('web.readHashTag', {
            url: '/readHashTag/:tag',
            templateUrl: 'pages/readAreaNews.html',
            controller: 'hashTagController',
            resolve: {
                getHashNews: ['frontEndServices', '$stateParams', function (frontEndServices, $stateParams) {
                    return frontEndServices.getHashNews($stateParams.tag);
                }]
            }
        })


})

frontApp.factory('httpInterceptor', function ($q, $rootScope, $log) {

    var numLoadings = 0;

    return {
        request: function (config) {

            numLoadings++;

            // Show loader
            $rootScope.$broadcast("loader_show");
            return config || $q.when(config)

        },
        response: function (response) {

            if ((--numLoadings) === 0) {
                // Hide loader
                $rootScope.$broadcast("loader_hide");
            }

            return response || $q.when(response);

        },
        responseError: function (response) {

            if (!(--numLoadings)) {
                // Hide loader
                $rootScope.$broadcast("loader_hide");
            }

            return $q.reject(response);
        }
    };
});
frontApp.config(function ($httpProvider) {
    $httpProvider.interceptors.push('httpInterceptor');
});

frontApp.factory('frontEndServices', function ($http) {
    return {
        // 1st function
        websiteCall: function () {
            return  $http({
                method: 'post',
                url: pcbPath + 'Website/getWebsiteData',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data) {
                    console.log("rest website responce loaded-" + new Date())
                    return data;
                });
        },
        getBreakingNews: function () {
            return  $http({
                method: 'post',
                url: pcbPath + 'Admin/getBreakingNews',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data) {
                    return data;
                });
        },
        pollCall: function () {
            return  $http({
                method: 'post',
                url: pcbPath + 'Website/getPollData',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data) {
                    return data;
                });
        },
        getPcbNewsByType: function (id) {

            return  $http({
                method: 'post',
                url: pcbPath + 'Admin/getPcbNewsByType',
                data: {news_type: id, limit: 50},
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data) {
                    ////console.log(data)
                    return data;


                });
        },
        getTopCollectionNews: function (id) {

            return  $http({
                method: 'post',
                url: pcbPath + 'Admin/getTopCollectionNews',
                data: {news_type: id, limit: 50},
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data) {
                    ////console.log(data)
                    return data;


                });
        },
        getTopReadCollectionNews: function (id) {

            // alert(id)
            return  $http({
                method: 'post',
                url: pcbPath + 'Admin/getTopReadCollectionNews',
                data: {news_type: id, limit: 50},
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data) {
                    ////console.log(data)
                    return data;


                });
        },
        getHashTag: function (id) {

            // alert(id)
            return  $http({
                method: 'post',
                url: pcbPath + 'Admin/getHashTag',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data) {
                    //console.log(data)
                    return data;


                });
        },
        getHashNews: function (tag) {

            // alert(id)
            return  $http({
                method: 'post',
                url: pcbPath + 'Admin/getPcbNewsByHashTag',
                data: {tag: tag},
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data) {
                    //console.log(data)
                    return data;


                });
        },
        getWardInfo: function () {
            return  $http({
                method: 'post',
                url: pcbPath + 'Admin/getWardInfo',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data) {
                    //console.log(data)
                    return data;
                });
        },
        wardCandidateInfo: function (id) {
            return  $http({
                method: 'post',
                url: pcbPath + 'Website/getCandidateWardInfo',
                data: {id: id},
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data) {
                    console.log(data)
                    return data;
                });
        },
        getAllCandidateInfo: function () {
            return  $http({
                method: 'post',
                url: pcbPath + 'Website/getAllCandidateInfo',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data) {
                    // console.log(data)
                    return data;
                });
        },
        getCandidateWardInfo: function (id) {
            return  $http({
                method: 'post',
                url: pcbPath + 'Website/getCandidateWardInfo',
                data: {id: id},
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data) {
                    return data;
                });
        },
        getAds: function () {
            return  $http({
                method: 'post',
                url: pcbPath + 'Website/getAdvertise',

                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data) {
                    console.log(data)
                    return data;
                });
        }
    };
});


frontApp.service("myService", function ($rootScope) {
    this.getAddition = function (a, b) {
        return a + b;
    }
});
frontApp.service("getNewsService", function ($rootScope, $http) {
    this.getNews = function (id) {
        return  $http({
            method: 'post',
            url: pcbPath + 'Website/getNews',
            data: {id: id},
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (data) {
                ////console.log(data)
                return data;

            });
    },
        this.getRelatedNews = function (id) {
            return  $http({
                method: 'post',
                url: pcbPath + 'Admin/getRelatedNewsList',
                data: {id: id},
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data) {
                    console.log(data)
                    return data;

                });
        }
});
frontApp.service("saveVoteService", function ($rootScope, $http) {
    this.saveVote = function (id, option) {
        $http({
            method: 'post',
            url: pcbPath + 'Website/savePollVote',
            data: {option: option, id: id},
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (data) {
                //  //console.log(data[0]);
                var totalVotes = data[0].total;
                var data = {
                    p1: data[0].cnt_a,
                    p2: data[0].cnt_b,
                    p3: data[0].cnt_c,
                    p4: data[0].cnt_d
                };

                updateDisplay(totalVotes, data);

            });
    }
});


frontApp.filter('dateFormat', function ($filter) {
    return function (input) {
        if (input == null) {
            return "";
        }

        var _date = $filter('date')(new Date(input), 'dd MMMM yyyy');

        return _date.toUpperCase();

    };
});

frontApp.controller('ContentController', function () {
})

frontApp.controller('electionResultController', function ($scope,getAllCandidateInfo,getWardInfo) {
    $scope.candidateInfo=getAllCandidateInfo.data;
   $scope.ward_id;
    console.clear();
    $scope.wardInfo=getWardInfo.data;

    $scope.setFilter = function () {

        $scope.filter_textfilter_text = $("#update_ward option:selected").text();

        if ($scope.filter_text == 'All') {
            $scope.filter_text = "";
        }
    }

    setTimeout(function () {
    $('table').DataTable();
    }, 50);
})

frontApp.controller('wardsInfoController', function ($scope, wardCandidateInfo,getCandidateWardInfo) {
    $scope.vm = this;
  //  $scope.vm.images = wardCandidateInfo.data;
    $scope.vm.images = getCandidateWardInfo.data;
    $scope.area=$scope.vm.images.wardInfo[0].area;
    $scope.prabhag_name=$scope.vm.images.wardInfo[0].prabhag_no;
    console.clear();
console.log($scope.vm.images)

    Grid.init();
})

frontApp.controller('hashTagController', function ($scope, getHashNews, $rootScope, $anchorScroll) {
    $anchorScroll();
    $scope.pcbImagePath = pcbImagePath;
    $scope.pcbPath = pcbPath;
    $rootScope.ads = false;
    $rootScope.rashi = false;
    $rootScope.poll = false;
    $scope.news = getHashNews.data;
    if ($scope.news.length > 0) {
        $scope.show = true;
    }
    $scope.currentPage = 0;
    $scope.pageSize = 20;

    $scope.numberOfPages = function () {
        return Math.ceil($scope.news.length / $scope.pageSize);
    }
})
// create the controller and inject Angular's $scope
frontApp.controller('electionController', function ($scope) {
    $scope.pcbPath = pcbPath;
    $(document).ready(function (e) {
        $('img[usemap]').rwdImageMaps();


        $('.map').maphilight();


    });

    $scope.showInfo = function (area, call) {

        $.getJSON("js/election/election2017.json", function (data) {
            $.each(data, function (key, val) {

                $scope.prabhag_no = val[area].id;
                $scope.prabhag_area = val[area].area;
                $scope.prabhag_A = val[area].subward.A
                $scope.prabhag_B = val[area].subward.B
                $scope.prabhag_C = val[area].subward.C
                $scope.prabhag_D = val[area].subward.D

                $scope.prabhag_candidates = val[area].candidates;
                $scope.prabhag_map = $scope.pcbPath + '/images/election/' + val[area].map + '.jpg'
                $scope.$apply();
            });
        });
        //  if(call!=0)
        //  $('#map-model').click();

    }
    $scope.showInfo('ward_1', '0')
});
frontApp.controller('electionWardsController', function ($scope, wardInfo) {
    $scope.wards = wardInfo.data;

});
frontApp.controller('headerController', function ($scope, $rootScope, websiteData) {

    $('.side-collapse li').click(function() {
        $(this).siblings('li').removeClass('active');
        $(this).addClass('active');
    });

    if (isMobile.Android()) {

        $('.apps').css('display', 'none');

    } else if (isMobile.iOS()) {
        $('.apps').css('display', 'none');
    } else {
        $('#contact-buttons-bar').css('display', 'none');

    }
    $scope.breakingNews = websiteData.data['breaking'];
    createMarquee({ duration: 35000 });
    /// for responsive left side menu effect
    $('[data-toggle=collapse-side]').click(function (e) {
        $('.side-collapse').toggleClass('in');
    });

    $('.side-collapse li a:last-child').click(function (e) {
        $('.side-collapse').toggleClass('in');
    });


// end effect here
    /////check device OS
    if (isMobile.Android()) {
        $('.ios').css('display', 'none');
        var height = $('header').height();

        $('body').css('padding-top', height + 'px');
        $('#contact-buttons-bar').css('padding-top', height + 'px');
        $('#myModal').css('top', height + 'px');
        $('.desc p').css('font-size', '16px');
        $('#contact-buttons-bar').css('display', 'block');
        $('.logo img').css('width', '140px');

    } else if (isMobile.iOS()) {
        $('.android').css('display', 'none');
        var height = $('header').height();
        //   alert(height)

      //  $('body').css('padding-top', height + 'px');
        $('#contact-buttons-bar').css('padding-top', height + 'px');
      //  $('.desc p').css('font-size', '16px');
        $('#contact-buttons-bar').css('display', 'block');
        $('.logo img').css('width', '140px');


    } else {
        $('#contact-buttons-bar').css('display', 'none');
        //  $('body').css('padding-top','100px');
    }

});
frontApp.controller('footerController', function ($scope, $rootScope, websiteData) {

});
frontApp.controller('rightBarController', function ($scope, $rootScope, saveVoteService, websiteData, topReadCollectionNews, pollData, hashTag,getAds) {
    $rootScope.ads = true;
    $rootScope.rashi = true;
    $rootScope.poll = true;
    $scope.topReadCollectionNews = topReadCollectionNews.data;
    $scope.pollData = pollData.data[0];
    $scope.hashTag = hashTag.data;
    $scope.rightAds=getAds.data['Right Side'];
    $scope.rightbottomAds=getAds.data['Right bottom'];
    $scope.myInterval = 3000;
      //  console.clear()
    //console.log(getAds.data)
    //console.log( $scope.rightAds)
    //console.log($scope.rightbottomAds)
    var totalVotes = $scope.pollData.total;
    var data = {
        p1: $scope.pollData.cnt_a,
        p2: $scope.pollData.cnt_b,
        p3: $scope.pollData.cnt_c,
        p4: $scope.pollData.cnt_d
    };

    updateDisplay(totalVotes, data);

    $scope.saveVote = function (id, option) {

        saveVoteService.saveVote(id, option);
    }

    /////  tag entry here
    //   var tags = ['vishal', 'nishant', 'nathbone', 'nair', 'vishal', 'nishant', 'nathbone', 'nair', 'vishal', 'nishant', 'nathbone', 'nair', 'vishal', 'nishant', 'nathbone', 'nair'];
    var minfont = 12;
    var maxfont = 30;
    //var x = Math.floor(Math.random() * (maxfont - minfont+ 1)) + minfont;
    var htmldata = '';
    for (var i = 0; i < $scope.hashTag.length; i++) {
        var x = Math.floor(Math.random() * (maxfont - minfont + 1)) + minfont;
        htmldata += '<a href="#readHashTag/' + $scope.hashTag[i].tag + '" style="display:inline-block; padding:3px;font-size:' + x + 'px">' + $scope.hashTag[i].tag + '</span>';
    }
    //alert(htmldata)
    $('#tags').html(htmldata)
    // end tag entry


});
frontApp.controller('mainController', function ($http, $scope, $rootScope, $location, websiteData, saveVoteService, topCollectionNews,getAds) {
    // $http.get('your-server-endpoint')
    var height = $('header').height();

    if (isMobile.Android()) {

        $('.container-fluid').css('padding-top', height + 'px !important');
        $('#contact-buttons-bar').css('display', 'none');

    } else if (isMobile.iOS()) {
        $('.container-fluid').css('padding-top', height + 'px');
        $('#contact-buttons-bar').css('display', 'none');
    }
    console.log("controller main loaded-" + new Date())

    $scope.bannerNews = websiteData.data[1];
    $scope.pimpriNews = websiteData.data[2];
    $scope.chinchwadNews = websiteData.data[3];
    $scope.bhosariNews = websiteData.data[4];
    $scope.puneNews = websiteData.data[5];
    $scope.maharashtraNews = websiteData.data[6];
    $scope.puneGraminNews = websiteData.data[12];
    $scope.deshNews = websiteData.data[7];
    $scope.videshNews = websiteData.data[8];
    $scope.kridaNews = websiteData.data[15];
    $scope.life_style = websiteData.data[16];
    $scope.notificationNews = websiteData.data[17];
    //$rootScope.breakingNews = websiteData.data['breaking'];
    $scope.pcbImagePath = pcbImagePath;
    $rootScope.ads = true;
    $rootScope.rashi = true;
    $rootScope.poll = true;
    //   $rootScope.pollData=pollData.data[0];
    // $rootScope.topReadCollectionNews=topReadCollectionNews.data;
    $scope.topCollectionNews = topCollectionNews.data;

    //console.log($scope.topCollectionNews)


    $(function () {

        //  createMarquee({ });

        //example of overwriting defaults:


        $scope.myInterval = 3000;
        $scope.slides = getAds.data['Middle'];
        $scope.Pop_Up = getAds.data['Pop Up'];


        setTimeout(function () {

            $(document).ready(function () {
              //$('#modelbtn').click();
                /////check device OS
                if (isMobile.Android()) {
                    $('.ios').css('display', 'none');
                    $('#myModal').css('margin-top','150px');

                } else if (isMobile.iOS()) {
                    $('.android').css('display', 'none');
                    $('#myModal').css('margin-top','150px');
                } else {

                    $('.main-slider img').height($('.list').height())
                    $('.newsimg img').css('height', $('.newstext').height())
                }


                jQuery('.flexslider').flexslider({
                    animation: 'fade',
                    controlNav: false,
                    slideshowSpeed: 4000,
                    animationDuration: 300
                });

                jQuery('#appcarousel').carouFredSel({
                    width: '100%',
                    direction: "bottom",
                    scroll: 400,
                    items: {
                        visible: '+3'
                    },
                    auto: {
                        items: 0,
                        timeoutDuration: 4000
                    },
                    prev: {
                        button: '#appprev',
                        items: 1
                    },
                    next: {
                        button: '#appnext',
                        items: 1
                    }
                });

                jQuery('#carousel').carouFredSel({
                    width: '100%',
                    direction: "bottom",
                    scroll: 400,
                    items: {
                        visible: '+3'
                    },
                    auto: {
                        items: 1,
                        timeoutDuration: 4000
                    },
                    prev: {
                        button: '#prev1',
                        items: 1
                    },
                    next: {
                        button: '#next1',
                        items: 1
                    }
                });

                jQuery('#carousel2').carouFredSel({
                    width: '100%',
                    direction: "bottom",
                    scroll: 400,
                    items: {
                        visible: '+3'
                    },
                    auto: {
                        items: 1,
                        timeoutDuration: 4000
                    },
                    prev: {
                        button: '#prev2',
                        items: 1
                    },
                    next: {
                        button: '#next2',
                        items: 1
                    }
                });
                jQuery('#carousel3').carouFredSel({

                    direction: "left",
                    scroll: {
                        duration: 800
                    },
                    width: '100%',               // The width of the carousel. Can be null (width will be calculated), a number, "variable" (automatically resize the carousel when scrolling items with variable widths), "auto" (measure the widest item) or a percentage like "100%" (only applies on horizontal carousels)
                    height: null,
                    items: {
                        visible: '4'
                    },
                    auto: {
                        items: 1,
                        timeoutDuration: 4000
                    },
                    prev: {
                        button: '#prev3',
                        items: 1
                    },
                    next: {
                        button: '#next3',
                        items: 1
                    }
                });




            });


        }, 0);

    });
});

frontApp.controller('readNewsController', function ($rootScope, $scope, $stateParams, getNews, $sce, getRelatedNews, $http, $anchorScroll) {
    $anchorScroll();
    // $http.get('your-server-endpoint')
    var news = getNews.data;
    $scope.news = news;
    $scope.relatedNews = getRelatedNews.data;
    $scope.newsId = $stateParams.id;


    $scope.newsdescription = $sce.trustAsHtml(news.description);


    $rootScope.ads = true;
    $rootScope.rashi = false;
    $rootScope.poll = false;

    // Google Fonts
    WebFontConfig = {
        google: { families: [ 'Lato:400,700,300:latin' ] }
    };
    (function () {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    })();

// Initialize Share-Buttons
    $.contactButtons({
        effect: 'slide-on-scroll',
        buttons: {
            'facebook': { class: 'facebook', use: true, link: 'https://www.facebook.com/pages/mycompany', extras: 'target="_blank"' },
            'linkedin': { class: 'linkedin', use: true, link: 'https://www.linkedin.com/company/mycompany' },
            'google': { class: 'gplus', use: true, link: 'https://plus.google.com/myidongoogle' },
            'email': { class: 'email', use: true, link: 'test@web.com' }
        }
    });

    var height = $('header').height();
    if (isMobile.Android()) {
        // $('.desc').removeProperty('position')
        $('.desc').css('position', '');
        $('#contact-buttons-bar').css('padding-top', height + 'px');
        $('#contact-buttons-bar').css('display', 'block');
        $('.sharebutton').css('display', 'none');


    } else if (isMobile.iOS()) {
        $('.desc').css('position', '');
        $('#contact-buttons-bar').css('padding-top', height + 'px');
        $('#contact-buttons-bar').css('display', 'block');
        $('.sharebutton').css('display', 'none');

    } else {
        $('#contact-buttons-bar').css('display', 'none');
        //  $('body').css('padding-top','100px');
    }


});
frontApp.constant('chunkSize', 100);
frontApp.filter('renderHTMLCorrectly', function ($sce) {
    return function (stringToParse) {
        return $sce.trustAsHtml(stringToParse);
    }
});

frontApp.controller('readAreaNewsController', function ($rootScope, $scope, getPcbNewsByType, $sce, $http, $anchorScroll) {
    //   $http.get('your-server-endpoint')

    $anchorScroll();
    $scope.pcbImagePath = pcbImagePath;
    $scope.pcbPath = pcbPath;
    // //console.log(getPcbNewsByType.data)
    $rootScope.ads = true;
    $rootScope.rashi = false;
    $rootScope.poll = false;

    $scope.news = getPcbNewsByType.data;

    if ($scope.news.length > 0) {
        $scope.show = true;
    }

    $scope.currentPage = 0;
    $scope.pageSize = 20;

    $scope.numberOfPages = function () {
        return Math.ceil($scope.news.length / $scope.pageSize);
    }

    if (isMobile.Android()) {

        $('#contact-buttons-bar').css('display', 'none');

    } else if (isMobile.iOS()) {
        $('#contact-buttons-bar').css('display', 'none');

    }
});

frontApp.controller('contactController', function ($scope) {
    $scope.message = 'Contact us! JK. This is just a demo.';
});

frontApp.directive("loader", function ($rootScope) {
        return function ($scope, element, attrs) {
            $scope.$on("loader_show", function () {
                return element.show();
            });
            return $scope.$on("loader_hide", function () {
                return element.hide();
            });
        };
    }
)

frontApp.directive('footerPanel', function () {
    return {
        restrict: 'A', //This menas that it will be used as an attribute and NOT as an element. I don't like creating custom HTML elements
        replace: true,
        templateUrl: "pages/footer.html"

    }
});
frontApp.directive('headerPart', function () {

    return {
        restrict: 'A', //This menas that it will be used as an attribute and NOT as an element. I don't like creating custom HTML elements
        replace: true,
        templateUrl: "pages/header.html"

    }

});
frontApp.directive('sideBar', function () {
    return {
        restrict: 'A', //This menas that it will be used as an attribute and NOT as an element. I don't like creating custom HTML elements
        replace: true,
        templateUrl: "pages/siderBar.html"

    }
});

frontApp.directive('ogThumbnailGrid', ['$timeout', function ($timeout) {
    return {
        scope: {},
        controller: ThumbnailGridCtrl,
        controllerAs: 'vm',
        bindToController: {
            images: '='
        },
        template: '<div id="og-grid" class="og-grid"><div ng-repeat="partyinfo in vm.images.partyInfo" class="pcb_card" style="margin-bottom: 20px;"><h2 style="font-weight: bold">{{partyinfo.party_name}}</h2> <div ng-repeat="info in vm.images.partyInfo[$index].candidate_info" class="col-xs-12 col-sm-4 col-md-3 data"><a href="javascript:void(0)" data-largesrc="uploads/candidate/{{info.photo}}" data-qualification="{{info.qualification}}" data-occupation="{{info.occupation}}" data-age="{{info.age}}" data-contact="{{info.mobile_no}}" data-email="{{info.email}}" data-reservation_name="{{info.reservation_name}}" data-party_name="{{info.party_name}}" data-party_full_name="{{info.party_full_name}}" data-symbol="{{info.symbol}}" data-title="{{info.name}}" data-description="{{info.description}}" data-details="{{info.description}}"><img ng-src="uploads/candidate/{{info.photo}}" alt="{{info.name}}" style="height: 250px;width: 100%;" /><p style="padding: 0;margin: 0;text-align: left"><span style="font-weight: bold;display: inline-block; width: 25px;">नाव:</span> {{info.name}}</p><p style="padding: 0;margin: 0;text-align: left"><span style="display: inline-block;font-weight: bold;width: 100px;">प्रभाग निवडणूक:</span>{{info.reservation_name}}</p></a></div><div style="clear: both"></div></div>',
        // template: '<ul id="og-grid" class="og-grid"><li ng-repeat="image in vm.images"><a href="#" data-largesrc="{{image.largesrc}}" data-title="{{image.title}}" data-description="{{image.description}}" data-details="{{image.template}}"><img ng-src="{{image.thumbnailsrc}}" alt="img01"/></a></li></ul>',
        link: function (scope, elm, attr) {
            $timeout(function () {
                //console.log(angular.element(elm.children()[0]).children())
                Grid.addItems(angular.element(elm.children()[0]).children());
            });
        }
    };
}]);


function ThumbnailGridCtrl() {

    var vm = this;
    //console.log(vm)
}

frontApp.filter('startFrom', function () {
    return function (input, start) {
        start = +start; //parse to int
        return input.slice(start);
    }
});

frontApp.directive('showDuringResolve', function ($rootScope) {

    return {
        link: function (scope, element) {

            element.addClass('ng-hide');

            var unregister = $rootScope.$on('$routeChangeStart', function () {

                element.removeClass('ng-hide');
            });

            scope.$on('$destroy', unregister);
        }
    };
});

frontApp.directive('newsDirective', function () {
    return {
        scope: {
            options: '=',
            pcbimagepath: '='
        },
        link: function(scope,rootScope, iElement, iAttrs, ngModelController) {

            scope.select = function(option) {
                ngModelController.$setViewValue(option);
                ngModelController.$setViewValue(pcbimagepath);
            };
        },

       // template: '<ul><li ng-repeat="option in options"><button ng-click="select(option)">{{ option }}</button></li></ul>',
        template: '<div class="outertight"><ul class="block"><li ng-repeat="news in options">'+
                    '<div class="col-md-3 newsimg" style="padding:0px;">'+
                        '<a href="#/readNews/{{news.collection_id}}"><img ng-src="{{pcbimagepath+news.newsType_id}}/{{news.image}}" alt="{{news.title}}" class="" style="width: 100%"></a>'+
                    '</div><div class="col-md-9 newstext" style="padding:5px;"><p style="min-height:44px">'+
                        '<a href="#/readNews/{{news.collection_id}}">{{news.title}}</a></p>'+
                    '<p class="more"><a href="#/readNews/{{news.collection_id}}">आणखी वाचा</a><span>{{news.created_date | dateFormat}}</span>'+
                     '</p></div></li></ul><div style="clear:both"></div></div>'

    };
});

frontApp.run(function ($timeout) { // instance-injector

    console.log("application loaded-" + new Date())

    /* var startMarquee = function () {

     createMarquee({ });
     }

     $timeout(startMarquee, 500);*/

})

