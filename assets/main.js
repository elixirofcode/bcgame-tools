var app = new Framework7({


  // App root element
  root: '#app',
  // App Name
  name: 'Peoplefeeds',
  // App id
  id: 'com.peoplefeeds.test',
  // Enable swipe panel
  panel: {
    swipe: 'left',
  },
  // Add default routes
  router: false,
  routes: [


  ],
  // ... other parameters
});

var mainView = app.views.create('.view-main', {
    domCache: true //enable inline pages
});

var $$ = Dom7;
