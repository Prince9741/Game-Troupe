export class InputHandler {
    constructor(canvas) {
        this.keys = [];
        //instruction by keyboard
        window.addEventListener('keydown', e => {
            if ((e.key == 'ArrowDown' ||
                e.key == 'ArrowUp' ||
                e.key == 'ArrowLeft' ||
                e.key == 'ArrowRight' ||
                e.key == 'Enter'
            ) && this.keys.indexOf(e.key) === -1) {
                this.keys.push(e.key);
            }
           // console.log(e.key, this.key);
        });
        window.addEventListener('keyup', e => {
            if (e.key == 'ArrowDown' ||
                e.key == 'ArrowUp' ||
                e.key == 'ArrowLeft' ||
                e.key == 'ArrowRight' ||
                e.key == 'Enter'){
                this.keys.splice(this.keys.indexOf(e.key), 1);
            }
           // console.log(e.key, this.key);
        });
        //instruction by mouse
        canvas.addEventListener('mousedown', e => {
                this.keys.push("click");
            // console.log("test1");
        });
        canvas.addEventListener('mouseup', e => {
            this.keys.splice(this.keys.indexOf("click"), 1);
            // console.log("test2");
        });
    }
}