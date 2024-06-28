import Page from '../../classes/Page';  
import Button from '../../animations/Button';

export default class Intro extends Page { 
    constructor() {
     super({
        id: 'intro',
        element: '.intro',
        elements: {
            navigation: '.navigation',
           button: '.intro__link'
        }   
    });
    }

    create() {
        super.create();
        if (this.elements.button) {
            this.button = new Button({
                element: this.elements.button
            });
        }
      
    }

    destroy() {
      super.destroy();
        this.button.removeEventListeners();
    }







}