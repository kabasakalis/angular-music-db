/**
 *  File AlbumFormCtrl.ts in Project Music Database
 *  Date: October 12 th 2013 , 3:39 PM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */
/// <reference path='../_refs.ts' />

module music_db.ctrl {
    'use strict';

export class AlbumFormCtrl extends BaseCtrl {
    create_new:boolean=false;
    album:any;
    artist:any;
    original_album:any;
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
            'Noty',
            '_artists_'
        ];
        // dependencies are injected via AngularJS $injector
        // controller's name is registered in Application.ts and specified from ng-controller attribute in index.html
        constructor(
            $scope,
            $rootScope,
            $state,
            $location,
            $filter,
            $window,
            Resource,
            Noty,
           _artists_
            ) {
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

            this.artist = utils.Utils.findByProperty($rootScope.artists, 'id', $state.params.artist_id);
            if ($state.params.album_id === 'new') {
                this.create_new = true;
                this.$rootScope.breadcrumbs = utils.BC.ALBUM_FORM_NEW(this.artist);
                this.album = null;
            }
            else {
                this.original_album = utils.Utils.findByProperty(this.$rootScope.albums, 'id', $state.params.album_id);
                this.album = angular.copy(this.original_album);
                this.$rootScope.breadcrumbs = utils.BC.ALBUM_FORM_EDIT(this.artist, this.album);
            }
        }

    saveAlbum() {
        var that = this;
        if (this.create_new)  //creating
            this.Resource.create('album', this.album).then(function (response) {
                that.Resource.linkResourceToRelated('artist', that.artist.id, 'album', response.data.album.id).then(function (linkresponse) {
                    that.$rootScope.artists = utils.Utils.removeArrayElementWithId(that.$rootScope.artists, linkresponse.data.artist.id);
                    that.$rootScope.artists.push(linkresponse.data.artist);
                    that.$state.go('albums', {artist_id: that.artist.id});
                });
            });
        else { //editing
            this.Resource.save('album', this.album).then(function (response) {
                var albums = utils.Utils.removeArrayElementWithId(that.artist.albums, that.album.id);
                albums.push(that.Resource.stripRelated('album', response.data.album));// add edited album
                that.artist.albums = albums; //assign albums to artist
                that.$state.go('albums', {artist_id: that.artist.id}); //go to artist's albums
            });
        }
    }

    onDeleteButtonClick(id) {

        this.Noty.closeFormBeforeDeleteMsg();

    }


    reset():void {
        if (this.create_new) this.album = null
        else  this.album = angular.copy(this.original_album);
    }

    hasError = function () {
        var errors = {
            form: this.$scope.albumForm.$invalid,
            name: {
                _any: this.$scope.albumForm.name.$dirty && this.$scope.albumForm.name.$invalid,
                required: this.$scope.albumForm.name.$error.required && this.$scope.albumForm.name.$dirty,
                minmax: this.$scope.albumForm.name.$error.minlength || this.$scope.albumForm.name.$error.maxlength,
                required_msg: 'Album\'s name  is required.',
                minmax_msg: 'Must be more than 3 and less than 50 characters long.'
            },

            year_release: {
                _any: this.$scope.albumForm.year_release.$dirty && this.$scope.albumForm.year_release.$invalid,
                minmax: this.$scope.albumForm.year_release.$error.minlength || this.$scope.albumForm.year_release.$error.maxlength,
                numeric: this.$scope.albumForm.year_release.$error.pattern,
                minmax_msg: 'Must be  4  digits  long.From 1901 to 2155',
                numeric_msg: 'Not a number.'
            }
        }
        return errors;
    }
}
}