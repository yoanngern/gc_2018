(function () { var require = undefined; var define = undefined; (function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

function Config(objectName) {
    this.objectName = objectName;
}

Config.prototype.get = function(k, d) {
    return ( window[this.objectName] !== undefined ) ? window[this.objectName][k] : d;
};

Config.prototype.set = function(k, v) {
    if( ! window[this.objectName] ) {
        window[this.objectName] = {};
    }

    window[this.objectName][k] = v;
};

module.exports = Config;
},{}],2:[function(require,module,exports){
'use strict';

function getButtonText(button) {
    return button.innerHTML ? button.innerHTML : button.value;
}

function setButtonText(button, text) {
    button.innerHTML ? button.innerHTML = text : button.value = text;
}

function Loader(formElement) {
    this.form = formElement;
    this.button = formElement.querySelector('input[type="submit"], button[type="submit"]');
    this.loadingInterval = 0;
    this.character = '\u00B7';

    if( this.button ) {
        this.originalButton = this.button.cloneNode(true);
    }
}

Loader.prototype.setCharacter = function(c) {
    this.character = c;
};

Loader.prototype.start = function() {
    if( this.button ) {
        // loading text
        var loadingText = this.button.getAttribute('data-loading-text');
        if( loadingText ) {
            setButtonText(this.button, loadingText);
            return;
        }

        // Show AJAX loader
        var styles = window.getComputedStyle( this.button );
        this.button.style.width = styles.width;
        setButtonText(this.button, this.character);
        this.loadingInterval = window.setInterval(this.tick.bind(this), 500 );
    } else {
        this.form.style.opacity = '0.5';
    }
};

Loader.prototype.tick = function() {
    // count chars, start over at 5
    var text = getButtonText(this.button);
    var loadingChar = this.character;
    setButtonText(this.button, text.length >= 5 ? loadingChar : text + " " + loadingChar);
};


Loader.prototype.stop = function() {
    if( this.button ) {
        this.button.style.width = this.originalButton.style.width;
        var text = getButtonText(this.originalButton);
        setButtonText(this.button, text);
        window.clearInterval(this.loadingInterval);
    } else {
        this.form.style.opacity = '';
    }

};


module.exports = Loader;
},{}],3:[function(require,module,exports){
'use strict';

var ConfigStore = require('./_config.js');
var Loader = require('./_form-loader.js');

var forms = window.mc4wp.forms;
var busy = false;
var config = new ConfigStore('mc4wp_ajax_vars');

// failsafe against including script twice
if( config.get('ready') ) {
	return;
}

forms.on('submit', function( form, event ) {

	// does this form have AJAX enabled?
	// @todo move to data attribute?
	if( form.element.getAttribute('class').indexOf('mc4wp-ajax') < 0 ) {
		return;
	}

	try{
		submit(form);
	} catch(e) {
		console.error(e);
		return true;
	}

	event.returnValue = false;
	event.preventDefault();
	return false;
});

function submit( form ) {

	var loader = new Loader(form.element);
	var loadingChar = config.get('loading_character');
	if( loadingChar ) {
		loader.setCharacter(loadingChar);
	}

	function start() {
		// Clear possible errors from previous submit
		form.setResponse('');
		loader.start();
		fire();
	}

	function fire() {
		// prepare request
		busy = true;
		var request = new XMLHttpRequest();
		request.onreadystatechange = function() {
			// are we done?
			if (this.readyState == 4) {
				clean();

				if (this.status >= 200 && this.status < 400) {
					// Request success! :-)
					try {
						var response = JSON.parse(this.responseText);
					} catch(error) {
						console.log( 'MailChimp for WordPress: failed to parse AJAX response.\n\nError: "' + error + '"' );

						// Not good..
						form.setResponse('<div class="mc4wp-alert mc4wp-error"><p>'+ config.get('error_text') + '</p></div>');
						return;
					}

					process(response);
				} else {
					// Error :(
					console.log(this.responseText);
				}
			}
		};
		request.open('POST', config.get('ajax_url'), true);
		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		request.send(form.getSerializedData());
		request = null;
	}

	function process( response ) {
		forms.trigger('submitted', [form]);

		if( response.error ) {
			form.setResponse(response.error.message);
			forms.trigger('error', [form, response.error.errors]);
		} else {
			var data  = form.getData();

			// trigger events
			forms.trigger('success', [form, data]);
			forms.trigger( response.data.event, [form, data ]);

			// for BC: always trigger "subscribed" event when firing "subscriber_updated" event
			if( response.data.event === 'subscriber_updated' ) {
                forms.trigger( 'subscribed', [form, data ]);
			}

			if( response.data.hide_fields ) {
				form.element.querySelector('.mc4wp-form-fields').style.display = 'none';
			}

			// Redirect to URL or show success message
			if( response.data.redirect_to ) {
				window.location.href = response.data.redirect_to;
			} else {
				form.setResponse(response.data.message);
			}

			// finally, reset form element
			form.element.reset();
		}
	}

	function clean() {
		loader.stop();
		busy = false;
	}

	// let's do this!
	if( ! busy ) {
		start();
	}
}

config.set('ready', true);

},{"./_config.js":1,"./_form-loader.js":2}]},{},[3]);
 })();