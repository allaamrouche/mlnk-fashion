import Page from '../../classes/Page';  

export default class Main extends Page {
    constructor() {
       super({
        id: 'main',
        element: '.main',
        elements: {
            wrapper: '.main__wrapper',
            navigation: '.navigation',
        }
    });
    }
}