import { lerp, getCursorPos } from './utils';

let cursor = {x: 0, y: 0};
window.addEventListener('mousemove', ev => cursor = getCursorPos(ev));

export default class Cursor {
    DOM = {
        el: null,
        text: null
    }
    renderedStyles = {
        tx: {previous: 0, current: 0, amt: 0.15},
        ty: {previous: 0, current: 0, amt: 0.15},
    };
    bounds;

    constructor(DOM_el) {
        this.DOM.el = DOM_el;
        this.DOM.text = this.DOM.el.querySelector('.cursor__text');
        this.DOM.el.style.opacity = 0;
        this.bounds = this.DOM.el.getBoundingClientRect();

        for (const key in this.renderedStyles) {
            this.renderedStyles[key].amt = this.DOM.el.dataset.amt || this.renderedStyles[key].amt;
        }

        window.addEventListener('mousemove', this.onMouseMoveEv.bind(this));
    }

    onMouseMoveEv() {
        this.renderedStyles.tx.current = cursor.x + 20;
        this.renderedStyles.ty.current = cursor.y - this.bounds.height / 2;
        this.DOM.el.style.opacity = 1;
        requestAnimationFrame(() => this.render());
    }

    updateText(text = '') {
        this.DOM.text.textContent = text;
    }

    render() {
        this.renderedStyles.tx.previous = lerp(this.renderedStyles.tx.previous, this.renderedStyles.tx.current, this.renderedStyles.tx.amt);
        this.renderedStyles.ty.previous = lerp(this.renderedStyles.ty.previous, this.renderedStyles.ty.current, this.renderedStyles.ty.amt);
        this.DOM.el.style.transform = `translateX(${this.renderedStyles.tx.previous}px) translateY(${this.renderedStyles.ty.previous}px)`;
        requestAnimationFrame(() => this.render());
    }
}

const cursorElement = document.querySelector('.cursor');
const cursorInstance = new Cursor(cursorElement);

document.querySelectorAll('[data-cursor-text]').forEach(element => {
    element.addEventListener('mouseover', () => {
        cursorInstance.updateText(element.dataset.cursorText);
    });
    element.addEventListener('mouseout', () => {
        cursorInstance.updateText();
    });
});



