/**
 *  File UIRouter  in Project Music Database
 *  Date: October 13 th 2013 , 11:51 AM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */

    /// <reference path='../_refs.ts' />

module music_db.config {
    'use strict';

    export class UIRouter {

        public  mod:ng.IModule;

        constructor() {
            throw new Error("Cannot instantiate  this Class");
        }

        public static configure(mod:ng.IModule) {
            // console.log('State configuration  started');

            var artistDetailsView:Object = {
                templateUrl: "partials/artist.details.tpl.html",
                resolve: {
                    _artist_: ['$rootScope', '$stateParams', 'Resource', function ($rootScope, $stateParams, Resource) {
                        return ctrl.ArtistCtrl.getArtist($rootScope, Resource, $stateParams.artist_id);
                    }]
                },//resolve
                controller: [ '$scope', '_artist_' , '$rootScope', '$stateParams', '$location','Noty', function ($scope, _artist_, $rootScope, $stateParams, $location,Noty) {
                    $scope.artist = _artist_;
                    $rootScope.breadcrumbs = utils.BC.ARTIST_DETAILS($scope.artist);
                    $rootScope.vm.onDeleteButtonClick=function(id) {
                       Noty.closeFormBeforeDeleteMsg();
                    };
                }],
            }

            var artistFormView:Object = {
                templateUrl: "partials/artistForm.tpl.html",
                controller: ctrl.ArtistFormCtrl,
                resolve: {
                    _genres_: ['$rootScope', 'Resource', function ($rootScope, Resource) {
                        return ctrl.ArtistFormCtrl.getGenres($rootScope, Resource);
                    }]
                } //resolve
            }

            var artistsView:Object = {
                templateUrl: "partials/artists.tpl.html",
                controller: ctrl.ArtistCtrl,
                resolve: {
                    _artists_: ['$rootScope', 'Resource', function ($rootScope, Resource) {
                        return ctrl.ArtistCtrl.getArtists($rootScope, Resource);
                    }]
                } //resolve
            };


            var tracksView:Object = {
                templateUrl: "partials/tracks.tpl.html",
                controller: ctrl.TracksCtrl,
                resolve: {
                    _artists_: ['$rootScope', 'Resource', function ($rootScope, Resource) {
                        return ctrl.ArtistCtrl.getArtists($rootScope, Resource);
                    }],
                    _tracks_: ['Resource', '$rootScope', '$stateParams', function (Resource, $rootScope, $stateParams) {
                        return  ctrl.TracksCtrl.getTracks($rootScope, Resource, $stateParams.album_id);
                    }]
                } //resolve
            }

            var trackFormView:Object = {
                templateUrl: "partials/tracksForm.tpl.html",
                controller: ctrl.TrackFormCtrl,
                resolve: {
                    _artists_: ['$rootScope', 'Resource', function ($rootScope, Resource) {
                        return ctrl.ArtistCtrl.getArtists($rootScope, Resource);
                    }],
                    _tracks_: ['Resource', '$rootScope', '$stateParams', function (Resource, $rootScope, $stateParams) {
                        return  ctrl.TracksCtrl.getTracks($rootScope, Resource, $stateParams.album_id);
                    }]
                } //resolve
            }

            var albumsView:Object = {
                resolve: {
                    _artists_: ['$rootScope', 'Resource', function ($rootScope, Resource) {
                        return ctrl.ArtistCtrl.getArtists($rootScope, Resource);
                    }]
                },   //resolve
                templateUrl: "partials/albums.tpl.html",
                controller: ctrl.AlbumsCtrl
            };

            var albumFormView:Object = {
                resolve: {
                    _artists_: ['$rootScope', 'Resource', function ($rootScope, Resource) {
                        return ctrl.ArtistCtrl.getArtists($rootScope, Resource);
                    }]
                },   //resolve
                templateUrl: "partials/albumsForm.tpl.html",
                controller: ctrl.AlbumFormCtrl
            };

//actual configuration
            mod.
                config(
                    [ '$stateProvider', '$urlRouterProvider',
                        function (stateProvider, urlRouterProvider) {

                            // For any unmatched url, redirect to /state1
                            urlRouterProvider.otherwise("/");

                            // Now set up the states

                            stateProvider

                                .state('index', {
                                    data: {title: 'Home'},
                                    url: "/",
                                    views: {
                                        'artists': artistsView
                                    }
                                })

                                .state('artist-details', {
                                    data: {title: 'artist'},
                                    url: "/artist/:artist_id",
                                    views: {
                                        'artists': artistsView,
                                        'artist-details': artistDetailsView
                                    }
                                })

                                .state('artist-form', {
                                    url: "/artist/:artist_id/edit",
                                    views: {
                                        'artist-form': artistFormView,
                                        'artists': artistsView,
                                    }
                                })

                                .state('albums', {
                                    url: "/artist/:artist_id/albums",
                                    views: {
                                        'albums': albumsView
                                    }
                                })

                                .state('album-form', {
                                    url: "/artist/:artist_id/albums/:album_id/edit",
                                    views: {
                                        'album-form': albumFormView,
                                        'albums': albumsView
                                    }
                                })

                                .state('tracks', {
                                    url: "/artist/:artist_id/albums/:album_id/tracks",
                                    views: {
                                        'tracks': tracksView
                                    }
                                })

                                .state('track-form', {
                                    url: "/artist/:artist_id/albums/:album_id/tracks/:track_id/edit",
                                    views: {
                                        'track-form': trackFormView,
                                        'tracks': tracksView
                                    }
                                })
                        }]); //config
        }
    }
}