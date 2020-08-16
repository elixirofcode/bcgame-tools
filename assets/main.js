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

var autocompleteDropdownAjax = app.autocomplete.create({
  inputEl: '.mentionconnection',
  openIn: 'dropdown',
  preloader: true, //enable preloader
  /* If we set valueProperty to "id" then input value on select will be set according to this property */
  valueProperty: 'id', //object's "value" property name
  textProperty: 'name', //object's "text" property name
  limit: 20, //limit to 20 results
  dropdownPlaceholderText: 'Page name',
  source: function (query, render) {
    var autocomplete = this;
    var results = [];
    if (query.length === 0) {
      render(results);
      return;
    }
    // Show Preloader
    autocomplete.preloaderShow();

    // Do Ajax request to Autocomplete data
    app.request({
      url: '/peoplefeed/page/mention/',
      method: 'GET',
      dataType: 'json',
      //send "query" to server. Useful in case you generate response dynamically
      data: {
        query: query,
      },
      success: function (data) {
        // Find matched items
        if (data != null) {
          for (var i = 0; i < data.length; i++) {
            if (data[i].name.toLowerCase().indexOf(query.toLowerCase()) >= 0) results.push(data[i]);
          }
        }

        autocomplete.preloaderHide();
        render(results);
      }
    });
  }
});

var autocompleteDropdownAjax = app.autocomplete.create({
  inputEl: '.mentionrelfinder',
  openIn: 'dropdown',
  preloader: true, //enable preloader
  /* If we set valueProperty to "id" then input value on select will be set according to this property */
  valueProperty: 'id', //object's "value" property name
  textProperty: 'name', //object's "text" property name
  limit: 20, //limit to 20 results
  dropdownPlaceholderText: 'Page name',
  source: function (query, render) {
    var autocomplete = this;
    var results = [];
    if (query.length === 0) {
      render(results);
      return;
    }
    // Show Preloader
    autocomplete.preloaderShow();

    // Do Ajax request to Autocomplete data
    app.request({
      url: '/peoplefeed/page/mention/',
      method: 'GET',
      dataType: 'json',
      //send "query" to server. Useful in case you generate response dynamically
      data: {
        query: query,
      },
      success: function (data) {
        // Find matched items
        if (data != null) {
          for (var i = 0; i < data.length; i++) {
            if (data[i].name.toLowerCase().indexOf(query.toLowerCase()) >= 0) results.push(data[i]);
          }
        }

        autocomplete.preloaderHide();
        render(results);
      }
    });
  }
});

var calendarDateFormat = app.calendar.create({
  inputEl: '#start_date',
  timePicker: true,
  dateFormat: { weekday: 'long', month: 'long', day: '2-digit', year: 'numeric', hour: 'numeric', minute: 'numeric' },
});

var calendarDateFormat = app.calendar.create({
  inputEl: '#end_date',
  timePicker: true,
  dateFormat: { weekday: 'long', month: 'long', day: '2-digit', year: 'numeric', hour: 'numeric', minute: 'numeric' },
});

var calendarDateFormat = app.calendar.create({
  inputEl: '#newdatetime1',
  timePicker: true,
  dateFormat: { weekday: 'long', month: 'long', day: '2-digit', year: 'numeric', hour: 'numeric', minute: 'numeric' },
});

var calendarDateFormat = app.calendar.create({
  inputEl: '#newdatetime2',
  timePicker: true,
  dateFormat: { weekday: 'long', month: 'long', day: '2-digit', year: 'numeric', hour: 'numeric', minute: 'numeric' },
});

var autocompleteStandaloneSimple = app.autocomplete.create({
  openIn: 'popup', //open in page
  openerEl: '#multimention', //link that opens autocomplete
  closeOnSelect: true, //go back after we select something
  valueProperty: 'id', //object's "value" property name
  textProperty: 'name', //object's "text" property name
  limit: 50, //limit to 20 results
  multiple: true, //allow multiple values
  source: function (query, render) {
    var autocomplete = this;
    var results = [];
    if (query.length === 0) {
      render(results);
      return;
    }
    // Show Preloader
    autocomplete.preloaderShow();

    // Do Ajax request to Autocomplete data
    app.request({
      url: '/peoplefeed/page/mention/',
      method: 'GET',
      dataType: 'json',
      //send "query" to server. Useful in case you generate response dynamically
      data: {
        query: query,
      },
      success: function (data) {
        // Find matched items
        if (data != null) {
          for (var i = 0; i < data.length; i++) {
            if (data[i].name.toLowerCase().indexOf(query.toLowerCase()) >= 0) results.push(data[i]);
          }
        }

        autocomplete.preloaderHide();
        render(results);
      }
    });
  },
  on: {
    change: function (value) {
      var itemText = [],
          inputValue = [];
      for (var i = 0; i < value.length; i++) {
        itemText.push(value[i].name);
        inputValue.push(value[i].id);
      }
      // Add item text value to item-after
      $$('#multimention').find('.item-after').text(itemText.join(', '));
      // Add item value to input value
      $$('#multimention').find('input').val(inputValue.join(', '));
    },
  },
});

var autocompleteStandaloneSimple = app.autocomplete.create({
  openIn: 'popup', //open in page
  openerEl: '#multimention2', //link that opens autocomplete
  closeOnSelect: true, //go back after we select something
  valueProperty: 'id', //object's "value" property name
  textProperty: 'name', //object's "text" property name
  limit: 50, //limit to 20 results
  multiple: true, //allow multiple values
  source: function (query, render) {
    var autocomplete = this;
    var results = [];
    if (query.length === 0) {
      render(results);
      return;
    }
    // Show Preloader
    autocomplete.preloaderShow();

    // Do Ajax request to Autocomplete data
    app.request({
      url: '/peoplefeed/page/mention/',
      method: 'GET',
      dataType: 'json',
      //send "query" to server. Useful in case you generate response dynamically
      data: {
        query: query,
      },
      success: function (data) {
        // Find matched items
        if (data != null) {
          for (var i = 0; i < data.length; i++) {
            if (data[i].name.toLowerCase().indexOf(query.toLowerCase()) >= 0) results.push(data[i]);
          }
        }

        autocomplete.preloaderHide();
        render(results);
      }
    });
  },
  on: {
    change: function (value) {
      var itemText = [],
          inputValue = [];
      for (var i = 0; i < value.length; i++) {
        itemText.push(value[i].name);
        inputValue.push(value[i].id);
      }
      // Add item text value to item-after
      $$('#multimention2').find('.item-after').text(itemText.join(', '));
      // Add item value to input value
      $$('#multimention2').find('input').val(inputValue.join(', '));
    },
  },
});
