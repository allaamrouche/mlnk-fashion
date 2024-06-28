import Page from 'classes/Page';

export default class Favorites extends Page {
    constructor() {
       super({
        id: 'favorites',
        element: '.favorites',
        elements: {
          wrapper: '.favorites__wrapper',
        
        }

    });
   
    }

    create() {
        super.create();
    }

    destroy() {
        super.destroy();
    }
}