import Page from '../../classes/Page'; 

import Hover from '../../components/Hover';
import DoubleSlider from '../../components/Double';

export default class Fashion extends Page {
    constructor() {
       super({
        id: 'fashion',
        element: '.fashion',
        elements: {
          wrapper: '.fashion__wrapper',
          navigation: '.navigation-overlay',
          slider: '.slider--bg'
        }

    });
    }

    create () {
      super.create();  
      this.hover = new Hover();

      // Background slider
this.sliderBG = new DoubleSlider(document.querySelector('.double-slider--bg'));

this.sliderFG = new DoubleSlider(document.querySelector('.double-slider--fg'), true);
      
     
    }



    destroy() {
        super.destroy();
    }
}