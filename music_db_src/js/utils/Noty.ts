/**
 *  File Noty.ts in Project  Angular-Typescript-Seed
 *  Date: November 16 th 2013 , 3:06 PM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */
module music_db.utils {
    'use strict';
    export class Noty {

        public static $inject:Array<string> = ['$window'];
        win:any;
        noty:any;

        static noty_defaults:Object = {
            layout: 'top',
            theme: 'defaultTheme',
            type: 'alert',
            text: '',
            dismissQueue: true, // If you want to use queue feature set this true
            template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
            animation: {
                open: {height: 'toggle'},
                close: {height: 'toggle'},
                easing: 'swing',
                speed: 500 // opening & closing animation speed
            },
            timeout: false, // delay for closing event. Set false for sticky notifications
            force: false, // adds notification to the beginning of queue when set to true
            modal: false,
            maxVisible: 5, // you can set max visible notification for dismissQueue true option
            closeWith: ['click'], // ['click', 'button', 'hover']
            callback: {
                onShow: function () {
                },
                afterShow: function () {
                },
                onClose: function () {
                },
                afterClose: function () {
                }
            },
            buttons: false // an array of buttons
        };


        static modal_dialog:Object = {
            layout: 'center',
            theme: 'defaultTheme',
            type: 'alert',
            text: '',
            dismissQueue: true, // If you want to use queue feature set this true
            template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
            animation: {
                open: {height: 'toggle'},
                close: {height: 'toggle'},
                easing: 'swing',
                speed: 500 // opening & closing animation speed
            },
            timeout: false, // delay for closing event. Set false for sticky notifications
            force: false, // adds notification to the beginning of queue when set to true
            modal: true,
            maxVisible: 5, // you can set max visible notification for dismissQueue true option
            closeWith: ['click'], // ['click', 'button', 'hover']
            callback: {
                onShow: function () {
                },
                afterShow: function () {
                },
                onClose: function () {
                },
                afterClose: function () {
                }
            },
            buttons: [
                {addClass: 'btn btn-danger btn-lg', text: 'Delete', onClick: null},
                {addClass: 'btn btn-warning btn-lg', text: 'Cancel', onClick: null}
            ] // an array of buttons  you have to fill in the onClick handlers
        };

        constructor($window) {
            this.noty = $window.noty;
            this.win = $window;

        }

        noty_dialog():Object {
            var that = this;
            return {
                layout: 'center',
                text: 'Whussup?',
                buttons: [
                    {addClass: 'btn btn-primary', text: 'Ok', onClick: function ($noty) {
                        $noty.close();
                        that.noty({text: 'You clicked "Ok" button', type: 'success'});
                    }
                    },
                    {addClass: 'btn btn-danger', text: 'Cancel', onClick: function ($noty) {
                        $noty.close();
                        that.noty({text: 'You clicked "Cancel" button', type: 'error'});
                    }
                    }
                ]
            }
        }

        create(options:Object):void {
            this.win.noty(options);
        }

     closeFormBeforeDeleteMsg():void{
        var dialog_options:any={};
        var confirm=function($noty):void{$noty.close() };
        dialog_options=utils.Noty.modal_dialog;
        dialog_options.text='Please complete or cancel the form first.';
        dialog_options.buttons= [
        {addClass: 'btn btn-danger btn-lg', text: 'OK', onClick: confirm}
    ] ;
    // an array of buttons  you have to fill in the onClick handlers
        dialog_options.layout='center';
         dialog_options.theme= 'defaultTheme';
         dialog_options.type= 'warning';
        this.create(dialog_options);
    }


      public static   protectDemoMessage():void{
          window['$'].noty.closeAll();
            var dialog_options:any={};
            var confirm=function($noty):void{$noty.close() };
            dialog_options=utils.Noty.modal_dialog;
            dialog_options.text='You cannot delete or edit this demo data.You can always create,delete and edit your own data.';
            dialog_options.buttons= [
                {addClass: 'btn btn-danger btn-lg', text: 'OK', onClick: confirm}
            ] ;
            // an array of buttons  you have to fill in the onClick handlers
            dialog_options.layout='center';
          dialog_options.theme= 'defaultTheme',
              dialog_options.type='warning',
            window['noty'](dialog_options);

        }

    }
}