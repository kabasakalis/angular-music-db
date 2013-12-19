/**
 *  File Toastr.ts in Project  ng-ts-seed
 *  Date: November 13 th 2013 , 9:46 PM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */
module music_db.utils {
    'use strict';
    export class Toastr {

        public static defaultOptions:Object = {
            //   containerId:'toastr-msg',
            closeButton: true,
            closeHtml: '<button><i class="glyphicon glyphicon-remove"></i></button>',
            newestOnTop: true,
            showMethod: 'fadeIn',//fadeIn/fadeOut, slideDown/slideUp(?), show/hide
            showDuration: 300,
            showEasing: 'linear',  //swing,linear
            hideMethod: 'fadeOut',
            hideDuration: 1000,
            hideEasing: 'linear',   //swing,linear
            timeOut: 0,
            //  onShown: function() { console.log('toastr shown'); },
            // onHidden :function() { console.log('toastr hidden');}
        }

        public static show(type:string, message:string, title?:string, _options?:Object) {

            if (_options !== undefined)
               window['toastr'].options = _options; else
               window['toastr'].options = Toastr.defaultOptions;
            if (type == 'success') {
               window['toastr'].success(message, title);
            }
            if (type == 'info') {
               window['toastr'].info(message, title);
            }
            if (type == 'warning') {
               window['toastr'].warning(message, title);
            }
            if (type == 'error') {
               window['toastr'].error(message, title);
            }
        }

        public static clear() {
           window['toastr'].clear();
        }

    }

}