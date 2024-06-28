import Page from '../../classes/Page';  

export default class Home extends Page {
    constructor() {
       super({
        id: 'home',
        element: '.home',
        elements: {
            wrapper: '.home__wrapper',
            navigation: '.navigation',
        }
    });
    }

    create () {
        super.create();
    
    }

    destroy() {
        super.destroy();
    }
}