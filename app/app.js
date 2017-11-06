(function () {

  'use strict';

  angular
    .module('app', [
      'auth0.auth0',
      'ui.router',
      'easypiechart',
      'ui.bootstrap',
      'ui.carousel',
      'ngTouch',
      'angularScreenfull'
    ])
    .config(config);

  config.$inject = [
    '$stateProvider',
    '$locationProvider',
    '$urlRouterProvider',
    'angularAuth0Provider'
  ];

  function config(
    $stateProvider,
    $locationProvider,
    $urlRouterProvider,
    angularAuth0Provider
  ) {

    $stateProvider
      .state('home', {
        url: '/',
        controller: 'HomeController',
        templateUrl: 'app/home/home.html',
        controllerAs: 'vm'
      })
      .state('profile', {
        url: '/profile',
        controller: 'ProfileController',
        templateUrl: 'app/profile/profile.html',
        controllerAs: 'vm',
        onEnter: checkAuthentication
      })
      .state('callback', {
        url: '/callback',
        controller: 'CallbackController',
        templateUrl: 'app/callback/callback.html',
        controllerAs: 'vm'
      })
      .state('atividade', {
        url: '/atividade',
        controller: 'AtividadeController',
        templateUrl: 'app/atividade/atividade.html',
        controllerAs: 'vm',
        onEnter: checkAuthentication
      })
      .state('atividade-item', {
        url: '/atividade-item',
        controller: 'AtividadeItemController',
        templateUrl: 'app/atividade/atividade.item.html',
        controllerAs: 'vm',
        onEnter: checkAuthentication
      })
      .state('doman-sobre', {
        url: '/doman-sobre',
        controller: 'StaticPageController',
        templateUrl: 'app/static-page/doman-sobre.html',
        controllerAs: 'vm'
      })
      .state('doman-filosofia', {
        url: '/doman-filosofia',
        controller: 'StaticPageController',
        templateUrl: 'app/static-page/doman-filosofia.html',
        controllerAs: 'vm'
      });

    function checkAuthentication($transition$) {
      var $state = $transition$.router.stateService;
      var auth = $transition$.injector().get('authService');
      if (!auth.isAuthenticated()) {
        return $state.target('home');
      }
    }
    // Initialization for the angular-auth0 library
    angularAuth0Provider.init({
      clientID: AUTH0_CLIENT_ID,
      domain: AUTH0_DOMAIN,
      responseType: 'token id_token',
      audience: AUTH0_AUDIENCE,
      redirectUri: AUTH0_CALLBACK_URL,
      scope: 'openid profile'
    });


    $urlRouterProvider.otherwise('/');

    $locationProvider.hashPrefix('');

    // Comment out the line below to run the app
    // without HTML5 mode (will use hashes in routes)
    $locationProvider.html5Mode(true);
  }

})();
