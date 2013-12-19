/**
 *  File ArtistCtrl.ts in Project Music Database
 *  Date: October 12 th 2013 , 3:39 PM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */
/// <reference path='../_refs.ts' />

module music_db.ctrl {
    'use strict';

export class ArtistCtrl extends BaseCtrl {
             artists;
        // $inject annotation.
        // It provides $injector with information about dependencies to be injected into constructor
        // it is better to have it close to the constructor, because the parameters must match in count and type.
        // See http://docs.angularjs.org/guide/di
        public static $inject = [
            '$rootScope',
            '$scope',
            '$location',
            '$filter',
            'Resource',
            '$state',
            '$window',
            'Noty',
            '_artists_'
        ];
        constructor(
            $rootScope,
            $scope,
            $location,
            $filter,
            Resource,
           $state,
           $window,
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
            this.artists=this.$rootScope.artists=angular.copy(_artists_);
            this.$rootScope.filteredArtists= this.artists;
            //breadcrumbs
            $rootScope.breadcrumbs=utils.BC.INDEX();
        }

    static  getArtists($rootScope,Resource){
        //check if artists are loaded in rootscope,if not (for example user accessed deep route),get artists from server
        if ($rootScope.artists === undefined  ){
            return Resource.getAll('artist').then(function(response){
                var artists=response.data.artist;
                return artists;
            }) ;
        } else
        {
            return $rootScope.artists;
        }
    }


    static getArtist($rootScope,Resource,artist_id){
        //check if artists are loaded,if not (for example user accessed deep route),get artists first from server.
        if ($rootScope.artists===undefined)
            return  Resource.getAll('artist').then(function(response){
                var artists=$rootScope.artists=response.data.artist;
                return utils.Utils.findByProperty(  artists,'id',artist_id);
            });else
            return utils.Utils.findByProperty($rootScope.artists,'id',artist_id);
    }



    //fliters artists table
    queryChanged (query) {
        this.$rootScope.filteredArtists = this.$filter("filter")(this.artists, query);
    }


deleteArtist(id,$$noty?){
    var that=this;
    this.Resource.delete('artist',id).then(function(response){
    var artists=that.$rootScope.artists;
     that.$rootScope.artists=that.$rootScope.filteredArtists=utils.Utils.removeArrayElementWithId(artists,response.data.artist.id);
       if($$noty) $$noty.close();
      that.$state.transitionTo('index',null,{reload:true});
    });
}

    onDeleteButtonClick(id){
   var that=this;
  var dialog_options:any={};
        var artists=this.$rootScope.artists;
        var artist_name_to_be_deleted=utils.Utils.findByProperty(this.$rootScope.artists,'id',id).name;
      var confirm=function($noty):void{ that.deleteArtist(id,$noty); };
      var cancel=function($noty):void{ $noty.close();};

        dialog_options=utils.Noty.modal_dialog;
        dialog_options.text='Are you sure you want to delete <br>'+ artist_name_to_be_deleted +' ?';
        dialog_options.buttons= [
            {addClass: 'btn btn-primary', text: 'Ok'},
            {addClass: 'btn btn-danger', text: 'Cancel'}
        ];
        dialog_options.buttons[0].onClick=confirm;
        dialog_options.buttons[1].onClick=cancel;
        dialog_options.layout='center';
        dialog_options.theme= 'defaultTheme',
        dialog_options.type='warning',
        this.Noty.create(dialog_options);
    }

    }

}