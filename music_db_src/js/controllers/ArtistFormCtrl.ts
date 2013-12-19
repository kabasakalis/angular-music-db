/**
 *  File ArtistFormCtrl.ts in Project Music Database
 *  Date: October 12 th 2013 , 3:39 PM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */
/// <reference path='../_refs.ts' />

module music_db.ctrl {
    'use strict';

    export class ArtistFormCtrl extends BaseCtrl {

        create_new:boolean = false;
        artist:any;
        original_artist:any;

        // $inject annotation.
        // It provides $injector with information about dependencies to be injected into constructor
        // it is better to have it close to the constructor, because the parameters must match in count and type.
        // See http://docs.angularjs.org/guide/di
        public static $inject = [
            '$scope',
            '$rootScope',
            '$state',
            '$location',
            '$filter',
            '$window',
            'Resource',
            'Noty'
        ];
        constructor($scope, $rootScope, $state, $location, $filter, $window, Resource, Noty) {
            super(
                $scope,
                $rootScope,
                $state,
                $location,
                $filter,
                $window,
                Resource,
                Noty
            );

           //Creating a new artist
            if ($state.params.artist_id == 'new') {
                this.create_new = true;
                this.artist = null;
                this.$rootScope.breadcrumbs = utils.BC.ARTIST_FORM_NEW();
            }
            //Editing an  artist
            else {
                this.original_artist = utils.Utils.findByProperty(this.$rootScope.artists, 'id', $state.params.artist_id);
                this.artist = angular.copy(this.original_artist);
                this.$rootScope.breadcrumbs = utils.BC.ARTIST_FORM_EDIT(this.artist);
            }

        } //constructor


        //fliters artists table
     /*   queryChanged (query) {
            console.log('art query');
            this.$rootScope.filteredArtists = this.$filter("filter")(this.artists, query);
        }*/


        //reset form
        reset():void {
            if (this.create_new) this.artist = null
            else  this.artist = angular.copy(this.original_artist);
        }

        saveArtist():void {
            var that = this;
            if (this.create_new)  //creating
                this.Resource.create('artist', this.artist).then(function (response) {
                    that.$rootScope.artists.push(response.data.artist);
                    that.$state.go('index');
                }); else //editing
            {
                this.Resource.save('artist', this.artist).then(function (response) {
                    var new_artists = utils.Utils.removeArrayElementWithId(that.$rootScope.artists, that.artist.id);
                    new_artists.push(response.data.artist);
                    that.$rootScope.artists = that.$rootScope.filteredArtists = new_artists;
                    that.$state.go('index');
                });

            }
        }

        onDeleteButtonClick(id) {

            this.Noty.closeFormBeforeDeleteMsg();

        }





        hasError = function () {
            var errors = {
                form: this.$scope.artistForm.$invalid,
                name: {
                    _any: this.$scope.artistForm.name.$dirty && this.$scope.artistForm.name.$invalid,
                    required: this.$scope.artistForm.name.$error.required && this.$scope.artistForm.name.$dirty,
                    minmax: this.$scope.artistForm.name.$error.minlength || this.$scope.artistForm.name.$error.maxlength,
                    required_msg: 'Artist\'s name  is required.',
                    minmax_msg: 'Must be more than 3 and less than 50 characters long.'
                },
                description: {
                    _any: this.$scope.artistForm.description.$dirty && this.$scope.artistForm.description.$invalid,
                    minmax: this.$scope.artistForm.description.$error.minlength || this.$scope.artistForm.description.$error.maxlength,
                    minmax_msg: 'Must be more than 10 and less than 1024 characters long.'
                },
                year_formed: {
                    _any: this.$scope.artistForm.year_formed.$dirty && this.$scope.artistForm.year_formed.$invalid,
                    minmax: this.$scope.artistForm.year_formed.$error.minlength || this.$scope.artistForm.year_formed.$error.maxlength,
                    numeric: this.$scope.artistForm.year_formed.$error.pattern,
                    minmax_msg: 'Must be  4  digits  long.From 1901 to 2155',
                    numeric_msg: 'Not a number.'
                }
            }
            return errors;
        }

        static getGenres($rootScope, Resource) {
            //check if genres are loaded,if not (for example user accessed deep route),get genres first.
            if ($rootScope.genres === undefined)
                return  Resource.getAll('genre').then(function (response) {
                    var genres = $rootScope.genres = response.data.genre;

                }); else
                return $rootScope.genres;
        }
    }

}