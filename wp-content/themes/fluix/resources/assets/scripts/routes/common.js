export default {
    init() {

        /* ======================================================================== */
        (function ($) {
            $(document).ready(function () {
                $('#get_more_focus').on('click', function (event) {
                    event.preventDefault();
                    let $self = $(this);
                    let id    = $self.data('post-id');
                    let container = $self.closest('.focus-on.container').find('.focus-on__row');
                    let counter = container.children().length;
                    $.ajax({
                        url: wpData.ajaxUrl,
                        data: {
                            action: 'get_more_focus_blocks',
                            counter: counter,
                            id: id,
                        },
                        type: 'POST',
                        success: function (response) {
                            if (response.html.length) {
                                let $response = $(response.html).hide();
                                container.append($response);
                                $response.slideDown();
                            }

                            setTimeout(() => {
                                if (response.quantity === 0) {
                                    $self.slideUp();
                                }
                            }, 500);
                        },
                    });
                });
            });
        })(jQuery);

        /* ======================================================================== */
        (function ($) {
            $(document).ready(function () {
                $('div.numbers__content').each(function () {
                    isElemInView($(this));
                });

                function isElemInView(elem) {
                    if (isScrolledIntoView(elem)) {
                        animate(elem);
                        elem.addClass('counted');
                    } else {
                        window.addEventListener('scroll', function () {
                            if (isScrolledIntoView(elem)) {
                                animate(elem);
                                elem.addClass('counted');
                            }
                        });
                    }
                }

                function isScrolledIntoView(elem) {
                    let docViewTop    = $(window).scrollTop();
                    let docViewBottom = docViewTop + $(window).height();
                    let elemTop       = $(elem).offset().top;
                    let elemBottom    = elemTop + $(elem).height();
                    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
                }

                function commaSeparateNumber(val, separator, pos) {
                    let reg = (pos === 1) ? /(\d+)(\d{1})/ : ((pos === 2) ? /(\d+)(\d{2})/ : /(\d+)(\d{3})/);
                    while (reg.test(val.toString())) {
                        val = val.toString().replace(reg, '$1' + separator + '$2');
                    }
                    return val;
                }

                function animate(emen) {
                    if (!emen.hasClass('counted')) {
                        const counters = emen.find('.numbers__number i');
                        counters.each(function () {
                            let $this     = $(this);
                            let separator = $this.data('separator') || ',';
                            let pos       = $this.data('pos') || 3;
                            $this.prop('Counter', 0).animate({
                                Counter: $(this).text(),
                            }, {
                                duration: 3500,
                                easing: 'swing',
                                step: function (now) {
                                    $(this).text(commaSeparateNumber(Math.ceil(now), separator, pos));
                                },
                            });
                        });
                    }
                }

            });
        })(jQuery);

        /* ======================================================================== */
        class BurgerMenu {
            constructor() {
                this.body                = document.querySelector('body');
                this.menu                = document.querySelector('.menu');
                this.burgerBtn           = document.querySelector('.menu__burger');
                this.menuBody            = document.querySelector('.menu__body');
                this.menuBody.innerHTML += '<div class="menu__close">X</div>';
                this.closeBtn            = document.querySelector('.menu__close');
                this.menuContainer       = document.querySelector('.menu__container');
                this.footerLinks         = document.querySelectorAll('.widget__title');
                this.init();
            }

            closeEvent() {
                this.menu.classList.add('close');
                setTimeout(() => {
                    this.menu.classList.remove('open');
                    this.menu.classList.remove('close');
                    this.body.classList.remove('lock');
                }, 500);
            }

            footerEvent() {
                this.footerLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        link.classList.toggle('active');
                        link.parentElement.querySelector('ul.menu').classList.toggle('open')
                    });
                });
            }

            init() {
                this.burgerBtn.addEventListener('click', () => {
                    this.menu.classList.add('open');
                    this.body.classList.add('lock');
                });

                this.closeBtn.addEventListener('click', () => {
                    this.closeEvent();
                });

                this.menuContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.menu__container') && !e.target.closest('.menu__body')) {
                        this.closeEvent();
                    }
                });

                this.footerEvent();
            }
        }

        return new BurgerMenu();
        /* ======================================================================== */
    },
    finalize() {
        // JavaScript to be fired on all pages, after page specific JS is fired
    },
};
