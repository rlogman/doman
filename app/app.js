'use strict';

/**
 * @ngdoc overview
 * @name domanApp
 * @description
 * # domanApp
 *
 * Main module of the application.
 */
var app = angular.module('domanApp', [
    'ngRoute',
])
    /* define 'config2' constant - which is available in Ng's config phase */
    .constant('CONSTANTES', {
        VIEW_FOLDER: 'app',
    })
    .config(['$logProvider', 'CONSTANTES', '$routeProvider', function ($logProvider, CONSTANTES, $routeProvider) {


    }])// Inicializa Variaveis de Sistema
    .run(['$log', '$rootScope', 'CONSTANTES', function ($log, $rootScope, CONSTANTES) { // instance-injector


    }]);
