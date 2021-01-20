/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/treeview.js":
/*!**********************************!*\
  !*** ./resources/js/treeview.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$.fn.extend({
  treed: function treed(o) {
    var openedClass = 'fa-plus';
    var closedClass = 'fa-minus';

    if (typeof o != 'undefined') {
      if (typeof o.openedClass != 'undefined') {
        openedClass = o.openedClass;
      }

      if (typeof o.closedClass != 'undefined') {
        closedClass = o.closedClass;
      }
    }

    ; //initialize each of the top levels

    var tree = $(this);
    tree.addClass("tree");
    tree.find('li').has("ul").each(function () {
      var branch = $(this); //li with children ul

      branch.prepend("<i class='indicator fas " + closedClass + "'></i>");
      branch.addClass('branch');
      var icon = $(this).children('i:first');
      icon.on('click', function (e) {
        $(this).toggleClass(openedClass + " " + closedClass);

        if (this == e.target) {
          $(this).parent().children().children().toggle();
        }
      });
    });
    $('ul').children('li').find('span').on('click', function (event) {
      console.log($(this).parent().data('id'));

      if (this == event.target) {
        removeActiveClass();
        var id = $(this).parent().data('id');
        $(this).toggleClass('active');
        $('#category_id').val(id);
        getFiles();
        getPermission();
        getOperations();
      }
    });
    $('#upload_permission').click(function (e) {
      var categoryId = $('#category_id').val();
      $.ajax({
        type: 'GET',
        url: 'set-upload-permission/' + categoryId,
        success: function success(data) {
          $('#upload_permission').prop("checked", JSON.parse(data));
          getOperations();
        }
      });
      e.preventDefault();
    });
    $('#download_permission').click(function (e) {
      var categoryId = $('#category_id').val();
      $.ajax({
        type: 'GET',
        url: 'set-download-permission/' + categoryId,
        success: function success(data) {
          $('#download_permission').prop("checked", JSON.parse(data));
          getFiles();
        }
      });
      e.preventDefault();
    });
    $(document).on('click', '#new-category', function () {
      $('.modal-body #parent_id').val($(this).data('catid'));
      $('.modal-body #category_id').val($(this).data('catid'));
    });
    $(document).on('click', '#edit-category', function () {
      $('.modal-body #parent_id').val($(this).data('parentid'));
      $('.modal-body #category_id').val($(this).data('catid'));
      $('.modal-body #title').val($(this).data('mytitle'));
    });
    $(document).on('click', '#delete-category', function () {
      $('.modal-body #category_id').val($(this).data('catid'));
    });
    $(document).on('click', '#upload-file', function () {
      $('.modal-body #category_id').val($(this).data('catid'));
    });
  }
});

function getOperations() {
  var id = $('#category_id').val();
  $.ajax({
    type: 'GET',
    url: 'get-operations/' + id,
    success: function success(data) {
      $('#operations_container').html(data);
    }
  });
}

function getFiles() {
  var id = $('#category_id').val();
  $.ajax({
    type: 'GET',
    url: 'get-file/' + id,
    success: function success(data) {
      $('#files_container').html(data);
    }
  });
}

function getPermission() {
  var id = $('#category_id').val();
  $.ajax({
    type: 'GET',
    url: 'get-permission/' + id,
    success: function success(data) {
      refreshPermissions(data);
    }
  });
}

function removeActiveClass() {
  $('ul').children('li').find('span').each(function () {
    $(this).removeClass('active');
  });
}

function refreshPermissions(data) {
  var parsedData = JSON.parse(data);

  if (parsedData.length !== 0) {
    parsedData.forEach(function (permission, index, array) {
      if (permission.permission_id === 1) {
        $('#upload_permission').prop("checked", true);
      } else {
        $('#download_permission').prop("checked", false);
      }

      if (permission.permission_id === 2) {
        $('#download_permission').prop("checked", true);
      } else {
        $('#download_permission').prop("checked", false);
      }
    });
  } else {
    $('#upload_permission').prop("checked", false);
    $('#download_permission').prop("checked", false);
  }
}

$('#tree1').treed();

/***/ }),

/***/ 1:
/*!****************************************!*\
  !*** multi ./resources/js/treeview.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\nexumtest\resources\js\treeview.js */"./resources/js/treeview.js");


/***/ })

/******/ });