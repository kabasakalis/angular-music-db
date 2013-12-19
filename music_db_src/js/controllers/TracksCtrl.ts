/**
 *  File TracksCtrl.ts in Project Music Database
 *  Date: October 12 th 2013 , 3:39 PM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */
/// <reference path='../_refs.ts' />

module music_db.ctrl {
    'use strict';


    export class TracksCtrl extends BaseCtrl {
        artist;
        album;
        tracks;

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
            '_tracks_',
        ];
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

            this.$rootScope.artists=_artists_;
            this.$rootScope.tracks=_tracks_;

            this.tracks=this.$rootScope.tracks=angular.copy(_tracks_);
            this.$rootScope.filteredTracks= this.tracks;

            this.artist = utils.Utils.findByProperty($rootScope.artists, 'id', $state.params.artist_id);
            this.album = this.$rootScope.album = utils.Utils.findByProperty(this.artist.albums, 'id', $state.params.album_id);
            this.$rootScope.breadcrumbs = utils.BC.TRACKS(this.artist, this.album);

        }

        //called by resolve in  view state declaration
        static getTracks($rootScope, Resource, album_id) {
            return Resource.getAllRelatedByResourceId('album', album_id, 'track').then(function (response) {
                var tracks = $rootScope.tracks = $rootScope.filteredTracks = response.data.track;
                return tracks;
            });
        }


        queryChanged(query) {
            this.$rootScope.filteredTracks = this.$filter("filter")(this.$rootScope.tracks, query);
        }


        deleteTrack(id, $$noty?) {
            var that = this;
            this.Resource.delete('track', id).then(function (response) {
                var tracks_reduced = utils.Utils.removeArrayElementWithId(that.tracks, id);
                that.$rootScope.tracks =  that.$rootScope.filteredTracks= tracks_reduced;
                if ($$noty) $$noty.close();
                that.$state.transitionTo('tracks', {artist_id: that.artist.id, album_id: that.album.id}, {reload: true});
            });
        }

        onDeleteButtonClick(id) {

            var that = this;
            var dialog_options:any = {};
            var tracks = this.$rootScope.tracks;
            var track_name_to_be_deleted = utils.Utils.findByProperty(this.$rootScope.tracks, 'id', id).name;

            var confirm = function ($noty):void {
                that.deleteTrack(id, $noty);
            };
            var cancel = function ($noty):void {
                $noty.close();
            };

            dialog_options = utils.Noty.modal_dialog;
            dialog_options.text = 'Are you sure you want to delete <br>' + track_name_to_be_deleted + ' ?';
            dialog_options.buttons= [
                {addClass: 'btn btn-primary', text: 'Ok'},
                {addClass: 'btn btn-danger', text: 'Cancel'}
            ];
            dialog_options.buttons[0].onClick = confirm;
            dialog_options.buttons[1].onClick = cancel;
            dialog_options.layout = 'center';
            dialog_options.theme= 'defaultTheme',
            dialog_options.type='warning',

            this.Noty.create(dialog_options);

        }
    }
}
