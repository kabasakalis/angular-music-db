/**
 *  File BseCtrl.ts in Project Music Database
 *  Date: October 15 th 2013 , 11:15 AM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */
/// <reference path='../_refs.ts' />

module music_db.ctrl {
    'use strict';

    export class BaseCtrl {
        vm;
        $scope;
        $rootScope;
        $state;
        $location;
        $filter;
        $window;
        Resource;
        Noty;
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
                         Noty
                          ) {
            this.$scope = $scope;
            this.$rootScope = $rootScope;
            this.$state = $state;
            this.$location = $location;
            this.$filter = $filter;
            this.$window = $window;
            this.Resource = Resource;
            this.Noty = Noty;

            // 'vm' stands for 'view model'. We're adding a reference to the controller to the scope
            // for its methods to be accessible from view / HTML
            $rootScope.vm = this;

            //Useful info,logging scope and vm for every controller instatiated
           // console.log($rootScope.$state, '$state');
           // console.log($scope, utils.Utils.getClassName(this) + ' scope');
           // console.log($scope.vm, utils.Utils.getClassName(this) + ' View Model,Controller instance  attached to scope');
        }
    }
}