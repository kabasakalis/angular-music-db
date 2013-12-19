/**
 *  File TrackFormCtrl.ts in Project Music Database
 *  Date: October 12 th 2013 , 3:39 PM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */

/// <reference path='../_refs.ts' />

module music_db.ctrl {
    'use strict';

export class TrackFormCtrl extends BaseCtrl {

    create_new:boolean=false;
    album:any;
    artist:any;
    track:any;
    tracks:any;
    original_track:any;

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
            'Noty',
            '_artists_',
            '_tracks_'
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
            _artists_,
            _tracks_
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



            this.artist = utils.Utils.findByProperty(this.$rootScope.artists, 'id', $state.params.artist_id);
            this.album = utils.Utils.findByProperty(this.artist.albums, 'id', $state.params.album_id);
            this.tracks = this.$rootScope.tracks;

            if ($state.params.track_id === 'new') {
                this.create_new = true;
                this.track = new Object;
                this.track.album_id = this.album.id;
                this.$rootScope.breadcrumbs = utils.BC.TRACK_FORM_NEW(this.artist, this.album);
            }
            else {
                this.original_track = utils.Utils.findByProperty($rootScope.tracks, 'id', $state.params.track_id);
                this.track = angular.copy(this.original_track);
                this.$rootScope.breadcrumbs = utils.BC.TRACK_FORM_EDIT(this.artist, this.album, this.track);
            }
        }

    reset():void {
        if (this.create_new) this.track = null
        else  this.track = angular.copy(this.original_track);
    }


    saveTrack():void {
        var that = this;
        if (this.create_new)  //creating
            this.Resource.create('track', this.track).then(function (response) {
                that.$rootScope.tracks.push(response.data.track);
                that.$state.go('tracks', {artist_id: that.artist.id, album_id: that.album.id});
            });
        else { //editing
            this.Resource.save('track', this.track).then(function (response) {
                var tracks = utils.Utils.removeArrayElementWithId(that.$rootScope.tracks, that.track.id);    //remove old track
                tracks.push(that.Resource.stripRelated('track', response.data.track));// add edited track
                that.$rootScope.tracks = tracks;
                that.$state.go('tracks', {artist_id: that.artist.id, album_id: that.album.id}); //go to artist's tracks
            });
        }
    }

    onDeleteButtonClick(id) {

        this.Noty.closeFormBeforeDeleteMsg();

    }



    hasError = function () {
        var errors = {
            form: this.$scope.trackForm.$invalid,
            name: {
                _any: this.$scope.trackForm.name.$dirty && this.$scope.trackForm.name.$invalid,
                required: this.$scope.trackForm.name.$error.required && this.$scope.trackForm.name.$dirty,
                minmax: this.$scope.trackForm.name.$error.minlength || this.$scope.trackForm.name.$error.maxlength,
                required_msg: 'Track\'s name  is required.',
                minmax_msg: 'Must be more than 3 and less than 128 characters long.'
            },
            playtime: {
                _any: this.$scope.trackForm.playtime.$dirty && this.$scope.trackForm.playtime.$invalid,
                minmax: this.$scope.trackForm.playtime.$error.minlength || this.$scope.trackForm.playtime.$error.maxlength,
                playtime_format: this.$scope.trackForm.playtime.$error.pattern,
                minmax_msg: 'Not playtime format.Must be mm:ss,for example 03:45.',
                playtime_format_msg: 'Not playtime format.Must be mm:ss,for example 03:45.'
            },
            lyrics: {
                _any: this.$scope.trackForm.lyrics.$dirty && this.$scope.trackForm.lyrics.$invalid,
                minmax: this.$scope.trackForm.lyrics.$error.minlength || this.$scope.trackForm.lyrics.$error.maxlength,
                minmax_msg: 'Must be  at least 10  characters  long,512 characters at most',
            }
        }
        return errors;
    }
}
}