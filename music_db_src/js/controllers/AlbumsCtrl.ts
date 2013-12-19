/**
 *  File AlbumsCtrl.ts in Project Music Database
 *  Date: October 12 th 2013 , 3:39 PM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */
/// <reference path='../_refs.ts' />

module music_db.ctrl {
    'use strict';

export class AlbumsCtrl  extends BaseCtrl {
     albums;
     artist;
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
            this.$rootScope.artists=_artists_;
            this.artist = utils.Utils.findByProperty($rootScope.artists, 'id', $state.params.artist_id);
            this.albums = this.$rootScope.albums= this.artist.albums;
            this.$rootScope.breadcrumbs = utils.BC.ARTIST_ALBUMS(this.artist);
            this.$rootScope.filteredAlbums= this.albums;
        }

    queryChanged(query) {
        this.$rootScope.filteredAlbums = this.$filter("filter")(this.albums, query);
    }


    deleteAlbum(id, $$noty?) {
        var that = this;
        this.Resource.delete('album', id).then(function (response) {
            var albums = utils.Utils.removeArrayElementWithId(that.artist.albums, id);
            that.$rootScope.filteredAlbums=  that.artist.albums = albums;
            if ($$noty) $$noty.close();
            that.$state.transitionTo('albums', {artist_id: that.artist.id}, {reload: true});
        });
    }

    onDeleteButtonClick(id) {
        var that = this;
        var dialog_options:any = {};
        var albums = this.$rootScope.albums;
        var album_name_to_be_deleted = utils.Utils.findByProperty(this.$rootScope.albums, 'id', id).name;

        var confirm = function ($noty):void {
            that.deleteAlbum(id, $noty);
        };
        var cancel = function ($noty):void {
            $noty.close();
        };

        dialog_options = utils.Noty.modal_dialog;
        dialog_options.text = 'Are you sure you want to delete <br>' + album_name_to_be_deleted + ' ?';
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