import Page from '../../classes/Page';  
import Slider from '../../components/Slider';

export default class Booking extends Page {
    constructor() {
       super({
        id: 'booking',
        element: '.booking',
        elements: {
          wrapper: '.booking__wrapper',
          navigation: '.navigation'
        }
    });
    }

    create () {
        super.create();
        this.slider = new Slider();
    }

    destroy() {
        super.destroy();
    }
}