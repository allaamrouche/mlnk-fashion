const lerp = (a, b, n) => (1 - n) * a + n * b;

/**
 * Gets the cursor position
 * @param {Event} ev - mousemove event
 */
const getCursorPos = ev => {
    return { 
        x : ev.clientX, 
        y : ev.clientY 
    };
};

export {
   lerp,
   getCursorPos,
};