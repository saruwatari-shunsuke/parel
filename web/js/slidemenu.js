/**
 * slidemenu.js
 */

$(function(){
    var Slidemenu = function () {
        this.$openTrigger = $('.js-menu-trigger');
        this.$closeTrigger = $('#overlay');
        this.startTouchPosition = 0;
        this.swipedRange = 5;
    }

    Slidemenu.prototype.open = function() {
        $('.js-header, .js-main, .js-footer, #overlay').css({
            'transform': 'translate3d(200px, 0px, 0px)',
            'transition': 'transform 200ms cubic-bezier(0, 0, 0.25, 1)',
        });
        $('.js-main, .js-footer, #overlay').css({
            'position': 'relative'
        });
        $('.js-header, .js-main, .js-footer').css({
            'z-index': 1000,
        });
        $('#overlay').css({
            'display': 'block',
            'position': 'fixed',
            'z-index': 1000,
            'border-spacing': 200
        });
        $('.js-panel').css({
            'width': 200,
            'position': 'fixed',
            'top': 0,
            'left': 0,
            'bottom': 0,
            'height': 'auto',
            'min-height': '100%',
            'z-index': 999,
            'display': 'block',
            'overflow-x': 'hidden',
            'overflow-y': 'scroll',
        });
    }

    Slidemenu.prototype.close = function() {
        $('#overlay').animate({'border-spacing': 0}, {
            duration: 150,
            step: function(now) {
                $('.js-header, .js-main, .js-footer, #overlay').css({
                    'transform': 'translate3d(' + now + 'px, 0px, 0px)'
                });
            },
            complete: function() {
                $('.js-header, .js-main, .js-footer, #overlay').css({
                    'transform': '',
                    'transition': ''
                });
                $('#overlay, .js-panel').css({
                    'display': 'none',
                    'z-index': 0
                });
            }
        });
    }

    Slidemenu.prototype.getTouchPosition = function(event) {
        return event.changedTouches[0].pageX;
    }

    Slidemenu.prototype.swipe = function() {
        if ((this.startTouchPosition - this.getTouchPosition(event)) > this.swipedRange) {
          this.close();
        }
    }

    var self = new Slidemenu();
    self.$openTrigger.on('click', function (e) {
        self.open();
    });
    self.$closeTrigger.on('click', function (e) {
        self.close();
    });
    self.$closeTrigger.bind('touchstart', function() {
        self.startTouchPosition = self.getTouchPosition(event);
    });
    self.$closeTrigger.bind('touchmove', function() {
        self.swipe();
    });
});



