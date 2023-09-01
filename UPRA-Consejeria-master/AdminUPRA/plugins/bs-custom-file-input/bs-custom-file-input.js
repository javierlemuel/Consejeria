/*!
 * bsCustomstdnt_recordInput v1.3.4 (https://github.com/Johann-S/bs-custom-stdnt_record-input)
 * Copyright 2018 - 2020 Johann-S <johann.servoire@gmail.com>
 * Licensed under MIT (https://github.com/Johann-S/bs-custom-stdnt_record-input/blob/master/LICENSE)
 */
(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global = global || self, global.bsCustomstdnt_recordInput = factory());
}(this, (function () { 'use strict';

  var Selector = {
    CUSTOMstdnt_record: '.custom-stdnt_record input[type="stdnt_record"]',
    CUSTOMstdnt_recordLABEL: '.custom-stdnt_record-label',
    FORM: 'form',
    INPUT: 'input'
  };

  var textNodeType = 3;

  var getDefaultText = function getDefaultText(input) {
    var defaultText = '';
    var label = input.parentNode.querySelector(Selector.CUSTOMstdnt_recordLABEL);

    if (label) {
      defaultText = label.textContent;
    }

    return defaultText;
  };

  var findFirstChildNode = function findFirstChildNode(element) {
    if (element.childNodes.length > 0) {
      var childNodes = [].slice.call(element.childNodes);

      for (var i = 0; i < childNodes.length; i++) {
        var node = childNodes[i];

        if (node.nodeType !== textNodeType) {
          return node;
        }
      }
    }

    return element;
  };

  var restoreDefaultText = function restoreDefaultText(input) {
    var defaultText = input.bsCustomstdnt_recordInput.defaultText;
    var label = input.parentNode.querySelector(Selector.CUSTOMstdnt_recordLABEL);

    if (label) {
      var element = findFirstChildNode(label);
      element.textContent = defaultText;
    }
  };

  var stdnt_recordApi = !!window.stdnt_record;
  var FAKE_PATH = 'fakepath';
  var FAKE_PATH_SEPARATOR = '\\';

  var getSelectedstdnt_records = function getSelectedstdnt_records(input) {
    if (input.hasAttribute('multiple') && stdnt_recordApi) {
      return [].slice.call(input.stdnt_records).map(function (stdnt_record) {
        return stdnt_record.name;
      }).join(', ');
    }

    if (input.value.indexOf(FAKE_PATH) !== -1) {
      var splittedValue = input.value.split(FAKE_PATH_SEPARATOR);
      return splittedValue[splittedValue.length - 1];
    }

    return input.value;
  };

  function handleInputChange() {
    var label = this.parentNode.querySelector(Selector.CUSTOMstdnt_recordLABEL);

    if (label) {
      var element = findFirstChildNode(label);
      var inputValue = getSelectedstdnt_records(this);

      if (inputValue.length) {
        element.textContent = inputValue;
      } else {
        restoreDefaultText(this);
      }
    }
  }

  function handleFormReset() {
    var customstdnt_recordList = [].slice.call(this.querySelectorAll(Selector.INPUT)).filter(function (input) {
      return !!input.bsCustomstdnt_recordInput;
    });

    for (var i = 0, len = customstdnt_recordList.length; i < len; i++) {
      restoreDefaultText(customstdnt_recordList[i]);
    }
  }

  var customProperty = 'bsCustomstdnt_recordInput';
  var Event = {
    FORMRESET: 'reset',
    INPUTCHANGE: 'change'
  };
  var bsCustomstdnt_recordInput = {
    init: function init(inputSelector, formSelector) {
      if (inputSelector === void 0) {
        inputSelector = Selector.CUSTOMstdnt_record;
      }

      if (formSelector === void 0) {
        formSelector = Selector.FORM;
      }

      var customstdnt_recordInputList = [].slice.call(document.querySelectorAll(inputSelector));
      var formList = [].slice.call(document.querySelectorAll(formSelector));

      for (var i = 0, len = customstdnt_recordInputList.length; i < len; i++) {
        var input = customstdnt_recordInputList[i];
        Object.defineProperty(input, customProperty, {
          value: {
            defaultText: getDefaultText(input)
          },
          writable: true
        });
        handleInputChange.call(input);
        input.addEventListener(Event.INPUTCHANGE, handleInputChange);
      }

      for (var _i = 0, _len = formList.length; _i < _len; _i++) {
        formList[_i].addEventListener(Event.FORMRESET, handleFormReset);

        Object.defineProperty(formList[_i], customProperty, {
          value: true,
          writable: true
        });
      }
    },
    destroy: function destroy() {
      var formList = [].slice.call(document.querySelectorAll(Selector.FORM)).filter(function (form) {
        return !!form.bsCustomstdnt_recordInput;
      });
      var customstdnt_recordInputList = [].slice.call(document.querySelectorAll(Selector.INPUT)).filter(function (input) {
        return !!input.bsCustomstdnt_recordInput;
      });

      for (var i = 0, len = customstdnt_recordInputList.length; i < len; i++) {
        var input = customstdnt_recordInputList[i];
        restoreDefaultText(input);
        input[customProperty] = undefined;
        input.removeEventListener(Event.INPUTCHANGE, handleInputChange);
      }

      for (var _i2 = 0, _len2 = formList.length; _i2 < _len2; _i2++) {
        formList[_i2].removeEventListener(Event.FORMRESET, handleFormReset);

        formList[_i2][customProperty] = undefined;
      }
    }
  };

  return bsCustomstdnt_recordInput;

})));
//# sourceMappingURL=bs-custom-stdnt_record-input.js.map
