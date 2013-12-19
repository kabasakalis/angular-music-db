/**
 *  File BC.ts in Project Music Database
 *  Breadcrumbs
 *  Date: October 12 th 2013 , 3:42 PM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */
/// <reference path='./../_refs.ts' />
module music_db.utils {
    'use strict';
    export class BC {

        //BASE URLS


        static INDEX_BASE_URL = music_db.config.Constants.APP_BASE_URL;
        static ARTIST_DETAILS_URL(artist):any {
            return   BC.INDEX_BASE_URL + 'artist/' + artist.id;
        }

        static ARTIST_FORM_EDIT_URL(artist):any {
            return     BC.ARTIST_DETAILS_URL(artist) + '/edit';
        }

        static ARTIST_FORM_NEW_URL(artist):any {
            return    BC.INDEX_BASE_URL + '/new/edit';
        }

        static ARTIST_ALBUMS_URL(artist):any {
            return     BC.ARTIST_DETAILS_URL(artist) + '/albums';
        }

        static    TRACKS_URL(artist, album):any {
            return     BC.ARTIST_ALBUMS_URL(artist) + '/' + album.id + '/tracks';
        }


//breadcrumbs arrays
        static INDEX() {
            return new Array({name: 'Artists', url: BC.INDEX_BASE_URL});
        }

        static  ARTIST_DETAILS(artist):any[] {
            return BC.INDEX().concat(Array({name: artist.name, url: BC.ARTIST_DETAILS_URL(artist)}));
        }

        static ARTIST_FORM_EDIT(artist):any {
            return     BC.ARTIST_DETAILS(artist).concat(Array({name: 'edit', url: ''}));
        }

        static ARTIST_FORM_NEW():any {

            return BC.INDEX().concat(Array({name: 'new', url: ''}));
        }

        static ARTIST_ALBUMS(artist):any {
            return BC.ARTIST_DETAILS(artist).concat(Array({name: 'albums', url: BC.ARTIST_ALBUMS_URL(artist)}));
        }

        static ALBUM_FORM_EDIT(artist, album):any {
            return BC.ARTIST_ALBUMS(artist).concat(Array({name: album.name + '     :edit', url: ''}));
        }

        static ALBUM_FORM_NEW(artist):any {
            return BC.ARTIST_ALBUMS(artist).concat(Array({name: 'new', url: 'new/edit'}));
        }

        static TRACKS(artist, album):any {
            return BC.ARTIST_ALBUMS(artist).concat(Array({name: album.name, url: BC.TRACKS_URL(artist, album)}));
        }

        static TRACK_FORM_NEW(artist, album):any {
            return BC.TRACKS(artist, album).concat(Array({name: 'new', url: album.id + '/new/edit'}));
        }

        static TRACK_FORM_EDIT(artist, album, track):any {
            return BC.TRACKS(artist, album).concat(Array({name: track.name + '   :edit', url: track.id + '/edit'}));
        }

    }
}