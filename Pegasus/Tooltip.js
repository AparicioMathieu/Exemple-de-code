class Tooltip {
    /*
     * Applique le système d'infobulles sur les éléments
     * @param {string} selector
     */

    hidden = true;
    static bind(selector) {
        document.querySelectorAll(selector).forEach(element => new Tooltip(element));
    }
    /**@param {HTMLElement} element
     */
    constructor(element) {
        this.element = element;
        this.title = element.getAttribute('title');
        this.tooltip = null;
        this.element.addEventListener('mousemove', this.mouseMove.bind(this));
        this.element.addEventListener('mouseover', this.mouseOver.bind(this));
        this.element.addEventListener('mouseout', this.mouseOut.bind(this));

    }
    mouseOver() {

        let tooltip = this.createTooltip();
        /*
        let width = this.tooltip.offsetWidth;
        let height = this.tooltip.offsetHeight;
        let left = this.Aleft + document.documentElement.scrollLeft + 5;
        let top = this.Aright + document.documentElement.scrollTop + 5;
        tooltip.style.left = left + "px";
        tooltip.style.top = top + "px";
*/
        this.hidden = false;
    }
    mouseOut() {
        this.hidden = "true";
        if (this.tooltip !== null) {
            document.body.removeChild(this.tooltip);
            this.tooltip = null;
        }
    }
    createTooltip() {
        if (this.tooltip === null) {
            let tooltip = document.createElement('div');
            tooltip.innerHTML = this.title;
            tooltip.classList.add('tooltipbat');
            document.body.appendChild(tooltip);
            this.tooltip = tooltip;
        }
        return this.tooltip;
    }
    mouseMove(e) {
        if (this.tooltip !== null) {
            if (e.pageX - document.documentElement.scrollLeft <= 1100 && e.pageY - document.documentElement.scrollTop <= 650) {
                this.tooltip.style.left = e.pageX - 10 + "px";
                this.tooltip.style.top = e.pageY - 30 + "px";
            } else if (e.pageX - document.documentElement.scrollLeft > 1100 && e.pageY - document.documentElement.scrollTop <= 650) {
                this.tooltip.style.left = e.pageX - 510 + "px";
                this.tooltip.style.top = e.pageY - 30 + "px";
            } else if (e.pageX - document.documentElement.scrollLeft <= 1100 && e.pageY - document.documentElement.scrollTop > 650) {
                this.tooltip.style.left = e.pageX - 10 + "px";
                this.tooltip.style.top = e.pageY - 225 + "px";
            } else {
                this.tooltip.style.left = e.pageX - 510 + "px";
                this.tooltip.style.top = e.pageY - 225 + "px";
            }
        }
    }
}


Tooltip.bind('a[title]');
