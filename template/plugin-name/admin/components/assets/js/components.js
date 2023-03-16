document.addEventListener( 'DOMContentLoaded', function() {
    /**
     * DOM elements
     */
    const sliders = document.querySelectorAll('input[type=range]');

    /**
     * Functions
     */
    events();

    /**
     * Events listenners
     */
    function events() {

        sliders.forEach( slider => {

            addValueToCss(slider);
            
            slider.addEventListener( 'input', (e) => {

                let input   = e.target;
                let value   = addValueToCss(input);

                let valueElement = input.nextElementSibling;
                let valueNumElement = valueElement.querySelector('.value-num');

                if ( valueNumElement ) {
                    valueNumElement.innerHTML = value;
                }
            });
        });
    }

    /**
     * Add input value to css
     */
    function addValueToCss( input ) {

        let value = input.value;

        input.parentNode.style.setProperty( '--value', value );
        input.parentNode.style.setProperty( '--min', input.min );
        input.parentNode.style.setProperty( '--max', input.max );

        return value;
    }

});